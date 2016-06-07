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
echo "<br>";
echo "<br>";

?>
<div id="msg"><?php echo $_GET['msg']; ?></div>

<h1>Create Category</h1>

<form name="create" action="controller.php" method="POST">
	<label for="name">Name</label>
	<input type="textfield" name="name" required>
	<br>
	<label for="description">Description</label>
	<input type="textfield" name="description" required>
	<br>
	<input type="hidden" name="create" value="create">
	<input type="submit" value="Create">
</form>