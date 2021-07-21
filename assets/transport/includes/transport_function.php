<?php
//**database query creation
//check query errors
 function confirm_query($string){
 	if(!$string){
 		die("Problem in the query");
 	}
 }

 function find_all_transport(){
 	global $connection;

 	$query = "SELECT * FROM transport";
 	$transportation_set = mysqli_query($connection, $query);
 	confirm_query($transportation_set);

 	return $transportation_set;
 }

 function find_fee_by_id($transport_id){
 	global $connection;

 	$secure_transport_id = mysqli_real_escape_string($connection, $transport_id);

 	$query = "SELECT * FROM transport ";
 	$query .= "WHERE id= {$secure_transport_id}";
 	$transportation_set = mysqli_query($connection, $query);
 	confirm_query($transportation_set);

 	if($transportation = mysqli_fetch_assoc($transportation_set)){
 		return $transportation;
 	}else{
 		return null;
 	}

 }

//report queries

function find_all_classes(){
	global $connection;

	$query = "SELECT * FROM classes";
	$classes_set = mysqli_query($connection, $query);
	confirm_query($classes_set);

	return $classes_set;
}

function find_all_payments(){
	global $connection;

	$query = "SELECT * FROM trans_payments";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);

	return $payments_set;
}

function find_all_students_trans_payments($term){
	global $connection;

	$secure_term = mysqli_real_escape_string($connection, $term);
	$query = "SELECT * FROM trans_payments ";
	$query .= "WHERE term = '{$secure_term}'";
	$students_set = mysqli_query($connection, $query);
	confirm_query($students_set);
	return $students_set;

}

function find_all_trans_by_class($class, $term){
	global $connection;

	$safe_class = mysqli_real_escape_string($connection, $class);
	$safe_term = mysqli_real_escape_string($connection, $term);

	$query = "SELECT * FROM trans_payments ";
	$query .= "WHERE class= '{$safe_class}' AND term = '{$safe_term}'";
	$students_set = mysqli_query($connection, $query);
	confirm_query($students_set);
	return $students_set;
}

function find_payments_by_class_status($class, $status)
{
	global $connection;

	$safe_class = mysqli_real_escape_string($connection, $class);
	$safe_status = mysqli_real_escape_string($connection, $status);

	$query = "SELECT * FROM trans_payments ";
	$query .= "WHERE class= '{$safe_class}' AND status = '{$safe_status}'";
	$students_set = mysqli_query($connection, $query);
	confirm_query($students_set);
	return $students_set;
}

function find_all_trans_by_status($status, $term){
	global $connection;

	$safe_status = mysqli_real_escape_string($connection, $status);
	$safe_term = mysqli_real_escape_string($connection, $term);

	$query = "SELECT * FROM trans_payments ";
	$query .= "WHERE status= '{$safe_status}' AND term = '{$safe_term}'";
	$students_set = mysqli_query($connection, $query);
	confirm_query($students_set);
	return $students_set;
}

function find_payments_by_status_and_date_range($status, $start_date, $end_date){
	global $connection;

	$safe_status = mysqli_real_escape_string($connection, $status);
	$safe_start_date = mysqli_real_escape_string($connection, $start_date);
	$safe_end_date = mysqli_real_escape_string($connection, $end_date);

	$query = "SELECT * FROM trans_payments ";
	$query .= "WHERE status = '{$safe_status}' AND date ";
	$query .= "BETWEEN '{$safe_start_date}' AND '$safe_end_date'";
	$date_set = mysqli_query($connection, $query);
	confirm_query($date_set);

	return $date_set;

}

function find_payments_by_date_range($start_date, $end_date){
	global $connection;

	$safe_start_date = mysqli_real_escape_string($connection, $start_date);
	$safe_end_date = mysqli_real_escape_string($connection, $end_date);

	$query = "SELECT * FROM trans_payments ";
	$query .= "WHERE date BETWEEN '{$safe_start_date}' AND '$safe_end_date'";
	$date_set = mysqli_query($connection, $query);
	confirm_query($date_set);

	return $date_set;

}





