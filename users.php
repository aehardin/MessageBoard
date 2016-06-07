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

echo "<h1>" .$user->username. "</h1>";
echo "<h2>" .$user->email. "</h2>";
echo ' <a href="app/protected/users/update.php?userId=' .$user->id. '">Update</a>';
echo "<br>";
echo "<br>";
echo "<br>";


if($user[1]->admin == '1' || $user[1]->readonly == '0'){
echo "<h3>Users</h3>";
echo "<br>";
}
$users = R::findAll( 'users' );

foreach($users as $u){
	$urlVar = "userId=" .$u->id;
	if($user[1]->admin == '1' || $user[1]->readonly == '0'){
		echo $u->username. ' | <a href="app/protected/users/update.php?'.$urlVar.'">Update</a>';
		echo ' | <a href="app/protected/users/delete.php?'.$urlVar.'">Delete</a>';
	}
	echo "<br>";
}

?>

<br>
<br>

<hr>
<?php

if($user[1]->admin == '1' || $user[1]->readonly == '0'){
	echo '<a href="app/protected/users/create.php">Create New User</a>';
}