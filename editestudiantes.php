<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estudiantes</title>


<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">


<style type="text/css">
    .table-scroll{
    	margin: 20px;
    }
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
</style>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://caucepr.weebly.com/">Página Principal CAUCE</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="menuprincipal.php">Inicio</a>
                    </li>
                    <li>
                        <a href="editcursos.php">Cursos</a>
                    </li>
                    <li>
                        <a href="editestudiantes.php">Estudiantes</a>
                    </li>
                    <li>
                        <a href="editvoluntarios.php">Voluntarios</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php
require_once("checklogin.php");


// Displays voluntary employees in table and allows for it to delete and add data.
$server = "localhost";
$dB = "avalles";
$user = "avalles";
$password = "avalles@";
$coneccion = new mysqli($server, $user, $password, $dB);
if ($coneccion->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>

  <div class="container">

      <form class="form-signin" method="post" enctype="application/x-www-form-urlencoded">
        <h3 class="form-signin-heading">Llene todos los espacios para añadir estudiantes: </h3>
        <label for="nombre_estudiante" class="sr-only">Nombre del Estudiante</label>
        <input type="text" name = "nombre_estudiante" id="nombre_estudiante" class="form-control" placeholder="Nombre del Estudiante" required autofocus>
        </br>
        <label for="direccion_estu" class="sr-only">Direccion Postal</label>
        <input type="text" name = "direccion_estu" id="direccion_estu" class="form-control" placeholder="Dirección Postal" required autofocus>
        </br>
        <label for="telefono_estu" class="sr-only">Telefono</label>
        <input type="text" name = "telefono_estu" id="telefono_estu" class="form-control" placeholder="Teléfono" required>
        </br>
        <label for="sexo_estu" class="sr-only">Sexo</label>
        <input type="text" name = "sexo_estu" id="sexo_estu" class="form-control" placeholder="Sexo" required>
        </br>
        </div>
        <center>
        <button type="submit" id ="submit" name = "submit" class="btn btn-lg btn-primary btn-danger">Editar</button>
        </center>
      </form>

    </div> <!-- /container -->

<?php

if (isset($_POST["submit"])) {
	$nombre_estudiante = $_POST["nombre_estudiante"];
	$direccion_estu = $_POST["direccion_estu"];
	$telefono_estu = $_POST["telefono_estu"];
	$sexo_estu = $_POST["sexo_estu"];
	mysqli_query($coneccion,"INSERT INTO estudiante ('nombre_estudiante', 'direccion_estu', 'telefono_estu', 'sexo_estu',
		VALUES ($nombre_estudiante, $direccion_estu, $telefono_estu, $sexo_estu)");
}

print "</br>";
print "<font size = '5'> Lista de estudiantes: </font>";
print "<br/>";
print "<font size = '3'> Seleccione la información que desea borrar. </font>";
print "<br/>";

print "<div class = 'table-scroll'>";
    print "<div class = 'table-responsive'>"; 
        print "<table class='table table-bordered'>";
		$query = "SELECT * FROM estudiante ORDER BY id_estudiante";

		if ($stmt = $coneccion->prepare($query) ) {
		$stmt -> execute();
		$stmt -> bind_result($id_estudiante, $nombre_estudiante, $direccion_estu, $telefono_estu, $sexo_estu);

		$columnas = array("ID del Estudiante", "Nombre del Estudiante", "Direccion", "Telefono", "Sexo", " ");
		print "<thead>";
		for ($i = 0; $i < 6; $i++) {
			print"<th>";
			print $columnas[$i];
			print"</th>";
		}
		print "</thead>";
		print "<tbody>";
		while( $stmt -> fetch() ) {
			print"<tr>";
			printf("</td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> \n", 
			 	 $id_estudiante, $nombre_estudiante, $direccion_estu, $telefono_estu, $sexo_estu);
                 ?>
            <td class="contact-delete">
            <form action='deleteestudiante.php?name="<?php echo $id_estudiante; ?>"' method="post">
            <input type="hidden" name="name" value="<?php echo $id_estudiante; ?>">
            <center>
            <button type="submit" id ="submit" name = "submit" class="btn btn-sm btn-default">Borrar</button>
            </center>
            </form>
            </td>

            <?php
			print"</tr>";
		}
		print "</tbody>";
		print "</table>";
		
		$stmt->close();
		}

    print "</div>";
print "</div>";

$coneccion ->close();
?>
    </div> <!-- /container -->
</body>
</html>