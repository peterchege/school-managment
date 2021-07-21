<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/class_function.php'; ?>
<?php 
  $current_student = find_student_by_id($_GET["student"]); 
  if(!$current_student){
    //student id doesnot exist 
    redirect_to('../classes.php');
  }
?>

<?php 
	//perform deletion query
	$id = $current_student["id"];
	$query = "DELETE FROM class_students WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The student was successfully removed";
		redirect_to("../classes.php");
	}else{
	//there was a failure
		$_SESSION['message'] = "student removal failed";
		redirect_to("../classes.php?student={$admin}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








