<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("registration", "surname", "fullnames", "gender", "class", "stream", "position");
    validate_presences($required_fields);

    if(empty($errors)){
      //3. get objectes and store them to variables
      $registration= mysqli_sec($_POST["registration"]);
      $surname= mysqli_sec($_POST["surname"]);
      $fullnames= mysqli_sec($_POST["fullnames"]);
      $gender= mysqli_sec($_POST["gender"]);
      $class= mysqli_sec($_POST["class"]);
      $stream= mysqli_sec($_POST["stream"]);
      $position= mysqli_sec($_POST["position"]);

      //perform insertion query 
      $query = "INSERT INTO student_board(";
      $query .= "registration, surname, "; 
      $query .= "fullnames, gender, ";
      $query .= "class, stream, ";
      $query .= "position";
      $query .= ")VALUES(";
      $query .= "'{$registration}', '{$surname}', ";
      $query .= "'{$fullnames}', '{$gender}', ";
      $query .= "'{$class}', '{$stream}', ";
      $query .= "'{$position}'";
      $query .= ")";
      $results = mysqli_query($connection, $query);

      if($results){
        //successfull
        $_SESSION["message"] = "You have successfully aded a student in the student board";
        redirect_to("../board.php");
      }else{
        //failed
        $_SESSION["error_message"] = "There was aproblem a new student to the student board/counsel";
        redirect_to("../board.php");
      }

    }else{
       redirect_to("../board.php");
    }

  }else{
     redirect_to("../board.php");
  }
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
