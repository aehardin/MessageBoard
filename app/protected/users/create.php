<?php

session_start();
try{
	require_once('../authenticate.php');
}
catch(Exception $e){
	exit("Unable to include authenticate script");
}
try{
	require_once('../connection.php');
}
catch(Exception $e){
	exit("Unable to include connection script");
}
try{
	require_once('../menu.php');
}
catch(Exception $e){
	exit("Unable to include menu script");
}

Authenticate::isLoggedIn();
$user  = R::find( 'users', ' id = '.$_SESSION['login']);
Menu::getMenu($user);

$userId = $_GET['userId'];

echo "<br>";
echo "<br>";

?>
<div id="msg"><?php echo $_GET['msg']; ?></div>

<h1>Create User</h1>

<form name="create" action="controller.php" method="POST">
	<label for="username">Username</label>
	<input type="textfield" name="username" required>
	<br>
	<label for="email">Email</label>
	<input type="textfield" name="email" required>
	<br>
	<label for="first">First</label>
	<input type="textfield" name="first" required>
	<br>
	<label for="last">Last</label>
	<input type="textfield" name="last" required>
	<br>
	<label for="password">Password</label>
	<input type="password" name="password" required>
	<br>
	<label for="admin">Admin</label>
	<input type="checkbox" name="admin" value="1" >
	<br>
	<label for="readonly">Read Only</label>
	<input type="checkbox" name="readonly" value="1" >
	<br>
	<input type="hidden" name="create" value="create">
	<input type="submit" value="Create">
</form>