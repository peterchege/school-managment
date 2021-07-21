<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php $current_payments = find_payments_by_id($_GET["payments"]); ?>
<?php  if(!$current_payments){redirect_to('../payments.php');} ?>
<?php 
	//perform deletion query
	$id = $current_payments["id"];
	$query = "DELETE FROM fee_payments WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The payments information has been successfully removed..";
		redirect_to('../payments.php');
	}else{
	//there was a failure
		$_SESSION['error_message'] = "payments information removal failed";
		redirect_to("../payments.php?payments={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








