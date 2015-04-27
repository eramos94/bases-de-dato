<?php
//protected_page.php
require_once("checklogin.php");
?>
<html>
<head>
<title>Menu Principal</title>
</head>

<body>
<h1> Menu: </h1>
<h3><a href = "cursos.php"> Lista de Cursos</a> <h3>
<h3><a href = "editcursos.php"> Editar Cursos</a> <h3>
<h3><a href = "estudiantes.php"> Lista de Estudiantes</a> <h3>
<h3><a href = "editestudiantes.php"> Editar Estudiantes</a> <h3>
<h3><a href = "voluntarios.php"> Lista de Voluntarios</a> <h3>
<h3><a href = "editvoluntarios.php"> Editar Voluntarios</a> <h3>
<h3><a href="logout.php">Logout</a></h3>
</body>
</html>