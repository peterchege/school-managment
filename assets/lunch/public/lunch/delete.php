<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/lunch_function.php'; ?>
<?php
$current_lunch_id = find_lunch_by_id($_GET["lunch"]);
if(!$current_lunch_id){
    //student id doesnot exist
    redirect_to('../lunch.php');
}
?>

<?php
//perform deletion query
$id = $current_lunch_id["id"];
$query = "DELETE FROM lunch WHERE id= {$id} LIMIT 1";
$results = mysqli_query($connection, $query);

//check whether the query was successful
if($results && mysqli_affected_rows($connection) == 1){
    //if success take me to the original page
    $_SESSION['message'] = "The lunch schedule was successfully removed";
    redirect_to("../lunch.php");
}else{
    //there was a failure
    $_SESSION['error_message'] = "lunch schedule removal failed";
    redirect_to("../lunch.php?lunch={$id}");
}


?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>






