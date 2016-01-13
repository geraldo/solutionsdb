<div class="navbar navbar-inverse navbar-fixed-top">      
    <!--Include your brand here-->
    <a class="navbar-brand" href="#">
	    <!--img src="tpl/<?php echo $skin; ?>/img/logo.png" alt="logo" width="32" height="31" /--> SolutionsDB 
    </a>
    
    <div class="pull-right panel-alerts">
	    <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-2x fa-exclamation-triangle"></i> <span class="badge">42</span></a>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			<li><a href="#">Action</a></li>
			<li><a href="#">Another action</a></li>
			<li><a href="#">Something else here</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#">Separated link</a></li>
		</ul>
    </div>
</div>

<div ng-app="app" ng-controller="mainController as mc" ng-init="initApp('<?php echo $baseHref; ?>','<?php echo $urlWMS; ?>')">

	<nav>
		<ul class="list-unstyled main-menu">
		    <!--Include your navigation here-->
		    <li class="menu-home"><a href="#" id="nav-expander"><i class="fa fa-bars"></i> <span><?php echo MENU_MENU; ?></span></a></li>
		    <li><a href="<?php echo $baseHref?>home.php"><i class="fa fa-home"></i> <span><?php echo MENU_HOME; ?></span></a></li>
		    <li>
				<div class="panel-group" id="accordion-search" role="tablist" aria-multiselectable="false">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingSearch">
							<a class="panel-accordion" data-toggle="collapse" data-parent="#accordion-search" href="#collapseSearch" aria-expanded="true" aria-controls="collapseSearch" ng-click="searchClick()"><i class="fa fa-search"></i> <span><?php echo MENU_SEARCHER; ?></span></a>
						</div>
						<div id="collapseSearch" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSearch">
							<div class="panel-body">
								<form>
									<div class="form-group">
										<label for="province"><?php echo FORM_PROVINCE; ?></label>
										<select class="form-control" 
											id="province" 
											ng-model="selectedProvince" 
											ng-change="provinceChanged(selectedProvince)" 
											data-ng-options="item.id as item.name for item in provinceList">
											<option value="" selected="selected"><?php echo FORM_SELECT; ?></option>
										</select>
									</div>
									<div class="form-group">
										<label for="city"><?php echo FORM_CITY; ?></label>
										<select class="form-control" 
											id="town" 
											ng-model="selectedTown"
											ng-change="townChanged(selectedTown)"
											data-ng-options="item.id as item.name for item in townList">
											<option value="" selected="selected"><?php echo FORM_SELECT; ?></option>
										</select>
									</div>
									<div class="form-group">
										<label for="ine"><?php echo FORM_INE; ?></label>
										<p class="ng-cloak" ng-cloak>{{town_ine}}</p>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
		    </li>
		    <li>
				<div class="panel-group" id="accordion-caption" role="tablist" aria-multiselectable="false">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingCaption">
							<a class="panel-accordion" data-toggle="collapse" data-parent="#accordion-caption" href="#collapseCaption" aria-expanded="true" aria-controls="collapseCaption"><i class="fa fa-map-marker"></i> <span><?php echo MENU_LEGEND; ?></span></a>
						</div>
						<div id="collapseCaption" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingCaption">
							<div class="panel-body">
	Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
							</div>
						</div>
					</div>
				</div>
		    </li>
		    <li><a href="#"><i class="fa fa-info"></i> <span><?php echo MENU_INFORMATION; ?></span></a></li>
		    <li><a href="#"><i class="fa fa-cog"></i> <span><?php echo MENU_CONFIGURATION; ?></span></a></li>
		    <li><a href="#"><i class="fa fa-tag"></i> <span><?php echo MENU_REPORT; ?></span></a></li>
		    <li>
				<div class="panel-group" id="accordion-contact" role="tablist" aria-multiselectable="false">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingContact">
							<a class="panel-accordion" data-toggle="collapse" data-parent="#accordion-contact" href="#collapseContact" aria-expanded="true" aria-controls="collapseContact"><i class="fa fa-envelope"></i> <span><?php echo MENU_CONTACT; ?></span></a>
						</div>
						<div id="collapseContact" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingContact">
							<div class="panel-body">
								<address>
									<span><?php echo FORM_NAME_AND_SURNAME; ?></span><br />
									<a href="mailto:#">first.last@example.com</a><br />
									<span>+34 600 000 000</span>
								</address>
								<form>
									<div class="form-group">
										<label for="name"><?php echo FORM_NAME; ?></label>
										<input type="text" class="form-control" id="name" name="name">
									</div>
									<div class="form-group">
										<label for="email"><?php echo FORM_EMAIL; ?></label>
										<input type="email" class="form-control" id="email" name="email">
									</div>
									<div class="form-group">
										<label for="subject"><?php echo FORM_SUBJECT; ?></label>
										<input type="text" class="form-control" id="subject" name="subject">
									</div>
									<div class="form-group">
										<label for="message"><?php echo FORM_MESSAGE; ?></label>
										<textarea class="form-control" id="message" name="message"></textarea>
									</div>
									<button type="submit" class="btn btn-default"><?php echo FORM_SEND; ?></button>
								</form>
							</div>
						</div>
					</div>
				</div>	    
		    
		    
			</li>
		</ul>
	</nav>






	<div>
		<div id="map"></div>
	</div>
	  
	  
	  
	<script src="http://openlayers.org/en/v3.12.1/build/ol.js"></script> 
    <link rel="stylesheet" href="http://openlayers.org/en/master/css/ol.css" />

    
    <!-- Application -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/proj4js/2.2.1/proj4.js" type="text/javascript"></script>
	<script src="js/app_dbmanager/app.js"></script>
	<script src="js/app_dbmanager/MainController.js"></script>
	<script src="js/app_dbmanager/mapService.js"></script>
	<script src="js/common/placesService.js"></script>
	<script src="js/common/responsiveService.js"></script>
</div>
