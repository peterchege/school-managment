<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/alumni_function.php'; ?>
<?php 
   find_selected_fields();
   if(!$current_alumni_id){
    redirect_to("../alumni.php");
   }
?>
<?php $upload_dir = "img/profile/"; ?>
<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
  $required_fields = array("registration", "surname", "fullnames");
  validate_presences($required_fields);

  //check whether there was any errors
  if(empty($errors)){
    //get objects from the form 
     //this is the path to store the uploaded image 
    
    //3. get objects info from the form 
    $id= $current_alumni_id["id"];    
    $registration= mysqli_sec($_POST["registration"]);
    $surname= mysqli_sec($_POST["surname"]);
    $fullnames= mysqli_sec($_POST["fullnames"]);
    $date_of_birth= mysqli_sec($_POST["date_of_birth"]);
    $gender= mysqli_sec($_POST["gender"]);
    $admin_date= mysqli_sec($_POST["admin_date"]);
    $skills= mysqli_sec($_POST["skills"]);
    $nationality= mysqli_sec($_POST["nationality"]);
    $county= mysqli_sec($_POST["county"]);
    $residence= mysqli_sec($_POST["residence"]);
    $year = mysqli_sec($_POST["year"]);
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
            unlink($upload_dir.$current_alumni_id["pic"]);
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
      $photoNameNew = $current_alumni_id["pic"];
    }


    //perform the update query 
    $query = "UPDATE alumni SET ";
    $query .= "registration= '{$registration}', surname= '{$surname}', ";
    $query .= "fullnames= '{$fullnames}', pic= '{$photoNameNew}', ";
    $query .= "dob= '{$date_of_birth}', gender= '{$gender}', ";
    $query .= "date_of_adm= '{$admin_date}', skills= '{$skills}', ";
    $query .= "nationality= '{$nationality}', county= '{$county}',  "; 
    $query .= "residence= '{$residence}', year= '{$year}', ";
    $query .= "background= '{$background}' ";
    $query .= "WHERE id= {$id} ";
    $query .= "LIMIT 1";
    $results = mysqli_query($connection, $query);

    //check whether the query took place
    if($results && mysqli_affected_rows($connection)==1){
      //it was successfull 
      $_SESSION["message"]= "Student update was successfull";
      redirect_to("profile.php?alumni=". urlencode($current_alumni_id["id"]));

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
<?php confirm_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="../alumni.php" class="current">Alumni </a> 
    </div>
    <h1>Students.</h1>
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
              <form action="edit.php?alumni=<?php echo urlencode($current_alumni_id["id"]);?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                
                    <!--registration number-->
                <div class="control-group">
                      <label class="control-label">REGISTRATION NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="registration" class="span11" placeholder="Enter student registration number..." value="<?php echo htmlentities($current_alumni_id["registration"]); ?>">
                      </div>
                  </div><!--control-group-->

                    <!--First name-->
                <div class="control-group">
                      <label class="control-label">SURNAME :</label>
                    <div class="controls">
                        <input type="text" name="surname" class="span11" placeholder="Enter students surname"  value="<?php echo htmlentities($current_alumni_id["surname"]); ?>">
                      </div>
                  </div><!--control-group-->
                 


                  <!--Last name-->
                  <div class="control-group">
                      <label class="control-label">FULL NAMES :</label>
                    <div class="controls">
                        <input type="text" name="fullnames" class="span11" placeholder="students full names.."  value="<?php echo htmlentities($current_alumni_id["fullnames"]); ?>">
                      </div>
                  </div><!--control-group-->

                  <!--photo-->
                <div class="control-group">
                  <label class="control-label">PASSPORT PHOTO :</label>
                  <div class="controls">
                    <img src="<?php echo $upload_dir.$current_alumni_id["pic"]; ?>" width="100">
                     <input type="file" name="myfile" />
                  </div>

                </div><!--control-group-->


                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">DATE OF BIRTH :</label>
                    <div class="controls">
                        <input type="text" name="date_of_birth" class="span11" placeholder="Enter students date of birth!.." value="<?php echo htmlentities($current_alumni_id["dob"]); ?>">
                      </div>
                  </div><!--control-group-->

                  <!--gender-->
                  <div class="control-group">
                      <label class="control-label">GENDER :</label>
                      <div class="controls">
                        <select name="gender">
                            <option

                              <?php 

                                if ($current_alumni_id["gender"] == 'Male') {
                                  
                                  echo "selected";
                                }

                              ?>

                            >Male</option>

                            <option

                               <?php 

                                if ($current_alumni_id["gender"] == 'Female') {
                                  
                                  echo "selected";
                                }

                              ?>

                            >Female</option>
                        </select>
                      </div>
                  </div><!--control-group-->

                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">DATE OF REGISTRATION :</label>
                    <div class="controls">
                        <input type="text" name="admin_date" class="span11" placeholder="Enter the date at which the student is being registered to the school.." value="<?php echo htmlentities($current_alumni_id["date_of_adm"]); ?>">
                      </div>
                  </div><!--control-group-->

                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">SKILLS/TALENTS :</label>
                    <div class="controls">
                        <input type="text" name="skills" class="span11" placeholder="Enter the students skills and talents.." value="<?php echo htmlentities($current_alumni_id["skills"]); ?>">
                      </div>
                  </div><!--control-group-->

      
  
                  <!--Nationality-->
                  <div class="control-group">
                      <label class="control-label">NATIONALITY :</label>
                    <div class="controls">
                        <input type="text" name="nationality" class="span11" placeholder="Enter students nationality.." value="<?php echo htmlentities($current_alumni_id["nationality"]); ?>">
                      </div>
                  </div><!--control-group-->

                  <!--Nationality-->
                  <div class="control-group">
                      <label class="control-label">COUNTY :</label>
                    <div class="controls">
                        <input type="text" name="county" class="span11" placeholder="Enter the county the student comes from.." value="<?php echo htmlentities($current_alumni_id["county"]); ?>">
                      </div>
                  </div><!--control-group-->

                  <!--Residential area-->
                  <div class="control-group">
                      <label class="control-label">AREA OF RESIDENCE :</label>
                    <div class="controls">
                        <input type="text" name="residence" class="span11" placeholder="Enter the area where the student lives.." value="<?php echo htmlentities($current_alumni_id["residence"]); ?>">
                      </div>
                  </div><!--control-group-->

                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">ACADEMIC YEAR :</label>
                    <div class="controls">
                        <input type="text" name="year" class="span11" placeholder="Enter the academic year for the student alumni.." value="<?php echo htmlentities($current_alumni_id["year"]); ?>">
                      </div>
                  </div><!--control-group-->



                  <!--background-->
                  <div class="control-group">
                      <label class="control-label">BACKGROUND :</label>
                      <div class="controls">
                        <textarea name="background" placeholder="Enter a little bit about the sstudents information.." class="span11"><?php echo htmlentities($current_alumni_id["background"]); ?></textarea>
                      </div>
                  </div><!--control-group-->

                  <div class="form-actions">
                      <button name="submit" type="submit" class="btn btn-success">
                      <i class="icon-download-alt"></i> Update
                      </button>

                      <a href="profile.php?alumni=<?php echo urlencode($current_alumni_id["id"]); ?>" type="submit" class="btn btn-danger">
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
