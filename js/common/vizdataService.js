(function() {
'use strict';

	/**
	 * Search Service
	 */
	 
	angular.module('app').factory('vizdataService', ['$http', function ($http) {
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
			console.log("vizdataServices init("+_baseHref+","+_token+")");
			baseHref		= _baseHref;
			token			= _token;
		}
		
		//list all volumenes data
		dataFactory.dbWaterListVolumenes 	= function(){
			var vars2send 					= {};
			vars2send.what					= "DBWATER_LIST_VOLUMENES";
			vars2send.token					= token;
			return $http.post(baseHref+'ajax.vizdata.php', vars2send);
		}
		
		return dataFactory;		
	}])

})();
