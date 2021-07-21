<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../include/admin_function.php'; ?>
<?php confirm_other_folder_logged_in(); ?>
<?php 
  //1. check whether the form has been submitted
  if(isset($_POST["submit"])){
    //submission was successfull go to step two
    //2. check form validation
      $required_fields= array("class", "venue", "day", "date", "period", "start_time", "end_time", "supervisor", "term");
      validate_presences($required_fields);

    //check whether there is any validation errorrs
    if(empty($errors)){
      //there is no any errors go to step 3
      //3. get objects from the form and store them on variables
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
      //you can now go to the next step
      //4. perform insertion query 
      $query = "INSERT INTO interviews(class, venue, day, int_date, period, start_time, end_time, supervisor, status, Term) VALUES('{$class}', '{$venue}', '{$day}', '{$date}', '{$period}', '{$start_time}', '{$end_time}', '{$supervisor}', '{$status}', '{$term}')";
      $results = mysqli_query($connection, $query);

      //5. check if the query took place.
      if($results){
        $_SESSION["message"] = "You have successfully created a new interview process";
        redirect_to("../interviews.php");
      }else{
        //the query failed 
        $_SESSION["message"]= "There was a problem in entering creating a new interview. please try again later...";
      }

    }
  }else{
    //the form was not submitted
    //probably a get request
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

    <div class="container-fluid"><hr>
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
                        <span class="icon">
                            <i class="icon-align-justify"></i>
                        </span>
                        <h5>Set up a new interview</h5>
                    </div><!--widget-title-->

                    <div class="widget-content nopadding">
                        <form action="new_interview.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <!--class-->
                            <div class="control-group">
                                <label class="control-label">CLASS :</label>
                                <div class="controls">
                                    <input name="class" placeholder="Enter the class taking the interview.." type="text" class="span11" placeholder="Enter the students class..">
                                </div>
                            </div><!--control-group-->


                            <!--venue-->
                            <div class="control-group">
                                <label class="control-label">VENUE :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Enter the venue for the interview.." name="venue" class="span11"/>
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
                                    <input type="text" data-date="01-02-2013" data-date-format="dd-mm-yyyy" value="01-02-2013" class="datepicker span11" name="date">
                                </div>
                            </div><!--control-group-->

                            <!--period-->
                            <div class="control-group">
                                <label class="control-label">PERIOD :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Enter the total time the interview should take.." name="period" class="span11">
                                </div>
                            </div><!--control-group-->

                            <!--start_time-->
                            <div class="control-group">
                                <label class="control-label">START TIME :</label>
                                <div class="controls">
                                    <input type="time" placeholder="Enter the starting time of the interview.." name="start_time" class="span11"/>
                                </div>
                            </div><!--control-group-->


                            <!--end_time-->
                            <div class="control-group">
                                <label class="control-label">END TIME :</label>
                                <div class="controls">
                                    <input type="time" placeholder="Enter the expected end time.." name="end_time" class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <!--supervisor-->
                            <div class="control-group">
                                <label class="control-label">SUPERVISOR :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Enter the supervisor of the interview.." name="supervisor" class="span11"/>
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
                                    <input type="text" name="term" placeholder="Enter the current term.." class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <div class="form-actions">
                                <button name="submit" type="submit" class="btn btn-success">
                                    <i class="icon-download-alt"></i> Save
                                </button>

                                <a href="../interviews.php" type="submit" class="btn btn-danger">
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

