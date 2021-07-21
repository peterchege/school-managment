<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php $current_cat = find_expense_by_id($_GET['cat']); ?>
<?php if(!$current_cat){
	redirect_to('../expenses.php');
}
?>

<?php
	$expense_set = find_expenses_for_cat($current_cat["id"]);
	if(mysqli_num_rows($expense_set) > 0){
		$_SESSION['error_message'] = "Cannot delete this expense.clear all the records under it first..!";
		redirect_to("../expenses.php?cat=".urlencode($current_cat['id']));
	}
?>

<?php 
	//perform deletion query
	$id = $current_cat["id"];
	$query = "DELETE FROM exp_cat WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "you have successfully removed the current expense";
		redirect_to("../expenses.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "Fee type removal failed";
		redirect_to("../expenses.php?student={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








