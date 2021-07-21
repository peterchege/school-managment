<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php 
   find_selected_fields();
   if(!$current_student_admin){
    redirect_to("../students.php");
   }
?>
<?php $upload_dir = "img/profile/"; ?>
<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
  $required_fields = array("registration", "full_names", "gender", "class");
  validate_presences($required_fields);

  //check whether there was any errors
  if(empty($errors)){
    //get objects from the form 
     //this is the path to store the uploaded image 
    
    //3. get objects info from the form 
    $admin= $current_student_admin["admin"];    
    $status = mysqli_sec($_POST["status"]);
    $registration= mysqli_sec($_POST["registration"]);
    $surname= mysqli_sec($_POST["surname"]);
    $full_names= mysqli_sec($_POST["full_names"]);
    $date_of_birth= mysqli_sec($_POST["date_of_birth"]);
    $gender= mysqli_sec($_POST["gender"]);
    $admin_date= mysqli_sec($_POST["admin_date"]);
    $student_class= mysqli_sec($_POST["class"]);
    $student_stream = mysqli_sec($_POST["stream"]);
    $school= mysqli_sec($_POST["school"]);
    $skills= mysqli_sec($_POST["skills"]);
    $nationality= mysqli_sec($_POST["nationality"]);
    $county= mysqli_sec($_POST["county"]);
    $residence= mysqli_sec($_POST["residence"]);
    $background= mysqli_sec($_POST["background"]);
    $photoName = $_FILES['myfile']['name'];
    $photoTmpName = $_FILES['myfile']['tmp_name'];
    $photoSize = $_FILES['myfile']['size'];
    $photoError = $_FILES['myfile']['error'];
    $photoType = $_FILES['myfile']['type'];

  if($photoName){

    //get image extention
    $photoExt = explode('.', $photoName);
    $photoActualExt = strtolower(end($photoExt));

    //allowed extensions
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    $photoNameNew = time().'_'.rand(1000,9999).'.'.$photoActualExt;

    //check valid image
      if(in_array($photoActualExt, $allowed)){
        //check whether there is errors in the image
        if ($photoError === 0) {
          //check size of the image 5MB
           if ($photoSize < 5000000) {
            //give the photo a new name
            $photoDestination = "img/profile/".$photoNameNew;
            //delete the old image
            unlink($upload_dir.$current_student_admin["pic"]);
            move_uploaded_file($photoTmpName, $photoDestination);

            }
          }
      }
    }else{
      //if no selected new image use the old image
      $photoNameNew = $current_student_admin["pic"];
    }


    //perform the update query 
    $query = "UPDATE students SET ";
    $query .= "registration= '{$registration}', sirname= '{$surname}', ";
    $query .= "full_names= '{$full_names}', pic= '{$photoNameNew}', ";
    $query .= "dob= '{$date_of_birth}', ";
    $query .= "Gender= '{$gender}', date_of_adm= '{$admin_date}', ";
    $query .= "class= '{$student_class}', stream= '{$student_stream}', school= '{$school}', Skills= '{$skills}', ";
    $query .= "status= '{$status}', nationality= '{$nationality}', "; 
    $query .= "residence= '{$residence}', county= '{$county}', ";
    $query .= "background= '{$background}' ";
    $query .= "WHERE admin= {$admin} ";
    $query .= "LIMIT 1";
    $results = mysqli_query($connection, $query);

    //check whether the query took place
    if($results && mysqli_affected_rows($connection)==1){
      //it was successfull 
      $_SESSION["message"]="Student update was successfull";
      redirect_to("../profile.php?student=". urlencode($current_student_admin["admin"]));

    }else{
      //update has failed
      $_SESSION["error_message"]= "There was an error in updating the student";

    }

  }
}else{
  //form has not been submitted
  //probably a get request 
}


?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="intakes.php" class="current">students</a> </div>
    <h1><span><a href="../students.php" class="btn btn-default"><i class="icon-arrow-left"></i></a></span> Students.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
  <hr>
  	 <div class="row-fluid">
  	 	<div class="span12">
      <?php echo message(); ?>
      <?php echo form_errors($errors); ?>
  	 		<div class="widget-box">
  	 			<div class="widget-title"> 
        			<span class="icon"><i class="icon-align-justify"></i> 
       				</span>
          			<h5>Update Student-info</h5>
        		</div><!--widget-title-->
        		<div class="widget-content nopadding">
              <form action="edit.php?student=<?php echo urlencode($current_student_admin["admin"]);?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <!--status-->
                  <div class="control-group">
                      <label class="control-label">STATUS :</label>
                    <div class="controls">
                        <select name="status">
                            <option
                              <?php 
                                if ($current_student_admin["status"] == "New") {
                                  echo "selected";
                                }

                              ?>
                            >New
                            </option>

                            <option
                            <?php 
                                if ($current_student_admin["status"] == "Existing") {
                                  echo "selected";
                                }

                            ?>

                            >Existing
                            </option>

                        </select>
                      </div>
                  </div><!--control-group-->

                    <!--registration number-->
                <div class="control-group">
                      <label class="control-label">REGISTRATION NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="registration" class="span11" placeholder="Enter student registration number..." value="<?php echo htmlentities($current_student_admin["registration"]); ?>">
                      </div>
                  </div><!--control-group-->

                    <!--First name-->
                <div class="control-group">
                      <label class="control-label">SURNAME :</label>
                    <div class="controls">
                        <input type="text" name="surname" class="span11" placeholder="Enter surname"  value="<?php echo htmlentities($current_student_admin["sirname"]); ?>">
                      </div>
                  </div><!--control-group-->
                 


                  <!--Last name-->
                  <div class="control-group">
                      <label class="control-label">FULL NAMES :</label>
                    <div class="controls">
                        <input type="text" name="full_names" class="span11" placeholder="students full names.."  value="<?php echo htmlentities($current_student_admin["full_names"]); ?>">
                      </div>
                  </div><!--control-group-->

                  <!--photo-->
                <div class="control-group">
                  <label class="control-label">PASSPORT PHOTO :</label>
                  <div class="controls">
                    <img src="<?php echo $upload_dir.$current_student_admin["pic"]; ?>" width="100">
                     <input type="file" name="myfile" />
                  </div>

                </div><!--control-group-->


                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">DATE OF BIRTH :</label>
                    <div class="controls">
                        <input name="date_of_birth" type="text" data-date="04-14-2017" data-date-format="mm-dd-yyyy" value="<?php echo htmlentities($current_student_admin['dob']); ?>" class="datepicker span11">
                        <span class="help-block">Date with Formate of  (mm-dd-yy)</span>
                      </div>
                  </div><!--control-group-->

                  <!--gender-->
                  <div class="control-group">
                      <label class="control-label">GENDER :</label>
                      <div class="controls">
                        <select name="gender">
                            <option <?php if ($current_student_admin["gender"] == 'MALE') {echo "selected"; } ?> >MALE</option>
                            <option <?php if ($current_student_admin["gender"] == 'FEMALE') { echo "selected";} ?>>FEMALE</option>
                        </select>
                      </div>
                  </div><!--control-group-->

                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">DATE OF REGISTRATION :</label>
                    <div class="controls">
                        <input name="admin_date" type="text" data-date="2017-04-14" data-date-format="yyyy-mm-dd" value="2017-04-14" class="datepicker span11">
                        <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                      </div>
                  </div><!--control-group-->

                  <!--class-->
                  <div class="control-group">
                      <label class="control-label">CLASS :</label>
                    <div class="controls">
                       <select name="class" class="span11">
                           <option><?php echo htmlentities($current_student_admin['class']); ?></option>
                           <?php
                           $class_set = find_all_classes();
                           if(mysqli_num_rows($class_set)>0){
                               while($class = mysqli_fetch_assoc($class_set)){?>
                                   <option><?php echo htmlentities($class["class"]); ?></option>
                                   <?php } ?>
                            <?php } ?>
                            <?php mysqli_free_result($class_set); ?>
                        </select>
                        
                      </div>
                  </div><!--control-group-->

                  <!--class-->
                  <div class="control-group">
                      <label class="control-label">STREAM :</label>
                      <div class="controls">
                          <select name="stream" class="span11">
                              <option><?php echo htmlentities($current_student_admin['stream']); ?></option>
                              <?php
                              $stream_set = find_all_classes();
                              if(mysqli_num_rows($stream_set)>0){
                                  while($stream = mysqli_fetch_assoc($stream_set)){
                                      ?>
                                      <option><?php echo htmlentities($stream["stream"]); ?></option>

                              <?php
                                  }
                              }
                              mysqli_free_result($stream_set);
                              ?>
                          </select>

                      </div>
                  </div><!--control-group-->


                  <!--age-->
                  <div class="control-group">
                    <label class="control-label">SCHOOL :</label>
                    <div class="controls">
                      <select name="school" class="span11">
                        <option
                        <?php 
                          if ($current_student_admin["school"] == 'PRE SCHOOL') {
                                   echo "selected";
                                }

                       ?>>PRE SCHOOL</option>
                        <option
                        <?php 
                          if ($current_student_admin["school"] == 'LOWER') {
                                   echo "selected";
                                }

                       ?>>LOWER</option>
                        <option
                        <?php 
                          if ($current_student_admin["school"] == 'UPPER') {
                                   echo "selected";
                                }

                       ?>>UPPER</option>

                          <option
                              <?php
                              if ($current_student_admin["school"] == 'CLASS 8') {
                                  echo "selected";
                              }

                              ?>>CLASS 8</option>
                      </select>
      
                    </div>
                  </div><!--control-group-->

                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">SKILLS/TALENTS :</label>
                    <div class="controls">
                        <input type="text" name="skills" class="span11" placeholder="Enter the students skills and talents.." value="<?php echo htmlentities($current_student_admin["Skills"]); ?>">
                      </div>
                  </div><!--control-group-->

          

                  <!--Nationality-->
                  <div class="control-group">
                      <label class="control-label">NATIONALITY :</label>
                    <div class="controls">
                        <input type="text" name="nationality" class="span11" placeholder="Enter students nationality.." value="<?php echo htmlentities($current_student_admin["nationality"]); ?>">
                      </div>
                  </div><!--control-group-->

                  <!--Nationality-->
                  <div class="control-group">
                      <label class="control-label">COUNTY :</label>
                    <div class="controls">
                        <input type="text" name="county" class="span11" placeholder="Enter the county the student comes from.." value="<?php echo htmlentities($current_student_admin["county"]); ?>">
                      </div>
                  </div><!--control-group-->

                  <!--Residential area-->
                  <div class="control-group">
                      <label class="control-label">AREA OF RESIDENCE :</label>
                    <div class="controls">
                        <input type="text" name="residence" class="span11" placeholder="Enter the area where the student lives.." value="<?php echo htmlentities($current_student_admin["residence"]); ?>">
                      </div>
                  </div><!--control-group-->



                  <!--background-->
                  <div class="control-group">
                      <label class="control-label">BACKGROUND :</label>
                      <div class="controls">
                        <textarea name="background" placeholder="Enter a little bit about the sstudents information.." class="span11"><?php echo htmlentities($current_student_admin["background"]); ?></textarea>
                      </div>
                  </div><!--control-group-->

                  <div class="form-actions">
                      <button name="submit" type="submit" class="btn btn-success">
                      <i class="icon-download-alt"></i> Update
                      </button>

                      <a href="../students.php" type="submit" class="btn btn-danger">
                      <i class="icon-exclamation-sign"></i> Cancel
                      </a>
                  </div>
               </form>
        		</div><!--widget-content nopadding-->
  	 		</div><!--widget-box-->
  	 	</div><!--span12-->
  	 </div><!--row-fluid-->
  </div><!--container-fluid-->
</div><!--content-->
<?php include '../../../../includes/system/table_footer.php'; ?>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.toggle.buttons.js"></script>
<script src="js/masked.js"></script>
<script src="js/jquery.uniform.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.form_common.js"></script>
<script src="js/wysihtml5-0.3.0.js"></script>
<script src="js/jquery.peity.min.js"></script>
<script src="js/bootstrap-wysihtml5.js"></script>
<script>
    $('.textarea_editor').wysihtml5();
</script>
</body>
</html>
