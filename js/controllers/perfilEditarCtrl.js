angular.module("selm").controller("perfilEditarCtrl", function ($scope, $http) {
    
    $scope.teste = "batata";
	var url = 'php/operador.php';
    $scope.perfilLogado = [];
	$scope.anuncios = [];
    $scope.categorias = []; 
    
	   $scope.carregarCategorias = function () {
           var operacao = "selectCategoria";
           var login = window.sessionStorage.getItem('login');

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
	 
         
     $scope.carregarPerfilLogin = function () {
  	  	var operacao = "selectPerfilLogin";
        var login = window.sessionStorage.getItem('login');

		$http({
		      method: 'post',
		      url: url,
		      data: $.param({ 'login' : login, 'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
                $scope.perfilLogado = data;
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
    
     $scope.carregarAnuncio = function () {
         var operacao = "selectAnuncio";
             var login = window.sessionStorage.getItem('login');

		  $http({
		      method: 'post',
		      url: url,
		      data: $.param({ 'login' : login, 'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
	    		$scope.anuncios = data;
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
    
    
    
    
	
		$scope.adicionarAnuncio = function (anuncio) {
		var operacao = "insertAnuncio";	
        var login = window.sessionStorage.getItem('login');
		$http({
		      method: 'post',
		      url: url,
		      data: $.param({'nome': anuncio.nome, 
			  				 'descricao': anuncio.descricao,
							 'idCategoria': anuncio.categoria.id,
							 'login': login,
			  				'operacao' : operacao 
							}),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
				delete $scope.anuncios;
                $scope.anuncioFeito = true;
				$scope.anuncioForm.$setPristine();
                $scope.carregarAnuncio();
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
	
    parseQueryString();
    $scope.carregarPerfilLogin();
	$scope.carregarCategorias();
    $scope.carregarAnuncio();
});