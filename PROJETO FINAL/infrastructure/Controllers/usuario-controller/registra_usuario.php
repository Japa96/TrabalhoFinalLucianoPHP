<!DOCTYPE html>

<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

    <link href="../../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="bg-success">
            <div id="menu-nav-bar">       
                <div id="bg-menu">
                    <a class="btn btn-default" href="../../../index.php" role="button">Inicio</a>
                    <a class="btn btn-default" href="../../Domains/usuario.php" role="button">Usuario</a>
                    <a class="btn btn-default" href="noticias.php" role="button">Noticias</a>
                    <div id="login-side">
                     	<?php
                            session_start();
                       if((isset($_SESSION['email'])) and (isset($_SESSION['senha']))){
                                $email = $_SESSION["email"];
                                $user = explode("@", $email);
                                echo "<div class='btn-group'>
                                <button type='button' class='btn btn-success dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <div id='size-exibition'><span id='glypf-administrate' class='glyphicon glyphicon-user' aria-hidden='true'></span><div class='align'>".$user[0]."</div></div></button>
                                <ul class='dropdown-menu'>
                                <li><a href='../../Domains/administrative_user-painel.php?'>Painel Administrador</a></li>
                                </ul>
                                </div>
                                ";

                                echo "<div id='logout-button'><a class='btn btn-default' href='../destroy-session.php'>Sair</a></div>";
                            }else{
                               header("location:../../../index.php");
                            }
                         ?>
                    </div>
	           	</div>                
	            <div class="bg-success">
	            	<div id="second-menu">
	            		<a class='btn btn-default' href='registra_usuario.php' role='button'>Registrar novo usuario</a>
	            		<a class='btn btn-default' href='Actions/action-lista.php' role='button'>Listar Usuarios</a>
	            	</div>
	            </div>	            
            </div>
        </div>
          <div id="forms-modal">
        	<form action='Actions/action-register.php' method='post'>	
				  <div class="form-group">
				    <label for="exampleInputEmail1">Email</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name='email'>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Senha</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name='senha'>
				  </div>
				  <button type="submit" class="btn btn-default">Registrar</button>
	        </form>
	      </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    
    </body>
</html>

