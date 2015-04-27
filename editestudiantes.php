<?php
require_once("checklogin.php"); 
?>


<?php
$server = "localhost";
$dB = "cauce";
$user = "eramos";
$password = "eramos";
$con = new mysqli($server, $user, $password, $dB);
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}




?>











 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Estudiantes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">


</div>

</body>
</html>