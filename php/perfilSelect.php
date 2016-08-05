<?php

	require_once ('config.php');
    
	date_default_timezone_set('America/Sao_Paulo');
	$post = file_get_contents("php://input");
	$data = json_decode($post);	
	
	$sql = "SELECT * FROM perfil WHERE id='$data'";
		
	$query = $mysqli->query($sql);
	$perfis = array();
	
	while ($dados = @$query->fetch_array()) { 	
		$json["id"] = $dados[0];
		$json["login"] = $dados[1];
		$json["senha"] = $dados[2];
		$json["nome"] = $dados[3];
		$json["celular"] = $dados[4];

		array_push($perfis, $json); 
	}
		
		echo($sql);
		

	json_encode($perfis);

	

?>