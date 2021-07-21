<?php 


//**database query creation
//check query errors
 function confirm_query($string){
 	if(!$string){
 		die("Problem in the query");
 	}
 }

function find_all_fees(){
	global $connection;

	$query = "SELECT * FROM fees ORDER BY id ASC";
	$fees_set = mysqli_query($connection, $query);
	confirm_query($fees_set);
	return $fees_set;
}

function find_all_fee_by_id($fee_id){
	global $connection;

	$secure_fee_id = mysqli_real_escape_string($connection, $fee_id);

	$query = "SELECT * FROM fees ";
	$query .= "WHERE id = {$secure_fee_id}";
	$fees_set = mysqli_query($connection, $query);
	confirm_query($fees_set);
	if($fees = mysqli_fetch_assoc($fees_set)){
		return $fees;
	}else{
		return null;
	}

}

function find_all_students_payments($registration){
	global $connection;

	$secure_registration = mysqli_real_escape_string($connection, $registration);
	$query = "SELECT * FROM fee_payments WHERE registration = '{$secure_registration}'";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);
	return $payments_set;

}

function find_all_fee_structure(){
	global $connection;

 	$query = "SELECT * FROM fee_structure";
 	$structure_set = mysqli_query($connection, $query);
 	confirm_query($structure_set);

 	return $structure_set;
}

function find_structure_by_id($structure_id){
	global $connection;

 	$secure_structure_id = mysqli_real_escape_string($connection, $structure_id);

 	$query = "SELECT * FROM fee_structure ";
 	$query .= "WHERE id= {$secure_structure_id}";
 	$structure_set = mysqli_query($connection, $query);
 	confirm_query($structure_set);

 	if($structure = mysqli_fetch_assoc($structure_set)){
 		return $structure;
 	}else{
 		return null;
 	}
}

function find_structure_by_term_and_school($school, $term){
	global $connection;

	$safe_school = mysqli_real_escape_string($connection, $school);
	$safe_term = mysqli_real_escape_string($connection, $term);

 	$query = "SELECT * FROM fee_structure ";
 	$query .= "WHERE school = '{$safe_school}' ";
 	$query .= "AND term = '{$safe_term}'";
 	$structure_set = mysqli_query($connection, $query);
 	confirm_query($structure_set);

 	return $structure_set;
}

function find_lunch_fee_structure(){
	global $connection;

	$query = "SELECT * FROM lunch_payments_structure";
	$lunch_structure_set = mysqli_query($connection, $query);
	confirm_query($lunch_structure_set);

	return $lunch_structure_set;

}

function find_lunch_fee_structure_by_id($lunch_id){
	global $connection;

	$secure_lunch_id = mysqli_real_escape_string($connection, $lunch_id);

	$query = "SELECT * FROM lunch_payments_structure ";
	$query .= "WHERE id= {$secure_lunch_id}";
	$lunch_structure_set = mysqli_query($connection, $query);
	confirm_query($lunch_structure_set);

	if($lunch_structure = mysqli_fetch_assoc($lunch_structure_set)){
		return $lunch_structure;
	}else{
		return null;
	}
}

function find_transport_fee_structure(){
	global $connection;

	$query = "SELECT * FROM transport_structure";
	$transport_structure_set = mysqli_query($connection, $query);
	confirm_query($transport_structure_set);

	return $transport_structure_set;
}


function find_transport_fee_structure_by_id($transport_id){
	global $connection;

	$secure_transport_id = mysqli_real_escape_string($connection, $transport_id);

	$query = "SELECT * FROM transport_structure ";
	$query .= "WHERE id= {$secure_transport_id}";
	$transport_structure_set = mysqli_query($connection, $query);
	confirm_query($transport_structure_set);

	if($transport_structure = mysqli_fetch_assoc($transport_structure_set)){
		return $transport_structure;
	}else{
		return null;
	}
}


function find_all_payments(){
	global $connection;

 	$query = "SELECT * FROM fee_payments";
 	$payments_set = mysqli_query($connection, $query);
 	confirm_query($payments_set);

 	return $payments_set;
}

function find_all_payments_search($value_set){
	global $connection;

	$safe_value_set = mysqli_real_escape_string($connection, $value_set);

	$query = "SELECT * FROM fee_payments ";
	$query .= "WHERE registration LIKE '%$safe_value_set%' OR ";
	$query .= "surname LIKE '%$safe_value_set%' OR fullnames LIKE '%$safe_value_set%'";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);

	return $payments_set;

}

function create_reports_by_date($date, $status){
	global $connection;

	$safe_date = mysqli_real_escape_string($connection, $date);
	$safe_status = mysqli_real_escape_string($connection, $status);

	$query = "SELECT * FROM fee_payments ";
	$query .= "WHERE date= '{$safe_date}' AND status = '{$safe_status}'";
	$reports_set = mysqli_query($connection, $query);
	confirm_query($reports_set);

	return $reports_set;
}

function create_reports_by_class($class, $status){
	global $connection;

	$safe_class = mysqli_real_escape_string($connection, $class);
	$safe_status = mysqli_real_escape_string($connection, $status);

	$query = "SELECT * FROM fee_payments ";
	$query .= "WHERE class= '{$safe_class}' AND status = '{$safe_status}'";
	$reports_set = mysqli_query($connection, $query);
	confirm_query($reports_set);

	return $reports_set;
}

function find_payments_by_term($term, $status){
	global $connection;

	$safe_term = mysqli_real_escape_string($connection, $term);
	$safe_status = mysqli_real_escape_string($connection, $status);

	$query = "SELECT * FROM fee_payments ";
	$query .= "WHERE term= '{$safe_term}' AND status = '{$safe_status}'";
	$reports_set = mysqli_query($connection, $query);
	confirm_query($reports_set);

	return $reports_set;

}



function find_payments_by_id($payments_id){
	global $connection;

 	$secure_payments_id = mysqli_real_escape_string($connection, $payments_id);

 	$query = "SELECT * FROM fee_payments ";
 	$query .= "WHERE id= {$secure_payments_id}";
 	$payments_set = mysqli_query($connection, $query);
 	confirm_query($payments_set);

 	if($payments = mysqli_fetch_assoc($payments_set)){
 		return $payments;
 	}else{
 		return null;
 	}
}


function find_all_exp_cat(){
	global $connection;

 	$query = "SELECT * FROM exp_cat";
 	$expense_set = mysqli_query($connection, $query);
 	confirm_query($expense_set);

 	return $expense_set;
}

function find_expense_by_id($cat_id){
	global $connection;

	$secure_cat_id = mysqli_real_escape_string($connection, $cat_id);

	$query = "SELECT * FROM exp_cat ";
	$query .= "WHERE id= {$secure_cat_id}";
	$expenses_set = mysqli_query($connection, $query);
	confirm_query($expenses_set);
	if($expense = mysqli_fetch_assoc($expenses_set)){
		return $expense;
	}else{
		return null;
	}

}

function find_expenses_for_cat($cat_id){
	global $connection;

	$secure_cat_id = mysqli_real_escape_string($connection, $cat_id);

	$query = "SELECT * FROM expense WHERE cat_id = {$secure_cat_id}";
	$expense_set = mysqli_query($connection, $query);
	confirm_query($expense_set);

	return $expense_set;

}

function find_expenses_for_cat_by_id($expense_id){
	global $connection;

	$secure_expense_id = mysqli_real_escape_string($connection, $expense_id);

	$query = "SELECT * FROM expense WHERE id = {$secure_expense_id}";
	$expenses_set = mysqli_query($connection, $query);
	confirm_query($expenses_set);
	if($expense = mysqli_fetch_assoc($expenses_set)){
		return $expense;
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
