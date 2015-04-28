<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Login al Sistema de Cauce</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>Menu Principal</title>
	<?php
	//menuprincipal.php
	require_once("checklogin.php");
	?>
  </head>
<body>
<center>
<h1> Menu: </h1>
<h3><a href = "cursos.php"> Lista de Cursos</a> <h3>
<h3><a href = "editcursos.php"> Editar Cursos</a> <h3>
<h3><a href = "estudiantes.php"> Lista de Estudiantes</a> <h3>
<h3><a href = "editestudiantes.php"> Editar Estudiantes</a> <h3>
<h3><a href = "voluntarios.php"> Lista de Voluntarios</a> <h3>
<h3><a href = "editvoluntarios.php"> Editar Voluntarios</a> <h3>
<h3><a href="logout.php">Logout</a></h3>
</center>
</body>
</html>