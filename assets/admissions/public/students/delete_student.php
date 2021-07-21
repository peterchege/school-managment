<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../include/admin_function.php'; ?>
<?php 
  find_selected_field();
  if(!$current_student_id){
    //student id doesnot exist 
    redirect_to('../interviews.php');
  }
?>

<?php 
	//perform deletion query
	$id =$current_student_id["id"];
	$query = "DELETE FROM interviewed_students WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The student has been successfully removed";
		redirect_to('students.php?interview='.urlencode($current_student_id["int_id"]));
	}else{
	//there was a failure
		$_SESSION['error_message'] = "Student removal failed";
		redirect_to('students.php?interview='.urlencode($current_student_id["int_id"]));
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
