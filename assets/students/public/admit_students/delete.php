<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php 
  $current_student = find_student_by_adm($_GET["student"]); 
  if(!$current_student){
    //student id doesnot exist 
    redirect_to('../students.php');
  }
?>
<?php 
//check whether the student has both parents and previous school records linkec to him/her
$parents_set = find_parents_for_student($current_student["admin"]);
if(mysqli_num_rows($parents_set) > 0){
	$_SESSION['error_message'] = "Cannot delete this student. Clear first his/her parents/gurdian records..!";
	redirect_to("../profile.php?student=".urlencode($current_student["admin"]));
}

?>

<?php 
//check whether the student has both parents and previous school records linkec to him/her
$siblings_set = find_siblings_for_student($current_student["admin"]);
if(mysqli_num_rows($siblings_set) > 0){
	$_SESSION['error_message'] = "Cannot delete this student. Remove the his/her siblings records first..!";
	redirect_to("../profile.php?student=".urlencode($current_student["admin"]));
}

?>

<?php 
	$class_set = find_class_for_student($current_student["admin"]);
	if(mysqli_num_rows($class_set) > 0){
			$_SESSION['error_message'] = "Cannot delete this student. Clear first his/her class records first..!";
			redirect_to("../profile.php?student=".urlencode($current_student["admin"]));
	}
?>




<?php 
	$payments_set = find_all_students_payments($current_student["admin"]);
	if(mysqli_num_rows($payments_set) > 0){
			$_SESSION['error_message'] = "Cannot delete this student. Clear all the payments records first before deleting..!";
			redirect_to("../profile.php?student=".urlencode($current_student["admin"]));
	}
?>

<?php
$trans_payments_set = find_transport_for_student($current_student["admin"]);
if(mysqli_num_rows($trans_payments_set) > 0){
	$_SESSION['error_message'] = "Cannot delete this student. Clear all the transport payments records first before deleting..!";
	redirect_to("../profile.php?student=".urlencode($current_student["admin"]));
}
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
		$_SESSION['error_message'] = "student removal failed";
		redirect_to("../students.php?student={$admin}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








