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
$catId = $_GET['catId'];
$thrId = $_GET['thrId'];
$thread = R::findOne( 'threads', ' id = ? ', [$thrId]);
Authenticate::isLoggedIn();
$user  = R::find( 'users', ' id = '.$_SESSION['login']);
Menu::getMenu($user);
echo "<br>";
echo "<br>";

?>
<div id="msg"><?php echo $_GET['msg']; ?></div>

<h1>Update Thread</h1>

<form name="update" action="controller.php" method="POST">
	<label for="title">Title</label>
	<input type="textfield" name="title" required value="<?php echo $thread->title; ?>">
	<br>
	<label for="subtitle">Subtitle</label>
	<input type="textfield" name="subtitle" required value="<?php echo $thread->subtitle; ?>">
	<br>
	<input type="hidden" name="update" value="update">
	<input type="hidden" name="thrId" value="<?php echo $thread->id; ?>">
	<input type="submit" value="Update">
</form>