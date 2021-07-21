<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../include/admin_function.php'; ?>
<?php 
  $current_interview = find_interview_by_id($_GET["interview"]); 
  if(!$current_interview){
    //student id doesnot exist 
    redirect_to('../interviews.php');
  }
?>

<?php 
//check whether the student has both parents and previous school records linkec to him/her
$student_set = find_students_doing_interview($current_interview["id"]);
if(mysqli_num_rows($student_set) > 0){
	$_SESSION['error_message'] = "Cannot delete this interview. clear all students records..!";
	redirect_to("../interviews.php");
}

?>

<?php 
	//perform deletion query
	$id =$current_interview["id"];
	$query = "DELETE FROM interviews WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The interview process has been successfully removed";
		redirect_to('../interviews.php');
	}else{
	//there was a failure
		$_SESSION['message'] = "interview removal failed";
		redirect_to('../interviews.php?interview={$id}');
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
