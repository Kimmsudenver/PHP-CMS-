<?php
//1. create a database connection
$host="localhost";
$user="lyndau";
$pass="lyndap";
$dbname="lynda";
$connection= mysqli_connect($host, $user, $pass, $dbname);
//Test if connection occured
if(mysqli_connect_errno()){
	die("database connection failed: ". mysqli_connect_error(). "(". mysqli_connect_errno(). ")"
		);
}
?>
