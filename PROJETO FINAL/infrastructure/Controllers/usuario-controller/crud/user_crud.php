<?php

	include '../../../../crud/crud_connection.php';
	function registerUser($DBConn, $email, $senha, $tipo){
		$query = "Insert into tbuser (Email, Senha, Tipo) VALUES ('$email', '$senha', '$tipo')";
		$resultado = mysqli_query($DBConn, $query);
		header("location:../../../../index.php");
	}

	function listaUsuario($DBConn){
		$query = "SELECT * FROM tbuser";
		$resultado = mysqli_query($DBConn, $query);
		while($linha = mysqli_fetch_array($resultado)){
			echo $linha[1] ." / ". $linha[2] ." / ".$linha[3];
		}
	}

?>