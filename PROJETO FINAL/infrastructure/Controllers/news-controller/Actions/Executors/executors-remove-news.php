<?php
include '../action-news.php';
include '../../../../../crud/crud_connection.php';
	$id = $_GET['Id'];
	_removeNoticia($DBConn, $id);
	header("location:../../../../../infrastructure/Domains/noticias.php")
?>