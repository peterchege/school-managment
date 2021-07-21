<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php $current_fee = find_all_fee_by_id($_GET['fee']); ?>
<?php
if(!$current_fee){
	//fee id doesnot exsist
	redirect_to("../fees.php");
}
?>
<?php 
	//perform deletion query
	$id = $current_fee["id"];
	$query = "DELETE FROM fees WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "Fee type was successfully removed";
		redirect_to("../fees.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "Fee type removal failed";
		redirect_to("../fees.php?student={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








