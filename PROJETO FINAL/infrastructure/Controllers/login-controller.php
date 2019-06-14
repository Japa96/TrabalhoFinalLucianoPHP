<?php
	include '../../crud/crud_connection.php';
	function _buscaDadosUsuario($DBConn, $sql){
		return $DBConn->query($sql);
	}

	function _validateTryingLogin($DBConn, $email, $senha){
		$query = "SELECT * FROM tbuser";
		$resultado = mysqli_query($DBConn, $query);
		while($linha = mysqli_fetch_array($resultado)){
			echo $linha[0].$linha[1].$linha[2];
			if($linha[1] == $email && $linha[2] == $senha){
				return true;
				}else
		     	continue;
		}
	}

	function _login_Operation($DBConn, $email, $senha){
		$verifica_login = _validateTryingLogin($DBConn, $email, $senha);
		session_start();
			if($verifica_login == true){
				$query = "SELECT * FROM tbuser";
				$busca = _buscaDadosUsuario($DBConn, $query);
				foreach($busca as $dados){
						if($dados["Email"] == $email && $dados["Senha"] == $senha){
							$_SESSION['email'] = $dados["Email"];
							$_SESSION['senha'] = $dados["Senha"];
							$tipo = $dados["Tipo"];
							if($tipo == 1){
								header("location:../Domains/administrative_user-painel.php");
							}elseif($tipo == 2 || $tipo == 3){
								header("location:../Domains/simple_user-painel.php");	
							}else{
								echo "Não foi possivel realizar o login devido a algum erro no registro, por favor contate algum administrador para mais informações.";
							}
						}else{
						    	echo "Não foi possivel realizar o login devido a algum erro no registro, por favor contate algum administrador para mais informações.";
						}
				}
			}else{
				header("location:../../index.php");
			}
	}

	function logout(){
		session_start();
				if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
					unset($_SESSION['email']);
					unset($_SESSION['senha']);
				}
		session_destroy();
		session_regenerate_id();
		header("location:../../index.php");
	}


?>