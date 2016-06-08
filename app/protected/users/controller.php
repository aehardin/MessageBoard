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
	if(isset($_POST['admin'])){
		if($_POST['admin'] == 1){
			$user->admin = $_POST['admin'];
		}
	}
	else{
		$user->admin = 0;
	}
	if(isset($_POST['readonly'])){
		if($_POST['readonly'] == 1){
			$user->readonly = $_POST['readonly'];
		}
	}
	else{
		$user->readonly = 0;
	}
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
	if(isset($_POST['admin'])){
		if($_POST['admin'] == 1){
			$user->admin = $_POST['admin'];
		}
	}
	else{
		$user->admin = 0;
	}
	if(isset($_POST['readonly'])){
		if($_POST['readonly'] == 1){
			$user->readonly = $_POST['readonly'];
		}
	}
	else{
		$user->readonly = 0;
	}
	R::store( $user );
	header ("Location: http://messageboard.hardinresources.com/index.php");	
}

if(isset($_POST['delete'])){
	$userId = $_POST['userId'];
	$user = R::load( 'users', $userId );
	
	R::trash( $user ); 
	header ("Location: http://messageboard.hardinresources.com/index.php");	
}