<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/parent_function.php'; ?>
<?php 
  $current_parent = find_parents_by_id($_GET["parent"]); 
  if(!$current_parent){
    //student id doesnot exist 
    redirect_to('../parents.php');
  }
?>

<?php 
	//perform deletion query
	$id = $current_parent["id"];
	$query = "DELETE FROM all_parents WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The parent/gurdian was successfully removed";
		redirect_to("../parents.php");
	}else{
	//there was a failure
		$_SESSION['message'] = "parent/gurdian removal failed";
		redirect_to("../parents.php?student={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








