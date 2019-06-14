<?php

	include '../../../../crud/crud_connection.php';

	function _registraNoticia($imagem, $descricao, $data_postagem, $id_usuario, $DBConn){
		$sql = "INSERT INTO tbnews (Imagem, Descricao, Data_postagem, Id_Usuario) VALUES ('$imagem','$descricao','$data_postagem','$id_usuario')";
		$resultado = mysqli_query($DBConn, $sql);
		echo $resultado;
		return $resultado;
	}

	function _listaNoticia($DBConn){
		$sql = "SELECT * FROM tbnews";
		$resultado = mysqli_query($DBConn, $sql);
		while($linha = mysqli_fetch_array($resultado)){
			echo "Imagem: ".$linha[1]." Descricao: ";
		}
	}
	
?>