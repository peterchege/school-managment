<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/staff_function.php'; ?>
<?php find_selected_fields(); ?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="teachers.php" class="current">Teaching Staff </a> 
    </div>
    <h1>Teaching classes and subjects.</h1>
  </div><!--content-header-->

  <div class="container-fluid"><hr/>
      <div class="row-fluid">
          <div class="span12">
              <?php $layout_context = $_SESSION['usertype']; ?>
              <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){?>
                <?php echo message(); ?>
              <?php } ?>
              <div class="widget-box">
                  <div class="widget-title">
                      <span class="icon">
                          <i class="icon-th"></i>
                      </span>
                      <span class="icon_right">
                          <a href="profile.php?teacher=<?php echo urlencode($current_teacher_id["id"]); ?>" class="btn btn-warning btn-mini">
                              BACK <i class="icon-arrow-left"></i>
                          </a>
                      </span>
                      <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
                      <span class="icon_right">
                          <a href="new_details.php?teacher=<?php echo urlencode($current_teacher_id["id"]); ?>" class="btn btn-mini btn-success">
                              <i class="icon-plus"></i>
                          </a>
                      </span>
                      <?php } ?>
                      <h5>Students table</h5>
                  </div>
                  <!--all students table-->
                  <div class="widget-content nopadding">

            <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th>TEACHING DAY</th>
                      <th>CLASS</th>
                      <th>STREAM</th>
                      <th>SUBJECT</th>
                      <th>TEACHING TIME</th>
                      <th>PERIOD</th>
                        <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
                            <th>Actions</th>
                        <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $details_set = find_teaching_details($_GET["teacher"]); ?>
                  <?php while($details = mysqli_fetch_assoc($details_set)){ ?>

                    <tr>
                      <td>
                      <?php echo htmlentities($details["teaching_day"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($details["classes"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($details["stream"]); ?>
                      </td>

                      <td>
                     <?php echo htmlentities($details["subject"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($details["starting_time"]);?> - <?php echo htmlentities($details["end_time"]); ?>
                      </td>


                       <td>
                      <?php echo htmlentities($details["period"]); ?>
                      </td>

                        <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
                      <td>

                        <div class="fr">

                          <a href="edit_details.php?details=<?php echo urlencode($details["id"]); ?>" class="btn btn-info btn-mini"><i class="icon-wrench"></i></a>

                          <a href="delete_details.php?details=<?php echo urlencode($details["id"]); ?>"" onclick= "return confirm('Are you Sure you..?!');" class="btn btn-danger btn-mini"><i class="icon-trash"></i></a>
                        </div>

                      </td>
                        <?php } ?>

                    </tr>
                    <?php } ?>
                  <?php mysqli_free_result($details_set); ?>

                  </tbody>

               </table>
            </div><!--widget-content tab-content nopadding-->
            <div class="widget-footer">


            </div>
          </div>
        </div><!--Widget-Box-->
      </div><!--span12-->
    </div><!--row-fluid-->
   
  </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../../includes/system/footer.php'; ?>
