<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/class_function.php'; ?>
<?php $current_class = find_class_by_id($_GET["class"]); ?>
<?php if (!$current_class) 
{
  redirect_to("../classes.php");
} 
?>
<?php 
//1. confirm that the form has been submitted
if(isset($_POST["submit"])){
    //submission was successfull check the form vallidation
    $required_fields = array("registration", "surname", "fullnames", "gender", "position");
    validate_presences($required_fields);

    if(!empty($errors)){
      $_SESSION["errors"] = $errors;
      redirect_to("students.php?class=".urlencode($current_class['id']));

    }else{
      $class_id = $current_class['id'];
      $registration = mysqli_sec($_POST["registration"]);
      $surname = mysqli_sec($_POST["surname"]);
      $fullnames = mysqli_sec($_POST["fullnames"]);
      $gender = mysqli_sec($_POST["gender"]);
      $position = mysqli_sec($_POST["position"]);
     

      //perform query 
      $query = "INSERT INTO class_students(";
      $query .= "class_id, registration, surname, ";
      $query .= "fullnames, gender, ";
      $query .= "position";
      $query .= ")VALUES(";
      $query .= "{$class_id}, '{$registration}', '{$surname}', ";
      $query .= "'{$fullnames}', '{$gender}', ";
      $query .= "'{$position}'";
      $query .= ")";
      $results = mysqli_query($connection, $query);
      if($results){
        $_SESSION["message"] = "Youve successfully added astudent to the current class";
        redirect_to("students.php?class=".urlencode($current_class['id']));


      }else{
        $_SESSION["error_message"] = "There was a problem in adding a student to thecurrent class";
       redirect_to("students.php?class=".urlencode($current_class['id']));
      }
    }


  }else{
    redirect_to("students.php?class=".urlencode($current_class['id']));
  }
    
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
