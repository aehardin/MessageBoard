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
$thread = R::findOne( 'threads', ' id = ? ', [$thrId]);
Authenticate::isLoggedIn();
$user  = R::find( 'users', ' id = '.$_SESSION['login']);
Menu::getMenu($user);
echo "<br>";
echo "<br>";

?>
<div id="msg"><?php echo $_GET['msg']; ?></div>

<h1>Delete Thread</h1>

<form name="update" action="controller.php" method="POST">
	<label for="title">Title</label>
	<p><?php echo $thread->title; ?></p>
	<label for="subtitle">Subtitle</label>
	<p><?php echo $thread->subtitle; ?></p>
	<input type="hidden" name="delete" value="delete">
	<input type="hidden" name="thrId" value="<?php echo $thread->id; ?>">
	<input type="submit" value="Delete">
</form>