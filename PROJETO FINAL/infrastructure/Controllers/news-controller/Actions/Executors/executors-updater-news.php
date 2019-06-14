<?php
include '../action-news.php';
include '../../../../../crud/crud_connection.php';
	$id = $_POST['Id'];
  	$arquivo = $_FILES['arquivo']['tmp_name'];
 	$tamanho = $_FILES['arquivo']['size'];
 	$tipo = $_FILES['arquivo']['type'];
 	$nome = $_FILES['arquivo']['name'];
 	$conteudo = file_get_contents($arquivo);
 	$conteudo = mysqli_real_escape_string($DBConn, $conteudo);
  	$data = $conteudo;

  	$descricao = $_POST['descricao'];
  	$titulo = $_POST['titulo'];
  	$datavisu = $_POST['datavisu'];
  	$dataremo = $_POST['dataremo'];
  	$id_imagem = FindImageById($DBConn, $id);
  	UpdateImageNews($DBConn, $id_imagem, $nome, $tamanho, $tipo, $data);
  	UpdateDadosNews($DBConn, $id, $descricao, $titulo, $datavisu, $dataremo);
    header("location:../../../../Domains/noticias.php");


?>