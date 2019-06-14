<?php
	include '../Executors/executors-alerts.php';
	$text = $_POST['text'];
	registerAlert($DBConn, $text);
	header("location:../../../Domains/noticias.php");
?>