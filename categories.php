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

$catId = $_GET["catId"];

$category = R::findOne( 'categories', ' id = ? ', [$catId]);

echo "<h1>" .$category->name. "</h1>";
echo "<br>";
echo "<p>" .$category->description. "</p>";
echo "<br>";


echo "<h3>Threads</h3>";
echo "<br>";

$threads = R::find('threads', ' categories_id = ? ', [$catId]);

$urlVar = "";
foreach($threads as $t){
	$urlVar = "catId=" .$catId. "&thrId=" .$t->id;
	echo '<a href="../threads.php?' .$urlVar. '">' .$t->title. '</a>';
	if($user->admin == '1'){
		echo ' | <a href="app/protected/threads/update.php?'.$urlVar.'">Update</a>';
		echo ' | <a href="app/protected/threads/delete.php?'.$urlVar.'">Delete</a>';
	}
	echo "<br>";
}

?>

<br>
<br>

<hr>
<?php

if($user->admin == '1' || $user->readonly == '0'){
	echo '<a href="app/protected/threads/create.php?catId=' .$catId. '">Create New Thread</a>';
}