<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/notice_function.php'; ?>
<?php require_once'../../../includes/validation_functions.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php find_selected_field(); ?>
<?php 
if (!$current_notification_by_id) {
	redirect_to("../../home.php");
}

?>
<?php 
//check whether the form has been submitted
if (isset($_POST["submit"])) {
	 //2. vvalidate the form
    $required_fields = array("title", "notice", "date", "month", "term");
    validate_presences($required_fields);

    if(empty($errors)){
    //3. get objectes and store them to variables
    	$id = $current_notification_by_id["id"];
    	$title= mysqli_sec($_POST["title"]);
    	$notice= mysqli_sec($_POST["notice"]);
    	$date= mysqli_sec($_POST["date"]);
    	$month= mysqli_sec($_POST["month"]);
    	$term= mysqli_sec($_POST["term"]);

    	//perform insertion query 
    	$query = "UPDATE notifications SET ";
    	$query .= "title='{$title}', notice='{$notice}', "; 
    	$query .= "not_date='{$date}', month='{$month}', ";
    	$query .= "term='{$term}' ";
    	$query .= "WHERE id= {$id} ";
    	$query .= "LIMIT 1";
    	$results = mysqli_query($connection, $query);
    	if ($results && mysqli_affected_rows($connection)==1) {
    		$_SESSION["message"] = "You've successfully updated notification";
    		redirect_to("../../home.php");
    	}else{
    		$_SESSION["error_message"] = "There was a problem in updating notification.";

    	}

    }
}else{
	//the form was not submitted
}


?>
<?php require_once'../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="" class="current">Notification </a> 
    </div>
    <h1>Notification.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
   <hr/>
   <div class="row-fluid">
   	<div class="span12">
   		<div class="widget-box">
   			<div class="widget-title">
   				<span class="icon">
   					<i class="icon-align-justify"></i>
   				</span>
   				<h5>Edit Notification</h5>
   			</div>
	        <div class="widget-content nopadding">
	            <form action="" method="POST" class="form-horizontal">
	              <!--class-->
	              <div class="control-group">
	                    <label class="control-label">TITLE :</label>
	                  <div class="controls">
	                      <input type="text" name="title" class="span11" placeholder="Enter the notification title.." value="<?php echo htmlentities($current_notification_by_id["title"]); ?>">
	                    </div>
	                </div><!--control-group-->


	                <!--stream-->
	                <div class="control-group">
	                  <label class="control-label">NOTICE :</label>
	                  <div class="controls">
	                  <input type="text" name="notice" class="span11" placeholder="Enter the notice.." value="<?php echo htmlentities($current_notification_by_id["notice"]); ?>">
	                  </div>
	                </div><!--control-group-->

	                <!--photo-->
	                <div class="control-group">
	                  <label class="control-label">DATE :</label>
	                  <div class="controls">
	                     <input type="text" name="date" class="span11" placeholder="YYYY-MM-DD" value="<?php echo htmlentities($current_notification_by_id["not_date"]); ?>">
	                  </div>
	                </div><!--control-group-->

	                <!--photo-->
	                <div class="control-group">
	                  <label class="control-label">MONTH :</label>
	                  <div class="controls">
	                     <input type="text" name="month" class="span11" placeholder="Enter the class teacher..." value="<?php echo htmlentities($current_notification_by_id["month"]); ?>">
	                  </div>
	                </div><!--control-group-->

	                <!--photo-->
	                <div class="control-group">
	                  <label class="control-label">TERM :</label>
	                  <div class="controls">
	                     <input type="text" name="term" class="span11" placeholder="Enter term..." value="<?php echo htmlentities($current_notification_by_id["term"]); ?>">
	                  </div>
	                </div><!--control-group-->



	                <div class="form-actions">
	                    <button name="submit" type="submit" class="btn btn-success">
	                    <i class="icon-download-alt"></i> Update
	                    </button>

	                    <a href="../../home.php" class="btn btn-danger">
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
<?php require_once'../../../includes/system/footer.php'; ?>
