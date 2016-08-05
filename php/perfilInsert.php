<?php

	require_once ('config.php');
	
  	$operacao = $_POST['operacao'];
	    
	if($operacao == "insertPerfil"){
				
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		$nome = $_POST['nome'];
		$celular = $_POST['celular'];
		$sobre = $_POST['sobre'];
					
		$sql = "INSERT INTO perfil(id, login, senha, nome, celular, sobre) VALUES (' ','$login','$senha','$nome','$celular','$sobre')";
		
		echo $sql;
		
		$mysqli->query($sql);
		$mysqli->close();
		
	}
	
	if($operacao == "selectPerfis"){

        
		$sql = "SELECT * FROM perfil";
		$query = $mysqli->query($sql);
		$perfis = array();
        
	       
		while ($dados = @$query->fetch_array()) { 	
			$json["id"] = $dados[0];
			$json["login"] = $dados[1];
			$json["senha"] = $dados[2];
			$json["nome"] = $dados[3];
			$json["celular"] = $dados[4];
			$json["sobre"] = $dados[5];

			array_push($perfis, $json); 
		}
               
		echo json_encode($perfis);
	
	}
	
	

	


?>