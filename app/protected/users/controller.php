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

Authenticate::isLoggedIn();

if(isset($_POST['create'])){
	$user = R::dispense( 'users' );
	$user->username = $_POST['username'];
	$user->email = $_POST['email'];
	$user->first = $_POST['first'];
	$user->last = $_POST['last'];
	$user->password = sha1($_POST['password']);
	$user->admin = $_POST['admin'];
	$user->readonly = $_POST['readonly'];
	R::store( $user );
	header ("Location: http://messageboard.hardinresources.com/index.php");
}

if(isset($_POST['update'])){
	$userId = $_POST['userId'];
	$user = R::load( 'users', $userId );
	$user->username = $_POST['username'];
	$user->email = $_POST['email'];
	$user->first = $_POST['first'];
	$user->last = $_POST['last'];
	if($user->last == sha1($_POST['old_password'])){
		$user->password = sha1($_POST['new_password']);
	}
	$user->admin = $_POST['admin'];
	$user->readonly = $_POST['readonly'];
	R::store( $user );
	header ("Location: http://messageboard.hardinresources.com/index.php");	
}

if(isset($_POST['delete'])){
	$userId = $_POST['userId'];
	$user = R::load( 'users', $userId );
	
	R::trash( $user ); 
	header ("Location: http://messageboard.hardinresources.com/index.php");	
}