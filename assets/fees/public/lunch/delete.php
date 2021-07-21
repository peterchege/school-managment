<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php
$current_structure = find_lunch_fee_structure_by_id($_GET["lunch"]);
if(!$current_structure){
    //student id doesnot exist
    redirect_to('../lunch.php');
}
?>

<?php
//perform deletion query
$id = $current_structure["id"];
$query = "DELETE FROM lunch_payments_structure WHERE id= {$id} LIMIT 1";
$results = mysqli_query($connection, $query);

//check whether the query was successful
if($results && mysqli_affected_rows($connection) == 1){
    //it was successfully
    //if success take me to the original page
    $_SESSION['message'] = "The structure has been successfully removed..";
    redirect_to("../lunch.php");
}else{
    //there was a failure
    $_SESSION['error_message'] = "Fee structure removal failed";
    redirect_to("../lunch.php?lunch={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








