<html>


<title>Cursos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<body>
<?php
// Displays the courses in a table.
$server = "localhost";
$dB = "cauce";
$user = "eramos";
$password = "eramos";
$coneccion = new mysqli($server, $user, $password, $dB);
if ($coneccion->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

print "<font size = '5'> Lista de Cursos: </font>";
print "<br/>";
print "<br/>";

print "<table border = 15>";
$query = "SELECT c.nombre_clase, c.horario, c.semestre, c.email, c.seccion, c.class_id
	FROM clases c, trabajo t, voluntario v 
	WHERE c.email = v.email AND c.semestre = t.semestre
	AND v.email = t.email ORDER BY c.class_id";

	if ($stmt = $coneccion->prepare($query) ) {
	$stmt -> execute();
	$stmt -> bind_result($nombre_clase, $horario, $semestre, $email, $seccion, $codigo);

	$columnas = array("Codigo del Curso", "Nombre del Curso", "Seccion", "Semestre", "Hora", "Email del Tutor");
	for ($i = 0; $i < 6; $i++) {
		print"<th>";
		print $columnas[$i];
		print"</th>";
	}
	while( $stmt -> fetch() ) {
		print"<tr>";
		printf("<td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> \n", 
			  $codigo, $nombre_clase, $seccion, $semestre, $horario, $email);
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