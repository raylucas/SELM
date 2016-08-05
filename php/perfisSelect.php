<?php

	require_once ('config.php');

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

	

?>