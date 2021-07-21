<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../include/admin_function.php'; ?>
<?php confirm_other_folder_logged_in(); ?>
<?php 
$current_interview_id = find_interview_by_id($_GET["interview"]);
if(!$current_interview_id){
  //the id doesnot exist
  redirect_to("../interviews.php");
}
?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
    

    
      //3. get objectes and store them to variables
      $int_id = $current_interview_id["id"];
	  $date= mysqli_sec($_POST["date"]);
      $surname= mysqli_sec($_POST["surname"]);
      $fullnames= mysqli_sec($_POST["fullnames"]);
      $age= mysqli_sec($_POST["age"]);
      $gender= mysqli_sec($_POST["gender"]);
      $class= mysqli_sec($_POST["class"]);
	  $paid= mysqli_sec($_POST["paid"]);
      //perform insertion query
		$query = mysqli_query($connection, "INSERT INTO interviewed_students (int_id, date, surname,fullnames, age,gender, class, paid)
          VALUES ('$int_id', '$date','$surname','$fullnames', '$age','$gender', '$class', '$paid')");

      if($query){
        //successfull
        $_SESSION["message"] = "You have successfully added a new student";
        redirect_to("students.php?interview=".urlencode($current_interview_id["id"]));
      }else{
        //failed
        $_SESSION["error_message"] = "There was aproblem in adding a new student";
        redirect_to("students.php?interview=".urlencode($current_interview_id["id"]));
      }

    
		
  }else{
     redirect_to("students.php?interview=".urlencode($current_interview_id["id"]));
  }
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
