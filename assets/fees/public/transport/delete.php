<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php $current_structure = find_transport_fee_structure_by_id($_GET["transport"]); ?>
<?php if(!$current_structure){ redirect_to('../transport.php');} ?>

<?php
$id = $current_structure["id"];
$query = "DELETE FROM transport_structure WHERE id= {$id} LIMIT 1";
$results = mysqli_query($connection, $query);

if($results && mysqli_affected_rows($connection) == 1){
    //it was successfully
    //if success take me to the original page
    $_SESSION['message'] = "The structure has been successfully removed..";
    redirect_to("../transport.php");
}else{
    //there was a failure
    $_SESSION['error_message'] = "Fee structure removal failed";
    redirect_to("../transport.php?transport={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








