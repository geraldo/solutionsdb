(function() {
'use strict';

/**
 * Map Service
 */
angular.module('app').factory('mapService', map_service);

var map							= null;		//map
var backgroundMap				= null;		//backgroundMap 1- CartoDB light, 2- CartoDB dark
var backgroundMapUrl			= 'http://{1-4}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png';
var customLayer					= null;		//wms layer
var highLightLayer				= null;		//layer for highlighted town
var highLightSource				= null;		//source for highlifgted polygon
var viewProjection 				= null;
var viewResolution 				= null;
var raster						= null;		//background raster
var filename 					= "mapService.js";
var lastMouseMove				= new Date().getTime()+5000;
var currentLayer				= null;		//current WMS layer
var urlWMS						= null;		//WMS service url
var highLightStyle				= null;		//ol.style for highlighted feature
var currentZoomLevel			= 9;
var mainLayer					= null;		//main layer, in this case dbwater_rend is a layer that contains layers
var layers						= null;		//layers contained in mainLayer (dbwater_rend)
var zoomTrigger					= null;		//zoom level for trigger active layer change
var activeLayer 				= null;
var layersForIndentification 	= null;
var layersStyle					= null;
var renderedLayers				= Array();

map_service.$inject 	= [ 
    '$http',
    '$rootScope'
];

function map_service($http,$rootScope){
	if (!ol) return {};

	function resize(){
		log("resize()");
		if(map){
			map.updateSize();
		}
	}
	

	function init(_urlWMS,_backgroundMap,_layers,_zoomTrigger,_layersForIndentification,_layersStyle){
		log("init("+_urlWMS+","+backgroundMap+","+_layers+","+_zoomTrigger+","+_layersForIndentification+","+_layersStyle+")");
		//****************************************************************
    	//***********************      LOAD MAP    ***********************
    	//****************************************************************
		backgroundMap				= _backgroundMap;
		urlWMS						= _urlWMS;
		zoomTrigger					= _zoomTrigger;
		layers 						= _layers;
		layersForIndentification	= _layersForIndentification;
		layersStyle					= _layersStyle;
		var projection 				= ol.proj.get('EPSG:4326');
		var extent    				= [-1.757,40.306,3.335,42.829];

	
		//background raster
		raster 					= new ol.layer.Tile({ });
		setBackground(backgroundMap);
		//view
		var view = new ol.View({
								projection: projection,
		
		  						//extent: extent,
		  						center: [1.753, 41.600],
		  						zoom: currentZoomLevel
		});
        						

		//map
		map 				= new ol.Map({
						        			/*controls: ol.control.defaults().extend([
												new ol.control.ScaleLine({
												units: 'degrees'
											})
										]),*/
				
								target: 'map'
        					});

        map.addLayer(raster);
        map.setView(view);
		viewProjection = view.getProjection();
		viewResolution = view.getResolution();
				
		//WMS Layer - Provincias
		renderWMS(layers[0],layersStyle[0]);
		//WMS Layer - Municipios 
		renderWMS(layers[1],layersStyle[1]); 
		setActiveLayer(layers[1]);
		//WMS Layer - Sectores 
		renderWMS(layers[2],layersStyle[2]); 
		//WMS Layer - Catastro 
		renderWMS(layers[3],layersStyle[3]); 
		//set style for highlighted geometry
		setHighLightStyle();							

        //****************************************************************
    	//***********************    END LOAD MAP    *********************
    	//****************************************************************       
    	
    	//****************************************************************
    	//***********************     CLICK EVENT  ***********************
    	//****************************************************************
    
		map.on('click', function(evt) {
			log("click coordinates: "+evt.coordinate);
			selectTown(evt.coordinate);
		});

    	//****************************************************************
    	//***********************   END CLICK EVENT  *********************
    	//****************************************************************
    	
    	//****************************************************************
    	//******************  EVENT ZOOM LEVEL CHANGE  *******************
    	//****************************************************************
    	
    	map.on('moveend', function(evt){
	    	var newZoomLevel = map.getView().getZoom();
	    	if (newZoomLevel != currentZoomLevel){
		      currentZoomLevel = newZoomLevel;
		      //log("newZoomLevel: "+newZoomLevel);
		      if(currentZoomLevel>=zoomTrigger){
			      setActiveLayer(layers[2]);
		      }else{
			      setActiveLayer(layers[1]);
		      }

		    }
	    });

	}
		    


	function renderWMS(layer,style){
		log("renderWMS("+layer+")");
		if(currentLayer){
			map.removeLayer(customLayer);
		}
		currentLayer		= layer;
	    //customLayer (WMS service Aqualia)
		var newLayer 		= new ol.layer.Tile({
								source: new ol.source.TileWMS({
												url: 		urlWMS,
												tileOptions: {crossOriginKeyword: 'anonymous'},
												crossOrigin: 'anonymous',
												params: {
															'LAYERS'		: layer,
															'tiled'			: true,
															'tilesorigin'	: -1.757+","+40.306,
															'STYLES'		: style
															
        										},
        										serverType: 'geoserver'      										
        								})
    						});
		map.addLayer(newLayer);
		renderedLayers.push(newLayer)

	}
	
	function setActiveLayer(layerName){
		log("setActiveLayer("+layerName+")");
		if(layers.length>0){
			for (var l = 0; l < layers.length; l++) {
				if(layerName===layers[l]){
					activeLayer = renderedLayers[l];
				}
			}
		}else{
			//default layer "municipios"
			activeLayer = renderedLayers[1];
		}
	}


	function displayFeatureInfo(coordinates) {

		var url		= activeLayer.getSource().getGetFeatureInfoUrl(
							coordinates, viewResolution, viewProjection,
							{'INFO_FORMAT': 'application/json'}
					);
		if (url) {
			//log("url",url);
			var parser = new ol.format.GeoJSON();
			$http.get(url).success(function(response){
				var result = parser.readFeatures(response);
				if(result.length>0){
					//console.log(result[0])
					var returnData	= {
							'nmun_cc'		: result[0].G.nmun_cc,
							'sub_aqp'		: result[0].G.sub_aqp,
							'show'			: true
					}	
				}else{
					var returnData	= {
							'show'			: false
					}
				}
				//Broadcast event for data rendering
				$rootScope.$broadcast('displayToolTip',returnData);
			});		
		}
	}
		
		
    	
	function selectTown(coordinates){
		log("selectTown()",coordinates);
		if(highLightSource){
		    	highLightSource.clear();
		    }
			var url = activeLayer.getSource().getGetFeatureInfoUrl(
											coordinates, viewResolution, viewProjection,
											{'INFO_FORMAT': 'application/json'}
			);
			if (url) {
			   log("url",url);
			    var parser = new ol.format.GeoJSON();
			    $http.get(url+"&feature_count=100").success(function(response){
				   var result = parser.readFeatures(response);
				   if(result.length>0){
						//AQUALIA towns can be indentified					  
					  if(result[0].G.sub_aqp==="AQUALIA"){
						   //************** Highlight town
						   var feature = new ol.Feature(result[0].G.geometry);
						   feature.setStyle(highLightStyle);
						   // Create vector source and the feature to it.
						   highLightSource = new ol.source.Vector();
						   highLightSource.addFeature(feature);
						   // Create vector layer attached to the vector source.
						   highLightLayer = new ol.layer.Vector({source: highLightSource});
						   // Add the vector layer to the map.
						   map.addLayer(highLightLayer);
						   //************** END Highlight town
							
						   //************** Send data to DOM
						   var returnData	= result[0].G;
		
						   //Broadcast event for data rendering
						   $rootScope.$broadcast('featureInfoReceived',returnData);
						   //************** END Send data to DOM
					   }else{
						   log("selectTown sub_aqp not AQUALIA: "+result[0].G.sub_aqp);
					   }
				   }
				});
        	}	
	}
	
	function zoomToTown(extend,coords){
		var extent    	= [extend.coordinates[0][0][0],extend.coordinates[0][0][1],extend.coordinates[0][2][0],extend.coordinates[0][2][1]];
		map.getView().fit(extent, map.getSize()); 
		map.getView().setZoom(map.getView().getZoom()-1);
		selectTown(coords.coordinates);
	}
	
	function setBackground(id){
		log("setBackground("+id+")");
		var source;
		id = parseInt(id);
		if(id===1){
			backgroundMapUrl = 'http://{1-4}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png';
			source 		= new ol.source.XYZ({url:backgroundMapUrl});
		}else if(id===2){
			backgroundMapUrl = 'http://{1-4}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png';
			source 		= new ol.source.XYZ({url:backgroundMapUrl});
		}else if(id===3){
			var projection 			= ol.proj.get('EPSG:4326');
			var projectionExtent 	= projection.getExtent();
			var size = ol.extent.getWidth(projectionExtent) / 512;
			var resolutions 		= new Array(18);
			var matrixIds 			= new Array(18);
			for (var z = 0; z < 18; ++z) {
				// generate resolutions and matrixIds arrays for this WMTS
				resolutions[z] = size / Math.pow(2, z);
				matrixIds[z] = "EPSG:4326:" + z;
			}
			source 					= new ol.source.WMTS({
											url: 'http://www.ign.es/wmts/pnoa-ma',
							                layer: 'OI.OrthoimageCoverage',
											matrixSet: 'EPSG:4326',
											//matrixSet: 'EPSG:3857',
											format: 'image/png',
											projection: projection,
											tileGrid: new ol.tilegrid.WMTS({
											  origin: ol.extent.getTopLeft(projectionExtent),
											  resolutions: resolutions,
											  matrixIds: matrixIds
											}),
											style: 'default'
									 });

		}
		backgroundMap 	= id;
		
		raster.setSource(source);
	}


	//log function
	function log(evt,data){
		$rootScope.$broadcast('logEvent',{evt:evt,extradata:data,file:filename});
	}
	
	function setHighLightStyle(){
		var _myStroke = new ol.style.Stroke({
							color : 'rgba(108, 141, 168, 1)',
							width : 6 
						});
			
		/*var _myFill = new ol.style.Fill({
							color: 'rgba(106, 134, 10, 0.5)'
						});*/
			
		highLightStyle = new ol.style.Style({
							stroke : _myStroke,
							//fill : _myFill
						});
	}
	
	// public API	
	var returnFactory 	= {
					    		map				: map, // ol.Map
								init			: init,
								zoomToTown		: zoomToTown,
								resize			: resize,
								setBackground	: setBackground,
								renderWMS		: renderWMS
						};
	return returnFactory;
}
})();