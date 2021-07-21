<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/student_function.php'; ?>
<?php $current_fee = find_fee_by_id($_GET["fee"]);
  if(!$current_fee){ redirect_to('../students.php');}
?>


<?php /*
	$school_set = find_school_for_student($current_fee["id"]);
	if(mysqli_num_rows($school_set) > 0){
			$_SESSION['message'] = "Cannot delete this student. Clear first his/her previous school records..!";
			redirect_to("../intakes.php?student={$current_fee["id"]}");
	}

*/
?>

<?php 
	//perform deletion query
	$id = $current_fee["id"];
	$query = "DELETE FROM students_pay WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The fee type has been successfully removed";
		redirect_to("payments.php?student=".urlencode($current_fee["student_adm"]));
	}else{
	//there was a failure
		$_SESSION['error_message'] = "fee type removal failed";
		redirect_to("payments.php?student=".urlencode($current_fee["student_adm"]));
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








