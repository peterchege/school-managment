<?php
//**database query creation
//check query errors
 function confirm_query($string){
 	if(!$string){
 		die("Problem in the query");
 	}
 }

//> this query is for reading all students who want interviews
function find_all_registration(){
	global $connection;

	$query= "SELECT * FROM registration";
	$registration_set= mysqli_query($connection, $query);
	confirm_query($registration_set);

	return $registration_set;
}

//interviews functions 

function find_all_interviews(){
	global $connection;

	$query= "SELECT * FROM interviews";
	$interview_set= mysqli_query($connection, $query);
	confirm_query($interview_set);

	return $interview_set;
}


function find_interview_by_id($interview_id){
	global $connection;

	$secure_interview_id= mysqli_real_escape_string($connection, $interview_id);

	$query= "SELECT * FROM  interviews ";
	$query .= "WHERE id = {$secure_interview_id} ";
	$query .= "LIMIT 1";
	$interview_set= mysqli_query($connection, $query);
	confirm_query($interview_set);

	if($interview= mysqli_fetch_assoc($interview_set)){
		return $interview;
	}else{
		return null;
	}
}

function find_students_doing_interview($interview_id){
	global $connection;

	$secure_interview_id= mysqli_real_escape_string($connection, $interview_id);
	$query= "SELECT * FROM interviewed_students ";
	$query .= "WHERE int_id = {$secure_interview_id}";
	$students_set= mysqli_query($connection, $query);
	confirm_query($students_set);
	return $students_set;

}

function find_student_by_id($student_id){
	global $connection;

	$secure_student_id= mysqli_real_escape_string($connection, $student_id);
	$query= "SELECT * FROM interviewed_students ";
	$query .= "WHERE id = {$secure_student_id}";
	$students_set= mysqli_query($connection, $query);
	confirm_query($students_set);
	if ($student = mysqli_fetch_assoc($students_set)) {
		return $student;
	}else{
		return null;
	}
	
}

function find_all_classes(){
	global $connection;

	$query = "SELECT * FROM classes";
	$classes_set = mysqli_query($connection, $query);
	confirm_query($classes_set);

	return $classes_set;
}

function find_selected_field(){
	global $current_interview_id;
	global $current_student_id;
	

	if(isset($_GET["interview"])){
		$current_interview_id= find_interview_by_id($_GET["interview"]);
		$current_student_id = null;
	}elseif(isset($_GET["student"])){
		$current_student_id= find_student_by_id($_GET["student"]);
		$current_interview_id= null;
	}else{
		$current_interview_id= null;
		$current_student_id = null;

	}
    
}

?>