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

$pstId = $_GET['pstId'];
$post = R::findOne( 'posts', ' id = ? ', [$pstId]);

echo "<br>";
echo "<br>";

?>
<div id="msg"><?php echo $_GET['msg']; ?></div>

<h1>Delete Post</h1>

<form name="create" action="controller.php" method="POST">
	<label for="title">Title:</label>
	<p><?php echo $post->title; ?></p>
	<label for="description">Description:</label>
	<p><?php echo $post->description; ?></p>
	<input type="hidden" name="delete" value="delete">
	<input type="hidden" name="posts_id" value="<?php echo $pstId; ?>">
	<input type="submit" value="Delete">
</form>