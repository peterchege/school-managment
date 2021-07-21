<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/staff_function.php'; ?>
<?php 
   find_selected_fields();
   if(!$current_teacher_id){
    redirect_to("../teachers.php");
   }
?>
<?php $upload_dir = "img/profile/"; ?>
<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
  $required_fields= array("surname", "full_names", "id_number");
  validate_presences($required_fields);

  //check whether there was any errors
  if(empty($errors)){
    //get objects from the form 
    //this is the path to store the uploaded image 
    
    //3. get objects info from the form 
    $id= $current_teacher_id["id"];    
    $surname= mysqli_sec($_POST["surname"]);
    $fullnames= mysqli_sec($_POST["full_names"]);
    $id_number= mysqli_sec($_POST["id_number"]);
    $gender= mysqli_sec($_POST["gender"]);
    $joined= mysqli_sec($_POST["joined"]);
    $status= mysqli_sec($_POST["status"]);
    $age= mysqli_sec($_POST["age"]);
    $marital= mysqli_sec($_POST["marital"]);
    $position= mysqli_sec($_POST["position"]);
    $subject= mysqli_sec($_POST["subject"]);
    $classes= mysqli_sec($_POST["classes"]);
    $college= mysqli_sec($_POST["college"]);
    $hobies= mysqli_sec($_POST["hobies"]);
    $mobile= mysqli_sec($_POST["mobile"]);
    $phone= mysqli_sec($_POST["phone"]);
    $email= mysqli_sec($_POST["email"]);
    $address= mysqli_sec($_POST["address"]);
    $nationality= mysqli_sec($_POST["nationality"]);
    $county= mysqli_sec($_POST["county"]);
    $residence= mysqli_sec($_POST["residence"]);
    $next_of_kin= mysqli_sec($_POST["next_of_kin"]);
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

            }else{
            $_SESSION["error_message"] = "The image size is too big for upload";
          }
          }else{
          $_SESSION["error_message"] = "There was an error in trying to upload your file";
        }
      }else{
        $_SESSION["error_message"] = "The file you are trying to upload is not allowed";
      }

    }else{
      //if no selected new image use the old image
      $photoNameNew = $current_student_admin["pic"];
    }


    //perform the update query 
    $query = "UPDATE teaching_staff SET ";
    $query .= "Idnumber= '{$id_number}', sirname= '{$surname}', ";
    $query .= "full_names= '{$fullnames}', pic='{$photoNameNew}', gender= '{$gender}', ";
    $query .= "age= '{$age}', marital= '{$marital}', ";
    $query .= "joined= '{$joined}', phone= '{$mobile}', ";
    $query .= "altphone= '{$phone}', email= '{$email}', ";
    $query .= "address= '{$address}', position= '{$position}', "; 
    $query .= "subject= '{$subject}', classes= '{$classes}', hobies= '{$hobies}', ";
    $query .= "education= '{$college}', nationality= '{$nationality}', ";
    $query .= "county= '{$county}', residence= '{$residence}', ";
    $query .= "next_kin= '{$next_of_kin}', background= '{$background}' ";
    $query .= "WHERE id= {$id} ";
    $query .= "LIMIT 1";
    $results = mysqli_query($connection, $query);

    //check whether the query took place
    if($results && mysqli_affected_rows($connection)==1){
      //it was successfull 
      $_SESSION["message"]= "Teacher update was successfull";
      redirect_to("profile.php?teacher=". urlencode($current_teacher_id["id"]));

    }else{
      //update has failed
      $_SESSION["error_message"]= "There was an error in updating the teacher info";

    }

  }
}else{
  //form has not been submitted
  //probably a get request 
}


?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
        <a href="../../../home.php" title="Go to Home" class="tip-bottom">
            <i class="icon-home"></i> Home
        </a>
        <a href="../teachers.php" class="current">
            Teaching staff
        </a>
    </div>
    <h1>Teachers.</h1>
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
        			 <form action="edit.php?teacher=<?php echo urlencode($current_teacher_id["id"]); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <!--photo-->
        			 	<!--First name-->
        			 	<div class="control-group">
              				<label class="control-label">SURNAME :</label>
             				<div class="controls">
                				<input type="text" name="surname" class="span11" value="<?php echo htmlentities($current_teacher_id["sirname"]); ?>" />
              				</div>
            			</div><!--control-group-->


            			<!--Last name-->
            			<div class="control-group">
              				<label class="control-label">FULL NAMES :</label>
             				<div class="controls">
                				<input type="text" name="full_names" class="span11" value="<?php echo htmlentities($current_teacher_id["full_names"]); ?>"/>
              				</div>
            			</div><!--control-group-->

                   <!--pic-->
                  <div class="control-group">
                    <label class="control-label">PASSPORT PHOTO :</label>
                    <div class="controls">
                      <img src="<?php echo $upload_dir . $current_teacher_id["pic"]; ?>" width="100">
                      <input type="file" name="myfile" />
                    </div>

                  </div><!--control-group-->


                  <!--Last name-->
                  <div class="control-group">
                      <label class="control-label">ID NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="id_number" class="span11" value="<?php echo htmlentities($current_teacher_id["Idnumber"]); ?>"/>
                      </div>
                  </div><!--control-group-->
                  
                  
            			<!--gender-->
            			<div class="control-group">
              				<label class="control-label">GENDER :</label>
              				<div class="controls">
				                <select name="gender">
					                  <option <?php 

                                if($current_teacher_id["gender"] == 'Male'){
                                  echo "selected";
                                }

                            ?>>Male</option>

					                  <option<?php 

                                 if($current_teacher_id["gender"] == 'Female'){
                                  echo "selected";
                                }


                            ?>>Female</option>
				                </select>
              				</div>
            			</div><!--control-group-->

                  <!--joined-->
                  <div class="control-group">
                      <label class="control-label">JOINED :</label>
                    <div class="controls">
                        <input type="text" name="joined" class="span11" value="<?php echo htmlentities($current_teacher_id["joined"]); ?>" />
                      </div>
                  </div><!--control-group-->

                  <!--status-->
                  <div class="control-group">
                      <label class="control-label">EMPLOYEE STATUS :</label>
                    <div class="controls">
                        <select name="status">
                            <option <?php 

                                if($current_teacher_id["status"] == 'working'){
                                  echo "selected";
                                }

                            ?>>working</option>

                            <option<?php 

                                 if($current_teacher_id["status"] == 'left'){
                                  echo "selected";
                                }


                            ?>>left</option>
                        </select> 
                    </div>
                  </div><!--control-group-->

            			<!--age-->
            			<div class="control-group">
              				<label class="control-label">AGE :</label>
             				<div class="controls">
                				<input type="text" name="age" class="span11" value="<?php echo htmlentities($current_teacher_id["age"]); ?>" />
              				</div>
            			</div><!--control-group-->

                  <!--marital-->
                  <div class="control-group">
                      <label class="control-label">MARITAL STATUS :</label>
                    <div class="controls">
                        
                         <select name="marital">
                            <option <?php 

                                if($current_teacher_id["marital"] == 'Married'){
                                  echo "selected";
                                }

                            ?>>Married</option>

                            <option<?php 

                                 if($current_teacher_id["marital"] == 'Single'){
                                  echo "selected";
                                }


                            ?>>Single</option>
                        </select>

                    </div>
                  </div><!--control-group-->

                   <!--dob-->
                  <div class="control-group">
                      <label class="control-label">WORKING POSITION :</label>
                    <div class="controls">
                        <input type="text" name="position" class="span11" value="<?php echo htmlentities($current_teacher_id["position"]); ?>" />
                      </div>
                  </div><!--control-group-->

            			<!--class-->
            			<div class="control-group">
              				<label class="control-label">TEACHING SUBJECTS :</label>
             				<div class="controls">
                				<input type="text" name="subject" class="span11"  value="<?php echo htmlentities($current_teacher_id["subject"]); ?>"  />
              				</div>
            			</div><!--control-group-->

                    <!--class-->
                  <div class="control-group">
                      <label class="control-label">TEACHING CLASSES :</label>
                    <div class="controls">
                        <input type="text" name="classes" class="span11" value="<?php echo htmlentities($current_teacher_id["classes"]); ?>" placeholder="Enter the classes the teachers teaches..">
                      </div>
                  </div><!--control-group-->

                  <!--category-->

            			<!--category-->

            			<!--skills-->
            			<div class="control-group">
              				<label class="control-label">UNIVERSITY/COLLEGE :</label>
             				<div class="controls">
                				<input type="text" name="college" class="span11" value="<?php echo htmlentities($current_teacher_id["education"]); ?>" />
              				</div>
            			</div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">HOBIES/TALENTS :</label>
                    <div class="controls">
                        <input type="text" name="hobies" class="span11" value="<?php echo htmlentities($current_teacher_id["hobies"]); ?>" />
                      </div>
                  </div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">MOBILE NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="mobile" class="span11" value="<?php echo htmlentities($current_teacher_id["phone"]); ?>" />
                      </div>
                  </div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">PHONE NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="phone" class="span11" value="<?php echo htmlentities($current_teacher_id["altphone"]); ?>" />
                      </div>
                  </div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">EMAIL ADDRESS :</label>
                    <div class="controls">
                        <input type="text" name="email" class="span11" value="<?php echo htmlentities($current_teacher_id["email"]); ?>" />
                      </div>
                  </div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">LOCAL ADDRESS :</label>
                    <div class="controls">
                        <input type="text" name="address" class="span11" value="<?php echo htmlentities($current_teacher_id["address"]); ?>" />
                      </div>
                  </div><!--control-group-->


            			<!--Nationality-->
            			<div class="control-group">
              				<label class="control-label">NATIONALITY :</label>
             				<div class="controls">
                				<input type="text" name="nationality" class="span11" value="<?php echo htmlentities($current_teacher_id["nationality"]); ?>" />
              				</div>
            			</div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">COUNTY :</label>
                    <div class="controls">
                        <input type="text" name="county" class="span11" value="<?php echo htmlentities($current_teacher_id["county"]); ?>" />
                      </div>
                  </div><!--control-group-->


            			<!--Residential area-->
            			<div class="control-group">
              				<label class="control-label">AREA OF RESIDENCE :</label>
             				<div class="controls">
                				<input type="text" name="residence" class="span11" value="<?php echo htmlentities($current_teacher_id["residence"]); ?>">
              				</div>
            			</div><!--control-group-->

                     <!--Residential area-->
                  <div class="control-group">
                    <label class="control-label">NEXT OF KIN :</label>
                    <div class="controls">
                      <input type="text" name="next_of_kin" class="span11" placeholder="Enter the teachers next of kin.." value="<?php echo htmlentities($current_teacher_id["next_kin"]); ?>">
                    </div>
                  </div><!--control-group-->

            			<!--background-->
            			<div class="control-group">
              				<label class="control-label">BACKGROUND:</label>
              				<div class="controls">
                				<textarea name="background" class="span11" >
                        <?php echo htmlentities($current_teacher_id["background"]); ?> 
                        </textarea>
              				</div>
            			</div><!--control-group-->

            			<div class="form-actions">
              				<button name="submit" type="submit" class="btn btn-success">
              				<i class="icon-download-alt"></i> Update
              				</button>

              				<a href="profile.php?teacher=<?php echo urlencode($current_teacher_id["id"]); ?>" type="submit" class="btn btn-danger">
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
<?php include'../../../../includes/system/footer.php'; ?>
