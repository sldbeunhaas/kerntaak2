<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'csvtest';

//Datbase connectie
$dbcon = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


if($dbcon->connect_error){
	echo "Database connection failed";
}//else{
//	echo "connection ok!";
//}


function escapeString($value, $dbcon){
	$escape = $dbcon->real_escape_string($value);
	return stripslashes(strip_tags(htmlentities($escape, ENT_QUOTES, "UTF-8")));
}

function setBcrypt($password){
	$options = array('cost' => 12);
	$hash = password_hash($password, PASSWORD_BCRYPT, $options);
	return $hash;
}
