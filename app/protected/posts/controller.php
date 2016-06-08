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
	$post = R::dispense( 'posts' );
	$post->title = $_POST['title'];
	$post->description = $_POST['description'];
	$post->threads_id = $_POST['threads_id'];
	$post->users_id = $_SESSION['login'];
	R::store( $post );
	header ("Location: http://messageboard.hardinresources.com/index.php");
}

if(isset($_POST['update'])){
	$postId = $_POST['pstId'];
	$post = R::load( 'posts', $postId );
	$post->title = $_POST['title'];
	$post->description = $_POST['description'];
	R::store( $post );
	header ("Location: http://messageboard.hardinresources.com/index.php");	
}

if(isset($_POST['delete'])){
	$postId = $_POST['posts_id'];
	$post = R::load( 'posts', $postId );
	
	R::trash( $post ); 
	header ("Location: http://messageboard.hardinresources.com/index.php");	
}