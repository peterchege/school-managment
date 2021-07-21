<?php require_once('../../../includes/initialization.php');  ?>
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
    <a href="teachers.php" class="current">Teaching Staff </a> 
    </div>
    <h1>All Teachers.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
    <hr/>
    <div class="row-fluid">
      <div class="span12">
          <?php $layout_context = $_SESSION['usertype']; ?>
          <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
          <?php echo message(); ?>
          <div class="widget-box">
              <div class="widget-content nopadding">
                  <form action="teaching/import_data.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                      <div class="control-group">
                          <label class="control-label"><strong>IMPORT DATA :</strong></label>
                          <div class="controls">
                              <input type="file" name="file">
                              <button type="submit" name="submit" class="btn btn-mini btn-success">
                                  <icon><i class="icon-download-alt"></i></icon> Save
                              </button>
                          </div><!--controls-->
                      </div><!--control-group-->
                  </form>
              </div>
          </div>
          <?php } ?>
          <div class="widget-box">
              <div class="widget-title">
                  <span class="icon">
                      <i class="icon-th"></i>
                  </span>
                  <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
                  <span class="icon_right">
                      <a href="teaching/new_teacher.php" class="btn btn-mini btn-success">
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
                      <th>SURNAME</th>
                      <th>FULL NAMES</th>
                      <th>ID NUMBER</th>
                      <th>GENDER</th>
                      <th>WORKING POSITION</th>
                      <th>PHONE NUMBER</th>
                      <th>PROFILE</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $teachers_set = find_all_teachers(); ?>
                  <?php while($teachers = mysqli_fetch_assoc($teachers_set)){ ?>
                  
                    <tr>
                      <td>
                      <?php echo htmlentities($teachers["sirname"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($teachers["full_names"]); ?>
                      </td>

                      <td>
                     <?php echo htmlentities($teachers["Idnumber"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($teachers["gender"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($teachers["position"]); ?>
                      </td>

                       <td>
                      <?php echo htmlentities($teachers["phone"]); ?>
                      </td>
                       <td>
        
                          <a href="teaching/profile.php?teacher=<?php echo urlencode($teachers["id"]); ?>">
                          <span class="icon">
                          profile <i class="icon-user"></i>
                          </span>
                          </a>
                    
                      </td>

                      
                    </tr>
                    <?php } ?>
                  <?php mysqli_free_result($teachers_set); ?>
                    
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
