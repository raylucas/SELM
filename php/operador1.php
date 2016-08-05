<?php


    require_once ('config.php');

  	$operacao = $_POST['operacao'];


  if($operacao == "selectCategoria"){

        echo("tamo no 1");
        
		$sql = "SELECT * FROM categoria";
		$query = $mysqli->query($sql);
		$categorias = array();
        
	       
		while ($dados = @$query->fetch_array()) { 	
			$json["id"] = $dados[0];
			$json["nome"] = $dados[1];
			array_push($categorias, $json); 
		}
        
		echo json_encode($categorias);
	}



    
    
?>