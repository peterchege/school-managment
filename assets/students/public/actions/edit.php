<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php 
   find_selected_fields();
   if(!$current_student_admin){
    redirect_to("../students.php");
   }
?>

<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
  $required_fields= array("surname", "full_names", "gender", "age", "date_of_birth", "place_of_birth", "class", "school", "skills", "status", "nationality", "residence", "background_info");
  validate_presences($required_fields);

  //check whether there was any errors
  if(empty($errors)){
    //get objects from the form 
     //this is the path to store the uploaded image 
    
    //3. get objects info from the form 
    $admin= $current_student_admin["admin"];    
    $surname= mysqli_sec($_POST["surname"]);
    $fullnames= mysqli_sec($_POST["full_names"]);
    $gender= mysqli_sec($_POST["gender"]);
    $age= mysqli_sec($_POST["age"]);
    $dob= mysqli_sec($_POST["date_of_birth"]);
    $pod= mysqli_sec($_POST["place_of_birth"]);
    $class= mysqli_sec($_POST["class"]);
    $school= mysqli_sec($_POST["school"]);
    $skills= mysqli_sec($_POST["skills"]);
    $status= mysqli_sec($_POST["status"]);
    $nationality= mysqli_sec($_POST["nationality"]);
    $residence= mysqli_sec($_POST["residence"]);
    $background_info= mysqli_sec($_POST["background_info"]);

    //perform the update query 
    $query = "UPDATE students SET ";
    $query .= "sirname= '{$surname}', full_names= '{$fullnames}', ";
    $query .= "Gender= '{$gender}', age= '{$age}', dob= '{$dob}', ";
    $query .= "pob= '{$pod}', Class= '{$class}', school= '{$school}', ";
    $query .= "Skills= '{$skills}', status= '{$status}', nationality= '{$nationality}', "; 
    $query .= "residence= '{$residence}', background= '{$background_info}' ";
    $query .= "WHERE admin= {$admin} ";
    $query .= "LIMIT 1";
    $results = mysqli_query($connection, $query);

    //check whether the query took place
    if($results && mysqli_affected_rows($connection)==1){
      //it was successfull 
      $_SESSION["message"]= "Student update was successfull";
      redirect_to("../profile.php?student=". urlencode($current_student_admin["admin"]));

    }else{
      //update has failed
      $_SESSION["message"]= "There was an error in updating the student";

    }

  }
}else{
  //form has not been submitted
  //probably a get request 
}


?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="intakes.php" class="current">students</a> </div>
    <h1>All students.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
  <hr>
  	 <div class="row-fluid">
  	 	<div class="span12">
      <?php echo message(); ?>
      <?php echo form_errors($errors); ?>
  	 		<div class="widget-box">
  	 			<div class="widget-title"> 
        			<span class="icon"> <i class="icon-align-justify"></i> 
       				</span>
          			<h5>Update Student-info</h5>
        		</div><!--widget-title-->
        		<div class="widget-content nopadding">
        			 <form action="edit.php?student=<?php echo urlencode($current_student_admin["admin"]); ?>" method="POST" class="form-horizontal">
                <!--photo-->
        			 	<!--First name-->
        			 	<div class="control-group">
              				<label class="control-label">SURNAME :</label>
             				<div class="controls">
                				<input type="text" name="surname" class="span11" value="<?php echo htmlentities($current_student_admin["sirname"]); ?>" />
              				</div>
            			</div><!--control-group-->


            			<!--Last name-->
            			<div class="control-group">
              				<label class="control-label">FULL NAMES :</label>
             				<div class="controls">
                				<input type="text" name="full_names" class="span11" value="<?php echo htmlentities($current_student_admin["full_names"]); ?>"/>
              				</div>
            			</div><!--control-group-->

                  
                  
            			<!--gender-->
            			<div class="control-group">
              				<label class="control-label">GENDER :</label>
              				<div class="controls">
				                <select name="gender">
					                  <option>Male</option>
					                  <option>Female</option>
				                </select>
              				</div>
            			</div><!--control-group-->

            			<!--age-->
            			<div class="control-group">
              				<label class="control-label">AGE :</label>
             				<div class="controls">
                				<input type="text" name="age" class="span11" value="<?php echo htmlentities($current_student_admin["age"]); ?>" />
              				</div>
            			</div><!--control-group-->

                  <!--dob-->
                  <div class="control-group">
                      <label class="control-label">DATE OF BIRTH :</label>
                    <div class="controls">
                        <input type="text" name="date_of_birth" class="span11" value="<?php echo htmlentities($current_student_admin["dob"]); ?>" />
                      </div>
                  </div><!--control-group-->

                   <!--dob-->
                  <div class="control-group">
                      <label class="control-label">PLACE OF BIRTH :</label>
                    <div class="controls">
                        <input type="text" name="place_of_birth" class="span11" value="<?php echo htmlentities($current_student_admin["pob"]); ?>" />
                      </div>
                  </div><!--control-group-->

            			<!--class-->
            			<div class="control-group">
              				<label class="control-label">CLASS :</label>
             				<div class="controls">
                				<input type="text" name="class" class="span11"  value="<?php echo htmlentities($current_student_admin["class"]); ?>"  />
              				</div>
            			</div><!--control-group-->

            			<!--category-->
            			<div class="control-group">
              				<label class="control-label">SCHOOL :</label>
             				<div class="controls">
                				<select name="school">
					                  <option <?php if($current_student_admin["school"] == 'pre school'){ echo "selected"; } ?>>
                            pre school
                            </option>

					                  <option <?php if($current_student_admin["school"] == 'lower'){ echo "selected"; } ?>>
                            lower
                            </option>

					                  <option <?php if($current_student_admin["school"] == 'upper'){ echo "selected"; } ?>>
                            upper
                            </option>
				                </select>
              				</div>
            			</div><!--control-group-->

            			<!--skills-->
            			<div class="control-group">
              				<label class="control-label">SKILLS :</label>
             				<div class="controls">
                				<input type="text" name="skills" class="span11" value="<?php echo htmlentities($current_student_admin["Skills"]); ?>" />
              				</div>
            			</div><!--control-group-->

                  <!--skills-->
                  <div class="control-group">
                      <label class="control-label">STATUS :</label>
                    <div class="controls">
                        <select name="status">
                            <option <?php if($current_student_admin["status"] == 'New'){ echo "selected"; } ?>>
                            New
                            </option>

                            <option <?php if($current_student_admin["status"] == 'Existing'){ echo "selected"; } ?>>
                            Existing
                            </option>

                            <option <?php if($current_student_admin["status"] == 'Allumni'){ echo "selected"; } ?>>
                            Allumni
                            </option>

                             <option <?php if($current_student_admin["status"] == 'Transfered'){ echo "selected"; } ?>>
                            Transfered
                            </option>
                        </select>
                      </div>
                  </div><!--control-group-->


            			<!--Nationality-->
            			<div class="control-group">
              				<label class="control-label">NATIONALITY :</label>
             				<div class="controls">
                				<input type="text" name="nationality" class="span11" value="<?php echo htmlentities($current_student_admin["nationality"]); ?>" />
              				</div>
            			</div><!--control-group-->

            			<!--Residential area-->
            			<div class="control-group">
              				<label class="control-label">AREA OF RESIDENCE :</label>
             				<div class="controls">
                				<input type="text" name="residence" class="span11" value="<?php echo htmlentities($current_student_admin["residence"]); ?>" />
              				</div>
            			</div><!--control-group-->



            			<!--background-->
            			<div class="control-group">
              				<label class="control-label">BACKGROUND:</label>
              				<div class="controls">
                				<textarea name="background_info" class="span11" >
                        <?php echo htmlentities($current_student_admin["background"]); ?> 
                        </textarea>
              				</div>
            			</div><!--control-group-->

            			<div class="form-actions">
              				<button name="submit" type="submit" class="btn btn-info">
              				Save
              				</button>

              				<a href="../profile.php?student=<?php echo urlencode($current_student_admin["admin"]); ?>" type="submit" class="btn btn-danger">
              				Cancel
              				</a>
            			</div>
        			 </form>
        		</div><!--widget-content nopadding-->
  	 		</div><!--widget-box-->
  	 	</div><!--span12-->
  	 </div><!--row-fluid-->
  </div><!--container-fluid-->
</div><!--content-->
<?php include'../../../../includes/system/footer.php'; ?>
