<?php

class Menu
{	
	public static function getMenu($user=Null)
	{
		echo '<a href="http://messageboard.hardinresources.com/index.php">Home</a>';
		echo ' | <a href="http://messageboard.hardinresources.com/users.php">Users</a>';
		if (isset($_SESSION['login']) && $_SESSION['login'] != '') 
		{
			echo ' | <a href="http://messageboard.hardinresources.com/logout.php">Logout</a>';
		}
		echo "<hr>";
	}
}