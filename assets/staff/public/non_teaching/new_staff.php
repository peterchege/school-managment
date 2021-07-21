<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/staff_function.php'; ?>

<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
 
  
    //get objects from the form 
    //this is the path to store the uploaded image 
    
    //3. get objects info from the form   
    $surname= mysqli_sec($_POST["surname"]);
    $fullnames= mysqli_sec($_POST["full_names"]);
    $id_number= mysqli_sec($_POST["id_number"]);
    $gender= mysqli_sec($_POST["gender"]);
    $joined= mysqli_sec($_POST["joined"]);
    $status= mysqli_sec($_POST["status"]);
    $age= mysqli_sec($_POST["age"]);
    $marital= mysqli_sec($_POST["marital"]);
    $position= mysqli_sec($_POST["position"]);
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

    $required_fields= array("surname", "full_names", "id_number");
    validate_presences($required_fields);

  //check whether there was any errors
  if(empty($errors)){

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


    //perform the update query 
    $query = "INSERT INTO non_teaching(";
    $query .= "Idnumber, sirname, ";
    $query .= "fullnames, pic, ";
    $query .= "gender, age, ";
    $query .= "marital, joined, ";
    $query .= "phone, altphone, ";
    $query .= "email, address, ";
    $query .= "position,  hobies, ";
    $query .= "education, nationality, ";
    $query .= "county, residence, ";
    $query .= "status, next_kin, background ";
    $query .= ")VALUES(";
    $query .= "'{$id_number}', '{$surname}', ";
    $query .= "'{$fullnames}', '{$photoNameNew}', ";
    $query .= "'{$gender}', '{$age}', ";
    $query .= "'{$marital}', '{$joined}', ";
    $query .= "'{$mobile}', '{$phone}', ";
    $query .= "'{$email}', '{$address}', ";
    $query .= "'{$position}', '{$hobies}', ";
    $query .= "'{$college}', '{$nationality}', ";
    $query .= "'{$county}', '{$residence}', ";
    $query .= "'{$status}', '{$next_of_kin}', '{$background}' ";
    $query .= ")";
    $results = mysqli_query($connection, $query);

    //check whether the query took place
    if($results){
      //it was successfull 
      $_SESSION["message"]= "you have successfully entered a new staff";
      redirect_to("../non_teaching.php");

    }else{
      //update has failed
      $_SESSION["error_message"]= "There was an error in entering a new staff";

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
        <a href="intakes.php" class="current">
            students
        </a>
    </div>
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
        			 <form action="new_staff.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <!--photo-->
        			 	<!--First name-->
        			 	<div class="control-group">
              				<label class="control-label">SURNAME :</label>
             				<div class="controls">
                				<input type="text" name="surname" class="span11" placeholder="Enter the staff sirname..">
              				</div>
            			</div><!--control-group-->


            			<!--Last name-->
            			<div class="control-group">
              				<label class="control-label">FULL NAMES :</label>
             				<div class="controls">
                				<input type="text" name="full_names" class="span11" placeholder="Enter the staff fullnames..">
              				</div>
            			</div><!--control-group-->

                   <!--pic-->
                  <div class="control-group">
                    <label class="control-label">PASSPORT PHOTO :</label>
                    <div class="controls">
                      <input type="file" name="myfile" />
                    </div>

                  </div><!--control-group-->

                  <!--Last name-->
                  <div class="control-group">
                      <label class="control-label">ID NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="id_number" class="span11" placeholder="Enter the staff idnumber..">
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

                  <!--joined-->
                  <div class="control-group">
                      <label class="control-label">JOINED :</label>
                    <div class="controls">
                        <input type="text" name="joined" class="span11" placeholder="Enter the date which the teacher joined the school..">
                      </div>
                  </div><!--control-group-->

                  <!--status-->
                  <div class="control-group">
                      <label class="control-label">EMPLOYEE STATUS :</label>
                    <div class="controls">
                        <select name="status">
                            <option>working</option>
                            <option>left</option>
                        </select> 
                    </div>
                  </div><!--control-group-->

            			<!--age-->
            			<div class="control-group">
              				<label class="control-label">AGE :</label>
             				<div class="controls">
                				<input type="text" name="age" class="span11" placeholder="Enter the staff age..">
              				</div>
            			</div><!--control-group-->

                  <!--marital-->
                  <div class="control-group">
                      <label class="control-label">MARITAL STATUS :</label>
                    <div class="controls">
                        
                         <select name="marital">
                            <option>Married</option>
                            <option>Single</option>
                        </select>

                    </div>
                  </div><!--control-group-->

                   <!--dob-->
                  <div class="control-group">
                      <label class="control-label">WORKING POSITION :</label>
                    <div class="controls">
                        <input type="text" name="position" class="span11" placeholder="Enter the staff position in the school..">
                      </div>
                  </div><!--control-group-->

            	
            			<!--category-->

            			<!--skills-->
            			<div class="control-group">
              				<label class="control-label">UNIVERSITY/COLLEGE :</label>
             				<div class="controls">
                				<input type="text" name="college" class="span11" placeholder="Enter the university/college the staff went to..">
              				</div>
            			</div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">HOBIES/TALENTS :</label>
                    <div class="controls">
                        <input type="text" name="hobies" class="span11" placeholder="Enter the staff hobies..">
                      </div>
                  </div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">MOBILE NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="mobile" class="span11" placeholder="Enter the staff mobile number..">
                      </div>
                  </div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">PHONE NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="phone" class="span11" placeholder="Enter the staff alternative phone number..">
                      </div>
                  </div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">EMAIL ADDRESS :</label>
                    <div class="controls">
                        <input type="text" name="email" class="span11" placeholder="Enter the staff email address..">
                      </div>
                  </div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">LOCAL ADDRESS :</label>
                    <div class="controls">
                        <input type="text" name="address" class="span11" placeholder="Enter the staff local address..">
                      </div>
                  </div><!--control-group-->


            			<!--Nationality-->
            			<div class="control-group">
              				<label class="control-label">NATIONALITY :</label>
             				<div class="controls">
                				<input type="text" name="nationality" class="span11" placeholder="Enter the staff nationality..">
              				</div>
            			</div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">COUNTY :</label>
                    <div class="controls">
                        <input type="text" name="county" class="span11" placeholder="Enter the staff county..">
                      </div>
                  </div><!--control-group-->


            			<!--Residential area-->
            			<div class="control-group">
              				<label class="control-label">AREA OF RESIDENCE :</label>
             				<div class="controls">
                				<input type="text" name="residence" class="span11" placeholder="Enter the staff residential area..">
              				</div>
            			</div><!--control-group-->

                    <!--Residential area-->
                  <div class="control-group">
                    <label class="control-label">NEXT OF KIN :</label>
                    <div class="controls">
                      <input type="text" name="next_of_kin" class="span11" placeholder="Enter the staff next of kin..">
                    </div>
                  </div><!--control-group-->

                    <!--background-->
                  <div class="control-group">
                      <label class="control-label">BACKGROUND :</label>
                      <div class="controls">
                        <textarea name="background" placeholder="Enter the staff working background.." class="span11"></textarea>
                      </div>
                  </div><!--control-group-->

            			<div class="form-actions">
              				<button name="submit" type="submit" class="btn btn-success">
              				<i class="icon-download-alt"></i> Save
              				</button>

              				<a href="../non_teaching.php" type="submit" class="btn btn-danger">
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
