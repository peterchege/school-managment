<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_stock = find_all_stocks_by_id($_GET['stock']) ?>
<?php if (!$current_stock) {redirect_to("../students.php");} ?>

<?php
//perform deletion query
$id = $current_stock["id"];
$query = "DELETE FROM stocks_payments WHERE id= {$id} LIMIT 1";
$results = mysqli_query($connection, $query);

if($results && mysqli_affected_rows($connection) == 1){
    $_SESSION['message'] = "The stock payment for student has been successfully removed";
    redirect_to("stocks.php?student=". urlencode($current_stock['student_admin']));
}else{
    //there was a failure
    $_SESSION['error_message'] = "teacher removal failed";
    redirect_to("stocks.php?student=". urlencode($current_stock['student_admin']));
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








