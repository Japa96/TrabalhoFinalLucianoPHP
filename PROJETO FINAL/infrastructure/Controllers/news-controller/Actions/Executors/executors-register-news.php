<?php
include '../action-news.php';
include '../../../../../crud/crud_connection.php';
	
  $arquivo = $_FILES['arquivo']['tmp_name'];
 	$tamanho = $_FILES['arquivo']['size'];
 	$tipo = $_FILES['arquivo']['type'];
 	$nome = $_FILES['arquivo']['name'];

  $base64 = chunk_split(base64_encode(file_get_contents($arquivo)));
  date_default_timezone_set('America/Sao_Paulo');
  $data_postagem = date('Y-m-d h:i:s');
  $descricao = $_POST['descricao'];
  InsertImage($DBConn, $nome, $tamanho, $tipo, $base64);
  $Id_Imagem = FindImageId($DBConn);

  session_start();
  isset($_SESSION['email']);
  isset($_SESSION['senha']);
  $senha = $_SESSION["senha"];
  $email = $_SESSION["email"];
  $user = explode("@", $email);
  $sql = "SELECT Id, Tipo from tbuser where Email = '$email' and senha = '$senha'";
  $result = mysqli_query($DBConn, $sql) or die("Erro ao executar query");
  $row = mysqli_fetch_array($result);
 


  $Id_Usuario = $row[0];
  $dataremo = $_POST['dataremo'];
  $datavisu = $_POST['datavisu'];
  $titulo = $_POST['titulo'];
  if($row[1] == 1 || $row[1] == 2){
    RegistraNoticia($DBConn, $descricao, $data_postagem, $Id_Usuario, $Id_Imagem, $datavisu, $dataremo, $titulo);
  }
  	header("location:../../../../Domains/noticias.php");
?>