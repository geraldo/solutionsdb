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
		$scope.sectorInfoPanel				= false;			//show/hide panel with sector info
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
			//layers 							= Array('provincias','municipios','sector','cadastro_parcela'),		//old geoserver!
			layers 							= Array('Provincias','Municipios rendimiento','Municipios otros','Sectores','Parcelas'),		//layers contained in dbwater_rend
			layersForIndentification 		= Array('Municipios','Sector'),		//layers that can be identified
			layersStyle 					= Array('provincias_v6','munis_rendimiento_v1','sector_rendimiento_v1','parceles_v1'),	//old geoserver!
			zoomTrigger 					= 14,								//zoom level for trigger active layer change
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
			$scope.townName = data.nmun_aq;
			if (data.nmun_aq.length > 25) $scope.townName = data.nmun_aq.substring(0,22)+"...";
			$scope.valueDay				= 0;
			$scope.valueWeek			= 0;
			$scope.valueMonth			= 0;
			
			$scope.sum_rebuig			= 0;
  			$scope.sum_suministrat		= 0;
  			$scope.sum_aportat			= 0;

			//console.log(placesService.dbWaterTest(data.cmuni5_dgc,data.codi_service,null,null));			
            
            placesService.dbWaterGetTown(data.cmuni5_dgc,data.codi_service,null,null).success(function(data) {
				log("dbWaterGetTown success: ",data);
				if(data.status==="Accepted"){  
					//performance
					if(typeof data.message.performance!="undefined"){
						$scope.valueHigh	= Math.round(parseFloat(data.message.performance.high)*100);
						$scope.valueLow		= Math.round(parseFloat(data.message.performance.low)*100);
						$scope.valueGlobal	= Math.round(parseFloat(data.message.performance.global)*100);
					} else {
						//test values for service != 08MDR
						$scope.valueHigh	= 0.80*100;
						$scope.valueLow		= 0.50*100;
						$scope.valueGlobal	= 0.65*100;
					}

					//info
					if(typeof data.message.info!="undefined"){
						$scope.valueSupplied	= parseFloat(data.message.info.supplied).toFixed(2);
						$scope.valueDistributed	= parseFloat(data.message.info.distributed).toFixed(2);
						$scope.valueLoses		= parseFloat(data.message.info.loses).toFixed(2);
						$scope.valueAvgFlow		= parseFloat(data.message.info.avg_flow).toFixed(2);
						$scope.valueNightFlow	= parseFloat(data.message.info.night_flow).toFixed(2);
						$scope.valueVolumePrice	= parseFloat(data.message.info.volume_price).toFixed(2);
					} else {
						//test values for service != 08MDR
						$scope.valueSupplied	= 243;
						$scope.valueDistributed	= 183;
						$scope.valueLoses		= 50;
						$scope.valueAvgFlow		= 10.125;
						$scope.valueNightFlow	= 18;
						$scope.valueVolumePrice	= 0;
					}

					// bar chart fitxa "tendencia últimos 7 días"
					if(typeof data.message.tendency!="undefined"){
						$scope.labels_fitxa_rend = getLast7Dates();
						$scope.data_fitxa_rend = [
							data.message.tendency
						];
						console.log(data.message.tendency);
					} else {
						//test values
						$scope.labels_fitxa_rend = ['28-10-2016', '29-10-2016', '30-10-2016', '31-10-2016', '01-11-2016', '02-11-2016', '03-11-2016'];
						$scope.data_fitxa_rend = [
							[65, 59, 80, 81, 56, 55, 40]
						];
					}
					$scope.series_fitxa_rend = ['Rendimiento'];
					$scope.options_fitxa_rend = {
				        scales: {
				            xAxes: [{
				                display: false
				            }]
				        },
				        tooltips: {
				        	titleFontSize: 10,
				        	bodyFontSize: 10,
				        	footerFontSize: 10,
				        	titleMarginBottom: 2,
				        	bodySpacing: 2,
				        	xPadding: 5,
				        	yPadding: 5
				        }
				    };

					// line chart fitxa "Volumenes"
					if(typeof data.message.volumenes7days!="undefined"){
						$scope.labels_fitxa_vol = getLast7Dates();
						$scope.data_fitxa_vol = data.message.volumenes7days;
						console.log(data.message.volumenes7days);
					} else {
						//test data
						$scope.labels_fitxa_vol = ["January", "February", "March", "April", "May", "June", "July"];
						$scope.data_fitxa_vol = [
							[65, 59, 80, 81, 56, 55, 40],
							[28, 48, 40, 19, 86, 27, 90],
							[8, 4, 0, 1, 6, 7, 9]
						];
					}
  					$scope.series_fitxa_vol = ['Suministrado', 'Aportado', 'Perdido'];
					$scope.options_fitxa_vol = {
				        scales: {
				            xAxes: [{
				                display: false
				            }]
				        },
				        tooltips: {
				        	position: 'nearest',
				        	titleFontSize: 10,
				        	bodyFontSize: 10,
				        	footerFontSize: 10,
				        	titleMarginBottom: 2,
				        	bodySpacing: 2,
				        	xPadding: 5,
				        	yPadding: 5
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
					$("#sectorInfoPanel").hide();

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
    	//*********************      SELECT SECTOR       *******************
    	//****************************************************************
	
		$scope.$on('featureSectorInfoReceived', function(event, data) {

			log("featureSectorInfoReceived",data);
			$scope.sectorName = data.nmun_aq;
			if (data.nmun_aq.length > 25) $scope.sectorName = data.nmun_aq.substring(0,22)+"...";
			$scope.sectorName = "Sector 20";
			$scope.valueDay				= 0;
			$scope.valueWeek			= 0;
			$scope.valueMonth			= 0;
			
			$scope.sum_rebuig			= 0;
  			$scope.sum_suministrat		= 0;
  			$scope.sum_aportat			= 0;
            
            placesService.dbWaterGetSector(data.cmuni5_dgc,data.codi_service,null,null).success(function(data) {
				log("dbWaterGetSector success: ",data);
				//if(data.status==="Accepted"){ 
				if (true) { 
					//performance
					if(typeof data.message.performance!="undefined"){
						$scope.valueHigh	= parseFloat(data.message.performance.high)*100;
						$scope.valueLow		= parseFloat(data.message.performance.low)*100;
						$scope.valueGlobal	= parseFloat(data.message.performance.global)*100;
					} else {
						//test values for service != 08MDR
						$scope.valueHigh	= 0.80*100;
						$scope.valueLow		= 0.50*100;
						$scope.valueGlobal	= 0.65*100;
					}

					//info
					if(typeof data.message.info!="undefined"){
						$scope.valueSupplied	= parseFloat(data.message.info.supplied);
						$scope.valueDistributed	= parseFloat(data.message.info.distributed);
						$scope.valueLoses		= parseFloat(data.message.info.loses);
						$scope.valueAvgFlow		= parseFloat(data.message.info.avg_flow);
						$scope.valueNightFlow	= parseFloat(data.message.info.night_flow);
						$scope.valueVolumePrice	= parseFloat(data.message.info.volume_price);
					} else {
						//test values for service != 08MDR
						$scope.valueSupplied	= 243;
						$scope.valueDistributed	= 183;
						$scope.valueLoses		= 50;
						$scope.valueAvgFlow		= 10.125;
						$scope.valueNightFlow	= 18;
						$scope.valueVolumePrice	= 0;
					}

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
				        },
				        tooltips: {
				        	titleFontSize: 10,
				        	bodyFontSize: 10,
				        	footerFontSize: 10,
				        	titleMarginBottom: 2,
				        	bodySpacing: 2,
				        	xPadding: 5,
				        	yPadding: 5
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
				        },
				        tooltips: {
				        	position: 'nearest',
				        	titleFontSize: 10,
				        	bodyFontSize: 10,
				        	footerFontSize: 10,
				        	titleMarginBottom: 2,
				        	bodySpacing: 2,
				        	xPadding: 5,
				        	yPadding: 5
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
					$scope.sectorInfoPanel		= true;
					$("#sectorInfoPanel").show();
					$("#townInfoPanel").hide();

				}else{
						
				}
			}).error(function (error) {
				  log("error in dbWaterGetSector");
			});			

	    });

		//****************************************************************
    	//*********************    END SELECT SECTOR     *******************
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
		
		//get dates
		function getLast7Dates() {
			var dates = [];
			var date = new Date();
			for (var i=1; i<=7; i++) {
				date.setDate(date.getDate() - 1);
				var month = date.getMonth()+1;
				dates.push(date.getDate()+"-"+month+"-"+date.getFullYear());
			}
			return dates;
		}

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