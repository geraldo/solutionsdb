<!DOCTYPE html>
<html>
	<head>
		<title>DBWater</title>
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
                    Visualziación grandes consumidores
                    <a href="#" class="pull-right" ng-click="toggleInfoviz(0)"><i class="fa fa-fw fa-times"></i></a>
                </h2>
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">

                            <p class="infoviz-title">Fecha inicio:</p>
                            <div id="infoviz-datepicker1"></div>
                            <p class="infoviz-title">Fecha final:</p>
                            <div id="infoviz-datepicker2"></div>
                            
                            <input type="radio" name="datatype" value="data-real" checked="checked"> Datos reales (máx 8 días)<br>
                            <input type="radio" name="datatype" value="data-day"> Datos diarios

                            <p class="infoviz-title">Municipio: 
                                <select>
                                  <option value=""></option>
                                  <option value="Molins de Rei">Molins de Rei</option>
                                  <option value="otro">otro</option>
                                </select>
                            </p>

                            <p class="infoviz-title">Sector:
                                <select>
                                  <option value=""></option>
                                </select>
                            </p>

                            <p class="infoviz-title">Dato: 
                                <select id="infoviz-data">
                                  <option value=""></option>
                                  <option value="sum_suministrat">Suministrado</option>
                                  <option value="sum_aportat">Aportado</option>
                                  <option value="sum_rebuig">Perdido</option>
                                </select>
                            </p>
                        </div>

                        <div class="col-xs-9">
                            <canvas id="infoviz-linechart" width="600" height="400"></canvas>
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
	                        <div justgage style="width:60px; height:60px"  titlePosition="below"
		                         									value="{{valueDay}}" value-font-color="{{valueFontColor}}"
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
                            	<div justgage style="width:60px; height:60px"
									value="{{valueWeek}}" value-font-color="{{valueFontColor}}"
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
                        <!--<div class="col-xs-4" align="center">
                            	<div justgage style="width:60px; height:60px"
									value="{{valueMonth}}" value-font-color="{{valueFontColor}}"
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
                            <p class="title">Mes</p>
                        </div>-->
                    </div>
                    <h3>Tendéncia del rendimiento</h3>
					<canvas id="fitxa-barchart" class="chart chart-bar" chart-data="data_fitxa_rend" chart-labels="labels_fitxa_rend" chart-series="series_fitxa_rend" chart-options="options_fitxa_rend"></canvas>
                    <h3>Información</h3>
                    <div class="list-with-icon">
                        <div class="icon-container">
	                        
                            <img src="tpl/default/img/dbwater/ic-water.jpg" class="icon" />
                        </div>
                        <ul class="list-unstyled list-left-bordered">
                            <li>Volumen aportado <span class="pull-right custom-badge">{{sum_aportat}}</span></li>
                            <li>Volumen suministrado <span class="pull-right custom-badge">{{sum_suministrat}}</span></li>
                            <li>Volumen de pérdida <span class="pull-right custom-badge">{{sum_rebuig}}</span></li>
                            <li>Caudal medio <span class="pull-right custom-badge">FALTA</span></li>
                            <li>Caudal mínimo nocturno <span class="pull-right custom-badge">FALTA</span></li>
                            <li>Caudal por m3 <span class="pull-right custom-badge">FALTA</span></li>
                        </ul>
                    </div>
                    <h3>Volumenes</h3>
                    <canvas id="fitxa-linechart" class="chart chart-line" chart-data="data_fitxa_vol" chart-labels="labels_fitxa_vol" chart-series="series_fitxa_vol" chart-options="options_fitxa_vol" chart-dataset override="datasetOverride"></canvas> 
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
                    Ficha de sector 43
                    <a href="#" class="pull-right"><i class="fa fa-fw fa-times"></i></a>
                </h2>
                <div class="content">
                    <div class="row">
                        <div class="col-xs-9">
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
                                            <span>Rendimiento</br />total</span>
                                        </div>
                                        <div class="col-xs-6">
                                            <div justgage style="width:60px; height:60px"
                                                value="{{valueWeek}}" value-font-color="{{valueFontColor}}"
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
                                <li class="active"><a href="#mensual" data-toggle="tab">Mensual</a></li>
                                <li><a href="#anual" data-toggle="tab">Anual</a></li>
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
                                                <h4>Volumen registrado</h4>
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
                                                <h4>Volumen pérdidas</h4>
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

                                <div class="spacer-20"></div>
                            
                                <canvas id="expedient-linechart" class="chart chart-line" chart-data="data_expedient" chart-labels="labels_expedient" chart-series="series_expedient" chart-options="options_expedient" chart-dataset override="datasetOverride"></canvas> 

                            </div>
                        </div>
                        <div class="col-xs-3 sidebar">
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

                //initial data for line chart
                var chartData = {
                        //labels: [],
                        datasets: []
                };

                
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
                    endDate: "31/12/2016",  //today???
                    language: "es",
                    multidate: false,
                    daysOfWeekHighlighted: "0",
                    calendarWeeks: true,
                    todayHighlight: true
                });
                $('#infoviz-datepicker2').datepicker({
                    format: "dd/mm/yyyy",
                    startDate: "01/01/2015",
                    endDate: "31/12/2016",  //today???
                    language: "es",
                    multidate: false,
                    daysOfWeekHighlighted: "0",
                    calendarWeeks: true,
                    todayHighlight: true
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

                // load line chart
                function loadLineChart(selectedData, data){
                    var dataset = {
                            //label: "",
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
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

                    <?php  
                        require_once 'libs/apps/vizdata/class.vizdata.php';
                        $vizdata = new Vizdata();

                        $response = $vizdata->getDatosMunicipio();

                        if ($response['status'] == "Accepted") {
                            $records = $response['message'];
                            echo 'var thisDataset = dataset;'.PHP_EOL;
                            echo 'thisDataset.label = selectedData;'.PHP_EOL;
                            echo 'data.labels = [];'.PHP_EOL;

                            foreach ($records as $record) {
                                //print_r($record);
                                echo 'data.labels.push("'.$record['data'].'");'.PHP_EOL;
                                echo 'if (selectedData == "sum_suministrat") {'.PHP_EOL;
                                    echo 'thisDataset.data.push('.$record['sum_suministrat'].');'.PHP_EOL;
                                echo '} else if (selectedData == "sum_aportat") {'.PHP_EOL;
                                    echo 'thisDataset.data.push('.$record['sum_aportat'].');'.PHP_EOL;
                                echo '} else if (selectedData == "sum_rebuig") {'.PHP_EOL;
                                    echo 'thisDataset.data.push('.$record['sum_rebuig'].');'.PHP_EOL;
                                echo '};'.PHP_EOL;
                            }
                            echo 'data.datasets.push(dataset);'.PHP_EOL;
                        }
                    ?>

                    //Initialising chartjs linechart for infoviz
                    var ctx = $("#infoviz-linechart");
                    var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: data,
                        options: {}
                    });
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
                    return false;
                });

               // Close the current window when press the times icon on the top right corner.
                
                $(".window").on("click", "h2 .fa-times", function(){
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
                $(".window.infoviz").on("change", "#infoviz-data", function(e){
                    // get selected data value
                    var selectedData = $('#infoviz-data option:selected').val();
                    loadLineChart(selectedData, chartData);
                    return false;
                });
            });
        </script>
        
    	<!-- Angular js -->
    	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    	
    	<!-- Open layers -->
    	<script src="http://openlayers.org/en/v3.12.1/build/ol.js"></script> 
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"></script>
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






	
