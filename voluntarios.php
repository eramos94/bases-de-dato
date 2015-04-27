<html>
<head>
<title>Voluntarios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
<?php

// Displays voluntary employees in table.
$server = "localhost";
$dB = "cauce";
$user = "eramos";
$password = "eramos";
$coneccion = new mysqli($server, $user, $password, $dB);
if ($coneccion->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

print "<font size = '5'> Voluntarios: </font>";
print "<br/>";
print "<br/>";

print "<table border = 10> <div class='container'>";
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
</div>
<br/>
<h3><a href="protected_page.php">Menu Principal</a></h3>
</div>
</body>
</html>