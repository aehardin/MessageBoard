<?php

session_start();
try{
	require_once('app/protected/authenticate.php');
}
catch(Exception $e){
	exit("Unable to include authenticate script");
}
try{
	require_once('app/protected/connection.php');
}
catch(Exception $e){
	exit("Unable to include connection script");
}

try{
	require_once('app/protected/menu.php');
}
catch(Exception $e){
	exit("Unable to include menu script");
}


//Authenticate::isLoggedIn();
//$user  = R::find( 'users', ' id = '.$_SESSION['login']);
Menu::getMenu();

echo "<br>";
echo "<br>";

?>
<div id="msg"><?php echo $_GET['msg']; ?></div>

<h1>Login Page</h1>

<form name="login" action="app/protected/userLogin.php" method="POST">
	<label for="username">Username</label>
	<input type="textfield" name="username" required>
	<br>
	<label for="password">Password</label>
	<input type="password" name="password" required>
	<br>
	<input type="submit" value="Login">
</form>