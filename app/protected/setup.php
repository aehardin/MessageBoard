<?php
try{
	require 'rb.php';
}
catch(Exception $e){
	exit("Unable to include rb.php");
}

try{
	R::setup('mysql:host=localhost;dbname=messageboard', 'root', 'djD84fn4sgQ1h');
}
catch(Exception $e){
	exit("Unable to connect to Database");
}

R::fancyDebug( TRUE );

//Uncomment to prevent new tables being created
//R::freeze(1);

//users
$users = R::dispense('users');

//username, email (or use email for both), first and last name, password, an admin flag, and a read-only flag.
$users->username = "alan";
$users->email = "alan.e.hardin@gmail.com";
$users->first = "alan";
$users->last = "hardin";
$users->password = sha1('urban40');
// Anyone that's an admin can see the edit/delete controls on ALL posts.
$users->admin = true;
// Anyone that IS read only can only view the threads and posts, but not add new threads/posts.
//Anyone that's NOT read-only can create new threads and will also see edit/delete controls on their own posts.
$users->readonly = false;


//categories
$categories = R::dispense('categories');
$categories->name = "Category1";
$categories->description = "This is the first category.";


//threads
$threads = R::dispense('threads');
$threads->title = "Thread1";
$threads->subtitle = "This is the first thread for category1";
$categories->ownThreadsList[] = $threads;



//posts
$posts1 = R::dispense('posts');
$posts1->title = "Post1";
$posts1->description = "This is the first post for thread1";
$posts2 = R::dispense('posts');
$posts2->title = "Post2";
$posts2->description = "This is the second post thread1";

$threads->ownPostsList[] = $posts1;
$threads->ownPostsList[] = $posts2;


try{
	R::store($posts1);
	R::store($posts2);
	R::store($threads);
	R::store($categories);
	R::store($users);
}
catch(Exception $e){
	echo 'Error Message: ' .$e->getMessage();
}
