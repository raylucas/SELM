angular.module("selm").controller("selmCtrl", function ($scope, $http) {
	$scope.teste = "Só foi!";
	$scope.perfis = [];
    $scope.perfil = [];
	$scope.login = [];
    $scope.anuncioAlimentos = [];
    $scope.anuncioBebidas = [];
    $scope.anuncioCosmeticos = [];
    $scope.anuncioServicos = [];
	var nome;
	var url = 'php/operador.php';
    
     

    

    $scope.carregarPerfis = function () {
    var operacao = "selectPerfis";
		$http({
		      method: 'post',
		      url: url,
		      data: $.param({ 'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
	    		$scope.perfis = data;
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
	
	 $scope.mandarIdPerfil = function (idPerfil) {
        window.location.href='perfil.html?id='+idPerfil;
            
	};
    
    $scope.carregarFotoPerfil = function(perfil){
        
        $http({
		      method: 'post',
		      url: 'php/carregaFotoPerfil.php',
		      data: $.param({'fileUpload': perfil.fileUpload}),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {

            }).error(function (data, status, headers, config) {
				$scope.message = "Aconteceu um problema: " + data;
			});
    };
	
	$scope.testeLogin = function(login){
			
        var operacao = "selectLogin";
		$http({
		      method: 'post',
		      url: url,
		      data: $.param({ 'login' : login, 'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
	    		$scope.login = data;

				if($scope.login == ""){
					$scope.loginExiste = false;
					$scope.loginOk = true;
				}
				else{
					$scope.loginExiste = true;
					$scope.loginOk = false;
				}
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});

		
		
	};
	
	$scope.testeSenha = function(senha, repeteSenha){
		
		if(senha == null){
			$scope.senhasIguais = false;
			$scope.senhasDiferentes = false;
			$scope.semSenha = true;
		}
		else{
			if(senha == repeteSenha){
				$scope.senhasIguais = true;
				$scope.senhasDiferentes = false;
				$scope.semSenha = false;
			}
			else{
				$scope.senhasIguais = false;
				$scope.senhasDiferentes = true;
				$scope.semSenha = false;
			}
		}
	};
    
	
	$scope.adicionarPerfil = function (perfis) {
		var operacao = "insertPerfil";	
		$http({
		      method: 'post',
		      url: url,
		      data: $.param({'login': perfis.login, 
			  				 'senha': perfis.senha,
							 'nome': perfis.nome,
							 'celular': perfis.celular,
							 'sobre': perfis.sobre,
							 'Filedata' : perfis.filedata,
			  				'operacao' : operacao 
							}),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
                $scope.perfilFeito = true;
				delete $scope.perfis;
				$scope.perfilForm.$setPristine();
				window.sessionStorage.setItem('login', perfis.login);

				setTimeout("location.href='perfil-editar.html'",5000);
			}).error(function (data, status, headers, config) {
				$scope.message = "Aconteceu um problema: " + data;
			});
	};
    
    var carregarAnuncios = function () {
         var operacao = "selectAnuncios";

		  $http({
		      method: 'post',
		      url: url,
		      data: $.param({'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
                $scope.anuncios = data;
              
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
    
     var carregarAnunciosAlimentos = function () {
         var operacao = "selectAnunciosAlimentos";

		  $http({
		      method: 'post',
		      url: url,
		      data: $.param({'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
                $scope.anuncioAlimentos = data;
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
    
    var carregarAnunciosBebidas = function () {
         var operacao = "selectAnunciosBebidas";

		  $http({
		      method: 'post',
		      url: url,
		      data: $.param({'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
                $scope.anuncioBebidas = data;
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
    
     var carregarAnunciosCosmeticos = function () {
         var operacao = "selectAnunciosCosmeticos";

		  $http({
		      method: 'post',
		      url: url,
		      data: $.param({'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
                $scope.anuncioCosmeticos = data;
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
    
    var carregarAnunciosServicos = function () {
         var operacao = "selectAnunciosServicos";

		  $http({
		      method: 'post',
		      url: url,
		      data: $.param({'operacao' : operacao }),
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).success(function(data, status, headers, config) {
                $scope.anuncioServicos = data;
            }).error(function (data, status, headers, config) {
			$scope.message = "Aconteceu um problema: " + data;
		});
	};
	
    

	
$scope.carregarPerfis();
carregarAnunciosAlimentos();
carregarAnunciosBebidas();
carregarAnunciosServicos();
carregarAnunciosCosmeticos();
	
});