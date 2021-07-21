<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php $current_fee = find_all_fee_by_id($_GET['fee']); ?>
<?php
	if(!$current_fee){
		//fee id doesnot exsist
		redirect_to("../fees.php");
	}
?>
<?php 
//1. confirm that the form has been submitted
if(isset($_POST["edit_fee"])){
	//the form has been submitted
	//2. perform form vallidation 
	$required_fields = array("fee");
	validate_presences($required_fields);

	//confirm if there were any errors
	if(empty($errors)){
		//no errors 
		//2. get the form objects
		$id = $current_fee["id"];
		$fee = mysqli_sec($_POST["fee"]);
		$description = mysqli_sec($_POST["description"]);

		//3. perform update query 
		$query = "UPDATE fees SET ";
		$query .= "type= '{$fee}', description = '{$description}' ";
		$query .= "WHERE id= {$id} ";
		$query .= "LIMIT 1";
		$results = mysqli_query($connection, $query);

		//confirm that the query took place 
		if($results && mysqli_affected_rows($connection) == 1){
			$_SESSION["message"] = "You have successfully updated the fee information";
			redirect_to("../fees.php");
		}else{
			//failure
			$_SESSION["error_message"] = "There was a problem in trying to update your fee information!..";
			redirect_to("../fees.php");
		}


	}else{
		//there was errors
		$errors = $_SESSION["errors"];
		redirect_to("../fees.php");
	}
}else{
	//something went wrong during submission
	redirect_to("../fees.php");
}

?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
              
               
             
            
             
              
           
           
            
             
            
              
              
                
            
            
      