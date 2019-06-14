<?php
	include "../crud/user_crud.php";

	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$tipo = 2;
	registerUser($DBConn, $email, $senha, $tipo);

?>