<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php find_selected_fields(); ?>
<?php 
if (!$current_student_admin) {
  redirect_to("students.php");
}
?>
<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
  $required_fields= array("full_names", "relationship");
  validate_presences($required_fields);

  //check whether there was any errors
  if(empty($errors)){
    //get objects from the form 
     //this is the path to store the uploaded image 
    
    //3. get objects info from the form 
    $student_admin= $current_student_admin["admin"];    
    $fullnames= mysqli_sec($_POST["full_names"]);
    $age= mysqli_sec($_POST["age"]);
    $gender= mysqli_sec($_POST["gender"]);
    $relationship= mysqli_sec($_POST["relationship"]);
    $school= mysqli_sec($_POST["school"]);
    
    //4. perform the update query 
    $query = "INSERT INTO siblings(";
    $query .= "admin_number, full_names, ";
    $query .= "age, relationship, ";
    $query .= "gender, school ";
    $query .= ") VALUES (";
    $query .= "{$student_admin}, '{$fullnames}', ";
    $query .= "'{$age}', '{$gender}', ";
    $query .= "'{$relationship}', '{$school}' ";
    $query .= ")"; 
    $results = mysqli_query($connection, $query);

    //5. check whether the query took place
    if($results){
      //it was successfull 
      $_SESSION["message"]= "You have successfully added a sibling";
      redirect_to("../profile.php?student=".urlencode($current_student_admin["admin"]));

    }else{
      //update has failed
      $_SESSION["error_message"]= "There was an error in adding a sibling";
      redirect_to("../profile.php?student=".urlencode($current_student_admin["admin"]));

    }

  }else{
    $errors = $_SESSION["errors"];
    redirect_to("../profile.php?student=".urlencode($current_student_admin["admin"]));
  }
}else{
  //form has not been submitted
  //probably a get request 
  redirect_to("../profile.php?student=".urlencode($current_student_admin["admin"]));
}


?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>