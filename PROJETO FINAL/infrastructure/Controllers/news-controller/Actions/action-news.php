<?php
	function FindImageById($DBConn, $Id){
		$sql = "SELECT Id_Imagem from tbnews where Id = $Id";
		$result_find_img = mysqli_query($DBConn, $sql);
		$row_img = mysqli_fetch_row($result_find_img);
		return $row_img[0];
	}
	function UpdateImageNews($DBConn, $id_imagem, $nome, $tamanho, $tipo, $arquivo){
		
		$sql = "UPDATE arquivos SET nome_arquivo = '$nome', tamanho_arquivo = '$tamanho', tipo_arquivo = '$tipo' ,arquivo = '$arquivo' where Id = '$id_imagem'";
		$result = mysqli_query($DBConn, $sql) or die ("Algo deu errado ao inserir o registro. Tente novamente.");
	}
	function UpdateDadosNews($DBConn, $Id, $descricao, $titulo, $datavisu, $dataremo){
		$sql_busca_usuario_noticia = "SELECT Id_Usuario FROM tbnews where Id = '$Id'";
		$resultado_id_user = mysqli_query($DBConn, $sql_busca_usuario_noticia);
		$row_user = mysqli_fetch_row($resultado_id_user);	
		$sql_encontra_tipo_usuario = "SELECT Tipo, Email, Senha from tbuser where Id = '$row_user[0]'";
		$resultado_tipo_user = mysqli_query($DBConn, $sql_encontra_tipo_usuario);
		$row_tipo_usuario = mysqli_fetch_row($resultado_tipo_user);
		if($row_tipo_usuario[0] == 1){
			session_start();
			$email = $_SESSION['email'];
			$senha = $_SESSION['senha'];
			if($row_tipo_usuario[1] == $email and $row_tipo_usuario[2] == $senha){
				$sql = "UPDATE tbnews set Descricao = '$descricao', Titulo = '$titulo', Data_visualizacao = '$datavisu', Data_remocao = '$dataremo' where Id = '$Id'";
				$result = mysqli_query($DBConn, $sql) or die("ERRO");
			}
		}
	}


	function _removeNoticia($DBConn, $id){
		$sql_busca_usuario_noticia = "SELECT Id_Usuario FROM tbnews where Id = '$id'";
		$resultado_id_user = mysqli_query($DBConn, $sql_busca_usuario_noticia);
		$row_user = mysqli_fetch_row($resultado_id_user);	
		$sql_encontra_tipo_usuario = "SELECT Tipo, Email, Senha from tbuser where Id = '$row_user[0]'";
		$resultado_tipo_user = mysqli_query($DBConn, $sql_encontra_tipo_usuario);
		$row_tipo_usuario = mysqli_fetch_row($resultado_tipo_user);
		
		if($row_tipo_usuario[0] == 2){
			session_start();
			$email = $_SESSION['email'];
			$senha = $_SESSION['senha'];
			if($row_tipo_usuario[1] == $email and $row_tipo_usuario[2] == $senha){
			$sql_delete = "DELETE FROM tbnews where Id = '$id'";
			mysqli_query($DBConn, $sql_delete);
			}
		}
		if($row_tipo_usuario[0] == 1){
			  session_start();
              $_SESSION['email'];
              $_SESSION['senha'];
              $sql_user = "SELECT * FROM tbuser where Id = '$row_user[0]'";
              $resultado_user_find = mysqli_query($DBConn, $sql_user);
              $row_usuario_busca = mysqli_fetch_row($resultado_user_find);
                   if($row_usuario_busca[1] == $_SESSION['email'] and $row_usuario_busca[2] == $_SESSION['senha']){
                  		$sql_delete_same_news = "DELETE FROM tbnews where Id = '$id'";
                  		mysqli_query($DBConn, $sql_delete_same_news);	
                     }
		}else{
			return "O usuário que registrou essa noticia é um administrador, por isso ela não pode ser removida.";
		}
			return "Ocorreu um problema a remover a noticia, por favor comunique ao administrador do sistema para averiguar o erro.";
	}


	function FindInfosNews($DBConn, $Id){
		$sql = "SELECT Descricao, Data_visualizacao, Data_remocao, Titulo from tbnews where Id = '$Id'";
		$result = mysqli_query($DBConn, $sql);
		$row = mysqli_fetch_row($result);

		 echo " <div id='forms-modal'>
                <form enctype='multipart/form-data' action='Executors/executors-updater-news.php' method='post'>   
                  <div class='form-group'>
                    <label>Id</label>
                    <input type='text' class='form-control' value='$Id' placeholder='id' name='Id' readonly >
                  </div>
                  <div class='form-group'>
                    <label>Imagem</label>
                    <input type='file' class='form-control'  placeholder='Imagem' name='arquivo' required='required'>
                  </div>
                  <div class='form-group'>
                    <label>Descricao</label>
                    <input type='text' class='form-control' value='$row[0]' name='descricao' required='required'>
                  </div>
                  <div class='form-group'>
                    <label>Titulo</label>
                    <input type='text' class='form-control' value='$row[3]'  name='titulo' required='required'>
                  </div>
                  <div class='form-group'>
                    <label>Data que fica visivel</label>
                    <input type='date' class='form-control' value='$row[1]' name='datavisu' required='required'>
                  </div>
                  <div class='form-group'>
                    <label>Data que nao ficara visivel</label>
                    <input type='date' class='form-control' value='$row[2]' name='dataremo' required='required'>
                  </div>
                  <button type='submit' class='btn btn-default'>Atualizar</button>
            </form>
          </div>";
	}

	function RegistraNoticia($DBConn, $descricao, $data_postagem, $Id_Usuario, $Id_Imagem, $datavisu, $dataremo, $titulo){
		$sql = "INSERT INTO tbnews (Descricao, Data_postagem, Id_Usuario, Id_Imagem, Data_visualizacao, Data_remocao, titulo) VALUES ('$descricao', '$data_postagem', '$Id_Usuario', '$Id_Imagem', '$datavisu', '$dataremo', '$titulo')";
		mysqli_query($DBConn, $sql) or die ("Erro ao executar operação");
	}
	
	function FindImageId($DBConn){
		$sql = "SELECT Max(Id) from arquivos";
		$result = mysqli_query($DBConn, $sql);
		$row = mysqli_fetch_array($result);
		return $row[0];
	}
	
	function InsertImage($DBConn, $nome_arquivo, $tamanho_arquivo, $tipo_arquivo, $arquivo){
		$sql = "INSERT INTO arquivos (nome_arquivo, tamanho_arquivo, tipo_arquivo, arquivo) values ('$nome_arquivo', '$tamanho_arquivo', '$tipo_arquivo', '$arquivo')";
		mysqli_query($DBConn, $sql) or die ("Erro");
	}

	function _removeAlerts($DBConn, $id){
		$sql_busca_usuario_noticia = "SELECT Id_Usuario FROM avisos where Id = '$id'";
		$resultado_id_user = mysqli_query($DBConn, $sql_busca_usuario_noticia) or die ("erro query 1");
		$row_user = mysqli_fetch_row($resultado_id_user);	
		$sql_encontra_tipo_usuario = "SELECT Tipo, Email, Senha from tbuser where Id = '$row_user[0]'";
		$resultado_tipo_user = mysqli_query($DBConn, $sql_encontra_tipo_usuario) or die ("erro query 2");
		$row_tipo_usuario = mysqli_fetch_row($resultado_tipo_user);
		
		if($row_tipo_usuario[0] == 2){
			$email = $_SESSION['email'];
			$senha = $_SESSION['senha'];
			echo $row_tipo_usuario[1];
			echo $row_tipo_usuario[2];
			if($row_tipo_usuario[1] == $email and $row_tipo_usuario[2] == $senha){
			$sql_delete = "DELETE FROM avisos where Id = '$id'";
			mysqli_query($DBConn, $sql_delete);
			}
		}
		if($row_tipo_usuario[0] == 1){
			  session_start();
              isset($_SESSION['email']);
              isset($_SESSION['senha']);
              $sql_user = "SELECT * FROM tbuser where Id = '$row_user[0]'";
              $resultado_user_find = mysqli_query($DBConn, $sql_user) or die ("erro query 3");
              $row_usuario_busca = mysqli_fetch_row($resultado_user_find);
                   if($row_usuario_busca[1] == $_SESSION['email'] and $row_usuario_busca[2] == $_SESSION['senha']){
                  		$sql_delete_same_news = "DELETE FROM avisos where Id = '$id'";
                  		mysqli_query($DBConn, $sql_delete_same_news) or die ("erro query 4");	
                     }
		}else{
			return "O usuário que registrou essa noticia é um administrador, por isso ela não pode ser removida.";
		}
			return "Ocorreu um problema a remover a noticia, por favor comunique ao administrador do sistema para averiguar o erro.";

	}

	function showMaxSizeNews($DBConn, $id){
		$sql = "SELECT Descricao, Data_postagem, Titulo, Id_Imagem, Data_visualizacao, Id_Usuario  from tbnews where Id = '$id'";
		$result = mysqli_query($DBConn, $sql);
		$row = mysqli_fetch_row($result);		

		$sqlUser = "SELECT Email from tbuser where Id = '$row[5]'";
		$resultEmailUser = mysqli_query($DBConn, $sqlUser);
		$row_user = mysqli_fetch_row($resultEmailUser);

		$sql2 = "SELECT arquivo, tipo_arquivo from arquivos where id = '$row[3]'";
		$resultimg = mysqli_query($DBConn, $sql2);
		$row_img = mysqli_fetch_row($resultimg);
		$tipo = $row_img[1];
		echo "<td><img  width='300px' src='data:$tipo;charset=binary;base64, $row_img[0]'/></td><br><br>";
		echo "<table>
				<tr>
				<b>Título</b>
					<td style='color:red;'><b>$row[2]</b></td>
				</tr>
			  </table>
			  <br>
			  <div id='tablediv'>
			  <b>Descrição:</b>
			  <table width='100%' style='background-color:#D3D3D3'>
				<tr>
					<td>$row[0]</td>
				</tr>
			  </table>
			  </div>
			  <br>
			  <b>Cadastrado por:</b>
			  <table>
				<tr>
					<td>$row_user[0]</td>
				</tr>
			  </table>
			  <br>
			  <b>Data de inserção:</b>
			  <table>
				<tr>
					<td>$row[1]</td>
				</tr>
			  </table>
			  <br>
			  <b>Data de expiração:</b>
			  <table>
				<tr>
					<td>$row[4]</td>
				</tr>
			  </table>
		";
	}

?>