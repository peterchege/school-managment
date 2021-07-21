<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/events_function.php'; ?>
<?php find_selected_fields(); ?>
<?php 
	if(!$current_event_id){
		//no id
		redirect_to("../events.php");
	}
?>

<?php 
	//perform deletion query
	$id = $current_event_id["id"];
	$query = "DELETE FROM events WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "Event has been successfully removed";
		redirect_to("../events.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "There was a problem in removing this event";
		redirect_to("../events.php?event={$id}");
	}

?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








