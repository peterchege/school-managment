<?php 

 //Query performance 
function confirm_query($string){
 	if(!$string){
 		die("Problem in the query");
 	}
 }


function find_all_stocks(){
	global $connection;

	$query = "SELECT * FROM stocks ORDER BY id ASC";
	$stocks_set = mysqli_query($connection, $query);
	confirm_query($stocks_set);

	return $stocks_set;
}

function find_all_available_stock($stock){
	global $connection;

	$secure_stock = mysqli_real_escape_string($connection, $stock);

	$query = "SELECT * FROM stocks WHERE stock = '{$secure_stock}'";
	$stocks_set = mysqli_query($connection, $query);
	confirm_query($stocks_set);

	return $stocks_set;
}

function find_stock_by_id($stock_id){
	global $connection;

	$secure_stock_id = mysqli_real_escape_string($connection, $stock_id);

	$query = "SELECT * FROM stocks ";
	$query .= "WHERE id = {$secure_stock_id} ";
	$stock_set = mysqli_query($connection, $query);
	confirm_query($stock_set);
	if($stock = mysqli_fetch_assoc($stock_set)){
		return $stock;
	}else{
		return null;
	}
}

function find_stocks_pieces_available_for_stocks($stock_id){
	global $connection;

	$secure_stock_id = mysqli_real_escape_string($connection, $stock_id);

	$query = "SELECT * FROM stocks_avial ";
	$query .= "WHERE stock_id = {$secure_stock_id} ";
	$query .= "ORDER BY size ASC";
	$stock_set = mysqli_query($connection, $query);
	confirm_query($stock_set);
	return $stock_set;
}

function find_stocks_pieces_available_by_id($avail_id){
	global $connection;

	$secure_avail_id = mysqli_real_escape_string($connection, $avail_id);

	$query = "SELECT * FROM stocks_avial WHERE id = {$secure_avail_id}";
	$stock_set = mysqli_query($connection, $query);
	confirm_query($stock_set);
	if($stock = mysqli_fetch_assoc($stock_set)){
		return $stock;
	}else{
		return null;
	}
}

//reports
function find_all_payments(){
	global $connection;

	$query = "SELECT * FROM stocks_payments";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);

	return $payments_set;
}

function find_stocks_payments($stock){
	global $connection;

	$safe_stock = mysqli_real_escape_string($connection, $stock);
	$query = "SELECT * FROM stocks_payments ";
	$query .= "WHERE stock = '{$safe_stock}'";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);

	return $payments_set;

}

function find_stocks_payments_by_term($term){
	global $connection;

	$safe_term = mysqli_real_escape_string($connection, $term);
	$query = "SELECT * FROM stocks_payments ";
	$query .= "WHERE term = '{$safe_term}'";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);

	return $payments_set;
}

function find_stocks_payments_by_stock_and_term($stock, $term){
	global $connection;

	$safe_stock = mysqli_real_escape_string($connection, $stock);
	$safe_term = mysqli_real_escape_string($connection, $term);
	$query = "SELECT * FROM stocks_payments ";
	$query .= "WHERE stock = '{$safe_stock}' AND term = '{$safe_term}'";
	$payments_set = mysqli_query($connection, $query);
	confirm_query($payments_set);

	return $payments_set;
}


function find_payments_by_date_range($start_date, $end_date){
	global $connection;

	$safe_start_date = mysqli_real_escape_string($connection, $start_date);
	$safe_end_date = mysqli_real_escape_string($connection, $end_date);

	$query = "SELECT * FROM stocks_payments ";
	$query .= "WHERE date BETWEEN '{$safe_start_date}' AND '$safe_end_date'";
	$date_set = mysqli_query($connection, $query);
	confirm_query($date_set);

	return $date_set;

}

?>