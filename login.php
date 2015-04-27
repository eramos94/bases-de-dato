<?php
//login.php
session_start();
require_once("functions.php");

if(isset($_POST['username'], $_POST['password'])) //verify we've got what we need to work with
{


$server = "localhost";
$dB = "cauce";
$user = "eramos";
$password = "eramos";

	/*********database_credentials.php**************/
	$mysqli = new mysqli($server, $user, $password, $dB);; //change to suit your database
	if($mysqli->errno)
		//connection wasn't made
		//handle the error here
		header("location: index.html"); //we'll just redirect for now
	/************************************************/	
$total = 0;
$passcauce = $_POST["password"];
$usercauce = $_POST["username"];
$query = "SELECT COUNT(credenciales.username) AS total FROM credenciales WHERE credenciales.username = ? AND credenciales.password = ?";

	//We don't have to work about SQL injections here 
	$stmt = $mysqli->prepare($query);
	//if the passwords in your table are hashed then you should apply the hashing and/or salts before passing it
	//they should in fact be hashed preferably with a hashing algorithm of the SHA family
	$stmt->bind_param("ss", $usercauce, $passcauce);
	$stmt->execute();
	$stmt->bind_result($total); //place the result (total) into this variable
	echo $total;
	$stmt->fetch(); //fill the result variable(s) binded 
		echo $total;

	
	//close all connections
	$stmt->close();
	$mysqli->close();


	//if total is equal to 1 then that means we have a match
	if((int)$total == 1)
	{
		session_regenerate_id(true); //delete old session variables
		/*********Explained below************/
		$_SESSION['user'] = $_POST['username'];
		$key = generate_key();
		$hash = hash_hmac('sha512', $_POST['password'], $key);
		$_SESSION['key'] = $key;
		$_SESSION['auth'] = hash_hmac('sha512', $key, 
				    hash_hmac('sha512', $_SESSION['user'] . 
						(isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? 
					 	       $_SERVER['HTTP_X_FORWARDED_FOR'] : 
					               $_SERVER['REMOTE_ADDR']), $hash));
		/************************************/

		if(!setcookie('hash', $hash, 0, '/')) //login isn't possible if user's browser doesn't accept cookies
		{
			session_regenerate_id(true);
			//echo "coooookie";
			header("location: index.html"); //original_page would be your login page
			exit();
		}
		header("location: protected_page.php");
	}
	else
	{
		//echo "else";
		//anything else we don't care about
		header("location: index.html");
	}
}
?>
