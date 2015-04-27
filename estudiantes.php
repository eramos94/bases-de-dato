<html>
<head>
<title>Voluntarios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
    #header { width:100%; background-color:#CCCCCC; text-align:center;}
    #layouttable{border:0px;width:100%; text-align:center;}
    #layouttable td.col1{width:20%;vertical-align:top;}
</style>
<body>
<?php
// Displays students in table.
$server = "localhost";
$dB = "cauce";
$user = "eramos";
$password = "eramos";
$coneccion = new mysqli($server, $user, $password, $dB);
if ($coneccion->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

print "<font size = '5'> Lista de Estudiantes: </font>";
print "<br/>";
print "<br/>";

print "<table border = 10>";
$query = "SELECT * FROM estudiante";

	if ($stmt = $coneccion->prepare($query) ) {
	$stmt -> execute();
	$stmt -> bind_result($id_estudiante, $nombre_estudiante, $direccion, $telefono, $sexo_estu);

	$columnas = array("ID", "Nombre del Estudiante", "Direccion", "Telefono", "Sexo");
	for ($i = 0; $i < 5; $i++) {
		print"<th>";
		print $columnas[$i];
		print"</th>";
	}
	while( $stmt -> fetch() ) {
		print"<tr>";
		printf("<td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> \n", 
			  $id_estudiante, $nombre_estudiante, $direccion, $telefono, $sexo_estu);
		print"</tr>";
	}
	$stmt->close();
}

print "</table>";

$coneccion ->close();
?>
<br/>
<h3><a href="protected_page.php">Menu Principal</a></h3>
</body>
</html>