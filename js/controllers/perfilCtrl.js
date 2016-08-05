angular.module("selm").controller("perfilCtrl", function ($scope, $http) {
    
    $scope.teste = "texto";
	var url = 'php/operador.php';
    
    $scope.perfil = [];
	$scope.anuncios = [];

     
     $scope.carregarPerfil = function () {
    var flag = window.sessionStorage.getItem('flag');
	var params = parseQueryString();
	var idPerfil = params["id"];
		 
  	  	var operacao = "selectPerfil";
		$http({
		      method: 'post',
		      url: url,
		      data: $.param({ 'idPerfil' : idPerfil, 'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
            
                if(flag == 1){
                    $scope.botaoEditar = true;
                    window.sessionStorage.removeItem('flag');
                }
	    		$scope.perfil = data;	
				var teste = new Object();

            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};

	$scope.carregarAnuncio = function () {
        var operacao = "selectAnuncioId";
		var params = parseQueryString();
		var idPerfil = params["id"];

		  $http({
		      method: 'post',
		      url: url,
		      data: $.param({ 'idPerfil' : idPerfil, 'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
	    		$scope.anuncios = data;
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};


	var parseQueryString = function() {

		var str = window.location.search;
		var objURL = {};

		str.replace(
			new RegExp( "([^?=&]+)(=([^&]*))?", "g" ),
			function( $0, $1, $2, $3 ){
				objURL[ $1 ] = $3;
			}
		);
		return objURL;
	};
    
    $scope.mandarIdPerfilEditar = function(idPerfil){
        window.location.href='perfil-editar.html?id='+idPerfil;
    };

         
	parseQueryString();
    $scope.carregarPerfil();
	$scope.carregarAnuncio();

});