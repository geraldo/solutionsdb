<!DOCTYPE html>
<html>
	<head>
		<title>DBWater</title>
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $baseHref?>/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="<?php echo $baseHref?>/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo $baseHref?>/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo $baseHref?>/manifest.json">
        <link rel="mask-icon" href="<?php echo $baseHref?>/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="js/libs/angular-datatables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="tpl/default/css/dbwater.css" type="text/css" charset="utf-8">
		<link rel="stylesheet" href="tpl/default/css/animate.css" type="text/css" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8" />
	</head>
	<body>
    	
        <div id="angularAppContainer" ng-app="app" ng-controller="mainController as mc" ng-init="initApp('<?php echo $baseHref; ?>','<?php echo $urlWMS; ?>','<?php echo $env; ?>','<?php echo $token; ?>','<?php echo $isMobile; ?>')">
            
            <div class="window main">
                <div class="content">
                    <ul id="menu" class="list-unstyled list-inline">
                        <li><a href="<?php echo $baseHref?>home.php"><img src="tpl/default/img/dbwater/logo.jpg" class="hidden-xs" /><img src="tpl/default/img/dbwater/logo-xs.jpg" class="visible-xs" /></a></li>
                        <li><div class="vertical-line"></div></li>
                        <li><a href="#" class="reports"><img src="tpl/default/img/dbwater/ic-expedient.jpg" /></a></li>
                        <li><a href="#" class="infoviz" ng-click="toggleReports(1)"><img src="tpl/default/img/dbwater/ic-graphic.jpg" /></a></li>
                        <li><a href="#" class="layers"><img src="tpl/default/img/dbwater/ic-layers.jpg" /></a></li>
                        <li><a href="#" class=""><img src="tpl/default/img/dbwater/ic-config.jpg" /></a></li>
                        <li><a href="#" class=""><img src="tpl/default/img/dbwater/ic-danger.jpg" /></a></li>
                        <li><a href="#" class="search"><img src="tpl/default/img/dbwater/ic-search.jpg" /></a></li>
                    </ul>
            
                </div>
            </div>
            
            <div class="window reports">
                <h2>
                    <img src="tpl/default/img/dbwater/ic-file.png" class="ic" />
	                Informes a generar
	                <a href="#" class="pull-right" ng-click="toggleReports(0)"><i class="fa fa-fw fa-times"></i></a>
	            </h2>
	            <div class="content">
    	            <ul id="list-reports" class="list-unstyled">
        	            <li><span class="number">1</span> Informe de rendimientos por sector.               <a class="report1" href="#"><img src="tpl/default/img/dbwater/ic-play.png" /></a></li>
        	            <li><span class="number">2</span> Informe de rendimientos por municipio.            <a href="#"><img src="tpl/default/img/dbwater/ic-play.png" /></a></li>
        	            <li><span class="number">3</span> Volumenes suministrados / Registros / Pérdidas.   <a href="#"><img src="tpl/default/img/dbwater/ic-play.png" /></a></li>
        	            <li><span class="number">4</span> Contadores.                                       <a href="#"><img src="tpl/default/img/dbwater/ic-play.png" /></a></li>
        	            <li><span class="number">5</span> Proyección.                                       <a href="#"><img src="tpl/default/img/dbwater/ic-play.png" /></a></li>
        	            <li><span class="number">6</span> Informe de rendimientos ALTA.                     <a href="#"><img src="tpl/default/img/dbwater/ic-play.png" /></a></li>
    	            </ul>
	            </div>
            </div>
            
            <div class="window report1">
                <h2>
                    <img src="tpl/default/img/dbwater/ic-file.png" class="ic" />
                    Informe de rendimientos por sector.
                    <a href="#" class="pull-right" ng-click="toggleReport(0,1)"><i class="fa fa-fw fa-times"></i></a>
                </h2>
                <div class="content">
                    <table id="report1" class="display">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>service_code</th>
                                <th>data</th>
                                <th>sum_suministrat</th>
                                <th>sum_aportat</th>
                                <th>sum_rebuig</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="window infoviz">
                <h2>
                    <img src="tpl/default/img/dbwater/ic-file.png" class="ic" />
                    Gráficas
                    <a href="#" class="pull-right" ng-click="toggleInfoviz(0)"><i class="fa fa-fw fa-times"></i></a>
                </h2>
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">

                            <p class="infoviz-title">Fecha inicio:</p>
                            <div id="infoviz-datepicker1"></div>
                            <p class="infoviz-title">Fecha final:</p>
                            <div id="infoviz-datepicker2"></div>

                            <p class="infoviz-title">Servicio:</p>
                            <select id="infoviz-municipi">
                              <option value="Molins de Rei" data-codi="08MDR" checked="checked">Molins de Rei</option>
                            </select>
                            

                            <p class="infoviz-title">Sector:</p>
                            <select id="infoviz-sector">
                              <option value=""></option>
                            </select>
                            

                            <p class="infoviz-title">Dato:</p>
                            <select id="infoviz-data">
                              <option value=""></option>
                              <option value="sum_suministrat">Suministrado</option>
                              <option value="sum_aportat">Aportado</option>
                              <option value="sum_rebuig">Perdido</option>
                            </select>
                            
                        </div>

                        <div class="col-xs-9">
                            <div id="infoviz-tag">
                                <a href="#" class="btn btn-sm btn-primary infoviz-comparativa">Comparativa</a>
                            </div>
                            <!--<canvas id="infoviz-linechart" width="600" height="400"></canvas>-->
                            <canvas id="infoviz-linechart1" width="600" height="340" class="chart chart-line"></canvas> 
                            <canvas id="infoviz-linechart2" width="600" height="100" class="chart chart-line"></canvas> 

                        </div>

                    </div>
                </div>
            </div>

            <div class="window right-side ng-cloak" ng-cloak ng-show="townInfoPanel" id="townInfoPanel">
                <h2>
	                {{townName}}
	                <a href="#" class="pull-right"><i class="fa fa-fw fa-times"></i></a>
	            </h2>
                <div class="content">
                    <h3>Rendimiento</h3>
                   
                    <div class="row list-of-donuts">
                        <div class="col-xs-6" align="center">
	                        <div justgage style="width:80px;height:70px;margin-top:-10px;" titlePosition="below"
		                         	value="{{valueHigh}}" value-font-color="{{valueFontColor}}"
									width="{{width}}" height="{{height}}" relative-gauge-size="{{relativeGaugeSize}}"
									value-min-font-size="{{valueMinFontSize}}" title-min-font-size="{{titleMinFontSize}}"
									label-min-font-size="{{labelMinFontSize}}" min-label-min-font-size="{{minLabelMinFontSize}}"
									maxLabelMinFontSize="{{maxLabelMinFontSize}}"
									min="{{min}}" max="{{max}}"
									hide-min-max="{{hideMinMax}}" hide-value="{{hideValue}}" hide-inner-shadow="{{hideInnerShadow}}"
									gauge-width-scale="{{gaugeWidthScale}}" gauge-color="{{gaugeColor}}"
									show-inner-shadow="{{showInnerShadow}}" shadow-opacity="{{shadowOpacity}}"
									shadow-size="{{shadowSize}}" shadow-vertical-offset="{{shadowVerticalOffset}}"
									level-colors="{{levelColors}}" custom-sectors="{{customSectors}}" no-gradient="{{noGradient}}"
									start-animation-time="{{startAnimationTime}}" start-animation-type="{{startAnimationType}}"
									refresh-animation-time="{{refreshAnimationTime}}" refresh-animation-type="{{refreshAnimationType}}"
									donut="{{donut}}" donut-start-angle="{{donutStartAngle}}"
									counter="{{counter}}" decimals="{{decimals}}" symbol="{{symbol}}" format-number="{{formatNumber}}"
									human-friendly="{{humanFriendly}}" human-friendly-decimal="{{humanFriendlyDecimal}}"
									text-renderer="textRenderer">									
								</div>
                           	<p class="title">Alta</p>
                        </div>
                        <div class="col-xs-6" align="center">
                            	<div justgage style="width:80px;height:70px;margin-top:-10px;" titlePosition="below"
									value="{{valueLow}}" value-font-color="{{valueFontColor}}"
									width="{{width}}" height="{{height}}" relative-gauge-size="{{relativeGaugeSize}}"
									value-min-font-size="{{valueMinFontSize}}" title-min-font-size="{{titleMinFontSize}}"
									label-min-font-size="{{labelMinFontSize}}" min-label-min-font-size="{{minLabelMinFontSize}}"
									maxLabelMinFontSize="{{maxLabelMinFontSize}}"
									min="{{min}}" max="{{max}}"
									hide-min-max="{{hideMinMax}}" hide-value="{{hideValue}}" hide-inner-shadow="{{hideInnerShadow}}"
									gauge-width-scale="{{gaugeWidthScale}}" gauge-color="{{gaugeColor}}"
									show-inner-shadow="{{showInnerShadow}}" shadow-opacity="{{shadowOpacity}}"
									shadow-size="{{shadowSize}}" shadow-vertical-offset="{{shadowVerticalOffset}}"
									level-colors="{{levelColors}}" custom-sectors="{{customSectors}}" no-gradient="{{noGradient}}"
									start-animation-time="{{startAnimationTime}}" start-animation-type="{{startAnimationType}}"
									refresh-animation-time="{{refreshAnimationTime}}" refresh-animation-type="{{refreshAnimationType}}"
									donut="{{donut}}" donut-start-angle="{{donutStartAngle}}"
									counter="{{counter}}" decimals="{{decimals}}" symbol="{{symbol}}" format-number="{{formatNumber}}"
									human-friendly="{{humanFriendly}}" human-friendly-decimal="{{humanFriendlyDecimal}}"
									text-renderer="textRenderer">									
								</div>
                            <p class="title">Baja</p>
                        </div>
                    </div>
                    <h3>Tendéncia del rendimiento</h3>
					<canvas id="fitxa-barchart" height="120" class="chart chart-bar" chart-data="data_fitxa_rend" chart-labels="labels_fitxa_rend" chart-series="series_fitxa_rend" chart-options="options_fitxa_rend"></canvas>
                    <h3>Información</h3>
                    <div class="list-with-icon">
                        <div class="icon-container">
	                        
                            <img src="tpl/default/img/dbwater/ic-water.jpg" class="icon" />
                        </div>
                        <ul class="list-unstyled list-left-bordered">
                            <li>Volumen aportado <span class="pull-right custom-badge">{{valueDistributed}}</span></li>
                            <li>Volumen suministrado <span class="pull-right custom-badge">{{valueSupplied}}</span></li>
                            <li>Volumen de pérdida <span class="pull-right custom-badge">{{valueLoses}}</span></li>
                            <li>Caudal medio <span class="pull-right custom-badge">{{valueAvgFlow}}</span></li>
                            <li>Caudal mínimo nocturno <span class="pull-right custom-badge">{{valueNightFlow}}</span></li>
                            <li>€ por m³ <span class="pull-right custom-badge">{{valueVolumePrice}}</span></li>
                        </ul>
                    </div>
                    <h3>Volumenes</h3>
                    <canvas id="fitxa-linechart" height="150" class="chart chart-line" chart-data="data_fitxa_vol" chart-labels="labels_fitxa_vol" chart-series="series_fitxa_vol" chart-options="options_fitxa_vol" chart-dataset override="datasetOverride"></canvas> 
                    <hr />
                    <a href="#" class="btn btn-sm btn-primary open-expedient">Ficha</a> Ver ficha completa
                </div>
            </div>
            
            <div class="window search">
                <form>
                    <label>Municipio <i ng-show="loadingLocations" class="glyphicon glyphicon-refresh"></i></label>
                    <input
                        class="form-control"
						type="text" 
						ng-model="asyncSelected" 
						typeahead-min-length="3" 
						placeholder="" 
						uib-typeahead="name for name in getTownsFromName($viewValue,'dbWater')" 
						typeahead-on-select="townSelected($item, $model, $label)"
						typeahead-loading="loadingLocations" 
						typeahead-no-results="noResults"
                        typeahead-append-to="searchResultsContainer"
                        typeahead-popup-template-url="customPopupTemplate.html">
                    <script type="text/ng-template" id="customPopupTemplate.html">
                        <div class="custom-popup-wrapper"
                            ng-style="{top: position().top+'px', left: position().left+'px'}"
                            style="display: block;"
                            ng-show="isOpen() && !moveInProgress"
                            aria-hidden="{{!isOpen()}}">                        
                            <ul class="list-unstyled" role="listbox">
                                <li ng-repeat="match in matches track by $index" ng-class="{active: isActive($index) }"
                                ng-mouseenter="selectActive($index)" ng-click="selectMatch($index)" role="option" id="{{::match.id}}">
                                    <a href="#" uib-typeahead-match index="$index" match="match" query="query" template-url="templateUrl"></a>
                                </li>
                            </ul>
                        </div>
                    </script>
                </form>
                <div class="no-results" ng-show="noResults">
                    <?php echo NO_RESULTS; ?>
                </div>		
            </div>
            
            <div class="window layers">
                <h2>
                    <img src="tpl/default/img/dbwater/ic-layers-20.jpg" class="ic" />
                    Gestor de capas
                    <a href="#" class="pull-right"><i class="fa fa-fw fa-times"></i></a>
                </h2>
                <div class="content">
                    <h3>Capas temáticas</h3>
                    <ul class="list-unstyled layers">
                        <li class="open">
                            <a href="#">
                                <i class="fa fa-lg fa-fw fa-caret-down"></i>
                                <i class="fa fa-lg fa-fw fa-caret-right"></i>
                            </a>
                            <input type="checkbox" />  Barcelona
                            <ul class="list-unstyled">
                                <li class="open">
                                    <a href="#">
                                        <i class="fa fa-lg fa-fw fa-caret-down"></i>
                                        <i class="fa fa-lg fa-fw fa-caret-right"></i>
                                    </a>
                                    <input type="checkbox" /> Molins de rey
                                    <ul class="list-unstyled">
                                        <li><input type="checkbox" /> Sensores</li>
                                        <li><input type="checkbox" /> Depósito</li>
                                        <li><input type="checkbox" /> Red de agua</li>
                                    </ul>
                                </li>
                                <li class="open">
                                    <a href="#">
                                        <i class="fa fa-lg fa-fw fa-caret-down"></i>
                                        <i class="fa fa-lg fa-fw fa-caret-right"></i>
                                    </a>
                                    <input type="checkbox" /> Tordera
                                    <ul class="list-unstyled">
                                        <li><input type="checkbox" /> Sensores</li>
                                        <li><input type="checkbox" /> Depósito</li>
                                        <li><input type="checkbox" /> Red de agua</li>
                                    </ul>
                                </li>
                                <li class="closed">
                                    <a href="#">
                                        <i class="fa fa-lg fa-fw fa-caret-down"></i>
                                        <i class="fa fa-lg fa-fw fa-caret-right"></i>
                                    </a>
                                    <input type="checkbox" /> Sant Fost de Capmcentelles
                                    <ul class="list-unstyled">
                                        <li><input type="checkbox" /> Sensores</li>
                                        <li><input type="checkbox" /> Depósito</li>
                                        <li><input type="checkbox" /> Red de agua</li>
                                    </ul>
                                </li>
                                <li class="closed">
                                    <a href="#">
                                        <i class="fa fa-lg fa-fw fa-caret-down"></i>
                                        <i class="fa fa-lg fa-fw fa-caret-right"></i>
                                    </a>
                                    <input type="checkbox" /> Sant Andreu de la Barca
                                    <ul class="list-unstyled">
                                        <li><input type="checkbox" /> Sensores</li>
                                        <li><input type="checkbox" /> Depósito</li>
                                        <li><input type="checkbox" /> Red de agua</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    
                    <h3>Capas de referéncia</h3>
                    <ul class="list-unstyled">
                        <li>
							<input type="radio" name="backgroundmap" id="backgroundmap_1" value="1" ng-model="backgroundmap" ng-change="changeBackgroundMap()" checked>
							<?php echo BACKGROUND_MAP_1; ?>
						</li>
                        <li>
                        	<input type="radio" name="backgroundmap" id="backgroundmap_2" value="2" ng-model="backgroundmap" ng-change="changeBackgroundMap()">
							<?php echo BACKGROUND_MAP_2; ?>
						</li>
                        <li>
                        	<input type="radio" name="backgroundmap" id="backgroundmap_3" value="3" ng-model="backgroundmap" ng-change="changeBackgroundMap()">
							PNOA
						</li>
                    </ul>
                </div>
            </div>
            
            <div class="window expedient">
                <h2>
                    Ficha del municipio: {{townName}}
                    <a href="#" class="pull-right"><i class="fa fa-fw fa-times"></i></a>
                </h2>
                <div class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="spacer-10"></div>
                            <div class="row gutter-20">
                                <div class="col-xs-3 sepparated">
                                    <ul class="list-unstyled list-expedient-location">
                                        <li><strong>Provincia: </strong> Barcelona</li>
                                        <li><strong>Municipio: </strong> Molins de Rei</li>
                                    </ul>
                                </div>
                                <div class="col-xs-3 sepparated">
                                    <ul class="list-unstyled list-expedient-sumatory">
                                        <li><img src="tpl/default/img/dbwater/ic-people.jpg" /> Núm. de clientes <span class="custom-badge pull-right">3200</span></li>
                                        <li><img src="tpl/default/img/dbwater/ic-pipe.jpg" /> Km. de red <span class="custom-badge pull-right">6700</span></li>
                                    </ul>
                                </div>
                                <div class="col-xs-3 sepparated">
                                    <div class="donut-with-title">
                                        <div class="col-xs-6">
                                            <span>Rendimiento</br />real anual</span>
                                        </div>
                                        <div class="col-xs-6">
                                            <div justgage style="width:80px;height:70px;"
                                                value="{{valueGlobal}}" value-font-color="{{valueFontColor}}"
                                                width="{{width}}" height="{{height}}" relative-gauge-size="{{relativeGaugeSize}}"
                                                value-min-font-size="{{valueMinFontSize}}" title-min-font-size="{{titleMinFontSize}}"
                                                label-min-font-size="{{labelMinFontSize}}" min-label-min-font-size="{{minLabelMinFontSize}}"
                                                maxLabelMinFontSize="{{maxLabelMinFontSize}}"
                                                min="{{min}}" max="{{max}}"
                                                hide-min-max="{{hideMinMax}}" hide-value="{{hideValue}}" hide-inner-shadow="{{hideInnerShadow}}"
                                                gauge-width-scale="{{gaugeWidthScale}}" gauge-color="{{gaugeColor}}"
                                                show-inner-shadow="{{showInnerShadow}}" shadow-opacity="{{shadowOpacity}}"
                                                shadow-size="{{shadowSize}}" shadow-vertical-offset="{{shadowVerticalOffset}}"
                                                level-colors="{{levelColors}}" custom-sectors="{{customSectors}}" no-gradient="{{noGradient}}"
                                                start-animation-time="{{startAnimationTime}}" start-animation-type="{{startAnimationType}}"
                                                refresh-animation-time="{{refreshAnimationTime}}" refresh-animation-type="{{refreshAnimationType}}"
                                                donut="{{donut}}" donut-start-angle="{{donutStartAngle}}"
                                                counter="{{counter}}" decimals="{{decimals}}" symbol="{{symbol}}" format-number="{{formatNumber}}"
                                                human-friendly="{{humanFriendly}}" human-friendly-decimal="{{humanFriendlyDecimal}}"
                                                text-renderer="textRenderer">                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 sepparated">
                                    <div class="key-value-list-with-title">
                                        <span class="title">Total<br />municipio</span>
                                        <ul class="list-unstyled">
                                            <li>Mensual <span class="pull-right custom-badge">12,1</span></li>
                                            <li>Interanual <span class="pull-right custom-badge">12,1</span></li>
                                            <li>Totalizador <span class="pull-right custom-badge">12345</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="spacer-10"></div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#volumenes" data-toggle="tab">Volumenes</a></li>
                                <li><a href="#ratios" data-toggle="tab">Ratios</a></li>
                                <li><a href="#contadores" data-toggle="tab">Contadores</a></li>
                                <li><a href="#xxx1" data-toggle="tab">Xxxxxxx</a></li>
                                <li><a href="#xxx2" data-toggle="tab">Xxxxxxx</a></li>
                                <li><a href="#xxx3" data-toggle="tab">Xxxxxxx</a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="mensual">
                                    <div class="row gutter-5">
                                        <div class="col-xs-4" align="center">
                                            <div class="table-list">
                                                <h4>Volumen aportado</h4>
                                                <ul class="list-unstyled">
                                                    <?php for($i=0; $i<12; $i++): ?>
                                                    <li><?php echo date('F Y', strtotime("+".$i." month", time())); ?> <span class="custom-badge pull-right"><?php echo rand(100, 50); ?></span></li>
                                                    <?php endfor; ?>
                                                    <li class="shoe">Total <span class="custom-badge pull-right"><?php echo rand(100, 50); ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-4" align="center">
                                            <div class="table-list">
                                                <h4>Volumen suministrado</h4>
                                                <ul class="list-unstyled">
                                                    <?php for($i=0; $i<12; $i++): ?>
                                                    <li><?php echo date('F Y', strtotime("+".$i." month", time())); ?> <span class="custom-badge pull-right"><?php echo rand(100, 50); ?></span></li>
                                                    <?php endfor; ?>
                                                    <li class="shoe">Total <span class="custom-badge pull-right"><?php echo rand(100, 50); ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-4" align="center">
                                            <div class="table-list">
                                                <h4>Volumen perdido</h4>
                                                <ul class="list-unstyled">
                                                    <?php for($i=0; $i<12; $i++): ?>
                                                    <li><?php echo date('F Y', strtotime("+".$i." month", time())); ?> <span class="custom-badge pull-right"><?php echo rand(100, 50); ?></span></li>
                                                    <?php endfor; ?>
                                                    <li class="shoe">Total <span class="custom-badge pull-right"><?php echo rand(100, 50); ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="anual">Anual</div>
                                <div role="tabpanel" class="tab-pane" id="xxx1">xxx1</div>
                                <div role="tabpanel" class="tab-pane" id="xxx2">xxx2</div>
                                <div role="tabpanel" class="tab-pane" id="xxx3">xxx3</div>

                                <!--<div class="spacer-20"></div>-->
                            
                                <canvas id="expedient-linechart" height="80" class="chart chart-line" chart-data="data_vol" chart-labels="labels_vol" chart-series="series_vol" chart-options="options_vol" chart-dataset override="datasetOverride"></canvas> 

                            </div>
                        </div>
                        <div class="col-xs-3 sidebar">
                            <div class="spacer-10"></div>
                            <img src="tpl/default/img/dbwater/fake-img-expedient-3.png" class="full-width" />
                            <hr />
                            <div class="alarms-number">
                                <span class="text">Número de alarmas</span>
                                <div class="ico">
                                    <span class="number">3</span>
                                    <i class="fa fa-fw fa-exclamation-triangle"></i>
                                </div>
                            </div>
                            
                            <div class="pdf-export">
                                Exportar a PDF &nbsp; <a href="#" class="btn btn-primary">PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        	<div id="map">
	        	<!-- map container -->

		        
		        <!-- end map container -->
	        </div>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

        <script>
            $(window).ready(function(){
                
                // z-index of each window is incremented when is open,
                // in order to let the last window be ever visible.
                
                var lastZIndex = 1;
                
                // Gutter is the standard separator space (15 is the Bootstrap default)
                // Is used around the layout
                
                var gutter = 15;

                // Tabs system (uses Bootstrap script)
                // Used in expedient window
                
                $('.nav.nav-tabs a').click(function (e) {
                    e.preventDefault()
                    $(this).tab('show')
                });

                //highlight infoviz line chart
                // The original draw function for the line chart. This will be applied after we have drawn our highlight range (as a rectangle behind the line chart).
                var originalLineDraw = Chart.controllers.line.prototype.draw;
                // Extend the line chart, in order to override the draw function.
                Chart.helpers.extend(Chart.controllers.line.prototype, {
                  draw : function() {
                    var chart = this.chart;
                    // Get the object that determines the region to highlight.
                    var xHighlightRange = chart.config.data.xHighlightRange;
                    var yHighlightRange = chart.config.data.yHighlightRange;

                    // If the object exists.
                    if (xHighlightRange !== undefined) {
                      var ctx = chart.chart.ctx;

                      var xRangeBegin = xHighlightRange.begin;
                      var xRangeEnd = xHighlightRange.end;

                      var xaxis = chart.scales['x-axis-0'];
                      var yaxis = chart.scales['y-axis-0'];

                      var xRangeBeginPixel = xaxis.getPixelForValue(xRangeBegin);
                      var xRangeEndPixel = xaxis.getPixelForValue(xRangeEnd);

                      ctx.save();

                      // The fill style of the rectangle we are about to fill.
                      ctx.fillStyle = 'rgba(0, 255, 0, 0.3)';
                      // Fill the rectangle that represents the highlight region. The parameters are the closest-to-starting-point pixel's x-coordinate,
                      // the closest-to-starting-point pixel's y-coordinate, the width of the rectangle in pixels, and the height of the rectangle in pixels, respectively.
                      ctx.fillRect(Math.min(xRangeBeginPixel, xRangeEndPixel), yaxis.top, Math.max(xRangeBeginPixel, xRangeEndPixel) - Math.min(xRangeBeginPixel, xRangeEndPixel), yaxis.bottom-yaxis.top);

                      ctx.restore();
                    }

                    // If the object exists.
                    if (yHighlightRange !== undefined) {
                      var ctx = chart.chart.ctx;

                      var yRangeBegin = yHighlightRange.begin;
                      var yRangeEnd = yHighlightRange.end;

                      var xaxis = chart.scales['x-axis-0'];
                      var yaxis = chart.scales['y-axis-0'];

                      var yRangeBeginPixel = yaxis.getPixelForValue(yRangeBegin);
                      var yRangeEndPixel = yaxis.getPixelForValue(yRangeEnd);

                      ctx.save();

                      // The fill style of the rectangle we are about to fill.
                      ctx.fillStyle = 'rgba(0, 255, 0, 0.3)';
                      // Fill the rectangle that represents the highlight region. The parameters are the closest-to-starting-point pixel's x-coordinate,
                      // the closest-to-starting-point pixel's y-coordinate, the width of the rectangle in pixels, and the height of the rectangle in pixels, respectively.
                      ctx.fillRect(xaxis.left, Math.min(yRangeBeginPixel, yRangeEndPixel), xaxis.right - xaxis.left, Math.max(yRangeBeginPixel, yRangeEndPixel) - Math.min(yRangeBeginPixel, yRangeEndPixel));

                      ctx.restore();
                    }

                    // Apply the original draw function for the line chart.
                    originalLineDraw.apply(this, arguments);
                  }
                });

                
                // Adjust the right window.
                // Used when window is loaded and resized.
                
                function adjustBaseWindows(){
                    //var width = $(window).width();
                    var winHeight = $(window).height();

                    var mainWindowPosition  = $(".window.main").position(),
                        mainWindowHeight    = $(".window.main").outerHeight(),
                        width = 240,
                        height = 600,
                        top = mainWindowPosition.top + mainWindowHeight + gutter,
                        right = gutter;

                    if ((winHeight - top - height) > top) {
                        top = (winHeight - height) / 2;
                    }
                    
                    $(".window.right-side").css({
                        "width": width,
                        "height": height,
                        "top": top,
                        "right": right
                        //"max-height": height-(gutter*2)
                    });
                }

                adjustBaseWindows();
                                
                $(window).resize(function(){
                    adjustBaseWindows();
                    setExpedientWindowPosition();
                });

                //Initialising datepicker for infoviz
                $('#infoviz-datepicker1').datepicker({
                    format: "dd/mm/yyyy",
                    startDate: "01/01/2015",
                    endDate: "0d",
                    language: "es",
                    multidate: false,
                    //defaultViewDate: {year:0, month:9, day:0},
                    daysOfWeekHighlighted: "0",
                    calendarWeeks: true,
                    todayHighlight: true
                });
                $('#infoviz-datepicker1').datepicker().on("changeDate", function(e) {
                    loadInfoviz();
                });

                $('#infoviz-datepicker2').datepicker({
                    format: "dd/mm/yyyy",
                    startDate: "01/01/2015",
                    endDate: "0d",
                    language: "es",
                    multidate: false,
                    daysOfWeekHighlighted: "0",
                    calendarWeeks: true,
                    todayHighlight: true
                });
                $('#infoviz-datepicker2').datepicker().on("changeDate", function(e) {
                    loadInfoviz();
                });
                
                // Adjust the search window position.
                // Used when the window is opened.
                
                function setSearchWindowPosition(){
                    var mainWindowPosition  = $(".window.main").position();
                    var mainWindowWidth     = $(".window.main").outerWidth();
                    var mainWindowHeight    = $(".window.main").outerHeight();
                    
                    var searchWindowWidth   = $(".window.search").outerWidth();
                    
                    var top  = mainWindowPosition.top + mainWindowHeight + gutter;
                    var left = mainWindowPosition.left + mainWindowWidth - searchWindowWidth;
                    
                    $(".window.search").css({
                        "top": top,
                        "left": left,
                        "z-index": lastZIndex++,
                        "max-height": $(window).height() - top - gutter,
                    });
                }

                // Adjust the layers window position.
                // Used when the window is opened.
                
                function setLayersWindowPosition(){
                    var mainWindowPosition  = $(".window.main").position();
                    var mainWindowHeight    = $(".window.main").outerHeight();
                    
                    var top  = mainWindowPosition.top + mainWindowHeight + gutter;
                    var left = gutter;
                    
                    $(".window.layers").css({
                        "top": top,
                        "left": left,
                        "z-index": lastZIndex++
                    });
                }
                
                // Adjust the expedient window position.
                // Used when the window is opened.
                
                function setExpedientWindowPosition(){
                    var mainWindowPosition  = $(".window.main").position();
                    var mainWindowHeight    = $(".window.main").outerHeight();
                    
                    var rightWindowPosition = $(".window.right-side").position();
                    var rightWindowWidth    = $(".window.right-side").outerWidth();
                    
                    //var top  = mainWindowPosition.top + mainWindowHeight + gutter;
                    var top = $("#townInfoPanel").position().top;
                    var left = gutter;
                    var right = rightWindowWidth + gutter + gutter;

                    // fixed size
                    var width = 960
                        height = 600;
                    
                    $(".window.expedient").css({
                        "top": top,
                        "right": right,
                        "width": width,
                        "height": height,
                        //"max-height": $(window).height() - top - gutter,
                        "z-index": lastZIndex++
                    }).addClass('animated slideInRight');
                }

                // Adjust the reports window position
                // Used when the window is opened.
                
                function setReportsWindowPosition(){
                    var mainWindowPosition  = $(".window.main").position();
                    var mainWindowHeight    = $(".window.main").outerHeight();
                    
                    var top  = mainWindowPosition.top + mainWindowHeight + gutter;
                    var left = gutter;
                    
                    $(".window.reports").css({
                        "top": top,
                        "left": left,
                        "max-height": $(window).height() - top - gutter,
                        "z-index": lastZIndex++
                    });
                }

                // Adjust the infoviz window position
                // Used when the window is opened.
                
                function setInfovizWindowPosition(){
                    var mainWindowPosition  = $(".window.main").position();
                    var mainWindowHeight    = $(".window.main").outerHeight();
                    
                    var top  = mainWindowPosition.top + mainWindowHeight + gutter;
                    var left = gutter;
                    
                    $(".window.infoviz").css({
                        "top": top,
                        "left": left,
                        "max-height": $(window).height() - top - gutter,
                        "z-index": lastZIndex++
                    });
                }

                // Adjust the report1 window position
                // Used when the window is opened.
                
                function setReport1WindowPosition(){
                    var mainWindowPosition  = $(".window.main").position();
                    var mainWindowHeight    = $(".window.main").outerHeight();
                    
                    var top  = mainWindowPosition.top + mainWindowHeight + gutter;
                    var left = gutter;
                    
                    $(".window.report1").css({
                        "top": top,
                        "left": left,
                        "max-height": $(window).height() - top - gutter,
                        "z-index": lastZIndex++
                    });
                }


                // load data table for report 1
                function loadReport1NEW(){
                    $('#report1').DataTable( {
                        "ajax": 'ajax.dataviz.php'
                    } );
                }

                function loadReport1(){
                    <?php  
                        require_once 'libs/apps/vizdata/class.vizdata.php';
                        $vizdata = new Vizdata();

                        $response = $vizdata->getDatosMunicipio();

                        if ($response['status'] == "Accepted") {
                            $records = $response['message'];
                            foreach ($records as $record) {
                                //print_r($record);

                                echo 'var tr = document.createElement("tr");'.PHP_EOL;

                                echo 'var td = document.createElement("td");'.PHP_EOL;
                                echo 'td.append(document.createTextNode("'.$record['id'].'"));'.PHP_EOL;
                                echo 'tr.append(td);'.PHP_EOL;

                                echo 'td = document.createElement("td");'.PHP_EOL;
                                echo 'td.append(document.createTextNode("'.$record['service_code'].'"));'.PHP_EOL;
                                echo 'tr.append(td);'.PHP_EOL;

                                echo 'td = document.createElement("td");'.PHP_EOL;
                                echo 'td.append(document.createTextNode("'.$record['data'].'"));'.PHP_EOL;
                                echo 'tr.append(td);'.PHP_EOL;

                                echo 'td = document.createElement("td");'.PHP_EOL;
                                echo 'td.append(document.createTextNode("'.$record['sum_suministrat'].'"));'.PHP_EOL;
                                echo 'tr.append(td);'.PHP_EOL;

                                echo 'td = document.createElement("td");'.PHP_EOL;
                                echo 'td.append(document.createTextNode("'.$record['sum_aportat'].'"));'.PHP_EOL;
                                echo 'tr.append(td);'.PHP_EOL;

                                echo 'td = document.createElement("td");'.PHP_EOL;
                                echo 'td.append(document.createTextNode("'.$record['sum_rebuig'].'"));'.PHP_EOL;
                                echo 'tr.append(td);'.PHP_EOL;

                                echo '$("#report1 tbody").append(tr);'.PHP_EOL;
                            }
                        }
                    ?>

                    var table = $('#report1').DataTable({
                        /*buttons: [
                            'copy', 'excel', 'pdf'
                        ]*/
                    });
                    //table.buttons().container().appendTo( $('#report1_wrapper', table.table().container() ) );
                }

                //load infoviz
                function loadInfoviz(){
                    var scope = angular.element("#angularAppContainer").scope();

                    var chartData1 = {};
                    var chartData2 = {};
                    chartData1.labels = [];
                    chartData2.labels = [];
                    var size = $(".infoviz-tagval").length;
                    if ($('.infoviz-comparativa').hasClass("active")) size = size * 2;
                    var datasets1 = new Array(size);
                    var datasets2 = new Array(size);

                    console.log(size,datasets1);

                    if (datasets1.length > 0) {

                        //get selected data
                        $(".infoviz-tagval").each(function( index ) {
                            var index2 = index+$(".infoviz-tagval").length;
                            console.log(index,index2,datasets1.length);

                            var style = {
                                fill: false,
                                lineTension: 0.1,
                                backgroundColor: "rgba(75,192,192,0.4)",
                                borderCapStyle: 'butt',
                                borderDash: [],
                                borderDashOffset: 0.0,
                                borderJoinStyle: 'miter',
                                pointBorderColor: "rgba(75,192,192,1)",
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 1,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                                pointHoverBorderColor: "rgba(220,220,220,1)",
                                pointHoverBorderWidth: 2,
                                pointRadius: 1,
                                pointHitRadius: 10,
                                data: [],
                                spanGaps: false,
                            };
                            datasets1[index] = style;
                            datasets1[index].label = $(this).data("value"); 
                            datasets2[index] = style;
                            datasets2[index].label = $(this).data("value"); 

                            //line color
                            if ($(this).hasClass("sum_aportat")) {
                                datasets1[index].borderColor = "#edae1a";
                                datasets2[index].borderColor = "#edae1a";
                            } 
                            else if ($(this).hasClass("sum_suministrat")) {
                                datasets1[index].borderColor = "#51caef";
                                datasets2[index].borderColor = "#51caef";
                            }
                            else if ($(this).hasClass("sum_rebuig")) {
                                datasets1[index].borderColor = "#6bc24c";
                                datasets2[index].borderColor = "#6bc24c";
                            }

                            //comparativa???
                            if ($('.infoviz-comparativa').hasClass("active")) {
                                datasets1[index2] = style;
                                datasets2[index2] = style;

                                datasets1[index2].borderDash = [5, 15];
                                datasets2[index2].borderDash = [5, 15];

                                if ($(this).hasClass("sum_aportat")) {
                                    datasets1[index2].borderColor = "#edae1a";
                                    datasets2[index2].borderColor = "#edae1a";
                                } 
                                else if ($(this).hasClass("sum_suministrat")) {
                                    datasets1[index2].borderColor = "#51caef";
                                    datasets2[index2].borderColor = "#51caef";
                                }
                                else if ($(this).hasClass("sum_rebuig")) {
                                    datasets1[index2].borderColor = "#6bc24c";
                                    datasets2[index2].borderColor = "#6bc24c";
                                }
                            }
                        });

                        // get data from datepicker
                        var fechaBegin = $('#infoviz-datepicker1').datepicker("getDate"),
                            fechaEnd = $('#infoviz-datepicker2').datepicker("getDate"),
                            fechaBeginAbs = new Date("2016-06-01"),
                            fechaEndAbs = new Date("2016-07-28");

                            //one year before
                        var fechaBeginComp = $('#infoviz-datepicker1').datepicker("getDate"),
                            fechaEndComp = $('#infoviz-datepicker2').datepicker("getDate"),
                            fechaBeginCompAbs = new Date("2016-06-01"),
                            fechaEndCompAbs = new Date("2016-07-28");

                        fechaBeginComp.setFullYear(fechaBeginComp.getFullYear() - 1),
                        fechaEndComp.setFullYear(fechaEndComp.getFullYear() - 1),
                        fechaBeginCompAbs.setFullYear(fechaBeginCompAbs.getFullYear() - 1),
                        fechaEndCompAbs.setFullYear(fechaEndCompAbs.getFullYear() - 1);
                        
                        //console.log("date",fechaBegin,fechaEnd,fechaBeginAbs,fechaEndAbs);
                        //console.log("comp",fechaBeginComp,fechaEndComp,fechaBeginCompAbs,fechaEndCompAbs);

                        //fill datasets
                        for (i in scope.vizdataList) {
                            var register = scope.vizdataList[i];
                            var fecha = new Date(register["data"]);
                            //console.log(register["data"]);

                            //fill dataset for line chart with date zoom
                            if (fecha >= fechaBegin && fecha <= fechaEnd) {
                                chartData1.labels.push(register['data']);

                                $(".infoviz-tagval").each(function( index ) {
                                    datasets1[index].data.push(register[$(this).data("value")]);
                                });
                            }

                            //in date limits?
                            if (fecha >= fechaBeginAbs && fecha <= fechaEndAbs) {
                                //fill dataset for line chart with all dates in date range
                                chartData2.labels.push(register['data']);
                                //chartData2.labels.push(new Date(register['data']));

                                $(".infoviz-tagval").each(function( index ) {
                                    datasets2[index].data.push(register[$(this).data("value")]);
                                });
                            }

                            //comparativa: fecha - 1 year                            
                            if ($('.infoviz-comparativa').hasClass("active")) {
                                if (fecha >= fechaBeginComp && fecha <= fechaEndComp) {
                                    $(".infoviz-tagval").each(function( index ) {
                                        datasets1[index+$(".infoviz-tagval").length].data.push(register[$(this).data("value")]);
                                    });
                                }

                                //in date limits?
                                if (fecha >= fechaBeginCompAbs && fecha <= fechaEndCompAbs) {
                                    $(".infoviz-tagval").each(function( index ) {
                                        datasets2[index+$(".infoviz-tagval").length].data.push(register[$(this).data("value")]);
                                    });
                                }
                            }
                        }
                        chartData1.datasets = datasets1;
                        chartData2.datasets = datasets2;

                        // get zoom highlight
                        var fechaRegisterBegin = new Date(scope.vizdataList[0]['data']),
                            fechaRegisterEnd = new Date(scope.vizdataList[scope.vizdataList.length-1]['data']);

                        if (fechaBegin < fechaRegisterBegin) 
                            fechaBegin = fechaRegisterBegin;
                        if (fechaEnd > fechaRegisterEnd) 
                            fechaEnd = fechaRegisterEnd;

                        //set zoom highlight
                        chartData2.xHighlightRange = {
                          begin: fechaBegin.yyyymmdd(),
                          end: fechaEnd.yyyymmdd()
                        }

                        //Initialising chartjs linechart for infoviz
                        var ctx1 = $("#infoviz-linechart1");
                        var myLineChart1 = new Chart(ctx1, {
                            type: 'line',
                            data: chartData1,
                            options: {
                                scales: {
                                    xAxes: [{
                                        type: "time",
                                        time: {
                                            unit: "day",
                                            unitStepSize: "7",
                                            //min: new Date("2016-06-01"),
                                            //max: new Date("2016-07-27"),
                                            displayFormats: {
                                                day: "DD-MM-YY"
                                            }
                                        }
                                    }]
                                }
                            }
                        });

                        var ctx2 = $("#infoviz-linechart2");
                        var myLineChart2 = new Chart(ctx2, {
                            type: 'line',
                            data: chartData2,
                            options: {
                                scales: {
                                    xAxes: [{
                                        type: "time",
                                        time: {
                                            unit: "week",
                                            unitStepSize: "4",
                                            //min: new Date("2016-06-01"),
                                            //max: new Date("2016-07-27"),
                                            displayFormats: {
                                                week: "MM-YY"
                                            }
                                        }
                                    }]
                                }
                            }
                        });

                        //add button Comparativa
                        $('.infoviz-comparativa').show();
                    } else {
                        $('.infoviz-comparativa').hide();
                        $('.infoviz-comparativa').removeClass('active');
                    }
                }

                // Toggle the search window when the menu icon is pressed
                
                $("#menu").on("click", ".search", function(){
                    $(".window.search").toggle();
                    setSearchWindowPosition();
                    
                    if($(".window.search").is(':visible'))
                        $(".window.search input").focus();
                    
                    return false;
                });
                
                // Toggle the layers window when the menu icon is pressed

                $("#menu").on("click", ".layers", function(){
                    $(".window.layers").toggle();
                    setLayersWindowPosition();
                    return false;
                });
                
                // Toggle the expedient window when the menu icon or
                // the right window button is pressed

                $("#menu").on("click", ".expedient", function(){
                    $(".window.expedient").toggle();
                    setExpedientWindowPosition();
                    return false;
                });

                $(document).on("click", '.open-expedient', function(){
                    $(".window.expedient").toggle();
                    setExpedientWindowPosition();
                    return false;
                });

                // Toggle the reports window when the menu icon is pressed

                $("#menu").on("click", ".reports", function(){
                    $(".window.reports").toggle();
                    setReportsWindowPosition();
                    return false;
                });

                // Toggle the reports window when the menu icon is pressed

                $("#menu").on("click", ".infoviz", function(){
                    $(".window.infoviz").toggle();
                    setInfovizWindowPosition();

                    //set start and end date for datepicker 
                    var onemonthago = new Date();
                    onemonthago.setMonth(onemonthago.getMonth() - 1);
                    var onedayago = new Date();
                    onedayago.setDate(onedayago.getDate() - 1);

                    // temporalmente lo ponemos a junio- julio ya que son los meses donde tenemos datos               
                    onemonthago = new Date("2016-06-01");
                    onedayago = new Date("2016-07-28");
                    /////////////

                    $('#infoviz-datepicker1').data({date: onemonthago});
                    $('#infoviz-datepicker1').datepicker('update');
                    $('#infoviz-datepicker2').data({date: onedayago});
                    $('#infoviz-datepicker2').datepicker('update');

                    return false;
                });

               // Close the current window when press the times icon on the top right corner.
                
                $(".window").on("click", "h2 .fa-times", function(){
                    if ($(this).parent().parent().parent().hasClass("right-side")) $(".window.expedient").hide();
                    $(this).closest(".window").toggle();
                });
                
                // Collapse and expand the layers list on the layers window.
                            
                $(".window.layers").on("click", "ul.layers li > a", function(){
                    $(this).parent('li').toggleClass("open closed");
                    return false;
                });

                // open the reports 1 window
                $(".window.reports").on("click", ".report1", function(){
                    loadReport1();
                    $(".window.reports").toggle();
                    $(".window.report1").toggle();
                    setReport1WindowPosition();
                    return false;
                });

                 // Load line chart
                $("#infoviz-data").on("change", function(e){

                    // get selected data value
                    var selectedData = $('#infoviz-data option:selected').val(),
                        selectedDataLabel = $('#infoviz-data option:selected').text(),
                        selectedDataCodi = $('#infoviz-municipi option:selected').data("codi");

                    if (selectedData !== "") {

                        // draw line chart if not already done                    
                        if (!$(".infoviz-tagval."+selectedData).length) {
                            //$(".infoviz-tagval").length < 1)
                            // add data tag
                            $("#infoviz-tag").prepend("<span data-value='"+selectedData+"' class='infoviz-tagval "+selectedData+"'>"+selectedDataCodi+" "+selectedDataLabel+" <span class='closeButton'>x</span></span>");
                            $(".closeButton").on("click", function(e){
                                $(this).parent().remove();
                                // redraw line chart
                                loadInfoviz();
                            });
                            // draw line chart
                            loadInfoviz();
                        }
                    }

                    return false;
                });

                $('.infoviz-comparativa').click(function(){
                    if ($(this).hasClass("active"))
                        $(this).removeClass("active");
                    else
                        $(this).addClass("active");
                    loadInfoviz();
                });
            });

            Date.prototype.yyyymmdd = function() {
              var mm = this.getMonth() + 1; // getMonth() is zero-based
              var dd = this.getDate();

              return [this.getFullYear(), mm<10 ? '0'+ mm: mm, dd<10 ? '0'+ dd : dd].join('-')
            };

        </script>
        
    	<!-- Angular js -->
    	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    	
    	<!-- Open layers -->
    	<script src="http://openlayers.org/en/v3.19.1/build/ol.js"></script> 
        <link rel="stylesheet" href="http://openlayers.org/en/master/css/ol.css" />
        <!-- End Open layers -->
        <!-- angular-bootstrap-ui -->
	    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js"></script>
		<link rel="stylesheet" href="js/libs/angular-bootstrap-ui/ui-bootstrap-custom-1.1.0-csp.css" />
	    <script src="js/libs/angular-bootstrap-ui/ui-bootstrap-custom-1.1.0.min.js"></script> 
	    <script src="js/libs/angular-bootstrap-ui/ui-bootstrap-custom-tpls-1.1.0.min.js"></script> 
	    <script src="js/libs/angular-bootstrap-ui/angular-locale_es.es.js"></script> 
	    <!-- end angular-bootstrap-ui -->
	    <!-- charts -->
	    <script src="js/libs/raphael-2.1.4.min.js"></script> 
		<script src="js/libs/justgage.js"></script> 
		<script src="js/libs/angular-gage.min.js"></script> 
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.min.js"></script>-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
		<script src="js/libs/angular-chart.min.js"></script>
        <script src="js/libs/angular-datatables.min.js"></script>
		<!-- end charts -->
        <!-- datatables and datepicker -->
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js"></script> 
        <!-- end datatables -->
        <!-- Application -->
    	<script src="js/app_dbwater/app.js"></script>
    	<script src="js/app_dbwater/MainController.js"></script>
    	<script src="js/app_dbwater/mapService.js"></script>
    	<script src="js/common/placesService.js"></script>
        <script src="js/common/vizdataService.js"></script>
    	<script src="js/common/loggerService.js"></script>
    	 <!-- End Application -->
    	 
	</body>
</html>






	
