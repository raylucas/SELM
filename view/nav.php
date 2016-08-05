<?php

	require_once ('../php/config.php');

    session_start();
    $nome = "";

    if(isset($_SESSION['login_liberado'])){
        $login=$_SESSION['login_liberado'];
        $senha=$_SESSION['senha_liberada'];
        $sql = "SELECT * FROM perfil WHERE login='$login' AND senha='$senha'  ";
        $query = $mysqli->query($sql);

        while ($dados = @$query->fetch_array()){
            $nome = $dados[3];	
			$perfil = $dados[1];
			$id = $dados[0];
        }
		
		$array=explode(" ",$nome);
    }

?>

<div ng-controller="loginCtrl">

<nav class="navbar navbar-inverse navbar-fixed-top"  >
	<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed"
			data-toggle="collapse" data-target="#navbar"
			aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span> <span
				class="icon-bar"></span> <span class="icon-bar"></span> <span
				class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.html"><img class="logo" src="images/logo/logo.png"></a>
	</div>
	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			
			
			<li class="dropdown"><a href="#" class="dropdown-toggle"
				data-toggle="dropdown" role="button" aria-haspopup="true"
				aria-expanded="false">Categorias <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Produtos</li>
					<li><a href="#">Comida</a></li>
					<li><a href="#">Cosméticos</a></li>
					<li role="separator" class="divider"></li>
					<li class="dropdown-header">Serviços</li>
					<li><a href="#">Serviço</a></li>
				</ul>
			</li>
		</ul>

		
		<form class="navbar-form navbar-left" role="search">
			<div class="form-group">
			<div class="input-group">
					<input type="text" class="form-control" placeholder="Pesquise" aria-describedby="sizing-addon1" />
					<span class="input-group-btn">
						<button id="sizing-addon1" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
					</span>
				</div>
			</div>
      </form>
				
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown"><a href="#" class="dropdown-toggle"
				data-toggle="dropdown" role="button" aria-haspopup="true"
				aria-expanded="false"> <?php 
										if($nome == ""){ ?> 
                                            <span class="glyphicon glyphicon-user"></span>
											<?php echo "Conta"; ?>
											
										<?php } 
										else{
											?>
                                            
                                            <div class="mini">
                                                <div class="nome-mini"><?php echo $array[0]; ?></div>

                                                <div class="perfil-mini"><img class="img-circle img-responsive " src="images/perfis/<?php echo $perfil; ?>/perfil.jpeg"  alt="" width="60px" height="60px;" /></div>
                                            </div>
							
										
										<?php } 
									?> </a>
				<ul class="dropdown-menu dropdown-login">
                    <?php if($nome == ""){ ?>
					<form class="navbar-form form-login" role="search">
						<div class="form-group">
							<h4 class="login-title">Entre com seu login:</h4>
							<input type="text" ng-model="perfil.login" class="form-control" placeholder="Login" style=" display: inline-block;">
							
							<input type="password" ng-model="perfil.senha"  class="form-control" placeholder="Senha">
							<br /> <br />
						</div>
						<button type="submit" class="btn btn-warning btn-block" ng-click="login(perfil)">Entrar</button>
						<br />
                        <a href="cria-perfil.html" class="btn btn-link " role="button" >Você ainda não tem uma conta? <strong>Cadastre-se</strong></a>

					</form>
                    <?php  }else{ ?>
                    
                    <li><a href="#" ng-click="mandarIdPerfil(<?php echo $id; ?>)">Meu perfil</a></li>
                    <li><a href="#" ng-click="logout()">Sair</a></li>
                    <?php } ?>
				</ul>
			</li>
		</ul>
	</div>
	</div>
</nav>

</div>