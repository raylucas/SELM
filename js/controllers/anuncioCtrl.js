angular.module("selm").controller("anuncioCtrl", function ($scope, $http) {
    $scope.eita = "eita";
	$scope.login1 = [];
    var url = 'php/operador.php';
   
    
	$scope.carregarLogin = function () {
    var operacao = "selectLogin";
	var login = window.sessionStorage.getItem('login');
		$http({
		      method: 'post',
		      url: url,
		      data: $.param({ 'login' : login, 'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
	    		$scope.login1 = data;
				
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
    
    $scope.carregarCategorias = function () {
    var operacao = "selectCategoria";
		$http({
		      method: 'post',
		      url: url,
		      data: $.param({ 'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
	    		$scope.categorias = data;
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
	
	 $scope.mandarIdPerfil = function (idPerfil) {
        window.sessionStorage.setItem('idPerfil', idPerfil);
        window.location.href='perfil.html';
            
	};
  	
	$scope.criarAnuncio = function (anuncio) {
		var operacao = "insertAnuncio";	
		$http({
		      method: 'post',
		      url: url,
		      data: $.param({'nome': anuncio.nome, 
			  				 'descricao': anuncio.descricao,
							 'categoria': anuncio.categoria.id,
			  				'operacao' : operacao 
							}),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
				setTimeout("location.href='cria-anuncio.html'",5000);
			}).error(function (data, status, headers, config) {
				$scope.message = "Aconteceu um problema: " + data;
			});
	};
        
      $scope.carregarCategorias();
	  $scope.carregarLogin();
});