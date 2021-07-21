<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/events_function.php'; ?>
<?php find_selected_fields(); ?>
<?php confirm_other_folder_logged_in(); ?>
<?php 
	if(!$current_event_id){
		//no id
		redirect_to("../events.php");
	}
?>
<?php 
//1. confirm that the form has been submitted
if(isset($_POST["submit"])){
	//submission was successfull check the form vallidation
    $required_fields = array("upcoming", "venue", "day", "date", "time", "attendance", "comments");
    validate_presences($required_fields);

    if(empty($errors)){
    	$id = $current_event_id["id"];
	    $upcoming = mysqli_sec($_POST["upcoming"]);
	    $venue = mysqli_sec($_POST["venue"]);
	    $day = mysqli_sec($_POST["day"]);
	    $date = mysqli_sec($_POST["date"]);
	    $time = mysqli_sec($_POST["time"]);
	    $attendance = mysqli_sec($_POST["attendance"]);
	    $comments = mysqli_sec($_POST["comments"]);

	    //perform query
	    $query = "UPDATE events SET ";
	    $query .= "upcoming= '{$upcoming}', venue= '{$venue}', ";
	    $query .= "day= '{$day}', event_date= '{$date}', ";
	    $query .= "event_time= '{$time}', attendance= '{$attendance}', ";
	    $query .= "comments= '{$comments}' ";
	    $query .= "WHERE id= {$id} ";
	    $query .= "LIMIT 1";
	    $results = mysqli_query($connection, $query);

	    if($results && mysqli_affected_rows($connection)==1){
	    	$_SESSION["message"] = "Event update was successfull";
	    	redirect_to("../events.php");
	    }else{
	    	$_SESSION["error_message"] = "There was a problem in trying to update your event";
	    }
    }
}else{
	//failure in submission
}



?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="../events.php" class="current">Events </a> 
    </div>
    <h1>Events.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
    <hr/>
    <div class="row-fluid">
	    <div class="span12">
	    	<div class="widget-box">
	    		<div class="widget-title">
            		<span class="icon"><i class="icon-th"></i></span>
             		<h5>Update events</h5>
          		</div><!--widget-title-->
          		<div class="widget-content nopadding">

          			 <form action="edit.php?event=<?php echo urlencode($current_event_id["id"]); ?>" method="POST" class="form-horizontal">
			              <!--upcoming-->
			             <div class="control-group">
			                <label class="control-label">UPCOMING EVENTS :</label>
			                <div class="controls">
			              		<input type="text" name="upcoming" class="span11" placeholder="Enter the upcoming event.." value="<?php echo htmlentities($current_event_id["upcoming"]); ?>" >
			                </div>
			             </div><!--control-group-->


               			<!--venue-->
               			<div class="control-group">
                  			<label class="control-label">VENUE :</label>
                  			<div class="controls">
                  				<input type="text" name="venue" class="span11" placeholder="Enter the venue.." value="<?php echo htmlentities($current_event_id["venue"]); ?>" >
                  			</div>
                		</div><!--control-group-->

                		<!--day-->
                		<div class="control-group">
                  			<label class="control-label">DAY :</label>
                  			<div class="controls">
                     			<input type="text" name="day" class="span11" placeholder="Enter the events day..." value="<?php echo htmlentities($current_event_id["day"]); ?>">
                  			</div>
                		</div><!--control-group-->

                		<!--date-->
                		<div class="control-group">
                  			<label class="control-label">DATE :</label>
                  			<div class="controls">
                     			<input type="text" name="date" class="span11" placeholder="Enter the date..." value="<?php echo htmlentities($current_event_id["event_date"]); ?>">
                  			</div>
                		</div><!--control-group-->

                		<!--photo-->
                		<div class="control-group">
                  			<label class="control-label">TIME :</label>
                  			<div class="controls">
                     			<input type="text" name="time" class="span11" placeholder="HH:MM:SS" value="<?php echo htmlentities($current_event_id["event_time"]); ?>">
                 			 </div>
                		</div><!--control-group-->

		                <!--attendance-->
		                <div class="control-group">
		                  	<label class="control-label">ATTENDANCE :</label>
		                  	<div class="controls">
		                     	<input type="text" name="attendance" class="span11" placeholder="Enter the events attendance..." value="<?php echo htmlentities($current_event_id["attendance"]); ?>">
		                  	</div>
		                </div><!--control-group-->

                		<!--photo-->
                		<div class="control-group">
                  			<label class="control-label">COMMENTS :</label>
                  			<div class="controls">
                     			<textarea name="comments" class="span11" placeholder="Enter the comments...">
                     			<?php echo htmlentities($current_event_id["comments"]); ?>
                     			</textarea>
                  			</div>
                		</div><!--control-group-->

                		<div class="form-actions">
                    		<button name="submit" type="submit" class="btn btn-success">
                      			<i class="icon-download-alt"></i> Update
                    		</button>

                    		<a href="../events.php" class="btn btn-danger">
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