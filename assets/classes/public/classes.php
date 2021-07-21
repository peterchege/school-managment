<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/class_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="classes.php" class="current">Classes </a> 
    </div>
    <h1>All classes.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
   <hr/>

    <div class="row-fluid">
    <div class="span12">
        <?php $layout_context = $_SESSION['usertype']; ?>
        <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
        <?php echo message(); ?>
        <?php //echo form_errors($errors); ?>
        <?php } ?>
        <?php if(isset($_POST["submit"])){ ?>
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-user"></i>
                    </span>
                    <h5>Student profile</h5>
                </div><!--title-->
                <div class="widget-content nopadding">
                    <form action="action/new_classes.php" method="POST" class="form-horizontal">
                        <!--class-->
                        <div class="control-group">
                            <label class="control-label">CLASS :</label>
                            <div class="controls">
                                <input type="text" name="class" class="span11" placeholder="Enter class.." />
                            </div>
                        </div><!--control-group-->

                        <!--stream-->
                        <div class="control-group">
                            <label class="control-label">STREAM :</label>
                            <div class="controls">
                                <input type="text" name="stream" class="span11" placeholder="Enter the stream.." />
                            </div>
                        </div><!--control-group-->

                        <!--photo-->
                        <div class="control-group">
                            <label class="control-label">CLASS TEACHER :</label>
                            <div class="controls">
                                <input type="text" name="class_teacher" class="span11" placeholder="Enter the class teacher..." />
                            </div>
                        </div><!--control-group-->

                        <div class="form-actions">
                            <button name="submit" type="submit" class="btn btn-success">
                                <i class="icon-download-alt"></i> Save
                            </button>
                        </div>
                    </form>
                </div><!--widget-content-->
            </div><!--widget-box-->
        <?php }  ?>
      
     
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-th"></i>
                </span>
                <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){?>
                <span class="icon_right">
                    <form action="classes.php" method="POST" class="form-horizontal">
                        <button type="submit" name="submit" class="btn btn-mini btn-success">
                            <i class="icon-plus"></i>
                        </button>

                        <a href="" class="btn btn-mini btn-default">
                            <i class="icon-refresh"></i>
                        </a>
                    </form>
                </span>
                <?php } ?>
             <h5>classes table</h5>
          </div>

          <!--all students table-->
         <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th>CLASS</th>
                      <th>STREAM</th>
                      <th>CLASS TEACHER</th>
                      <th>VIEW</th>
                        <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){?>
                      <th>ACTIONS</th>
                        <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $classes_set = find_all_classes(); ?>
                  <?php while($classes = mysqli_fetch_assoc($classes_set)){ ?>
                  
                    <tr>
                      <td>
                      <?php echo htmlentities($classes["class"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($classes["stream"]); ?>
                      </td>

                      <td>
                     <?php echo htmlentities($classes["teacher"]); ?>
                      </td>

                     <td>
                        <a href="students/students.php?class=<?php echo urlencode($classes["id"]);?>">
                          <span class="icon">
                            students <i class="icon-user-md"></i>
                          </span>
                        </a>
                    </td>
                        <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){?>
                    <td>
                      <a href="action/edit.php?class=<?php echo urlencode($classes["id"]); ?>" class="btn btn-mini btn-info"><i class="icon-pencil"></i></a>

                      <a href="action/delete.php?class=<?php echo urlencode($classes["id"]); ?>" class="btn btn-mini btn-danger" id="delete"><i class="icon-trash"></i></a>
                    </td>
                        <?php } ?>
                      
                    </tr>
                    <?php } ?>
                  <?php mysqli_free_result($classes_set); ?>
                    
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
<script type="text/javascript">
  document.getElementById('delete').onclick=function(){
    return confirm('Are you sure..?!');
  }
</script>
<?php include'../../../includes/system/footer.php'; ?>
