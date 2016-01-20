(function() {
'use strict';

	/**
	 * Search Service
	 */
	 
	angular.module('app').factory('placesService', ['$http', function ($http) {
		var baseHref,
			token;
		
		//****************************************************************
    	//***********************   HELPER METHODS   *********************
    	//****************************************************************
    	
		function formatDateForDb(date){
			var d = new Date(date),
		        month = '' + (d.getMonth() + 1),
		        day = '' + d.getDate(),
		        year = d.getFullYear();
		    if (month.length < 2) month = '0' + month;
		    if (day.length < 2) day = '0' + day;
		    return [year, month, day].join('-');		
		}
	
		//****************************************************************
    	//***********************   END HELPER METHODS   *****************
    	//****************************************************************
    	
		var dataFactory = {};
		
		dataFactory.init	= function(_baseHref,_token){
			console.log("placesServices init("+_baseHref+","+_token+")");
			baseHref		= _baseHref;
			token			= _token;
		}
		
		dataFactory.listProvinces	= function(){
			var vars2send 			= {};
			vars2send.what			= "LIST_PROVINCES";
			vars2send.token			= token;
			return $http.post(baseHref+'ajax.places.php', vars2send);
		}
		
		dataFactory.listTowns	= function(id){
			var vars2send 			= {};
			vars2send.id			= id;
			vars2send.what			= "LIST_TOWNS";
			vars2send.token			= token;
			return $http.post(baseHref+'ajax.places.php', vars2send);
		}
		dataFactory.getTown	= function(id){
			var vars2send 			= {};
			vars2send.id			= id;
			vars2send.what			= "TOWN_INFO";
			vars2send.token			= token;
			return $http.post(baseHref+'ajax.places.php', vars2send);
		}
		dataFactory.updateTown	= function(data){
			var vars2send 					= {};
			vars2send.what					= "UPDATE_TOWN";
			vars2send.token					= token;
			vars2send.id_town				= data.id_town;
			vars2send.town_water_provider	= data.town_water_provider;
			vars2send.town_sanity_provider	= data.town_sanity_provider;
			if(data.town_w_contract_init!=""){
				vars2send.town_w_contract_init	= formatDateForDb(data.town_w_contract_init);
			}
			if(data.town_w_contract_end!=""){
				vars2send.town_w_contract_end	= formatDateForDb(data.town_w_contract_end);
			}
			if(data.town_s_contract_init!=""){
				vars2send.town_s_contract_init	= formatDateForDb(data.town_s_contract_init);
			}
			if(data.town_s_contract_end!=""){
				vars2send.town_s_contract_end	= formatDateForDb(data.town_s_contract_end);
			}
			console.log("updateTown data",vars2send);
			return $http.post(baseHref+'ajax.places.php', vars2send);
		}
		return dataFactory;
		
		
	}])

})();
