<?php
	include '../../../../crud/crud_connection.php';

	function registerAlert($DBConn, $text){
        session_start();
		$email = $_SESSION['email'];
		$senha = $_SESSION['senha'];
		$sql = "SELECT Id, Tipo from tbuser WHERE Email = '$email' and Senha = '$senha'";
		$result_user = mysqli_query($DBConn, $sql);
		$row = mysqli_fetch_row($result_user);
		if($row[1] == 1 || $row[1] == 3 ){
			$sql = "INSERT into avisos (Texto, Id_Usuario) VALUES ('$text', '$row[0]')";
			$result = mysqli_query($DBConn, $sql) or die("Erro ao executar query");
		}		
	}
?>