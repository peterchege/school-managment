<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/events_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="events.php" class="current">Events </a> 
    </div>
    <h1>Events.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
    <hr/>
    <div class="row-fluid">
      <div class="span12">
      <?php echo message(); ?>
      <?php if (isset($_POST["add"])) { ?>
      <div class="widget-box">
         <div class="widget-content nopadding">
            <form action="events/new_events.php" method="POST" class="form-horizontal">
              <!--class-->
              <div class="control-group">
                    <label class="control-label">UPCOMING EVENTS :</label>
                  <div class="controls">
                      <input type="text" name="upcoming" class="span11" placeholder="Enter the upcoming event.." />
                    </div>
                </div><!--control-group-->


                <!--stream-->
                <div class="control-group">
                  <label class="control-label">VENUE :</label>
                  <div class="controls">
                  <input type="text" name="venue" class="span11" placeholder="Enter the venue.." />
                  </div>
                </div><!--control-group-->

                <!--photo-->
                <div class="control-group">
                  <label class="control-label">DAY :</label>
                  <div class="controls">
                     <input type="text" name="day" class="span11" placeholder="Enter the events day..." />
                  </div>
                </div><!--control-group-->

                <!--photo-->
                <div class="control-group">
                  <label class="control-label">DATE :</label>
                  <div class="controls">
                     <input type="text" name="date" class="span11" placeholder="Enter the date..." />
                  </div>
                </div><!--control-group-->

                <!--photo-->
                <div class="control-group">
                  <label class="control-label">TIME :</label>
                  <div class="controls">
                     <input type="text" name="time" class="span11" placeholder="HH:MM:SS" />
                  </div>
                </div><!--control-group-->

                <!--photo-->
                <div class="control-group">
                  <label class="control-label">ATTENDANCE :</label>
                  <div class="controls">
                     <input type="text" name="attendance" class="span11" placeholder="Enter the events attendance..." />
                  </div>
                </div><!--control-group-->

                <!--photo-->
                <div class="control-group">
                  <label class="control-label">COMMENTS :</label>
                  <div class="controls">
                     <textarea name="comments" class="span11" placeholder="Enter the comments...">
                     </textarea>
                  </div>
                </div><!--control-group-->

                <div class="form-actions">
                    <button name="submit" type="submit" class="btn btn-success">
                      <i class="icon-download-alt"></i> Save
                    </button>

                    <a href="" class="btn btn-default"><i class="icon-refresh"></i></a>
                </div>


            </form>
        </div><!--widget-content-->
       </div><!--widget-box-->
       <?php } ?>

      <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <span class="icon_right">
              <form action="events.php" method="POST" class="">
                <button type="submit" name="add" class="btn btn-mini btn-success">
                  <i class="icon-plus"></i>
                </button>
              </form>
            <a href="teaching/new_teacher.php" >
            
            </a>
            </span>
             <h5>Events</h5>
          </div>

          <!--all students table-->
         <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table">
              <thead>
                <th>UPCOMING EVENT</th>
                <th>VENUE</th>
                <th>DAY</th>
                <th>DATE</th>
                <th>TIME</th>
                <th>ACTION</th>
              </thead>
              <?php $events_set = find_all_events_set(); ?>
              <?php while($events = mysqli_fetch_assoc($events_set)){ ?>
              <tbody>
              
                <tr>
                  <td>
                  <?php echo htmlentities($events["upcoming"]); ?>
                  </td>

                  <td>
                  <?php echo htmlentities($events["venue"]); ?>
                  </td>

                  <td>
                 <?php echo htmlentities($events["day"]); ?>
                  </td>

                  <td>
                  <?php echo htmlentities($events["event_date"]); ?>
                  </td>

                  <td>
                  <?php echo htmlentities($events["event_time"]); ?>
                  </td>
                  <td>
                    <div class="fr">
                      <a href="events/edit.php?event=<?php echo urlencode($events["id"]); ?>" class="btn btn-mini btn-info"><i class="icon-edit"></i></a>

                      <a href="events/delete.php?event=<?php echo urlencode($events["id"]); ?>" class="btn btn-mini btn-danger"><i class="icon-trash"></i></a>
                    </div>
                  </td>
                </tr>
              </tbody>
              <?php } ?>
              <?php mysqli_free_result($events_set); ?> 
               </table>
            </div><!--widget-content tab-content nopadding-->
          </div>
        </div><!--Widget-Box-->
      </div><!--span12-->
    </div><!--row-fluid-->
   
  </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../includes/system/footer.php'; ?>
