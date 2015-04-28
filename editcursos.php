<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<style type="text/css">
    .table-scroll{
    	margin: 20px;
    }
</style>
<body>
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
        <h3 class="form-signin-heading">Llene todos los espacios para añadir clases: </h3>
        <label for="nombre_clase" class="sr-only">Nombre de la Clase</label>
        <input type="text" name = "nombre_clase" id="nombre_clase" class="form-control" placeholder="Nombre de la Clase" required autofocus>
        </br>
        <label for="horario" class="sr-only">Horario</label>
        <input type="text" name = "horario" id="horario" class="form-control" placeholder="Horario" required autofocus>
        </br>
        <label for="semestre" class="sr-only">Semestre</label>
        <input type="text" name = "semestre" id="semestre" class="form-control" placeholder="Semestre" required>
        </br>
        <label for="nombre_vol" class="sr-only">Nombre del Tutor</label>
        <input type="text" name = "nombre_vol" id="nombre_vol" class="form-control" placeholder="Nombre del Tutor" required>
        </br>
        <label for="seccion" class="sr-only">Seccion</label>
        <input type="text" name = "seccion" id="seccion" class="form-control" placeholder="Seccion" required>
        </br>
        </div>
        <center>
        <button type="submit" id ="submit" name = "submit" class="btn btn-lg btn-primary btn-danger">Editar</button>
        </center>
      </form>

    </div> <!-- /container -->

<?php

if (isset($_POST["submit"])) {
	$nombre_clase = $_POST["nombre_clase"];
	$horario = $_POST["horario"];
	$semestre = $_POST["semestre"];
	$nombre_vol = $_POST["nombre_vol"];
	$seccion = $_POST["seccion"];
	mysqli_query($coneccion,"INSERT INTO clases ('nombre_clase', 'horario', 'semestre', 'nombre_vol', 'seccion',
		VALUES ($nombre_clase, $horario, $semestre, $nombre_vol, $seccion)");
}

print "</br>";
print "<font size = '5'> Lista de clases: </font>";
print "<br/>";
print "<font size = '3'> Seleccione la información que desea borrar. </font>";
print "<br/>";

print "<div class = 'table-scroll'>";
    print "<div class = 'table-responsive'>"; 
        print "<table class='table table-bordered'>";
		$query = "SELECT * FROM clases";

		if ($stmt = $coneccion->prepare($query) ) {
		$stmt -> execute();
		$stmt -> bind_result($nombre_clase, $horario, $semestre, $id_vol, $seccion, $class_id);

		$columnas = array("#", "ID del Curso", "Nombre del Curso", "Seccion", "ID del Tutor", "Semestre", "Horario");
		print "<thead>";
		for ($i = 0; $i < 7; $i++) {
			print"<th>";
			print $columnas[$i];
			print"</th>";
		}
		print "</thead>";
		print "<tbody>";
		while( $stmt -> fetch() ) {
			print"<tr>";
			printf(" <td align='center' bgcolor= '#FFFFFF'> <input name='checkbox[]' type='checkbox' id='checkbox[]' value='$class_id'> </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> \n", 
			 	 $class_id, $nombre_clase, $seccion, $id_vol, $semestre, $horario);
			print"</tr>";
		}
		print "</tbody>";
		print "</table>";

		print "<align='center' bgcolor='#FFFFFF'> <input type='submit' id='delete' name = 'delete' value='Borrar'>";
		
		$result = 0;
		// Check if delete button active, start this 
		if (isset($_POST['delete'])) {
			for ($i = 0; $i < 2 ; $i++){
				$del_id = $checkbox[$i];
				mysqli_query($coneccion, "DELETE FROM clases WHERE class_id = '$del_id'");

				}
			}
			// if successful redirect to delete_multiple.php 
		if ($result) {
			echo "<meta http-equiv=\'refresh\' content=\'0;URL=editvoluntarios.php\'>";
		}
		$stmt->close();
		}

    print "</div>";
print "</div>";

$coneccion ->close();
?>
<h3><a href="menuprincipal.php">Menu Principal</a></h3>
</body>
</html>