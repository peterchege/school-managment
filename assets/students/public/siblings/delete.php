<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/student_function.php'; ?>
<?php 
  $current_sibling = find_sibling_by_id($_GET["sibling"]); 
  if(!$current_sibling){
    //student id doesnot exist 
    redirect_to('../students.php');
  }
?>

<?php 
	//perform deletion query
	$id = $current_sibling["id"];
	$query = "DELETE FROM  siblings WHERE id= {$id} LIMIT 1";
	$results = mysqli_query($connection, $query);

	//check whether the query was successful
	if($results && mysqli_affected_rows($connection) == 1){
			//it was successfully  
			//if success take me to the original page
		$_SESSION['message'] = "The sibling was successfully removed";
		redirect_to("../profile.php?student=". urlencode($current_sibling["admin_number"]));
	}else{
	//there was a failure
		$_SESSION['error_message'] = "sibling removal failed";
		redirect_to("../profile.php?student=". urlencode($current_sibling["admin_number"]));
}



?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








