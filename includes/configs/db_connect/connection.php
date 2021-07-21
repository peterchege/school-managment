<?php 
define('DB_HOST', 'Localhost');
define('DB_USER', 'fideria');
define('DB_PASSWORD', 'F0701448318#');
define('DB_NAME', 'school2');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//test if connection occured
if(mysqli_connect_errno()){
	die("Database connection failed: " .
		mysqli_connect_error() .
		"(" . mysqli_connect_errno() . ")"
	);
}
?>