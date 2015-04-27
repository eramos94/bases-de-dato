<?php
//protected_page.php
require_once("checklogin.php");
?>
<html>
<head>
<title>Menu Principal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>	

<body>
<div class="container">
<h1> Menu: </h1>
<h3><a href = "cursos.php"> Lista de Cursos</a> <h3>
<h3><a href = "editcursos.php"> Editar Cursos</a> <h3>
<h3><a href = "estudiantes.php"> Lista de Estudiantes</a> <h3>
<h3><a href = "editestudiantes.php"> Editar Estudiantes</a> <h3>
<h3><a href = "voluntarios.php"> Lista de Voluntarios</a> <h3>
<h3><a href = "editvoluntarios.php"> Editar Voluntarios</a> <h3>
<h3><a href="logout.php">Logout</a></h3>
</div>
</body>
</html>