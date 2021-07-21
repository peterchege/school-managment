<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/staff_function.php'; ?>
<?php 
  $current_teacher = find_teacher_by_id($_GET["teacher"]); 
  if(!$current_teacher){
    //student id doesnot exist 
    redirect_to('../teachers.php');
  }
?>
<?php 
//check whether the student has both parents and previous school records linkec to him/her
$details_set = find_teaching_details($current_teacher["id"]);
if(mysqli_num_rows($details_set) > 0){
	$_SESSION['error_message'] = "Cannot delete this teacher. Clear first his/her teaching records..!";
	redirect_to("profile.php?teacher=". urlencode($current_teacher["id"]));
}

?>

<?php /*
	$school_set = find_school_for_student($current_teacher["id"]);
	if(mysqli_num_rows($school_set) > 0){
			$_SESSION['message'] = "Cannot delete this student. Clear first his/her previous school records..!";
			redirect_to("../intakes.php?student={$current_teacher["id"]}");
	}

*/
?>

<?php 
	//perform deletion query
	$id = $current_teacher["id"];
	$query = "DELETE FROM teaching_staff WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The teacher was successfully removed";
		redirect_to("../teachers.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "teacher removal failed";
		redirect_to("../teachers.php?teacher={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








