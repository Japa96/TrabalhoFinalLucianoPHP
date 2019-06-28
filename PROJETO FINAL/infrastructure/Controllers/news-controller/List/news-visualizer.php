<!DOCTYPE html>

<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

    <link href="../../../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php
            include '../Controllers/date-controller/date-controller.php';

            	function List_News($DBConn){
                    $sql = "SELECT Id, Descricao, Data_Postagem, titulo from tbnews where (Data_visualizacao <= CURRENT_TIMESTAMP AND Data_remocao > CURRENT_TIMESTAMP) order by id desc";
            		$resultado = mysqli_query($DBConn, $sql);
                    echo "<b id='align'>NOTICIAS</b>";
            		while($row = mysqli_fetch_array($resultado)){                       
                        echo "<table class='table' style='table-layout:fixed;'>";
                        echo "<tr>";
                        echo "<td><b>Titulo: <a href='../Controllers/news-controller/Actions/show-max-news.php?Id=$row[0]'>$row[3]</b></a></td>";
                        echo "<td><div>
                        <a class='btn btn-default' href='../Controllers/news-controller/Actions/Executors/executors-remove-news.php?Id=$row[0]'>Remover</a>
                        </div>
                        </td>";
                        echo "</tr>";
            			echo "<tr>";
                       
            			echo "</tr>";                       
            			echo "</table>";
            		}
            	}
                function listAlert($DBConn){
                    $sql = "SELECT Id, Texto from avisos order by Id desc";
                    $resultado = mysqli_query($DBConn, $sql);
                    echo "<b id='align'>AVISOS</b>";
                    while($row = mysqli_fetch_array($resultado)){
                        echo "<table id='alerts' class='table'>";
                        echo "<tr>";
                        echo "<td>$row[1]</td>";
                        echo "<td><a class='btn btn-default' href='../Controllers/news-controller/Actions/Executors/executors-remove-alerts.php?Id=$row[0]'>Remover</a></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "</tr>";
                        echo "</table>";
                    }
                }
            ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    
    </body>
</html>
