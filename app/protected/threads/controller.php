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
	$thread = R::dispense( 'threads' );
	$thread->title = $_POST['title'];
	$thread->subtitle = $_POST['subtitle'];
	$thread->categories_id = $_POST['categories_id'];
	R::store( $thread );
	header ("Location: http://messageboard.hardinresources.com/index.php");
}

if(isset($_POST['update'])){
	$threadId = $_POST['thrId'];
	$thread = R::load( 'threads', $threadId );
	$thread->title = $_POST['title'];
	$thread->subtitle = $_POST['subtitle'];
	R::store( $thread );
	header ("Location: http://messageboard.hardinresources.com/index.php");	
}

if(isset($_POST['delete'])){
	$threadId = $_POST['thrId'];
	$thread = R::load( 'threads', $threadId );
	
	$posts = R::find('posts', ' threads_id = ? ', [$threadId]);
	
	R::trashAll( $posts );
	R::trash( $thread ); 
	header ("Location: http://messageboard.hardinresources.com/index.php");	
}