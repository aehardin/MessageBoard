<?php 

class Authenticate
{	
	public static function isLoggedIn()
	{
		if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
		{
			echo "Is NOT logged in session = " .$_SESSION['login'];
			header ("Location: http://messageboard.hardinresources.com/login.php");
		}
	}
}