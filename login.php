<?php
//login.php
session_start();
require_once("functions.php");

if(isset($_POST['username'], $_POST['password']))
{


$server = "localhost";
$dB = "avalles";
$user = "avalles";
$password = "avalles@";

	$mysqli = new mysqli($server, $user, $password, $dB);; 
	if($mysqli->errno)
		
		header("location: index.html"); 
	
$total = 0;
$passcauce = $_POST["password"];
$usercauce = $_POST["username"];
$query = "SELECT COUNT(credenciales.username) AS total FROM credenciales WHERE credenciales.username = ? AND credenciales.password = ?";

	
	$stmt = $mysqli->prepare($query);
	
	$stmt->bind_param("ss", $usercauce, $passcauce);
	$stmt->execute();
	$stmt->bind_result($total); 
	echo $total;
	$stmt->fetch(); 
		echo $total;

	
	$stmt->close();
	$mysqli->close();


	if((int)$total == 1)
	{
		session_regenerate_id(true); 
		
		$_SESSION['user'] = $_POST['username'];
		$key = generate_key();
		$hash = hash_hmac('sha512', $_POST['password'], $key);
		$_SESSION['key'] = $key;
		$_SESSION['auth'] = hash_hmac('sha512', $key, 
				    hash_hmac('sha512', $_SESSION['user'] . 
						(isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? 
					 	       $_SERVER['HTTP_X_FORWARDED_FOR'] : 
					               $_SERVER['REMOTE_ADDR']), $hash));

		if(!setcookie('hash', $hash, 0, '/')) 
		{
			session_regenerate_id(true);
			header("location: index.html"); 
			exit();
		}
		header("location: menuprincipal.php");
	}
	else
	{
		header("location: index.html");
	}
}
?>
