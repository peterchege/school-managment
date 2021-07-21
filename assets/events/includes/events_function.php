<?php
 
//Query performance 
function confirm_query($string){
 	if(!$string){
 		die("Problem in the query");
 	}
 }

 function find_all_events_set(){
	global $connection;

	$query = "SELECT * FROM events";
	$events_set= mysqli_query($connection, $query);
	check_query($events_set);
	return $events_set;
}


function find_events_by_id($events_id){
	global $connection;

	$safe_events_id= mysqli_real_escape_string($connection, $events_id);

	$query= "SELECT * FROM events ";
	$query .= "WHERE id = {$safe_events_id}";
	$events_set = mysqli_query($connection, $query);
	confirm_query($events_set);
	if($events= mysqli_fetch_assoc($events_set)){
		return $events;
	}else{
		return null;
	}

}


function find_selected_fields(){
	global $current_event_id;
	
	if(isset($_GET["event"])){
		$current_event_id=find_events_by_id($_GET["event"]);
	}else{
		$current_event_id = null;
	}
}

?>