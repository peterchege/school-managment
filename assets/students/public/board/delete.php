<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php 
   $current_student = find_board_by_id($_GET["board"]); 
  if(!$current_student){
    //student id doesnot exist 
    redirect_to('../board.php');
}
?>


<?php 
	//perform deletion query
	$id = $current_student["id"];
	$query = "DELETE FROM student_board WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The student has been successfully removed";
		redirect_to("../board.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "Student removal failed";
		redirect_to("../board.php?board={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








