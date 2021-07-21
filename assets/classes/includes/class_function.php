<?php
//Query performance 
function confirm_query($string){
 	if(!$string){
 		die("Problem in the query");
 	}
 }

function find_all_classes(){
	global $connection;

	$query = "SELECT * FROM classes";
	$classes_set = mysqli_query($connection, $query);
	confirm_query($classes_set);

	return $classes_set;
}


function find_class_by_id($class_id){
	global $connection;

	$safe_class_id = mysqli_real_escape_string($connection, $class_id);

	$query = "SELECT * FROM  classes WHERE id = {$safe_class_id}";
	$class_set = mysqli_query($connection, $query);
	confirm_query($class_set);

	if($class = mysqli_fetch_assoc($class_set)){
		return $class;
	}else{
		return null;
	}
}

function find_all_students_with_class($class, $stream){
	global $connection;

	$safe_class = mysqli_real_escape_string($connection, $class);
	$safe_stream = mysqli_real_escape_string($connection, $stream);

	$query = "SELECT * FROM students WHERE class = '{$safe_class}' AND stream = '{$safe_stream}'";
	$class_set = mysqli_query($connection, $query);
	confirm_query($class_set);

	return $class_set;
}


function find_all_students_search($class, $value_set){
	global $connection;

	$safe_class = mysqli_real_escape_string($connection, $class);
	$safe_value_set = mysqli_real_escape_string($connection, $value_set);

	$query = "SELECT * FROM students ";
	$query .= "WHERE registration LIKE '%$safe_value_set%' AND class = '{$safe_class}' OR ";
	$query .= "sirname LIKE '%$safe_value_set%' AND class = '{$safe_class}' OR ";
	$query .= "full_names LIKE '%$safe_value_set%' AND class = '{$safe_class}' OR ";
	$query .= "gender LIKE '%$safe_value_set%' AND class = '{$safe_class}'";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);

	return $payments_set;

}


function find_payments_for_students($registration){
	global $connection;

	$safe_registration = mysqli_real_escape_string($connection, $registration);

	$query = "SELECT * FROM fee_payments WHERE registration= '{$safe_registration}'";
	$student_set = mysqli_query($connection, $query);
	confirm_query($student_set);
	return $student_set;

}

function find_all_payments(){
	global $connection;

	$query = "SELECT * FROM fee_payments";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);
	return $payments_set;


}

function find_all_payments_for_class($class){
	global $connection;

	$safe_class = mysqli_real_escape_string($connection, $class);
	$query = "SELECT * FROM fee_payments WHERE class = '{$safe_class}'";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);
	return $payments_set;

}