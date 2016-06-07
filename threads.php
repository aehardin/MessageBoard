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

$user  = R::find( 'users', ' id = '.$_SESSION['login']);
Menu::getMenu($user);
echo "<br>";
echo "<br>";

$catId = $_GET["catId"];
$thrId = $_GET["thrId"];

$category = R::findOne( 'categories', ' id = ? ', [$thrId]);
$thread = R::findOne( 'threads', ' id = ? ', [$thrId]);

echo "<h1>" .$thread->title. "</h1>";
echo "<br>";
echo "<p>" .$thread->subtitle. "</p>";
echo "<br>";


echo "<h3>Posts</h3>";
echo "<br>";

$posts = R::find('posts', ' threads_id = ? ', [$thrId]);

foreach($posts as $p){
	$urlVar = "thrId=" .$thrId. "&pstId=" .$p->id;
	echo '<h5>' .$p->title. '</h5>';
	if($user[1]->admin == '1' || $user[1]->readonly == '0'){
		echo ' | <a href="app/protected/posts/update.php?'.$urlVar.'">Update</a>';
		echo ' | <a href="app/protected/posts/delete.php?'.$urlVar.'">Delete</a>';
	}
	echo "<p>" .$p->description. "</p>";
	echo "<br>";
}

?>

<br>
<br>

<hr>
<?php

if($user[1]->admin == '1' || $user[1]->readonly == '0'){
	echo '<a href="app/protected/posts/create.php?thrId=' .$thrId. '">Create New Post</a>';
}