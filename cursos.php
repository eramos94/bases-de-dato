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

// Displays the courses in a table.
$server = "localhost";
$dB = "avalles";
$user = "avalles";
$password = "avalles@";
$coneccion = new mysqli($server, $user, $password, $dB);
if ($coneccion->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

print "<font size = '5'> Lista de Cursos: </font>";
print "<br/>";

print "<div class = 'table-scroll'>";
    print "<div class = 'table-responsive'>"; 
        print "<table class='table table-bordered'>";

		$query = "SELECT distinct c.nombre_clase, c.horario, c.semestre, c.id_vol, c.seccion, c.class_id
			FROM clases c, trabajo t, voluntario v 
			WHERE c.id_vol = v.id_vol AND c.semestre = t.semestre
			AND v.id_vol = t.id_vol ORDER BY c.class_id;";

		if ($stmt = $coneccion->prepare($query) ) {
		$stmt -> execute();
		$stmt -> bind_result($nombre_clase, $horario, $semestre, $id_vol, $seccion, $codigo);

		$columnas = array("Codigo del Curso", "Nombre del Curso", "Seccion", "Semestre", "Hora", "ID del Tutor");
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
			printf("<td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> \n", 
			  	$codigo, $nombre_clase, $seccion, $semestre, $horario, $id_vol);
			print"</tr>";
		}
		print "</tbody>";

		$stmt->close();
		}

		print "</table>";
    print "</div>";
print "</div>";

$coneccion ->close();
?>
<h3><a href="menuprincipal.php">Menu Principal</a></h3>
</body>
</html>