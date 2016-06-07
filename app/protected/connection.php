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