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
$catId = $_GET["catId"];

echo "<br>";
echo "<br>";

?>
<div id="msg"><?php echo $_GET['msg']; ?></div>

<h1>Create Thread</h1>

<form name="create" action="controller.php" method="POST">
	<label for="title">Title</label>
	<input type="textfield" name="title" required>
	<br>
	<label for="subtitle">Subtitle</label>
	<input type="textfield" name="subtitle" required>
	<br>
	<input type="hidden" name="create" value="create">
	<input type="hidden" name="categories_id" value="<?php echo $catId; ?>">
	<input type="submit" value="Create">
</form>