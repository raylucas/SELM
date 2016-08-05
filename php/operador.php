<?php

	require_once ('config.php');
	
  	$operacao = $_POST['operacao'];


   if($operacao == "login"){
        $login = $_POST['login'];
        $senha = $_POST['senha'];
		$nome = "";
        
        $sql = "SELECT * FROM perfil WHERE login='$login' AND senha='$senha'  ";
        $query = $mysqli->query($sql);
		
		echo $sql;
		
        while ($dados = @$query->fetch_array()){
            $nome = $dados[3];	
        }
        
        session_start();
        
       if($nome != ""){
           $_SESSION['login_liberado']=$login;
           $_SESSION['senha_liberada']=$senha;
        }
      
	  	 header("Refresh:0");

        
    }
	
	if($operacao == "logout"){ 
        echo $operacao;
        session_start();
        unset ($_SESSION['login_liberado']);
        unset ($_SESSION['senha_liberada']);
        header("Location: index.html");
    }
	  
	 if($operacao == "selectPerfilLogin"){
		
		$login = $_POST['login'];
	
		$sql = "SELECT * FROM perfil WHERE login='$login'";
		
		$query = $mysqli->query($sql);
		$perfil = array();
		
		while ($dados = @$query->fetch_array()) { 	
			$json["id"] = $dados[0];
			$json["login"] = $dados[1];
			$json["senha"] = $dados[2];
			$json["nome"] = $dados[3];
			$json["celular"] = $dados[4];
			$json["sobre"] = $dados[5];

			array_push($perfil, $json); 
		}
		
		
		echo json_encode($perfil);
		
	}
	    
	if($operacao == "insertPerfil"){
				
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		$nome = $_POST['nome'];
		$celular = $_POST['celular'];
		$sobre = $_POST['sobre'];
        
        session_start();
        
        mkdir("../images/perfis/".$login,777);
        $caminhoOriginal = $_SESSION['$imagePath'];
        $caminhoTemporario =  $_SESSION['fotoPerfil'];
        $caminhoNovo = "../images/perfis/".$login."/perfil.jpeg";
                
        if (!copy($caminhoTemporario, $caminhoNovo)) {
            echo "Deu ruim, deu ruim, deu mto ruim";
        }
        
        unlink($caminhoTemporario);
        unlink($caminhoOriginal);
        
		$sql = "INSERT INTO perfil(id, login, senha, nome, celular, sobre) VALUES (' ','$login','$senha','$nome','$celular','$sobre')";	
		
		$mysqli->query($sql);
		$mysqli->close();
        
        $_SESSION['login_liberado']=$login;
        $_SESSION['senha_liberada']=$senha;
		
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


	
/*	if($operacao == "selectPerfil"){
		
		$idPerfil = $_POST['idPerfil'];
	
		$sql = "SELECT * FROM perfil WHERE id='$idPerfil'";
		$query = $mysqli->query($sql);
		$perfil = array();
		$anuncio = array();
		
		while ($dados = @$query->fetch_array()) { 	
			$json["id"] = $dados[0];
			$json["login"] = $dados[1];
			$json["senha"] = $dados[2];
			$json["nome"] = $dados[3];
			$json["celular"] = $dados[4];
			$json["sobre"] = $dados[5];

				
			$idPerfil = $dados[0];
			
			$sql1 = "SELECT * FROM anuncio WHERE idPerfil='$idPerfil'";
			$query1 = $mysqli->query($sql1);
			            
			while ($dados1 = @$query1->fetch_array()) { 
				$json1["id"] = $dados1[0];
				$json1["nome"] = $dados1[1];
				$json1["descricao"] = $dados1[2];

				$idCategoria = $dados1[3];
				
				$sql2 = "SELECT * FROM categoria WHERE id='$idCategoria'";
				$query2 = $mysqli->query($sql2);
							
				while ($dados2 = @$query2->fetch_array()) { 
					$json2["id"] = $dados2[0];
					$json2["nome"] = $dados2[1];

					$json1["categoria"] = $json2;
				}

				array_push($anuncio, $json1);

				$json["anuncio"] = $anuncio;
	
			}

			array_push($perfil, $json); 
		}
		
		var_dump($perfil);

		echo json_encode($perfil);
		
	}*/

	if($operacao == "selectPerfil"){
		
		$idPerfil = $_POST['idPerfil'];
	
		$sql = "SELECT * FROM perfil WHERE id='$idPerfil'";
		
		$query = $mysqli->query($sql);
		$perfil = array();
		
		while ($dados = @$query->fetch_array()) { 	
			$json["id"] = $dados[0];
			$json["login"] = $dados[1];
			$json["senha"] = $dados[2];
			$json["nome"] = $dados[3];
			$json["celular"] = $dados[4];
			$json["sobre"] = $dados[5];

			array_push($perfil, $json); 
		}
		

		echo json_encode($perfil);
		
	}


	if($operacao == "selectAnuncioId"){
        
    	$idPerfil = $_POST['idPerfil'];
        
      	$sql = "SELECT * FROM anuncio WHERE idPerfil='$idPerfil'";
	    $query = $mysqli->query($sql);    
		$anuncios = array();
        
		while ($dados = @$query->fetch_array()) { 
            $teste = $dados[0];
			$json["id"] = $dados[0];
			$json["nome"] = $dados[1];
			$json["descricao"] = $dados[2];
			
			$idCategoria = $dados[3];
			
			$sql1 = "SELECT * FROM categoria WHERE id='$idCategoria'";
			$query1 = $mysqli->query($sql1);
			$categoria = array();
			            
			while ($dados1 = @$query1->fetch_array()) { 
				$json1["id"] = $dados1[0];
				$json1["nome"] = $dados1[1];
				$json["categoria"] = $json1;
	
			}

			array_push($anuncios, $json); 
		}
               
		echo json_encode($anuncios);
	
	}

	
	if($operacao == "selectCategoria"){
        
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
	
	if($operacao == "insertAnuncio"){
				
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$idCategoria = $_POST['idCategoria'];
		
		$login = $_POST['login'];
         		        
		$sql = "SELECT * FROM perfil WHERE login='$login'";
		$query = $mysqli->query($sql);
        $idPerfil;
        
        while ($dados = @$query->fetch_array()) { 	
            $idPerfil = $dados[0];
        }

					
		$sql = "INSERT INTO anuncio(id, nome, descricao, idCategoria, idPerfil) VALUES (' ','$nome','$descricao','$idCategoria', '$idPerfil')";	
			
			
		$mysqli->query($sql);
		$mysqli->close();
		
	}

    if($operacao == "selectAnuncio"){
        
    	$login = $_POST['login'];
                
		$sql = "SELECT * FROM perfil WHERE login='$login'";
		$query = $mysqli->query($sql);
        $idPerfil;
        
        while ($dados = @$query->fetch_array()) { 	
            $idPerfil = $dados[0];
        }
        
		$anuncios = array();
        
      	$sql = "SELECT * FROM anuncio WHERE idPerfil='$idPerfil'";
	    $query = $mysqli->query($sql);    
        $teste;
        
		while ($dados = @$query->fetch_array()) { 
            $teste = $dados[0];
			$json["id"] = $dados[0];
			$json["nome"] = $dados[1];
			$json["descricao"] = $dados[2];
			
			$idCategoria = $dados[3];
			
			$sql1 = "SELECT * FROM categoria WHERE id='$idCategoria'";
			$query1 = $mysqli->query($sql1);
			$categoria = array();
			            
			while ($dados1 = @$query1->fetch_array()) { 
				$json1["id"] = $dados1[0];
				$json1["nome"] = $dados1[1];
				$json["categoria"] = $json1;
	
			}

			array_push($anuncios, $json); 
		}
               
		echo json_encode($anuncios);
	
	}

    if($operacao == "selectAnuncios"){
        
        
      	$sql = "SELECT * FROM anuncio";
	    $query = $mysqli->query($sql); 
        $anuncios = array();
        
		while ($dados = @$query->fetch_array()) { 
			$json["id"] = $dados[0];
			$json["nome"] = $dados[1];
			$json["descricao"] = $dados[2];
			
			$idCategoria = $dados[3];
			
			$sql1 = "SELECT * FROM categoria WHERE id='$idCategoria'";
			$query1 = $mysqli->query($sql1);
			$categoria = array();
			            
			while ($dados1 = @$query1->fetch_array()) { 
				$json1["id"] = $dados1[0];
				$json1["nome"] = $dados1[1];
				$json["categoria"] = $json1;
	
			}
            
            $idPerfil = $dados[4];
            
            $sql2 = "SELECT * FROM perfil WHERE id='$idPerfil'";
			$query2 = $mysqli->query($sql2);
			$perfil = array();
			            
			while ($dados2 = @$query2->fetch_array()) { 
				$json2["id"] = $dados2[0];
				$json2["nome"] = $dados2[3];
				$json["perfil"] = $json2;
	
			}
            
			array_push($anuncios, $json); 
		}
               
		echo json_encode($anuncios);
	
	}

    if($operacao == "selectAnunciosAlimentos"){
        
        $alimentos = 5;
        
      	$sql = "SELECT * FROM anuncio WHERE idCategoria='$alimentos'";
	    $query = $mysqli->query($sql); 
        $anuncios = array();
        
		while ($dados = @$query->fetch_array()) { 
			$json["id"] = $dados[0];
			$json["nome"] = $dados[1];
			$json["descricao"] = $dados[2];
			
			$idCategoria = $dados[3];
			
			$sql1 = "SELECT * FROM categoria WHERE id='$idCategoria'";
			$query1 = $mysqli->query($sql1);
			$categoria = array();
			            
			while ($dados1 = @$query1->fetch_array()) { 
				$json1["id"] = $dados1[0];
				$json1["nome"] = $dados1[1];
				$json["categoria"] = $json1;
	
			}
            
            $idPerfil = $dados[4];
            
            $sql2 = "SELECT * FROM perfil WHERE id='$idPerfil'";
			$query2 = $mysqli->query($sql2);
			$perfil = array();
			            
			while ($dados2 = @$query2->fetch_array()) { 
				$json2["id"] = $dados2[0];
				$json2["nome"] = $dados2[3];
				$json["perfil"] = $json2;
	
			}
            
			array_push($anuncios, $json); 
		}
               
		echo json_encode($anuncios);
	
	}

    if($operacao == "selectAnunciosBebidas"){
        
        $bebidas = 6;
        
      	$sql = "SELECT * FROM anuncio WHERE idCategoria='$bebidas'";
	    $query = $mysqli->query($sql); 
        $anuncios = array();
        
		while ($dados = @$query->fetch_array()) { 
			$json["id"] = $dados[0];
			$json["nome"] = $dados[1];
			$json["descricao"] = $dados[2];
			
			$idCategoria = $dados[3];
			
			$sql1 = "SELECT * FROM categoria WHERE id='$idCategoria'";
			$query1 = $mysqli->query($sql1);
			$categoria = array();
			            
			while ($dados1 = @$query1->fetch_array()) { 
				$json1["id"] = $dados1[0];
				$json1["nome"] = $dados1[1];
				$json["categoria"] = $json1;
	
			}
            
            $idPerfil = $dados[4];
            
            $sql2 = "SELECT * FROM perfil WHERE id='$idPerfil'";
			$query2 = $mysqli->query($sql2);
			$perfil = array();
			            
			while ($dados2 = @$query2->fetch_array()) { 
				$json2["id"] = $dados2[0];
				$json2["nome"] = $dados2[3];
				$json["perfil"] = $json2;
	
			}
            
			array_push($anuncios, $json); 
		}
               
		echo json_encode($anuncios);
	
	}

    if($operacao == "selectAnunciosCosmeticos"){
        
        $cosmeticos = 7;
        
      	$sql = "SELECT * FROM anuncio WHERE idCategoria='$cosmeticos'";
	    $query = $mysqli->query($sql); 
        $anuncios = array();
        
		while ($dados = @$query->fetch_array()) { 
			$json["id"] = $dados[0];
			$json["nome"] = $dados[1];
			$json["descricao"] = $dados[2];
			
			$idCategoria = $dados[3];
			
			$sql1 = "SELECT * FROM categoria WHERE id='$idCategoria'";
			$query1 = $mysqli->query($sql1);
			$categoria = array();
			            
			while ($dados1 = @$query1->fetch_array()) { 
				$json1["id"] = $dados1[0];
				$json1["nome"] = $dados1[1];
				$json["categoria"] = $json1;
	
			}
            
            $idPerfil = $dados[4];
            
            $sql2 = "SELECT * FROM perfil WHERE id='$idPerfil'";
			$query2 = $mysqli->query($sql2);
			$perfil = array();
			            
			while ($dados2 = @$query2->fetch_array()) { 
				$json2["id"] = $dados2[0];
				$json2["nome"] = $dados2[3];
				$json["perfil"] = $json2;
	
			}
            
			array_push($anuncios, $json); 
		}
               
		echo json_encode($anuncios);
	
	}

    if($operacao == "selectAnunciosServicos"){
        
        $servicos = 8;
        
      	$sql = "SELECT * FROM anuncio WHERE idCategoria='$servicos'";
	    $query = $mysqli->query($sql); 
        $anuncios = array();
        
		while ($dados = @$query->fetch_array()) { 
			$json["id"] = $dados[0];
			$json["nome"] = $dados[1];
			$json["descricao"] = $dados[2];
			
			$idCategoria = $dados[3];
			
			$sql1 = "SELECT * FROM categoria WHERE id='$idCategoria'";
			$query1 = $mysqli->query($sql1);
			$categoria = array();
			            
			while ($dados1 = @$query1->fetch_array()) { 
				$json1["id"] = $dados1[0];
				$json1["nome"] = $dados1[1];
				$json["categoria"] = $json1;
	
			}
            
            $idPerfil = $dados[4];
            
            $sql2 = "SELECT * FROM perfil WHERE id='$idPerfil'";
			$query2 = $mysqli->query($sql2);
			$perfil = array();
			            
			while ($dados2 = @$query2->fetch_array()) { 
				$json2["id"] = $dados2[0];
				$json2["nome"] = $dados2[3];
				$json["perfil"] = $json2;
	
			}
            
			array_push($anuncios, $json); 
		}
               
		echo json_encode($anuncios);
	
	}

?>