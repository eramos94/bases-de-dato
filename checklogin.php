<?php
//checklogin.php
session_start();

if(isset($_COOKIE['hash'], 
		 $_SESSION['key'], 
		$_SESSION['user'])
   ) 
{
	if(strcmp($_SESSION['auth'], 
			  hash_hmac('sha512', $_SESSION['key'],
					hash_hmac('sha512', $_SESSION['user'] .
						      (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? 
					 	            $_SERVER['HTTP_X_FORWARDED_FOR'] : 
					                    $_SERVER['REMOTE_ADDR']), 
						  $_COOKIE['hash'])
					)
			 )
		)
	{
		header("location: index.html");
	}
}
else
{
	header("location: index.html");
}
?>
