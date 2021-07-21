<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../includes/users_function.php'; ?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php find_selected_fields(); ?>
<?php if(!$current_user_id){
  redirect_to("../users.php");
  } ?>

<?php 
	//perform deletion query
	$id = $current_user_id["id"];
	$query = "DELETE FROM users WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "You have successfully removed the user";
		redirect_to("../users.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "There was a problem in removing the current user";
		redirect_to("profile.php?user=".urlencode($current_user_id["id"]));
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








