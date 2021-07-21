<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php $current_expense = find_expenses_for_cat_by_id($_GET['expense']); ?>
<?php if(!$current_expense){
    redirect_to('../expenses.php');
}
?>

<?php
//perform deletion query
$id = $current_expense["id"];
$query = "DELETE FROM expense WHERE id= {$id} LIMIT 1";
$results = mysqli_query($connection, $query);

//check whether the query was successful
if($results && mysqli_affected_rows($connection) == 1){
    //it was successfully
    //if success take me to the original page
    $_SESSION['message'] = "you have successfully removed the current expense";
    redirect_to("expense.php?cat=". urlencode($current_expense['cat_id']));
}else{
    //there was a failure
    $_SESSION['error_message'] = "Fee type removal failed";
    redirect_to("expense.php?cat=". urlencode($current_expense['cat_id']));
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








