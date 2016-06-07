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
$thrId = $_GET['thrId'];
$pstId = $_GET['pstId'];
$post = R::findOne( 'posts', ' id = ? ', [$pstId]);
Authenticate::isLoggedIn();
$user  = R::find( 'users', ' id = '.$_SESSION['login']);
Menu::getMenu($user);
echo "<br>";
echo "<br>";

?>
<div id="msg"><?php echo $_GET['msg']; ?></div>

<h1>Update Post</h1>

<form name="update" action="controller.php" method="POST">
	<label for="title">Title</label>
	<input type="textfield" name="title" required value="<?php echo $post->title; ?>">
	<br>
	<label for="description">Description</label>
	<input type="textfield" name="description" required value="<?php echo $post->description; ?>">
	<br>
	<input type="hidden" name="update" value="update">
	<input type="hidden" name="pstId" value="<?php echo $post->id; ?>">
	<input type="submit" value="Update">
</form>