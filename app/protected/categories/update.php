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
$category = R::findOne( 'categories', ' id = ? ', [$catId]);
Authenticate::isLoggedIn();
$user  = R::find( 'users', ' id = '.$_SESSION['login']);
Menu::getMenu($user);
echo "<br>";
echo "<br>";

?>
<div id="msg"><?php echo $_GET['msg']; ?></div>

<h1>Update Category</h1>

<form name="update" action="controller.php" method="POST">
	<label for="name">Name</label>
	<input type="textfield" name="name" required value="<?php echo $category->name; ?>">
	<br>
	<label for="description">Description</label>
	<input type="textfield" name="description" required value="<?php echo $category->description; ?>">
	<br>
	<input type="hidden" name="update" value="update">
	<input type="hidden" name="catId" value="<?php echo $category->id; ?>">
	<input type="submit" value="Update">
</form>