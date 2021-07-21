<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../include/admin_function.php'; ?>
<?php confirm_other_folder_logged_in(); ?>
<?php 
find_selected_field();
if(!$current_student_id){
  //the id doesnot exist
  redirect_to("../interviews.php");
}
?>

<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
  	//2. vvalidate the form
    $required_fields = array("surname", "fullnames", "age", "gender", "class");
    validate_presences($required_fields);

    if(empty($errors)){
    	//3. get objectes and store them to variables
      $id = $current_student_id["id"];
      $surname= mysqli_sec($_POST["surname"]);
      $fullnames= mysqli_sec($_POST["fullnames"]);
      $age= mysqli_sec($_POST["age"]);
      $gender= mysqli_sec($_POST["gender"]);
      $class= mysqli_sec($_POST["class"]);
      //perform insertion query 

      $query = "UPDATE interviewed_students SET ";
      $query .= "surname= '{$surname}', "; 
      $query .= "fullnames='{$fullnames}', age='{$age}', ";
      $query .= "gender='{$gender}', class='{$class}' ";
      $query .= "WHERE id= {$id} ";
      $query .= "LIMIT 1";
      $results = mysqli_query($connection, $query);

      if($results && mysqli_affected_rows($connection) == 1){
        //the query went through 
        $_SESSION["message"] = "You have successfully updated the student info";
        redirect_to("students.php?interview=".urlencode($current_student_id["int_id"]));


      }else{
         $_SESSION["error_message"] = "There was a problem in trying to update the student info";

      }

    }
  }else{
  	//there was a problem in form submission 
  }



?>

<?php include '../../../../includes/system/header.php'; ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="../../../home.php" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home
      </a>
      <a href="../interviews.php" class="current">Interviews</a>
    </div>
    <h1>Students Interview.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
  <hr>
  	<div class="row-fluid">
  		<div class="span12">
  			<div class="widget-box">
  				<div class="widget-title">
  					<span class="icon"> 
  						<i class="icon-align-justify"></i> 
       				</span>
       				<h5>Update student info</h5>
  				</div>
  				<div class="widget-content nopadding">
  			<form action="edit_student.php?student=<?php echo urlencode($current_student_id["id"]); ?>" method="POST" class="form-horizontal">
              <!--class-->
			      <div class="control-group">
                  <label class="control-label">DATE :</label>
                  <div class="controls">
                      <input type="text" name="date" class="span11" placeholder="Enter Registration date.." value="<?php echo htmlentities($current_student_id["date"]); ?>" readonly>
                    </div>
                </div><!--control-group-->
              <div class="control-group">
                  <label class="control-label">SURNAME :</label>
                  <div class="controls">
                      <input type="text" name="surname" class="span11" placeholder="Enter the students surname.." value="<?php echo htmlentities($current_student_id["surname"]); ?>">
                    </div>
                </div><!--control-group-->


                <!--stream-->
                <div class="control-group">
                  <label class="control-label">FULLNAMES :</label>
                  <div class="controls">
                  <input type="text" name="fullnames" class="span11" placeholder="Enter the students fullnames.." value="<?php echo htmlentities($current_student_id["fullnames"]); ?>">
                  </div>
                </div><!--control-group-->

                <!--photo-->
                <div class="control-group">
                  <label class="control-label">AGE :</label>
                  <div class="controls">
                     <input type="text" name="age" class="span11" placeholder="Enter the students age." value="<?php echo htmlentities($current_student_id["age"]); ?>">
                  </div>
                </div><!--control-group-->

                <div class="control-group">
                  <label class="control-label">GENDER :</label>
                  <div class="controls">
                     <input type="text" name="gender" class="span11" placeholder="Enter the students gender.." value="<?php echo htmlentities($current_student_id["gender"]); ?>">
                  </div>
                </div><!--control-group-->

                <div class="control-group">
                  <label class="control-label">CLASS :</label>
                  <div class="controls">
                     <input type="text" name="class" class="span11" placeholder="Enter the students class.." value="<?php echo htmlentities($current_student_id["class"]); ?>">
                  </div>
                </div><!--control-group-->
					<div class="control-group">
                  <label class="control-label">FEE PAID :</label>
                  <div class="controls">
                     <input type="text" name="paid" class="span11" placeholder="Interview Fee Paid" value="<?php echo htmlentities($current_student_id["paid"]); ?>" >
                  </div>
                </div><!--control-group-->
                <div class="form-actions">
                    <button name="submit" type="submit" class="btn btn-success">
                    <i class="icon-download-alt"></i> Update
                    </button> 

                    <a href="students.php?interview=<?php echo urlencode($current_student_id["int_id"]); ?>" class="btn btn-danger">
                    	<i class="icon-exclamation-sign"></i> Cancel
                    </a> 
                </div>
            </form>
  				</div>
  			</div><!--widget-box-->
  		</div><!--span12-->
  	</div><!--widget-title-->
  </div><!--container-fluid-->
</div><!--content-->
<?php include '../../../../includes/system/form_footer.php'; ?>
