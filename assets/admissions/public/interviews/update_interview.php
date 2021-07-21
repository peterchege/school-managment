<?php require_once '../include/session.php'; ?>
<?php require_once '../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../../includes/functions.php'; ?>
<?php require_once '../include/admin_function.php'; ?>
<?php require_once '../include/validation_functions.php'; ?>
<?php 
	$current_student_interview = find_interview_for_student($_GET["student"]);
	if(!$current_student_interview){
		redirect_to("intakes.php");
	}
?>
<?php 
//check whether the form has been submitted
if(isset($_POST["submit"])){
	//get object fields 
	$id= $current_student_interview["id"];
	$status = mysqli_sec($_POST["status"]);
	$interview_fee = mysqli_sec($_POST["interview_fee"]);
	$Results =  mysqli_sec($_POST["Results"]);

	//perform update query 
	$query = "UPDATE interview_info SET interview_status= '{$status}', payments_status= '{$interview_fee }', interview_results= '{$Results}' WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//confirm if the query took place
	if($results && mysqli_affected_rows($connection)==1){
		//was successfull
		$_SESSION["message"] = "interview has been successfully updated";

		redirect_to("profile.php?student=". urlencode($current_student_interview["student_id"]));
	}else{
		$_SESSION["message"] = "problem occured when updating info";

		redirect_to("profile.php?student=". urlencode($current_student_interview["student_id"]));
	} 
	

}else{
	//the form has not been  submitted 
	//go back
	redirect_to("profile.php?student=". urlencode($current_student_interview["student_id"]));

}

?>