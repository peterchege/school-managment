<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php require_once '../../includes/class_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("class");
    validate_presences($required_fields);

    if(empty($errors)){
      //3. get objectes and store them to variables
      $class= mysqli_sec($_POST["class"]);
      $stream= mysqli_sec($_POST["stream"]);
      $teacher= mysqli_sec($_POST["class_teacher"]);

      //perform insertion query 
      $query = "INSERT INTO classes(";
      $query .= "class, stream, teacher";
      $query .= ") VALUES (";
      $query .= "'{$class}', '{$stream}', '{$teacher}'";
      $query .= ")";
      $results = mysqli_query($connection, $query);

      if($results){
        //successfull
        $_SESSION["message"] = "You have successfully added a class for this student";
        redirect_to("../classes.php");
      }else{
        //failed
        $_SESSION["message"] = "There was aproblem in adding a class to the student";
        redirect_to("../classes.php");
      }

    }else{
       redirect_to("../classes.php");
    }

  }else{
     redirect_to("../classes.php");
  }
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>