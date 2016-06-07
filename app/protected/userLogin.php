<?php
session_start();

try{
	require_once('connection.php');
}
catch(Exception $e){
	exit("Unable to include connection script");
}

$sql = "SELECT * FROM messageboard.users
Where username = :username AND password = :password";

$rows = R::getAll( $sql, array(':username'=>$_POST['username'], ':password'=>sha1($_POST['password'])) );

if(isset($rows[0])){
	$_SESSION['login'] = $rows[0]['id'];
	header ("Location: ../../index.php");
}
else{
	$msg = urlencode("User Password Combination Incorrect. username = " .$safe_user. " password = " .$safe_password);
	header ("Location: ../../login.php?msg=" .$msg);
}
