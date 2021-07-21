<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../include/admin_function.php'; ?>
<?php confirm_other_folder_logged_in(); ?>
<?php 
find_selected_field();
if(!$current_interview_id){
  //the id doesnot exist
  redirect_to("../interviews.php");
}
?>

<?php
//1.check if the form has been submittec
  if(isset($_POST["submit"])){
    //the form has been submitted go to step 2
    //2. perform form validation.
    $required_fields= array("class", "venue", "day", "date", "period", "start_time", "end_time", "supervisor", "term", "status");
    validate_presences($required_fields);

    //check if there was any vallidation errors 
    if(empty($errors)){

      //no errors go to the 3 step 
      //3. get form objects and store them on variables
      $id = $current_interview_id["id"];
      $class= mysqli_sec($_POST["class"]);
      $venue= mysqli_sec($_POST["venue"]);
      $day= mysqli_sec($_POST["day"]);
      $date= mysqli_sec($_POST["date"]);
      $period= mysqli_sec($_POST["period"]);
      $start_time= mysqli_sec($_POST["start_time"]);
      $end_time= mysqli_sec($_POST["end_time"]);
      $supervisor= mysqli_sec($_POST["supervisor"]);
      $status= mysqli_sec($_POST["status"]);
      $term= mysqli_sec($_POST["term"]);

      //go to 4th step 
      //perform query on what you get 
      $query = "UPDATE interviews SET ";
      $query .= "class= '{$class}', venue = '{$venue}', ";
      $query .= "day= '{$day}', int_date= '{$date}', ";
      $query .= "period = '{$period}', start_time= '{$start_time}', ";
      $query .= "end_time= '{$end_time}', supervisor= '{$supervisor}', ";
      $query .= "status= '{$status}', Term= '{$term}' ";
      $query .= "WHERE id= {$id} ";
      $query .= "LIMIT 1";
      $results = mysqli_query($connection, $query);

      //5. check if the query took place
      if($results && mysqli_affected_rows($connection) == 1){
        //the query went through 
        $_SESSION["message"] = "You have successfully updated the interview";
        redirect_to("profile.php?interview=".urlencode($current_interview_id["id"]));


      }else{
         $_SESSION["error_message"] = "There was a problem in trying to update the interview process";

      }



    }

  }else{
    //the form has not yet been submitted
    //this is probably a get request 
  }

?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
        <a href="../../../home.php" title="Go to Home" class="tip-bottom">
            <i class="icon-home"></i> Home
        </a>
        <a href="../interviews.php" class="current">Interviews</a>
    </div>
    <h1>Students Interviews.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
  <hr>
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
        			<span class="icon"> <i class="icon-align-justify"></i> 
       				</span>
          			<h5>Set up a new interview</h5>
        		</div><!--widget-title-->
        		<div class="widget-content nopadding">
                    <form action="edit_interview.php?interview=<?php echo urlencode($current_interview_id["id"]); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <!--class-->
        			 	<div class="control-group">
              				<label class="control-label">CLASS :</label>
             				<div class="controls">
                      
                				<input name="class" value="<?php echo htmlentities($current_interview_id["class"]); ?>" type="text" class="span11" placeholder="Enter the students class..">
              				</div>
            			</div><!--control-group-->

                        <div class="control-group">
                            <label class="control-label">VENUE :</label>
             				<div class="controls">
                                <select name="venue" class="span11">
                                    <?php $class_set = find_all_classes(); ?>
                                    <?php while ($class = mysqli_fetch_assoc($class_set)) { ?>
                                        <option value="<?php echo htmlentities($current_interview_id["venue"]); ?>">
                                            <?php echo htmlentities($class["class"]); ?>
                                        </option>
                                    <?php } ?>
                                </select>
              				</div>
                        </div><!--control-group-->

            			<!--day-->
            			<div class="control-group">
              				<label class="control-label">DAY :</label>
              				<div class="controls">
                                <select name="day">
                                    <option>Sunday</option>
                                    <option>Monday</option>
                                    <option>Tuesday</option>
                                    <option>Wednesday</option>
                                    <option>Thursday</option>
                                    <option>Friday</option>
                                    <option>Saturday</option>
				                </select>
              				</div>
            			</div><!--control-group-->

                  <!--date-->
                  <div class="control-group">
                      <label class="control-label">DATE :</label>
                    <div class="controls">
                         <input type="text" data-date="01-02-2013" data-date-format="dd-mm-yyyy" value="<?php echo htmlentities($current_interview_id['int_date']); ?>" class="datepicker span11" name="date">
                      </div>
                  </div><!--control-group-->

            			<!--period-->
            			<div class="control-group">
              				<label class="control-label">PERIOD :</label>
             				   <div class="controls">
                				<input type="text" value="<?php echo htmlentities($current_interview_id["period"]); ?>" name="period" class="span11">
              				</div>
            			</div><!--control-group-->

            			<!--start_time-->
            			<div class="control-group">
              				<label class="control-label">START TIME :</label>
             				<div class="controls">
                				<input type="time" value="<?php echo htmlentities($current_interview_id["start_time"]); ?>" name="start_time" class="span11"/>
              				</div>
            			</div><!--control-group-->


            			<!--end_time-->
            			<div class="control-group">
              				<label class="control-label">END TIME :</label>
             				<div class="controls">
                				<input type="time" value="<?php echo htmlentities($current_interview_id["end_time"]); ?>" name="end_time" class="span11"/>
              				</div>
            			</div><!--control-group-->

                  <!--supervisor-->
                  <div class="control-group">
                      <label class="control-label">SUPERVISOR :</label>
                    <div class="controls">
                        <input type="text" value="<?php echo htmlentities($current_interview_id["supervisor"]); ?>" name="supervisor" class="span11"/>
                      </div>
                  </div><!--control-group-->

                   <!--status-->
                  <div class="control-group">
                      <label class="control-label">STATUS :</label>
                      <div class="controls">
                        <select name="status">
                            <option>Complete</option>
                            <option>Started</option>
                            <option>Going on</option>
                        </select>
                      </div>
                  </div><!--control-group-->

                  <!--term-->
                  <div class="control-group">
                      <label class="control-label">TERM :</label>
                    <div class="controls">
                        <select name="term" value="<?php echo htmlentities($current_interview_id["Term"]); ?>" class="span11">
                            <option>ONE</option>
                            <option>TWO</option>
                            <option>THREE</option>
                        </select>
                      </div>
                  </div><!--control-group-->

                        <div class="form-actions">
              				<button name="submit" type="submit" class="btn btn-success">
              				<i class="icon-download-alt"></i> Update
              				</button>

              				<a href="profile.php?interview=<?php echo urlencode($current_interview_id["id"]); ?>" type="submit" class="btn btn-danger">
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
<?php include'../../../../includes/system/form_footer.php'; ?>
