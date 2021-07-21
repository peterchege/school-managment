<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/staff_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="non_teaching.php" class="current">Non Teaching Staff </a> 
    </div>
    <h1>Non Teaching Staff.</h1>
  </div><!--content-header-->

  <div class="container-fluid"><hr/>
      <div class="row-fluid">
          <div class="span12">
              <?php $layout_context = $_SESSION['usertype']; ?>
              <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
                  <?php echo message(); ?>
              <?php } ?>

              <div class="widget-box">
                  <div class="widget-title">
                      <span class="icon">
                          <i class="icon-th"></i>
                      </span>
                      <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
                      <span class="icon_right">
                          <a href="non_teaching/new_staff.php" class="btn btn-mini btn-success">
                              <i class="icon-plus"></i>
                          </a>
                      </span>
                      <?php } ?>
                      <h5>Staff table</h5>
                  </div>
                  <!--all students table-->
         <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th>SURNAME</th>
                      <th>FULL NAMES</th>
                      <th>ID NUMBER</th>
                      <th>WORKING POSITION</th>
                      <th>PHONE NUMBER</th>
                      <th>PROFILE</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $staff_set = find_all_non_teaching_staff(); ?>
                  <?php while($staff = mysqli_fetch_assoc($staff_set)){ ?>
                  
                    <tr>
                      <td>
                      <?php echo htmlentities($staff["sirname"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($staff["fullnames"]); ?>
                      </td>

                      <td>
                     <?php echo htmlentities($staff["Idnumber"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($staff["position"]); ?>
                      </td>

                       <td>
                      <?php echo htmlentities($staff["phone"]); ?>
                      </td>
                       <td>
        
                          <a href="non_teaching/profile.php?staff=<?php echo urlencode($staff["id"]); ?>">
                          <span class="icon">
                          profile <i class="icon-user"></i>
                          </span>
                          </a>
                    
                      </td>

                      
                    </tr>
                    <?php } ?>
                  <?php mysqli_free_result($staff_set); ?>
                    
                  </tbody>
                  
               </table>
            </div><!--widget-content tab-content nopadding-->
          </div>
        </div><!--Widget-Box-->
      </div><!--span12-->
    </div><!--row-fluid-->
   
  </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../includes/system/alt_footer.php'; ?>
