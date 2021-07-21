<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/staff_function.php'; ?>
<?php 
  $current_staff = find_non_teaching_staff_by_id($_GET["staff"]); 
  if(!$current_staff){
    //student id doesnot exist 
    redirect_to('../non_teaching.php');
  }
?>
<?php /*
//check whether the student has both parents and previous school records linkec to him/her
$parents_set = find_parents_for_students($current_staff["id"]);
if(mysqli_num_rows($parents_set) > 0){
	$_SESSION['message'] = "Cannot delete this student. Clear first his/her parents/gurdian records..!";
	redirect_to("../intakes.php?student={$current_staff["id"]}");
}
*/
?>

<?php /*
	$school_set = find_school_for_student($current_staff["id"]);
	if(mysqli_num_rows($school_set) > 0){
			$_SESSION['message'] = "Cannot delete this student. Clear first his/her previous school records..!";
			redirect_to("../intakes.php?student={$current_staff["id"]}");
	}

*/
?>

<?php 
	//perform deletion query
	$id = $current_staff["id"];
	$query = "DELETE FROM non_teaching WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The staff was successfully removed";
		redirect_to("../non_teaching.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "Staff removal failed";
		redirect_to("../non_teaching.php?staff={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








