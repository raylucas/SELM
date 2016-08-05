angular.module("selm").controller("loginCtrl", function ($scope, $http) {
    $scope.teste = "login";
    var nome;
	var url = 'php/operador.php';
    
    $scope.login = function (perfis) {
		var operacao = "login";	
       	nome = perfis.login;

		$http({
		      method: 'post',
		      url: url,
		      data: $.param({'login': perfis.login, 
			  				 'senha': perfis.senha,
			  				'operacao' : operacao 
							}),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
                location.reload();
			}).error(function (data, status, headers, config) {
				$scope.message = "Aconteceu um problema: " + data;
			});
	};
	
	$scope.logout = function () {
		var operacao = "logout";	
		$http({
		      method: 'post',
		      url: url,
		      data: $.param({ 'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
			}).error(function (data, status, headers, config) {
                        	location.reload();

				$scope.message = "Aconteceu um problema: " + data;
			});
	};

	$scope.mandarIdPerfil = function (idPerfil) {
         window.sessionStorage.setItem('flag', 1);
        window.location.href='perfil.html?id='+idPerfil;
            
	};
    
});