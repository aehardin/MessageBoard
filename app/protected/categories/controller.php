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
	$category = R::dispense( 'categories' );
	$category->name = $_POST['name'];
    $category->description = $_POST['description'];
	R::store( $category );
	header ("Location: http://messageboard.hardinresources.com/index.php");
}

if(isset($_POST['update'])){
	$catId = $_POST['catId'];
	$category = R::load( 'categories', $catId );
	$category->name = $_POST['name'];
    $category->description = $_POST['description'];
	R::store( $category );
	header ("Location: http://messageboard.hardinresources.com/index.php");	
}

if(isset($_POST['delete'])){
	$catId = $_POST['catId'];
	$category = R::load( 'categories', $catId );
	
	$threads = R::find('threads', ' categories_id = ? ', [$catId]);
	
	foreach($threads as $thread)
	{
		$posts = R::find('posts', ' threads_id = ? ', [$thread->id]);
		R::trashAll( $posts );
	}
	
	R::trashAll( $threads );
	R::trash( $category ); 
	header ("Location: http://messageboard.hardinresources.com/index.php");	
}