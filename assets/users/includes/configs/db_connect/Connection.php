<?php 
define('DB_HOST', 'Localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'stevekama2016');
define('DB_NAME', 'school_management');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//test if connection occured
if(mysqli_connect_errno()){
	die("Database connection failed: " .
		mysqli_connect_error() .
		"(" . mysqli_connect_errno() . ")"
	);
}
?>