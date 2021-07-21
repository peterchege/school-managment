<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/staff_function.php'; ?>
<?php 
   $current_teacher_details = find_details_by_id($_GET["details"]);
   if(!$current_teacher_details){
    //no 
    redirect_to("../teachers.php");
   }
?>

<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
  $required_fields= array("teaching_day", "class");
  validate_presences($required_fields);

  //check whether there was any errors
  if(empty($errors)){
    //get objects from the form 
    //this is the path to store the uploaded image 
    
    //3. get objects info from the form 
    $id= $current_teacher_details["id"];    
    $teaching_day= mysqli_sec($_POST["teaching_day"]);
    $class= mysqli_sec($_POST["class"]);
    $stream= mysqli_sec($_POST["stream"]);
    $subject= mysqli_sec($_POST["subject"]);
    $starting_time= mysqli_sec($_POST["starting_time"]);
    $end_time= mysqli_sec($_POST["end_time"]);
    $period= mysqli_sec($_POST["period"]);
    

    //perform the update query 
    $query = "UPDATE teachers_classes SET ";
    $query .= "classes= '{$class}', stream= '{$stream}', ";
    $query .= "subject= '{$subject}', starting_time= '{$starting_time}', ";
    $query .= "end_time= '{$end_time}', period= '{$period}', ";
    $query .= "teaching_day= '{$teaching_day}' ";
    $query .= "WHERE id= {$id} ";
    $query .= "LIMIT 1";
    $results = mysqli_query($connection, $query);

    //check whether the query took place
    if($results && mysqli_affected_rows($connection)==1){
      //it was successfull 
      $_SESSION["message"]= "Teachers teaching details update was successfull";
      redirect_to("classes.php?teacher=". urlencode($current_teacher_details["teacher_id"]));

    }else{
      //update has failed
      $_SESSION["message"]= "There was an error in updating the teachers teaching details";

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
        			 <form action="edit_details.php?details=<?php echo urlencode($current_teacher_details["id"]); ?>" method="POST" class="form-horizontal">
                <!--photo-->
        			 	<!--First name-->
        			 	<div class="control-group">
              				<label class="control-label">TEACHING DAY :</label>
             				<div class="controls">
                				<input type="text" name="teaching_day" class="span11" value="<?php echo htmlentities($current_teacher_details["teaching_day"]); ?>" />
              				</div>
            			</div><!--control-group-->


            			<!--Last name-->
            			<div class="control-group">
              			<label class="control-label">CLASS :</label>
             				<div class="controls">
                			<select name="class">
                        <?php 

                          $current_class = find_all_classes();
                          while($classes = mysqli_fetch_assoc($current_class)){
                        ?>

                          <option><?php echo htmlentities($classes["class"]); ?></option>

                        <?php } ?>
                        <?php mysqli_free_result($current_class); ?>   
                      </select>
              			</div>
            			</div><!--control-group-->

                  <!--Last name-->
                  <div class="control-group">
                      <label class="control-label">STREAM :</label>
                    <div class="controls">
                       <select name="stream">
                        <?php 

                          $current_stream = find_all_classes();
                          while($stream = mysqli_fetch_assoc($current_stream)){
                        ?>

                          <option><?php echo htmlentities($stream["stream"]); ?></option>

                        <?php } ?>
                        <?php mysqli_free_result($current_stream); ?>   
                      </select>
                    </div>
                  </div><!--control-group-->
                  
                    <div class="control-group">
                      <label class="control-label">SUBJECT :</label>
                    <div class="controls">
                        <input type="text" name="subject" class="span11" value="<?php echo htmlentities($current_teacher_details["subject"]); ?>" />
                      </div>
                  </div><!--control-group-->
            			

                  <!--joined-->
                  <div class="control-group">
                      <label class="control-label">STARTING TIME :</label>
                    <div class="controls">
                        <input type="text" name="starting_time" class="span11" value="<?php echo htmlentities($current_teacher_details["starting_time"]); ?>" />
                      </div>
                  </div><!--control-group-->

                   <!--joined-->
                  <div class="control-group">
                      <label class="control-label">END TIME :</label>
                    <div class="controls">
                        <input type="text" name="end_time" class="span11" value="<?php echo htmlentities($current_teacher_details["end_time"]); ?>" />
                      </div>
                  </div><!--control-group-->

            			<!--age-->
            			<div class="control-group">
              				<label class="control-label">PERIOD :</label>
             				<div class="controls">
                				<input type="text" name="period" class="span11" value="<?php echo htmlentities($current_teacher_details["period"]); ?>" />
              				</div>
            			</div><!--control-group-->

            			<div class="form-actions">
              				<button name="submit" type="submit" class="btn btn-success">
              				<i class="icon-download-alt"></i> Update
              				</button>

              				<a href="classes.php?teacher=<?php echo urlencode($current_teacher_details["teacher_id"]); ?>" type="submit" class="btn btn-danger">
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
