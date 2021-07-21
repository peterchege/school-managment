<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/student_function.php'; ?>
<?php 
  $current_student = find_student_by_adm($_GET["student"]); 
  if(!$current_student){
    //student id doesnot exist 
    redirect_to('../students.php');
  }
?>


<?php /*
	$school_set = find_school_for_student($current_student["id"]);
	if(mysqli_num_rows($school_set) > 0){
			$_SESSION['message'] = "Cannot delete this student. Clear first his/her previous school records..!";
			redirect_to("../intakes.php?student={$current_student["id"]}");
	}

*/
?>

<?php 
	//perform deletion query
	$admin = $current_student["admin"];
	$query = "DELETE FROM students WHERE admin= {$admin} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The student was successfully removed";
		redirect_to("../students.php");
	}else{
	//there was a failure
		$_SESSION['message'] = "student removal failed";
		redirect_to("../students.php?student={$admin}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








