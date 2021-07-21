<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/notice_function.php'; ?>
<?php find_selected_field(); ?>
<?php 
if (!$current_notification_by_id) {
	redirect_to("../../home.php");
}

?>
<?php 
	//perform deletion query
	$id = $current_notification_by_id["id"];
	$query = "DELETE FROM notifications WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "Notification has been successfully removed";
		redirect_to("../../home.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "Notification deletion failed";
		redirect_to("../../home.php?notice={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








