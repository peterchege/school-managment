<?php 
//navigation
//**database query creation
//check query errors
 function confirm_query($string){
 	if(!$string){
 		die("Problem in the query");
 	}
 }

//> this query is for reading all students who want interviews


//interviews functions 

function find_all_notices_set(){
	global $connection;

	$query= "SELECT * FROM notifications";
	$notification_set= mysqli_query($connection, $query);
	confirm_query($notification_set);
	return $notification_set;
}


function find_notification_by_id($notification_id){
	global $connection;

	$secure_notification_id= mysqli_real_escape_string($connection, $notification_id);

	$query= "SELECT * FROM notifications ";
	$query .= "WHERE id = {$secure_notification_id} ";
	$query .= "LIMIT 1";
	$notification_set= mysqli_query($connection, $query);
	confirm_query($notification_set);

	if($notification= mysqli_fetch_assoc($notification_set)){
		return $notification;
	}else{
		return null;
	}
}


function find_selected_field(){
	global $current_notification_by_id;
	
	if(isset($_GET["notice"])){
		$current_notification_by_id= find_notification_by_id($_GET["notice"]);
	}else{
		$current_notification_by_id= null;
	}
    
}

?>