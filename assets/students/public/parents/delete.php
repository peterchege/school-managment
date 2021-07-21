<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php 
  $current_parent = find_parent_by_id($_GET["parent"]); 
  if(!$current_parent){
    //student id doesnot exist 
    redirect_to('../students.php');
  }
?>

<?php 
	//perform deletion query
	$id = $current_parent["id"];
	$query = "DELETE FROM all_parents WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The parent/gurdian was successfully removed";
		redirect_to("../profile.php?student=". urlencode($current_parent["admin_number"]));
	}else{
	//there was a failure
		$_SESSION['error_message'] = "parent/gurdian removal failed";
		redirect_to("../profile.php?student=". urlencode($current_parent["admin_number"]));
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








