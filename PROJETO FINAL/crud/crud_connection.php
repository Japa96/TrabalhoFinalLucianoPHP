<?php

	$host = "127.0.0.1";
	$user = "root";
	$password = "";
	$database = "news_database";
	$port = "3306";
	$socket = "";

$DBConn = mysqli_connect($host, $user, $password, $database, $port, $socket) or die("Não foi possivel a Conexão com o MYSQL");

	if(!$DBConn){
	    printf("Não foi possivel a conexão com o MySQL: \n", mysqli_connect_error());
	    exit();
}