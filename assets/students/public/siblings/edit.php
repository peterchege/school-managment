<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php find_selected_fields(); ?>
<?php 
if(!$current_sibling_id)
  {
    redirect_to("../students.php");
  } 
?>

<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
  $required_fields= array("full_names", "age", "gender", "relationship",  "school");
  validate_presences($required_fields);

  //check whether there was any errors
  if(empty($errors)){
    //get objects from the form 
     //this is the path to store the uploaded image 
    
    //3. get objects info from the form 
    $id= $current_sibling_id["id"];    
    $fullnames= mysqli_sec($_POST["full_names"]);
    $age= mysqli_sec($_POST["age"]);
    $gender= mysqli_sec($_POST["gender"]);
    $relationship= mysqli_sec($_POST["relationship"]);
    $school= mysqli_sec($_POST["school"]);
    
    //4. perform the update query 
    $query = "UPDATE siblings SET ";
    $query .= "full_names= '{$fullnames}', age= '{$age}', ";
    $query .= "relationship= '{$relationship}', gender= '{$gender}', ";
    $query .= "school= '{$school}' WHERE id= {$id} ";
    $query .= "LIMIT 1";
    $results = mysqli_query($connection, $query);

    //5. check whether the query took place
    if($results && mysqli_affected_rows($connection)==1){

        $_SESSION["message"]= "Sibling info update was successfull";
        redirect_to("profile.php?sibling=". urlencode($current_sibling_id["id"]));

    }else{

        $_SESSION["error_message"]= "There was an error in updating the sibling info";

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
    <div id="breadcrumb"> <a href="../../../home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="../students.php" class="current">students</a> </div>
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
        			 <form action="edit.php?sibling=<?php echo urlencode($current_sibling_id["id"]); ?>" method="POST" class="form-horizontal">
                <!--photo-->
        			 	<!--full_names-->
            			<div class="control-group">
              				<label class="control-label">FULL NAMES :</label>
             				<div class="controls">
                				<input type="text" name="full_names" class="span11" value="<?php echo htmlentities($current_sibling_id["full_names"]); ?>"/>
              				</div>
            			</div><!--control-group-->

                  <!--age-->
                  <div class="control-group">
                      <label class="control-label">AGE :</label>
                    <div class="controls">
                        <input type="text" name="age" class="span11" value="<?php echo htmlentities($current_sibling_id["age"]); ?>" />
                      </div>
                  </div><!--control-group-->

                  <!--gender-->
                  <div class="control-group">
                      <label class="control-label">GENDER :</label>
                      <div class="controls">
                        <select name="gender">
                            <option <?php if($current_sibling_id["gender"] == 'Male'){
                                  echo "selected";
                              } ?>>Male</option>
                            <option <?php if($current_sibling_id["gender"] == 'Female'){
                                echo "selected";
                              } ?>>Female</option>
                        </select>
                      </div>
                  </div><!--control-group-->


                   <!--relationship-->
                  <div class="control-group">
                      <label class="control-label">RELATIONSHIP :</label>
                    <div class="controls">
                        <input type="text" name="relationship" class="span11" value="<?php echo htmlentities($current_sibling_id["relationship"]); ?>" />
                      </div>
                  </div><!--control-group-->
                
                  
            			
          
                   <!--occupation-->
                  <div class="control-group">
                      <label class="control-label">SCHOOL :</label>
                    <div class="controls">
                        <input type="text" name="school" class="span11" value="<?php echo htmlentities($current_sibling_id["school"]); ?>" />
                      </div>
                  </div><!--control-group-->

            			

            			<div class="form-actions">
              				<button name="submit" type="submit" class="btn btn-info">
              				    Save
              				</button>

              				<a href="profile.php?sibling=<?php echo urlencode($current_sibling_id["id"]); ?>" type="submit" class="btn btn-danger">
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
