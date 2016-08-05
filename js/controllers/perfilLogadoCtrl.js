angular.module("selm").controller("perfilLogadoCtrl", function ($scope, $http) {
    
    $scope.teste = "texto";
	var url = 'php/operador.php';
    
    $scope.perfil = [];
     
     $scope.carregarPerfilLogin = function () {
        var login = window.sessionStorage.getItem('login');
  //    window.sessionStorage.removeItem('perfil');
  	  	var operacao = "selectPerfil";
		$http({
		      method: 'post',
		      url: url,
		      data: $.param({ 'idPerfil' : idPerfil, 'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
	    		$scope.perfil = data;	
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
    $scope.carregarPerfil();

});