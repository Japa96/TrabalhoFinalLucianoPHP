<?php
	include '../../crud/crud_connection.php';
	include 'login-controller.php';

	 $email = $_POST["email"];
	 $senha = $_POST["senha"];
	 
	 _login_Operation($DBConn, $email, $senha);

?>