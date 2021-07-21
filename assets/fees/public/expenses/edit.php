<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php $current_cat = find_expense_by_id($_GET['cat']); ?>
<?php if(!$current_cat){
	redirect_to('../expenses.php');
}
?>
<?php 
//1. confirm that the form has been submitted
	if(isset($_POST["submit"])){
  	//2. vvalidate the form
    $required_fields = array("expense");
    validate_presences($required_fields);

    if(empty($errors)){
      //3. get objectes and store them to variables
		$id = $current_cat["id"];
		$expense= mysqli_sec($_POST["expense"]);
		$description= mysqli_sec($_POST["description"]);
		$year= mysqli_sec($_POST["year"]);

      //perform insertion query 
		$query = "UPDATE exp_cat SET ";
		$query .= "expense= '{$expense}', description= '{$description}', year= '{$year}' ";
		$query .= "WHERE id= {$id} ";
		$query .= "LIMIT 1";
		$results = mysqli_query($connection, $query);

    	if($results && mysqli_affected_rows($connection) == 1){
			$_SESSION["message"] = "You have successfully updated the expense";
			redirect_to("../expenses.php");
		}else{
				//failure
			$_SESSION["error_message"] = "There was a problem in updating the expense";
			redirect_to("../expenses.php");
		}

	}else{
		$_SESSION['errors'] = $errors;
		redirect_to('../expenses.php');
	}

  }else{
  //there was problem during submission
		redirect_to('../expenses.php');
  }

?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>