<?php 

 //Query performance 
function confirm_query($string){
 	if(!$string){
 		die("Problem in the query");
 	}
 }


function find_all_alumni(){
	global $connection;

	$query = "SELECT * FROM alumni";
	$students_set= mysqli_query($connection, $query);
	confirm_query($students_set);
	return $students_set;
}

function find_alumni_by_id($alumni_id){
	global $connection;

	$safe_alumni_id= mysqli_real_escape_string($connection, $alumni_id);

	$query= "SELECT * FROM alumni ";
	$query .= "WHERE id = {$safe_alumni_id}";
	$alumni_set = mysqli_query($connection, $query);
	confirm_query($alumni_set);
	if($alumni= mysqli_fetch_assoc($alumni_set)){
		return $alumni;
	}else{
		return null;
	}

}
function find_alumni_by_cat($category){
	global $connection;

	$safe_category = mysqli_real_escape_string($connection, $category);
	$query= "SELECT * FROM alumni ";
	$query .= "WHERE category='{$safe_category}'";
	$alumni_set = mysqli_query($connection, $query);
	confirm_query($alumni_set);
	return $alumni_set;
}

function find_alumni_by_year($year){
	global $connection;

	$safe_year = mysqli_real_escape_string($connection, $year);
	$query= "SELECT * FROM alumni ";
	$query .= "WHERE year='{$safe_year}'";
	$alumni_set = mysqli_query($connection, $query);
	confirm_query($alumni_set);
	return $alumni_set;
}



function find_alumni_by_cat_and_year($category, $year){
	global $connection;

	$safe_category = mysqli_real_escape_string($connection, $category);
	$safe_year= mysqli_real_escape_string($connection, $year);

	$query= "SELECT * FROM alumni ";
	$query .= "WHERE category='{$safe_category}' AND year='{$safe_year}'";
	$alumni_set = mysqli_query($connection, $query);
	confirm_query($alumni_set);
	return $alumni_set;
}

function find_parents_for_alumni($student_admin){
	global $connection;

	$safe_student_admin= mysqli_real_escape_string($connection, $student_admin);

	$query= "SELECT * FROM all_parents ";
	$query .= "WHERE admin_number = {$safe_student_admin}";
	$parent_set = mysqli_query($connection, $query);
	confirm_query($parent_set);
	return $parent_set;
}

function find_all_payments(){
	global $connection;

	$query = "SELECT * FROM alumni_payments";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);

	return $payments_set;
}

function find_student_payments($student_admin){
	global $connection;

	$safe_student_admin= mysqli_real_escape_string($connection, $student_admin);

	$query= "SELECT * FROM alumni_payments ";
	$query .= "WHERE student_admin = {$safe_student_admin}";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);
	return $payments_set;

}

function find_total_student_amount($student_admin){
	global $connection;

	$safe_student_admin= mysqli_real_escape_string($connection, $student_admin);

	$query= "SELECT * FROM alumni_payments ";
	$query .= "WHERE student_admin = {$safe_student_admin}";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);
	return $payments_set;

}

function find_transport_payments($student_admin){
	global $connection;

	$safe_student_admin= mysqli_real_escape_string($connection, $student_admin);

	$query= "SELECT * FROM allumni_trans_payments ";
	$query .= "WHERE student_admin = {$safe_student_admin}";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);
	return $payments_set;

}


function find_selected_alumni($gender, $year){
	global $connection;

	$safe_gender= mysqli_real_escape_string($connection, $gender);
	$safe_year= mysqli_real_escape_string($connection, $year);

	$query = "SELECT * FROM alumni ";
	$query .= "WHERE gender= '$safe_gender' AND year = '{$safe_year}'";
	$alumni_set= mysqli_query($connection, $query);
	confirm_query($alumni_set);
	return $alumni_set;
}


function find_all_classes(){
	global $connection;

	$query = "SELECT * FROM classes";
	$classes_set = mysqli_query($connection, $query);
	confirm_query($classes_set);

	return $classes_set;
}


function find_selected_fields(){
	global $current_alumni_id;
	

	if(isset($_GET["alumni"])){
    	$current_alumni_id= find_alumni_by_id($_GET["alumni"]);
 	 }else{
 	 	$current_alumni_id= null;
 	 }
}

