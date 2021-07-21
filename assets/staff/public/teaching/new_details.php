<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/staff_function.php'; ?>
<?php 
   find_selected_fields();
   if(!$current_teacher_id){
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
    $teachers_id= $current_teacher_id["id"];    
    $teaching_day= mysqli_sec($_POST["teaching_day"]);
    $class= mysqli_sec($_POST["class"]);
    $stream= mysqli_sec($_POST["stream"]);
    $subject= mysqli_sec($_POST["subject"]);
    $starting_time= mysqli_sec($_POST["starting_time"]);
    $end_time= mysqli_sec($_POST["end_time"]);
    $period= mysqli_sec($_POST["period"]);
    

    //perform the update query 
    $query = "INSERT INTO teachers_classes( ";
    $query .= "teacher_id, classes, stream, ";
    $query .= "subject, starting_time, ";
    $query .= "end_time, period, teaching_day";
    $query .= ") VALUES (";
    $query .= "{$teachers_id}, '{$class}', '{$stream}', ";
    $query .= "'{$subject}', '{$starting_time}', ";
    $query .= "'{$end_time}', '{$period}', '{$teaching_day}'";
    $query .= ")";
    $results = mysqli_query($connection, $query);

    //check whether the query took place
    if($results && mysqli_affected_rows($connection)==1){
      //it was successfull 
      $_SESSION["message"]= "New teaching details have been successfully entered..";
      redirect_to("classes.php?teacher=". urlencode($current_teacher_id["id"]));

    }else{
      //update has failed
      $_SESSION["error_message"]= "There was an error in entering the new teaching details";

    }

  }
}else{
  //form has not been submitted
  //probably a get request 
}


?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_login_time(); ?>
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
        			 <form action="new_details.php?teacher=<?php echo urlencode($current_teacher_id["id"]); ?>" method="POST" class="form-horizontal">
                <!--photo-->
        			 	<!--First name-->
        			 	<div class="control-group">
              				<label class="control-label">TEACHING DAY :</label>
             				<div class="controls">
                				<input type="text" name="teaching_day" placeholder="Enter the day of teaching" class="span11">
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
                        <input type="text" name="subject" placeholder="Enter the subjct the current teacher teaches" class="span11">
                      </div>
                  </div><!--control-group-->
            			

                  <!--joined-->
                  <div class="control-group">
                      <label class="control-label">STARTING TIME :</label>
                    <div class="controls">
                        <input type="text" name="starting_time" class="span11" placeholder="HH:MM:SS">
                      </div>
                  </div><!--control-group-->

                   <!--joined-->
                  <div class="control-group">
                      <label class="control-label">END TIME :</label>
                    <div class="controls">
                        <input type="text" name="end_time" class="span11" placeholder="HH:MM:SS">
                      </div>
                  </div><!--control-group-->

            			<!--age-->
            			<div class="control-group">
              				<label class="control-label">PERIOD :</label>
             				<div class="controls">
                				<input type="text" name="period" class="span11" placeholder="Enter the total time the teacher takes to teach">
              				</div>
            			</div><!--control-group-->

            			<div class="form-actions">
              				<button name="submit" type="submit" class="btn btn-success">
              				<i class="icon-download-alt"></i> Save
              				</button>

              				<a href="classes.php?teacher=<?php echo urlencode($current_teacher_id["id"]); ?>" type="submit" class="btn btn-danger">
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
