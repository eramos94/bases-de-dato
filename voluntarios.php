<html>
<style type="text/css">
    #header { width:100%; background-color:#CCCCCC; text-align:center;}
    #layouttable{border:0px;width:100%; text-align:center;}
    #layouttable td.col1{width:20%;vertical-align:top;}
</style>
<body>
<?php

// Displays voluntary employees in table.
$server = "localhost";
$dB = "avalles";
$user = "avalles";
$password = "avalles@";
$coneccion = new mysqli($server, $user, $password, $dB);
if ($coneccion->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

print "<font size = '5'> Lista de Estudiantes: </font>";
print "<br/>";
print "<br/>";

print "<table border = 10>";
$query = "SELECT * FROM voluntario";

	if ($stmt = $coneccion->prepare($query) ) {
	$stmt -> execute();
	$stmt -> bind_result($nombre_vol, $email, $direccion, $telefono, $sexo_vol);

	$columnas = array("Nombre del Voluntario", "Email", "Direccion", "Telefono", "Sexo");
	for ($i = 0; $i < 5; $i++) {
		print"<th>";
		print $columnas[$i];
		print"</th>";
	}
	while( $stmt -> fetch() ) {
		print"<tr>";
		printf("<td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> \n", 
			  $nombre_vol, $email, $direccion, $telefono, $sexo_vol);
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