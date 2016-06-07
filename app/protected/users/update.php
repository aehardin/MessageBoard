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

<h1>Update User</h1>

<form name="update" action="controller.php" method="POST">
	<?php if($user[1]->admin == 1) : ?>
	<label for="username">Username</label>
	<input type="textfield" name="username" value="<?php echo $currentUser->username ?>" required>
	<br>
	<label for="email">Email</label>
	<input type="textfield" name="email" value="<?php echo $currentUser->email ?>" required>
	<br>
	<?php endif; ?>
	<label for="first">First</label>
	<input type="textfield" name="first" value="<?php echo $currentUser->first ?>" required>
	<br>
	<label for="last">Last</label>
	<input type="textfield" name="last" value="<?php echo $currentUser->last ?>" required>
	<br>
	<label for="old_password">Old Password</label>
	<input type="password" name="old_password" required>
	<br>
	<label for="new_password">New Password</label>
	<input type="password" name="new_password" required>
	<br>
	<?php if($user[1]->admin == 1) : ?>
	<label for="admin">Admin</label>
	<?php if($currentUser->admin == 1) : ?>
	<input type="checkbox" name="admin" value="1" checked>
	<?php else : ?>
	<input type="checkbox" name="admin" value="1">
	<?php endif; ?>
	<br>
	<label for="readonly">Read Only</label>
	<?php if($currentUser->readonly == 1) : ?>
	<input type="checkbox" name="readonly" value="1" checked>
	<?php else : ?>
	<input type="checkbox" name="readonly" value="1">
	<?php endif; ?>
	<br>
	<?php endif; ?>
	<input type="hidden" name="update" value="update">
	<input type="hidden" name="userId" value="<?php echo $currentUser->id; ?>">
	<input type="submit" value="Update">
</form>