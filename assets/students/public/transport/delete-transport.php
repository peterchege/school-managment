<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_payments= find_trans_payments_by_id($_GET['payments']) ?>
<?php if(!$current_payments) {redirect_to("../students.php");} ?>
<?php
//perform deletion query
$id = $current_payments["id"];
$query = "DELETE FROM trans_payments WHERE id= {$id} LIMIT 1";
$results = mysqli_query($connection, $query);

//check whether the query was successful
if($results && mysqli_affected_rows($connection) == 1){

    $_SESSION['message'] = "The transport fee you've selected was successfully removed";
    redirect_to("transport-invoice.php?student=".urlencode($current_payments['student_admin']));
}else{
    //there was a failure
    $_SESSION['message'] = "There was a problem in deleting the current transport fee";
    redirect_to("transport-invoice.php?student=".urlencode($current_payments['student_admin']));
}


?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
