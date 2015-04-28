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


// Displays voluntary employees in table.
$server = "localhost";
$dB = "avalles";
$user = "avalles";
$password = "avalles@";
$coneccion = new mysqli($server, $user, $password, $dB);
if ($coneccion->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

print "<font size = '5'> Lista de Voluntarios: </font>";
print "<br/>";

print "<div class = 'table-scroll'>";
    print "<div class = 'table-responsive'>"; 
        print "<table class='table table-bordered'>";
		$query = "SELECT * FROM voluntario";

		if ($stmt = $coneccion->prepare($query) ) {
		$stmt -> execute();
		$stmt -> bind_result($id_vol, $nombre_vol, $email, $direccion, $telefono, $sexo_vol);

		$columnas = array("ID del Voluntario", "Nombre del Voluntario", "Email", "Direccion", "Telefono", "Sexo");
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
			 	 $id_vol, $nombre_vol, $email, $direccion, $telefono, $sexo_vol);
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