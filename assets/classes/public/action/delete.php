<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../includes/class_function.php'; ?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php 
  $current_class = find_class_by_id($_GET["class"]); 
  if(!$current_class){
    //student id doesnot exist 
    redirect_to('../classes.php');
  }
?>


<?php 
	//perform deletion query
	$id = $current_class["id"];
	$query = "DELETE FROM classes WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The class was successfully removed";
		redirect_to("../classes.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "There was a problem in removing the class";
		redirect_to("../classes.php?class={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








