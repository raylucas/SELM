angular.module("selm").factory("selmAPI", function($http){

	var _savePerfil = function(data){
		return $http.post("php/perfilInsert.php", data);
	};

	
	var _getPerfis = function(data){
		return $http.post("php/perfilInsert.php", data);
	};
    
    var _getPerfis1 = function(data){
		return $http.get("php/perfilInsert.php");
	};

    var _getPerfil = function(){
		return $http.get("php/perfisSelect.php");
	};
	
	var _pegaId = function(id){
		return $http.post("php/perfilSelect.php", id);

	}


	
	return{
		savePerfil: _savePerfil,
		getPerfis:  _getPerfis,
		getPerfis1:  _getPerfis1,
        getPerfil:  _getPerfil,
		pegaId: _pegaId
	};
	
});