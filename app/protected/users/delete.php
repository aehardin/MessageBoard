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
$currentUser = R::findOne( 'users', ' id = ? ', [$userId]);
echo "<br>";
echo "<br>";

?>
<div id="msg"><?php echo $_GET['msg']; ?></div>

<h1>Delete User</h1>

<form name="delete" action="controller.php" method="POST">
	<label for="username">Username</label>
	<p><?php echo $currentUser->username; ?></p>
	<label for="email">Email</label>
	<p><?php echo $currentUser->email; ?></p>
	<label for="first">First</label>
	<p><?php echo $currentUser->first; ?></p>
	<label for="last">Last</label>
	<p><?php echo $currentUser->last; ?></p>
	<input type="hidden" name="delete" value="delete">
	<input type="hidden" name="userId" value="<?php echo $currentUser->id; ?>">
	<input type="submit" value="Delete">
</form>