<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/transport_function.php'; ?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php 
  $current_transport = find_fee_by_id($_GET["transport"]); 
  if(!$current_transport){
    //student id doesnot exist 
    redirect_to('../transport.php');
  }
?>
<?php
//check whether the class has both students and teachers records linkec to it
$student_set = find_students_for_transport($current_transport["id"]);
if(mysqli_num_rows($student_set) > 0){
	$_SESSION['error_message'] = "Cannot delete this transportation info. Clear first all students records..!";
	redirect_to("../transport.php?transport={$current_transport["id"]}");
}
?>


<?php 
	//perform deletion query
	$id = $current_transport["id"];
	$query = "DELETE FROM transport WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The transportation schedule was successfully removed";
		redirect_to("../transport.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "transportation schedule removal failed";
		redirect_to("../transport.php?transport={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








