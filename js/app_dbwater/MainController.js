(function() {
'use strict';

/**
 * Main Controller
 */
angular.module('app').controller('mainController', Controller);

Controller.$inject = [
    'mapService', 
    'loggerService',
    'placesService', 
    'vizdataService',
    '$timeout', 
    '$scope'
];

	function Controller(mapService, loggerService, placesService, vizdataService, $timeout, $scope) {

		//****************************************************************
    	//***********************     APP SETUP      *********************
    	//****************************************************************
		

		var mc 								= this; 
		$scope.legendUrl					= null;
		$scope.backgroundmap				= 1;
		$scope.toolTip						= {};
		$scope.townInfoPanel				= false;			//show/hide panel with town info
		$scope.windowReports				= false;			//show/hide reports panel
		$scope.windowInfoviz				= false;			//show/hide infoviz panel
		$scope.windowReport1				= false;			//show/hide report1 panel
		$scope.vizdataList					= Array();
		var baseHref,
			token,
			urlWMS,
			isMobile,
			mouseX,
			mouseY,
			toolTipInstant,
			layers 							= Array('provincias','municipios','sector','cadastro_parcela'),		//layers contained in dbwater_rend
			layersForIndentification 		= Array('municipios','sector'),		//layers that can be identified
			layersStyle 					= Array('provincias_v6','munis_rendimiento_v1','sector_rendimiento_v1','parceles_v1'),
			zoomTrigger 					= 15,								//zoom level for trigger active layer change
			version							= "1.0.0";
			//$('#info').hide();
		$scope.initApp	= function(_baseHref,_urlWMS,_environment,_token,_isMobile){
		
			baseHref			= _baseHref;
			token				= _token;
			urlWMS				= _urlWMS;
			isMobile			= parseInt(_isMobile);
			//logger service init
			loggerService.init(_environment);
			log("init("+_baseHref+","+urlWMS+","+_environment+","+_token+","+_isMobile+")");
	
			// search initialisation
			placesService.init(baseHref,_token);
			
			// map initialisation
			mapService.init(urlWMS,$scope.backgroundmap,layers,zoomTrigger,layersForIndentification,layersStyle);

			// dataviz initialisation
			vizdataService.init(baseHref,_token);
			//fill testdata on page load
			vizdataService.dbWaterListVolumenes().success(function(data) {
				log("init() dbWaterListVolumenes success",data);
				if(data.total>0){
					$scope.vizdataList 			= data.message;
				}
			})
			.error(function (error) {
			   log("init() error in dbWaterListVolumenes");
		    });	


			//gauges
			$scope.valueFontColor 		= '#6A90A6';
            $scope.min 					= 0;
            $scope.max 					= 100;
            $scope.width 				= 80;
            $scope.height 				= 80;
            $scope.valueMinFontSize 	= 80;
            $scope.titleMinFontSize 	= 48;
            $scope.labelMinFontSize 	= 9;
            $scope.minLabelMinFontSize 	= 9;
            $scope.maxLabelMinFontSize	= 9;
            $scope.hideValue 			= false;
            $scope.hideMinMax 			= true;
            $scope.hideInnerShadow 		= false;
            $scope.relativeGaugeSize 	= false;
            $scope.gaugeWidthScale 		= 1;
            $scope.gaugeColor 			= 'white';
            $scope.showInnerShadow 		= true;
            $scope.shadowOpacity 		= 0.5;
            $scope.shadowSize 			= 1;
            $scope.shadowVerticalOffset = 1;
            $scope.levelColors 			= ['#00FFF2', '#668C54', '#FFAF2E', '#FF2EF1'];
            $scope.customSectors 		= [
                {
                    color: "#ff0000",
                    lo: 0,
                    hi: 33
                },
                {
                    color: "#FBA40D",
                    lo: 33,
                    hi: 66
                },
                {
                    color: "#3d773d",
                    lo: 66,
                    hi: 100
                }
            ];
            $scope.noGradient 			= false;

            $scope.startAnimationTime 	= 1000;
            $scope.startAnimationType 	= "bounce";
            $scope.refreshAnimationTime = undefined;
            $scope.refreshAnimationType = undefined;
            $scope.donut 				= true;
            $scope.donutAngle 			= 90;
            $scope.counter 				= true;
            $scope.decimals 			= 0;
            $scope.symbol 				= '%';
            $scope.formatNumber 		= true;
            $scope.humanFriendly 		= true;
            $scope.humanFriendlyDecimal = true;
            $scope.textRenderer = function (value) {
                return value+"%";
            };
			$scope.valueDay				= 0;
			$scope.valueWeek			= 0;
			$scope.valueMonth			= 0;

			
			
			
			
		}
		
		$scope.searchResultsContainer = window.document.querySelector('.window.search');
		

		//****************************************************************
    	//********************      END APP SETUP      *******************
    	//****************************************************************

		//****************************************************************
    	//*********************      SELECT TOWN       *******************
    	//****************************************************************
	
		$scope.$on('featureInfoReceived', function(event, data) {

			log("featureInfoReceived",data);
			$scope.townName 			= data.nmun_aq;
			$scope.valueDay				= 0;
			$scope.valueWeek			= 0;
			$scope.valueMonth			= 0;
			
			$scope.sum_rebuig			= 0;
  			$scope.sum_suministrat		= 0;
  			$scope.sum_aportat			= 0;
            
            placesService.dbWaterGetTown(data.cmuni5_dgc,null,null).success(function(data) {
				log("dbWaterGetTown success: ",data);
				if(data.status==="Accepted"){  
					//gauges "rendimiento téorico"
					if(typeof data.message.day!="undefined"){
						$scope.valueDay				= data.message.day;
					}
					if(typeof data.message.week!="undefined"){
						$scope.valueWeek			= data.message.week;
					}
					if(typeof data.message.month!="undefined"){
						$scope.valueMonth			= data.message.month;
					}

					// test values
					$scope.valueDay = 80;
					$scope.valueWeek = 20;
					
					// bar chart fitxa "tendencia últimos 7 días"
					$scope.labels_fitxa_rend = ['28-10-2016', '29-10-2016', '30-10-2016', '31-10-2016', '01-11-2016', '02-11-2016', '03-11-2016'];
					$scope.series_fitxa_rend = ['Rendimiento'];
					$scope.data_fitxa_rend = [
									[65, 59, 80, 81, 56, 55, 40]
					];
					$scope.options_fitxa_rend = {
				        scales: {
				            xAxes: [{
				                display: false
				            }]
				        }
				    };
					
					// line chart fitxa "Volumenes"
					$scope.labels_fitxa_vol = ["January", "February", "March", "April", "May", "June", "July"];
  					$scope.series_fitxa_vol = ['Aportado', 'Suministrado', 'Perdido'];
					$scope.data_fitxa_vol = [
						[65, 59, 80, 81, 56, 55, 40],
						[28, 48, 40, 19, 86, 27, 90],
						[8, 4, 0, 1, 6, 7, 9]
					];
					$scope.options_fitxa_vol = {
				        scales: {
				            xAxes: [{
				                display: false
				            }]
				        }
				    };
 
 					// line chart fitxa detalle
 					$scope.labels_expedient = ["January", "February", "March", "April", "May", "June", "July"];
  					$scope.series_expedient = ['Aportado', 'Suministrado', 'Perdido'];
					$scope.data_expedient = [
						[65, 59, 80, 81, 56, 55, 40],
						[28, 48, 40, 19, 86, 27, 90],
						[8, 4, 0, 1, 6, 7, 9]
					];
					$scope.options_expedient = {};

  					if(typeof data.message.sum_rebuig!="undefined"){
	  					$scope.sum_rebuig			= data.message.sum_rebuig;
  					}
  					if(typeof data.message.sum_suministrat!="undefined"){
  						$scope.sum_suministrat		= data.message.sum_suministrat;
  					}
  					if(typeof data.message.sum_aportat!="undefined"){
  						$scope.sum_aportat			= data.message.sum_aportat;
  					}

  					//volumenes
  					if(typeof data.message.volumenes!="undefined"){
  						//console.log(data.message.volumenes);
  						
  						$scope.series_vol = ['Aportado', 'Suministrado', 'Perdido'];
  						$scope.labels_vol = [];
  						$scope.data_vol = [];
  						$scope.options_vol = {
					        scales: {
					            xAxes: [{
					                display: false
					            }]
					        }
					    };

  						var vol_aportat = [],
  							vol_suministrat = [],
  							vol_perdut = [];

  						$.each(data.message.volumenes, function(i, item) {
  							$scope.labels_vol.push(item.data);
	  						//vol_aportat.push(item.sum_aportat);
	  						vol_suministrat.push(item.sum_suministrat);
	  						vol_perdut.push(item.sum_rebuig);
						});

						$scope.data_vol.push(vol_aportat);
						$scope.data_vol.push(vol_suministrat);
						$scope.data_vol.push(vol_perdut);
  					}

					//show window
					$scope.townInfoPanel		= true;
					$("#townInfoPanel").show();

				}else{
						
				}
			}).error(function (error) {
				  log("error in dbWaterGetTown");
			});			

	    });

		//****************************************************************
    	//*********************    END SELECT TOWN     *******************
    	//****************************************************************

		
    	//****************************************************************
    	//***********************     CONFIGURATION    *******************
    	//****************************************************************
    	
		$scope.changeBackgroundMap	= function(){
			log("changeBackgroundMap: "+$scope.backgroundmap);
			mapService.setBackground($scope.backgroundmap);
		}

    	//****************************************************************
    	//***********************  END CONFIGURATION    ******************
    	//****************************************************************
		

		//****************************************************************
    	//***********************        SEARCH        *******************
    	//****************************************************************
	    
		$scope.getTownsFromName	= function(val) {
			log("getTownsFromName("+val+")");
			return placesService.getTownsFromName(val,"dbWater");
		};
				
		$scope.townSelected	= function ($item, $model, $label){
			log("townChanged: "+$item);
			placesService.getTownByName($item).success(function(data) {
				log("townSelected: ",data);
				mapService.zoomToTown(JSON.parse(data.message.bbox),JSON.parse(data.message.coords));
			})
			.error(function (error) {
			  log("error in townSelected");
		    });		
		}		
		//****************************************************************
    	//***********************       END SEARCH     *******************
    	//****************************************************************

		//****************************************************************
    	//***********************        REPORTS       *******************
    	//****************************************************************

		$scope.toggleReports 	= function(what){
			log("toggleReports("+what+")");
			if(parseInt(what)===0){
				$scope.windowReports = false;
			}else{
				$scope.windowReports = true;
			}
		}

		$scope.toggleInfoviz 	= function(what){
			log("toggleInfoviz("+what+")");
			if(parseInt(what)===0){
				$scope.windowInfoviz = false;
			}else{
				$scope.windowInfoviz = true;
			}
		}

		$scope.toggleReport 	= function(what, num){
			log("toggleReport"+num+"("+what+")");
			if(parseInt(what)===0){
				$scope.windowReport1 = false;
			}else{
				$scope.windowReport1 = true;
			}
			
			
		}
		//****************************************************************
    	//***********************      END REPORTS     *******************
    	//****************************************************************


		//****************************************************************
    	//***********************   HELPER METHODS   *********************
    	//****************************************************************
		
		//log event
		$scope.$on('logEvent', function (event, data){
			if(data.extradata){
				log(data.evt,data.extradata);
			}else{
				log(data.file+" "+data.evt);	
			}			
		});
		
		function log(evt,extradata){
			if(extradata){
				loggerService.log("app_dbwater -> MainController.js v."+version,evt,extradata);
			}else{
				loggerService.log("app_dbwater -> MainController.js v."+version,evt);	
			}			
		}
			
		//****************************************************************
    	//********************   END HELPER METHODS  *********************
    	//****************************************************************	
	}
})();