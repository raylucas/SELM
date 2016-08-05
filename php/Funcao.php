<?php
	include "Conexao.php";
	session_start();
	
	//Cadastrado
	if($_GET['funcao'] == "cadastro"){

		$nome = $_POST['nome'];
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		$confsenha = $_POST['confsenha'];
		$prof=$_SESSION['prof'];
		
		//$sql=mysql_query("select * from login where login='$login'");
		
			if ($nome==""){
				echo "<script>alert ('Insira o seu nome')</script>";
				echo "<meta http-equiv='refresh' content='0;URL=Cadastro-Aluno.php'>";
			}
			else if($login==""){
				echo "<script>alert ('Insira um nome para login')</script>";
				echo "<meta http-equiv='refresh' content='0;URL=Cadastro-Aluno.php'>";
			}
			else if($senha==""){
				echo "<script>alert ('Insira uma senha')</script>";
				echo "<meta http-equiv='refresh' content='0;URL=Cadastro-Aluno.php'>";
			}
			else if($confsenha==""){
				echo "<script>alert ('Confirme sua senha')</script>";
				echo "<meta http-equiv='refresh' content='0;URL=Cadastro-Aluno.php'>";
			}
			else if ($senha!=$confsenha){
				echo "<script>alert ('Sua senha não coincide com a confirmação')</script>";
				echo "<meta http-equiv='refresh' content='0;URL=Cadastro-Aluno.php'>";
			}
			else if (mysql_num_rows($sql)==1){
			echo "<script>alert ('Login já existe')</script>";
				echo "<meta http-equiv='refresh' content='0;URL=Cadastro-Aluno.php'>";
			}
			else{
				$inserir = mysql_query("INSERT INTO login VALUES(NULL,'$nome','$login','$senha','$prof')");
				
				
				$_SESSION['login_liberado']=$login;
				$_SESSION['senha_liberada']=$senha;
				
					if($prof=="Professor"){
						echo "<script>alert ('Bem Vindo(a) professor(a) $nome')</script>"; 
						echo "<meta http-equiv='refresh' content='0;URL=Index.php'>";
					}
					else{
						echo "<script>alert ('Bem Vindo(a) $nome')</script>"; 
						echo "<meta http-equiv='refresh' content='0;URL=Index.php'>";
					}
			}
	}

	
	//Uploads  
	if($_GET['funcao'] == "upload"){
		
	// Por padrão, o Flash envia o arquivo como 'Filedata'
	$file = $_FILES['Filedata'];
 	// Onde salvar o arquivo
	$arquivo = "informatica/".$file['name'];
	// Move o arquivo e retorna o resultado para o Flash com o "echo"
	echo move_uploaded_file($file['tmp_name'], $arquivo);

	}
	
	//Uploads Web 
	if($_GET['funcao'] == "uploadweb"){
		session_start();
		$login=$_SESSION['login_liberado'];
		mkdir("C:\wamp\www\ProjetoFinal\Sites\.$login",777);
		
		// Por padrão, o Flash envia o arquivo como 'Filedata'
		$file = $_FILES['Filedata'];
 		// Onde salvar o arquivo
		$arquivo = "Sites/.$login".$file['name'];
		// Move o arquivo e retorna o resultado para o Flash com o "echo"
		echo move_uploaded_file($file['tmp_name'], $arquivo);
		
		
		
		echo '<a href="localhost/ProjetoFinal/Sites/adm" target="_blank">';
		echo '<a href="http://localhost/phpmyadmin/" target="_blank">';
		
	}
	
	
	//Downloads	
	if($_GET['funcao'] == "download"){ 
	$pasta="informatica";	
		if(isset ($_GET['file']) && file_exists("{$pasta}/".$_GET['file'])){
			$file = $_GET['file'];
			$type = filetype("{$pasta}/{$file}");
			$size = filesize("{$pasta}/{$file}");
			header ("Content-Description: File Transfer");
			header("Content-Type:{$type})");
			header("Content-Length:{$size})");
			header("Content-Disposition: attachment; filename=$file");
			readfile("{$pasta}/{$file}");
			exit;
		}
	}
	//Login
	if($_GET['funcao'] == "login"){ 
		
		$sql = mysql_query("select *from login where login='{$_POST['login']}' and senha='{$_POST['senha']}'  ");
		while ($listar = mysql_fetch_array($sql)){
			$login = $listar ['login'];
			$nome = $listar ['nome'];
			$senha= $listar ['senha'];
			$prof = $listar ['profissao'];
		}
			if (mysql_num_rows($sql)==1){ 
				
				$_SESSION['login_liberado']=$login;
				$_SESSION['senha_liberada']=$senha;
				
					if($prof=="Professor"){
						echo "<script>alert ('Bem Vindo(a) professor(a) $nome')</script>";
						echo "<meta http-equiv='refresh' content='0;URL=Index.php'>"; 
					}
					else if($prof=="ADM"){
						echo "<script>alert ('Bem Vindo(a) Administrador(a) $nome')</script>";
						echo "<meta http-equiv='refresh' content='0;URL=Index.php'>"; 
					}
					else{
						echo "<script>alert ('Bem Vindo(a) $nome')</script>"; 
						echo "<meta http-equiv='refresh' content='0;URL=Index.php'>";
					}
			}
			else{
				unset ($_SESSION['login_liberado']);
				unset ($_SESSION['senha_liberada']);
				echo "<script>alert ('Login ou senhas incorretos')</script>"; 
				echo "<meta http-equiv='refresh' content='0;URL=Login.php'>";
			}
			
	}
	
	//Logout
	if($_GET['funcao'] == "logout"){ 
	
		$sql = mysql_query("select *from login where login='$login1'");
		while ($listar = mysql_fetch_array($sql)){
			$nome = $listar ['nome'];
		}
		
		unset ($_SESSION['login_liberado']);
		unset ($_SESSION['senha_liberada']);
		header("Location: index.php");
		
		
	}
	
	//Excluir
	if($_GET['funcao']=="excluir"){
		$codigo = $_GET['codigo'];
		$sql = mysql_query("select *from login where codigo='$codigo'");
		while ($listar = mysql_fetch_array($sql)){
			$prof = $listar ['profissao'];
		}
		$excluir= mysql_query("delete from login where codigo ='$codigo'");
		echo "<script>alert ('Usuário deletado)</script>"; 	
		
			if($prof=="Aluno"){
				echo "<meta http-equiv='refresh' content='0;URL=exclualuno.php'>";
			}
			else{
				echo "<meta http-equiv='refresh' content='0;URL=excluprof.php'>";
			}
			
	}
	
	//Logado
	session_start();
	$login=$_SESSION['login_liberado'];
	$senha=$_SESSION['senha_liberada'];
	$sql = mysql_query("select *from login where login='$login' and senha='$senha'  ");
		while ($listar = mysql_fetch_array($sql)){
			
		$nome=$listar['nome'];	
		}
			if(!isset($_SESSION['login_liberado'])and !isset($_SESSION['senha_liberada'])){
				header("Location: index.php");
			}
	
	
	if($_GET['funcao']=="abrir"){
?>
		<script language="javascript"> 

		window.open("http://localhost/phpmyadmin/");
		window.open("http://localhost/");  
 
</script>

<?php
	}
?>

