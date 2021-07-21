<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php //perform insert
//1.check whether the form is submited 
if(isset($_POST["submit"])){
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

    //2.validate the form
    $required_fields = array("status", "registration", "surname", "full_names", "gender", "class");
    validate_presences($required_fields);
    if(empty($errors)){
        $photoExt = explode('.', $photoName);
        $photoActualExt = strtolower(end($photoExt));
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        $photoNameNew = time().'_'.rand(1000,9999).'.'.$photoActualExt;

        if(in_array($photoActualExt, $allowed)){
            if ($photoError === 0) {
                if ($photoSize < 5000000) {
                    $photoDestination = "img/profile/".$photoNameNew;
                    move_uploaded_file($photoTmpName, $photoDestination);
                }
            }
        }

        $check_registration_number =  find_student_by_registration($registration);
        if(mysqli_num_rows($check_registration_number) > 0){
            $_SESSION["error_message"] = "The registration number youve enterer exists. Please correct it and try again..";
        }else{
            $query = "INSERT INTO students(";
            $query .= "registration, sirname, ";
            $query .= "full_names, pic, ";
            $query .= "dob, ";
            $query .= "gender, date_of_adm, ";
            $query .= "class, stream, school, Skills, ";
            $query .= "status, nationality, ";
            $query .= "county, residence, ";
            $query .= "background";
            $query .= ")VALUES(";
            $query .= "'{$registration}', '{$surname}', ";
            $query .= "'{$full_names}', '{$photoNameNew}', ";
            $query .= "'{$date_of_birth}', ";
            $query .= "'{$gender}', '{$admin_date}', ";
            $query .= "'{$student_class}', '{$student_stream}', '{$school}', '{$skills}', ";
            $query .= "'{$status}', '{$nationality}', ";
            $query .= "'{$county}', '{$residence}', ";
            $query .= "'{$background}'";
            $query .= ")";
            $results = mysqli_query($connection, $query);
            if($results){
                $_SESSION["message"] = "New student has been successfully added.";
                redirect_to('../students.php');
            }else{
                $_SESSION["error_message"] = "There was a problem in adding the new student..";
            }
        }
    }
}else{
  //this is probably a get request 
  //submit not submitted.
}
?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo  navigation_nav(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home</a> Admission
        </div>
        <h1>Admit Students.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="widget-box">
                <?php echo message(); ?>
                <?php echo form_errors($errors); ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-align-justify"></i>
       				</span>
          			<h5>Admit new student</h5>
        		</div><!--widget-title-->
        		<div class="widget-content nopadding">
        			 <form action="new_student.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <!--status-->
                  <div class="control-group">
                      <label class="control-label">STATUS :</label>
                    <div class="controls">
                        <select name="status">
                            <option>New</option>
                            <option>Existing</option>

                        </select>
                      </div>
                  </div><!--control-group-->

                    <!--registration number-->
                <div class="control-group">
                      <label class="control-label">REGISTRATION NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="registration" class="span11" placeholder="Enter student registration number..." />
                      </div>
                  </div><!--control-group-->

                    <!--First name-->
                <div class="control-group">
                      <label class="control-label">SURNAME :</label>
                    <div class="controls">
                        <input type="text" name="surname" class="span11" placeholder="Enter surname" />
                      </div>
                  </div><!--control-group-->
                         <!--Last name-->
            			<div class="control-group">
              				<label class="control-label">FULL NAMES :</label>
             				<div class="controls">
                				<input type="text" name="full_names" class="span11" placeholder="students full names.." />
              				</div>
            			</div><!--control-group-->

                  <!--photo-->
                <div class="control-group">
                  <label class="control-label">PASSPORT PHOTO :</label>
                  <div class="controls">
                     <input type="file" name="myfile" />
                  </div>

                </div><!--control-group-->

                <!--age-->
                 

                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">DATE OF BIRTH :</label>
                    <div class="controls">
                        <input name="date_of_birth" type="text" data-date="2017-04-14" data-date-format="yyyy-mm-dd" value="Select" class="datepicker span11">
                        <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                    </div>
                  </div><!--control-group-->

            			<!--gender-->
            			<div class="control-group">
              				<label class="control-label">GENDER :</label>
              				<div class="controls">
				                <select name="gender">
					                  <option>MALE</option>
					                  <option>FEMALE</option>
				                </select>
              				</div>
            			</div><!--control-group-->

                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">DATE OF REGISTRATION :</label>
                    <div class="controls">
                        <input name="admin_date" type="text" data-date="2017-04-14" data-date-format="yyyy-mm-dd" value="<?php echo htmlentities(date('Y-m-d')); ?>" class="datepicker span11">
                        <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                      </div>
                  </div><!--control-group-->

            			
            			 <!--class-->
                  <div class="control-group">
                      <label class="control-label">CLASS :</label>
                    <div class="controls">
                       <select name="class" class="span11">
                          <?php 
                            $class_set = find_all_classes();
                            if(mysqli_num_rows($class_set)>0){
                              while($class = mysqli_fetch_assoc($class_set)){
                            ?>
                            <option><?php echo htmlentities($class["class"]); ?></option>

                            <?php 
                              }
                            }
                            mysqli_free_result($class_set);
                          ?>
                        </select>
                        
                      </div>
                  </div><!--control-group-->

                         <div class="control-group">
                             <label class="control-label">STREAM :</label>
                             <div class="controls">
                                 <select name="stream" class="span11">
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

                   <div class="control-group">
                    <label class="control-label">SCHOOL :</label>
                    <div class="controls">
                      <select name="school" class="span11">
                        <option>PRE SCHOOL</option>
                        <option>LOWER</option>
                        <option>UPPER</option>
                          <option>CLASS 8</option>
                      </select>
      
                    </div>
                  </div><!--control-group-->

                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">SKILLS/TALENTS :</label>
                    <div class="controls">
                        <input type="text" name="skills" class="span11" placeholder="Enter the students skills and talents.." />
                      </div>
                  </div><!--control-group-->

          

            			<!--Nationality-->
            			<div class="control-group">
              				<label class="control-label">NATIONALITY :</label>
             				<div class="controls">
                				<input type="text" name="nationality" class="span11" placeholder="Enter students nationality.." />
              				</div>
            			</div><!--control-group-->

                  <!--Nationality-->
                  <div class="control-group">
                      <label class="control-label">COUNTY :</label>
                    <div class="controls">
                        <input type="text" name="county" class="span11" placeholder="Enter the county the student comes from.." />
                      </div>
                  </div><!--control-group-->

            			<!--Residential area-->
            			<div class="control-group">
              				<label class="control-label">AREA OF RESIDENCE :</label>
             				<div class="controls">
                				<input type="text" name="residence" class="span11" placeholder="Enter the area where the student lives.." />
              				</div>
            			</div><!--control-group-->



            			<!--background-->
            			<div class="control-group">
              				<label class="control-label">BACKGROUND :</label>
              				<div class="controls">
                				<textarea name="background" placeholder="Enter a little bit about the sstudents information.." class="span11"></textarea>
              				</div>
            			</div><!--control-group-->

            			<div class="form-actions">
              				<button name="submit" type="submit" class="btn btn-success">
              				<i class="icon-download-alt"></i> Admit
              				</button>
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

