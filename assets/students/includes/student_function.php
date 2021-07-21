<?php 

//Query performance
function confirm_query($string){
 	if(!$string){
 		die("Problem in the query");
 	}
 }


function find_all_students(){
	global $connection;

	$query = "SELECT * FROM students ORDER BY registration ASC";
	$students_set= mysqli_query($connection, $query);
	confirm_query($students_set);
	return $students_set;
}

function find_student_by_registration($registration){
	global $connection;

	$safe_student_registration= mysqli_real_escape_string($connection, $registration);

	$query= "SELECT * FROM students ";
	$query .= "WHERE registration = {$safe_student_registration}";
	$student_set = mysqli_query($connection, $query);
	confirm_query($student_set);
	return $student_set;

}

function find_student_by_adm($student_adm){
	global $connection;

	$safe_student_adm= mysqli_real_escape_string($connection, $student_adm);

	$query= "SELECT * FROM students ";
	$query .= "WHERE admin = {$safe_student_adm}";
	$student_set = mysqli_query($connection, $query);
	confirm_query($student_set);
	if($student= mysqli_fetch_assoc($student_set)){
		return $student;
	}else{
		return null;
	}

}


function find_all_new_students(){
	global $connection;

	$query = "SELECT * FROM students ";
	$query .= "WHERE status= 'New' ";
	$query .= "ORDER BY admin ASC";
	$students_set= mysqli_query($connection, $query);
	confirm_query($students_set);
	return $students_set;
}






function find_selected_students($gender, $class){
	global $connection;

	$safe_gender= mysqli_real_escape_string($connection, $gender);
	$safe_class= mysqli_real_escape_string($connection, $class);


	$query = "SELECT * FROM students ";
	$query .= "WHERE gender= '$safe_gender' OR class = '{$safe_class}' ";
	$query .= "ORDER BY admin ASC";
	$students_set= mysqli_query($connection, $query);
	confirm_query($students_set);
	return $students_set;
}

function find_parents_for_student($student_adm){
	global $connection;

	$safe_student_adm= mysqli_real_escape_string($connection, $student_adm);

	$query= "SELECT * FROM all_parents ";
	$query .= "WHERE admin_number = {$safe_student_adm}";
	$parent_set = mysqli_query($connection, $query);
	confirm_query($parent_set);
	return $parent_set;
}

function find_current_parent($student_adm){
	global $connection;

	$safe_student_adm= mysqli_real_escape_string($connection, $student_adm);

	$query= "SELECT * FROM all_parents ";
	$query .= "WHERE admin_number = {$safe_student_adm} LIMIT 1";
	$parent_set = mysqli_query($connection, $query);
	confirm_query($parent_set);
	if($parent = mysqli_fetch_assoc($parent_set)){
		return $parent;
	}else{
		return null;
	}
}


function find_parent_by_id($parent_id){
	global $connection;

	$safe_parent_id= mysqli_real_escape_string($connection, $parent_id);

	$query= "SELECT * FROM all_parents ";
	$query .= "WHERE id = {$safe_parent_id}";
	$parent_set = mysqli_query($connection, $query);
	confirm_query($parent_set);
	if($parent= mysqli_fetch_assoc($parent_set)){
		return $parent;
	}else{
		return null;
	}
}

function find_siblings_for_student($student_adm){
	global $connection;

	$safe_student_adm= mysqli_real_escape_string($connection, $student_adm);

	$query= "SELECT * FROM siblings ";
	$query .= "WHERE admin_number = {$safe_student_adm}";
	$sibling_set = mysqli_query($connection, $query);
	confirm_query($sibling_set);
	return $sibling_set;
}

function find_sibling_by_id($sibling_id){
	global $connection;

	$safe_sibling_id= mysqli_real_escape_string($connection, $sibling_id);

	$query= "SELECT * FROM siblings ";
	$query .= "WHERE id = {$safe_sibling_id}";
	$sibling_set = mysqli_query($connection, $query);
	confirm_query($sibling_set);
	if($sibling= mysqli_fetch_assoc($sibling_set)){
		return $sibling;
	}else{
		return null;
	}
}

function find_class_for_student($student_adm){
	global $connection;

	$safe_student_adm= mysqli_real_escape_string($connection, $student_adm);

	$query= "SELECT * FROM student_class ";
	$query .= "WHERE student_adm = {$safe_student_adm}";
	$class_set = mysqli_query($connection, $query);
	confirm_query($class_set);
	if($class= mysqli_fetch_assoc($class_set)){
		return $class;
	}else{
		return null;
	}
}

function find_class_by_id($class_id){
	global $connection;

	$safe_class_id= mysqli_real_escape_string($connection, $class_id);

	$query= "SELECT * FROM student_class ";
	$query .= "WHERE id = {$safe_class_id}";
	$class_set = mysqli_query($connection, $query);
	confirm_query($class_set);
	if($class= mysqli_fetch_assoc($class_set)){
		return $class;
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

function find_all_students_fee($student_adm){
	global $connection;

	$safe_student_adm= mysqli_real_escape_string($connection, $student_adm);

	$query = "SELECT * FROM students_pay ";
	$query .= "WHERE student_adm= {$safe_student_adm}";
	$fees_set = mysqli_query($connection, $query);
	confirm_query($fees_set);

	return $fees_set;
}



function find_all_fees(){
	global $connection;

	$query = "SELECT * FROM fees ORDER BY id ASC";
	$fees_set = mysqli_query($connection, $query);
	confirm_query($fees_set);
	return $fees_set;
}


 function find_all_students_board(){
 	global $connection;

	$query = "SELECT * FROM student_board";
	$students_set= mysqli_query($connection, $query);
	confirm_query($students_set);
	return $students_set;

 }

 function find_board_by_id($board_id){
 	global $connection;

	$safe_board_id= mysqli_real_escape_string($connection, $board_id);

	$query = "SELECT * FROM student_board ";
	$query .= "WHERE id = {$safe_board_id}";
	$board_set = mysqli_query($connection, $query);
	confirm_query($board_set);
	if($board = mysqli_fetch_assoc($board_set)){
		return $board;
	}else{
		return null;
	}

 }


function find_selected_fields(){
	global $current_student_admin;
	global $current_parent_id;
	global $current_sibling_id;
	global $current_payment_alumni;

	if(isset($_GET["student"])){
    	$current_student_admin= find_student_by_adm($_GET["student"]);
    	$current_parent_id = null;
    	$current_sibling_id= null;
 	 }elseif(isset($_GET["parent"])) {
 	 	$current_parent_id = find_parent_by_id($_GET["parent"]);
 	 	$current_student_admin= null;
 	 	$current_sibling_id= null;
	}elseif(isset($_GET["stock"])) {
 	 	$current_stock = find_parent_by_id($_GET["stock"]);
 	 	$current_student_admin= null;
 	 	$current_sibling_id= null;
	}elseif(isset($_GET["alumni"])) {
 	 	$current_payment_alumni = find_parent_by_id($_GET["alumni"]);
 	 	$current_student_admin= null;
 	 	$current_sibling_id= null;	
 	 }elseif (isset($_GET["sibling"])) {
 	 	$current_sibling_id= find_sibling_by_id($_GET["sibling"]);
 	 	$current_student_admin= null;
 	 	$current_parent_id = null;
 	 }else{
 	 	$current_student_admin= null;
 	 	$current_parent_id = null;
 	 	$current_sibling_id= null;
 	 }
}



?>