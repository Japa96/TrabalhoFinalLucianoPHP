<?php
	function verifyUserAcess($DBConn, $email, $senha){
		$sql = "SELECT Tipo from tbuser where Email = '$email' and Senha = '$senha'";
		$result = mysqli_query($DBConn, $sql);
		$row = mysqli_fetch_row($result);
		return $row[0];
	}
?>