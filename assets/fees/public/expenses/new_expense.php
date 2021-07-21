<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("expense");
    validate_presences($required_fields);

    if(empty($errors)){
      //3. get objectes and store them to variables
      $expense= mysqli_sec($_POST["expense"]);
      $description= mysqli_sec($_POST["description"]);
      $year= mysqli_sec($_POST["year"]);

      //perform insertion query 
      $query = "INSERT INTO exp_cat(";
      $query .= "expense, description, year";
      $query .= ") VALUES (";
      $query .= "'{$expense}', '{$description}', '{$year}'";
      $query .= ")";
      $results = mysqli_query($connection, $query);

      if($results){
        //successfull
        $_SESSION["message"] = "Expensehas been successfully added";
        redirect_to("../expenses.php");
      }else{
        //failed
        $_SESSION["error_message"] = "There was aproblem in adding an expense";
        redirect_to("../expenses.php");
      }

    }else{
       redirect_to("../expenses.php");
    }

  }else{
     redirect_to("../expenses.php");
  }
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
