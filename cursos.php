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
                        <a href="cursos.php">Cursos</a>
                    </li>
                    <li>
                        <a href="editcursos.php">Editar Cursos</a>
                    </li>
                    <li>
                        <a href="estudiantes.php">Estudiantes</a>
                    </li>
                    <li>
                        <a href="editestudiantes.php">Editar Estudiantes</a>
                    </li>
                    <li>
                        <a href="voluntarios.php">Voluntarios</a>
                    </li>
                    <li>
                        <a href="editvoluntarios.php">Editar Voluntarios</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

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

		$query = "SELECT distinct c.nombre_clase, s.seccion, s.horario, v.nombre_vol
        FROM clases c, voluntario v, tutor t, secciones s, ofrece o
        WHERE c.nombre_clase = s.nombre_clase AND s.seccion_id = o.seccion_id AND o.id_vol = t.id_vol
        AND t.id_vol = v.id_vol;";

		if ($stmt = $coneccion->prepare($query) ) {
		$stmt -> execute();
		$stmt -> bind_result($nombre_clase, $seccion, $horario, $nombre_vol);

		$columnas = array("Nombre del Curso", "Seccion", "Hora", "Nombre del Tutor");
		print "<thead>";
		for ($i = 0; $i < 4; $i++) {
			print"<th>";
			print $columnas[$i];
			print"</th>";
		}
		print "</thead>";
		print "<tbody>";
		while( $stmt -> fetch() ) {
			print"<tr>";
			printf("<td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> \n", 
			  	$nombre_clase, $seccion, $horario, $nombre_vol);
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