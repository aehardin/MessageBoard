<?php
session_start();
try{
	require_once('app/protected/authenticate.php');
}
catch(Exception $e){
	exit("Unable to include authenticate script");
}
try{
	require_once('app/protected/connection.php');
}
catch(Exception $e){
	exit("Unable to include connection script");
}
try{
	require_once('app/protected/menu.php');
}
catch(Exception $e){
	exit("Unable to include menu script");
}

Authenticate::isLoggedIn();
$user  = R::findOne( 'users', ' id = '.$_SESSION['login']);
Menu::getMenu($user);
echo "<br>";
echo "<br>";

//R::fancyDebug( TRUE );

$categories = R::findAll('categories');

//var_dump($categories);
$urlVar = "";
foreach($categories as $c){
	$urlVar = "catId=".$c->id;
	echo '<a href="../categories.php?'.$urlVar.'">'.$c->name.'</a>';
	
	if($user->admin == '1'){
		echo ' | <a href="app/protected/categories/update.php?'.$urlVar.'">Update</a>';
		echo ' | <a href="app/protected/categories/delete.php?'.$urlVar.'">Delete</a>';
	}
	
	echo "<br>";
}
?>

<br>
<br>

<hr>
<?php

if($user->admin == '1'){
	echo '<a href="app/protected/categories/create.php">Create New Category</a>';
}
