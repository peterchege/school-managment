<?php  require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/notice_function.php'; ?>
<?php require_once'../../../includes/validation_functions.php'; ?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("title", "notice", "date", "month", "term");
    validate_presences($required_fields);

    if(empty($errors)){
      //3. get objectes and store them to variables
      $title= mysqli_sec($_POST["title"]);
      $notice= mysqli_sec($_POST["notice"]);
      $date= mysqli_sec($_POST["date"]);
      $month= mysqli_sec($_POST["month"]);
      $term= mysqli_sec($_POST["term"]);

      //perform insertion query 
      $query = "INSERT INTO notifications(";
      $query .= "title, notice, "; 
      $query .= "not_date, month, ";
      $query .= "term";
      $query .= ") VALUES (";
      $query .= "'{$title}', '{$notice}', ";
      $query .= "'{$date}', '{$month}', ";
      $query .= "'{$term}'";
      $query .= ")";
      $results = mysqli_query($connection, $query);

      if($results){
        //successfull
        $_SESSION["message"] = "You have successfully added a new notification";
        redirect_to("../../home.php");
      }else{
        //failed
        $_SESSION["error_message"] = "There was aproblem in adding a transportation schedule";
        redirect_to("../../home.php");
      }

    }else{
       redirect_to("../../home.php");
    }

  }else{
     redirect_to("../../home.php");
  }
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
