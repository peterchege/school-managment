<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/alumni_function.php'; ?>
<?php 
  $current_alumni = find_alumni_by_id($_GET["alumni"]); 
  if(!$current_alumni){
    //student id doesnot exist 
    redirect_to('../alumni.php');
  }
?>


<?php 
	//perform deletion query
	$id = $current_alumni["id"];
	$query = "DELETE FROM alumni WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The student was successfully removed";
		redirect_to("../alumni.php");
	}else{
	//there was a failure
		$_SESSION['error_message'] = "student removal failed";
		redirect_to("../alumni.php?alumni={$id}");
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








