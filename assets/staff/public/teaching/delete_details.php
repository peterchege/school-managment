<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/staff_function.php'; ?>
<?php 
  $current_teaching_details = find_details_by_id($_GET["details"]); 
  if(!$current_teaching_details){
    //student id doesnot exist 
    redirect_to('../teachers.php');
  }
?>

<?php 
	//perform deletion query
	$id = $current_teaching_details["id"];
	$query = "DELETE FROM teachers_classes WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The teachers details was successfully removed";
		redirect_to("classes.php?teacher=". urlencode($current_teaching_details["teacher_id"]));
	}else{
	//there was a failure
		$_SESSION['error_message'] = "there was a problem in removing the teachers details";
		redirect_to("classes.php?teacher=". urlencode($current_teaching_details["teacher_id"]));
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








