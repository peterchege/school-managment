<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/parent_function.php'; ?>
<?php 
   find_selected_fields();
   if(!$current_parent_id){
    redirect_to("../students.php");
   }
?>

<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
  $required_fields= array("full_names", "id_number", "relationship", "gender", "occupation", "phone_number", "office_phone", "email", "address", "marital_status", "nationality", "county", "residence");
  validate_presences($required_fields);

  //check whether there was any errors
  if(empty($errors)){
    //get objects from the form 
     //this is the path to store the uploaded image 
    
    //3. get objects info from the form 
    $id= $current_parent_id["id"];    
    $fullnames= mysqli_sec($_POST["full_names"]);
    $id_number= mysqli_sec($_POST["id_number"]);
    $relationship= mysqli_sec($_POST["relationship"]);
    $gender= mysqli_sec($_POST["gender"]);
    $occupation= mysqli_sec($_POST["occupation"]);
    $phone_number= mysqli_sec($_POST["phone_number"]);
    $office_phone= mysqli_sec($_POST["office_phone"]);
    $email= mysqli_sec($_POST["email"]);
    $address= mysqli_sec($_POST["address"]);
    $marital_status= mysqli_sec($_POST["marital_status"]);
    $nationality= mysqli_sec($_POST["nationality"]);
    $county= mysqli_sec($_POST["county"]);
    $residence= mysqli_sec($_POST["residence"]);
    

    //4. perform the update query 
    $query = "UPDATE all_parents SET ";
    $query .= "full_names= '{$fullnames}', id_number= '{$id_number}', ";
    $query .= "relationship= '{$relationship}', gender= '{$gender}', ";
    $query .= "occupation= '{$occupation}', phone= '{$phone_number}', ";
    $query .= "altphone= '{$office_phone}', email= '{$email}', ";
    $query .= "address= '{$address}', marital= '{$marital_status}', ";
    $query .= "nationality= '{$nationality}', county= '{$county}', residence= '{$residence}' ";
    $query .= "WHERE id= {$id} ";
    $query .= "LIMIT 1";
    $results = mysqli_query($connection, $query);

    //5. check whether the query took place
    if($results && mysqli_affected_rows($connection)==1){
      //it was successfull 
      $_SESSION["message"]= "Prent/Gurdian info update was successfull";
      redirect_to("profile.php?parent=". urlencode($current_parent_id["id"]));

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
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
        <a href="../../../home.php" title="Go to Home" class="tip-bottom">
            <i class="icon-home"></i> Home
        </a>
        <a href="../students.php" class="current">
            students
        </a>
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
        			<span class="icon"> <i class="icon-align-justify"></i> 
       				</span>
          			<h5>Update gurdian/parent info</h5>
        		</div><!--widget-title-->
        		<div class="widget-content nopadding">
        			 <form action="edit.php?parent=<?php echo urlencode($current_parent_id["id"]); ?>" method="POST" class="form-horizontal">
                <!--photo-->
        			 	<!--full_names-->
            			<div class="control-group">
              				<label class="control-label">FULL NAMES :</label>
             				<div class="controls">
                				<input type="text" name="full_names" class="span11" value="<?php echo htmlentities($current_parent_id["full_names"]); ?>"/>
              				</div>
            			</div><!--control-group-->
                  <!--id_number-->
                  <div class="control-group">
                      <label class="control-label">ID NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="id_number" class="span11" value="<?php echo htmlentities($current_parent_id["id_number"]); ?>" />
                      </div>
                  </div><!--control-group-->

                   <!--relationship-->
                  <div class="control-group">
                      <label class="control-label">RELATIONSHIP :</label>
                    <div class="controls">
                        <input type="text" name="relationship" class="span11" value="<?php echo htmlentities($current_parent_id["relationship"]); ?>" />
                      </div>
                  </div><!--control-group-->
                
                  
            			<!--gender-->
            			<div class="control-group">
              				<label class="control-label">GENDER :</label>
              				<div class="controls">
				                <select name="gender">
					                  <option <?php if($current_parent_id["gender"] == 'Male'){
                                  echo "selected";
                              } ?>>Male</option>
					                  <option <?php if($current_parent_id["gender"] == 'Female'){
                                echo "selected";
                              } ?>>Female</option>
				                </select>
              				</div>
            			</div><!--control-group-->

          
                   <!--occupation-->
                  <div class="control-group">
                      <label class="control-label">OCCUPATION :</label>
                    <div class="controls">
                        <input type="text" name="occupation" class="span11" value="<?php echo htmlentities($current_parent_id["occupation"]); ?>" />
                      </div>
                  </div><!--control-group-->

            			<!--phone-->
            			<div class="control-group">
              				<label class="control-label">PHONE NUMBER :</label>
             				<div class="controls">
                				<input type="text" name="phone_number" class="span11"  value="<?php echo htmlentities($current_parent_id["phone"]); ?>"  />
              				</div>
            			</div><!--control-group-->

                  <!--altphone-->
                  <div class="control-group">
                      <label class="control-label">OFFICE PHONE NUMBER :</label>
                    <div class="controls">
                        <input type="text" name="office_phone" class="span11" value="<?php echo htmlentities($current_parent_id["altphone"]); ?>" />
                      </div>
                  </div><!--control-group-->

                  <!--email-->
                  <div class="control-group">
                      <label class="control-label">EMAIL ADDRESS :</label>
                    <div class="controls">
                        <input type="text" name="email" class="span11" value="<?php echo htmlentities($current_parent_id["email"]); ?>" />
                      </div>
                  </div><!--control-group-->

                  <!--altphone-->
                  <div class="control-group">
                      <label class="control-label">LOCAL ADDRESS :</label>
                    <div class="controls">
                        <input type="text" name="address" class="span11" value="<?php echo htmlentities($current_parent_id["address"]); ?>" />
                      </div>
                  </div><!--control-group-->

            			<!--altphone-->
            			<div class="control-group">
              				<label class="control-label">MARITAL STATUS :</label>
             				<div class="controls">
                				<select name="marital_status">
					                  <option <?php if($current_parent_id["marital"] == 'Married')
                            { echo "selected"; } 
                            ?>>Married</option>

					                  <option <?php if($current_parent_id["marital"] == 'Single'){ echo "selected"; } ?>>Single</option>

				                </select>
              				</div>
            			</div><!--control-group-->

  

            			<!--Nationality-->
            			<div class="control-group">
              				<label class="control-label">NATIONALITY :</label>
             				<div class="controls">
                				<input type="text" name="nationality" class="span11" value="<?php echo htmlentities($current_parent_id["nationality"]); ?>" />
              				</div>
            			</div><!--control-group-->

                  <div class="control-group">
                      <label class="control-label">COUNTY :</label>
                    <div class="controls">
                        <input type="text" name="county" class="span11" value="<?php echo htmlentities($current_parent_id["county"]); ?>" />
                    </div>
                  </div><!--control-group-->

            			<!--Residential area-->
            			<div class="control-group">
              				<label class="control-label">RESIDENTIAL AREA :</label>
             				<div class="controls">
                				<input type="text" name="residence" class="span11" value="<?php echo htmlentities($current_parent_id["residence"]); ?>" />
              				</div>
            			</div><!--control-group-->


            			<div class="form-actions">
              				<button name="submit" type="submit" class="btn btn-success">
              				<i class="icon-download-alt"></i> Update
              				</button>

              				<a href="profile.php?parent=<?php echo urlencode($current_parent_id["id"]); ?>" type="submit" class="btn btn-danger">
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
