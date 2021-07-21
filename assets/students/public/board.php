<?php require_once('../../../includes/initialization.php');  ?>
<?php require_once '../includes/student_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="board.php" class="current">students board</a> 
    </div>
    <h1>Students.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
   <hr/>

    <div class="row-fluid">
      <div class="span12">
      <?php echo message(); ?>
      <?php if (isset($_POST["add"])) { ?>
      <div class="widget-box">
        <div class="widget-content nopadding">
          <form action="board/new_student.php" method="POST" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">REGISTRATION # :</label>
              <div class="controls">
                <select name="registration">
                  <?php $registration_set = find_all_students(); ?>
                  <?php while ($registration = mysqli_fetch_assoc($registration_set)) { ?>
                    <option><?php echo htmlentities($registration["registration"]); ?></option>
                  <?php } ?>
                  <?php mysqli_free_result($registration_set); ?>
                </select>
              </div>
            </div><!--control-group-->


                <!--plate-->
            <div class="control-group">
              <label class="control-label">SURNAME :</label>
              <div class="controls">
                <select name="surname" class="span11">
                  <?php $surname_set = find_all_students(); ?>
                  <?php while ($surname = mysqli_fetch_assoc($surname_set)) { ?>
                    <option><?php echo htmlentities($surname["sirname"]); ?></option>
                  <?php } ?>
                  <?php mysqli_free_result($surname_set); ?>
                </select>
              </div>
            </div><!--control-group-->

                <!--route-->
            <div class="control-group">
              <label class="control-label">FULLNAMES :</label>
              <div class="controls">

                <select name="fullnames" class="span11">
                  <?php $fullnames_set = find_all_students(); ?>
                  <?php while ($fullnames = mysqli_fetch_assoc($fullnames_set)) { ?>
                    <option><?php echo htmlentities($fullnames["full_names"]); ?></option>
                  <?php } ?>
                  <?php mysqli_free_result($fullnames_set); ?>
                </select>
              </div>
            </div><!--control-group-->

                 <!--amount-->
            <div class="control-group">
              <label class="control-label">GENDER :</label>
              <div class="controls">
                <select name="gender">
                  <option>MALE</option>
                  <option>FEMALE</option>
                </select>
              </div>
            </div><!--control-group-->

            <div class="control-group">
              <label class="control-label">CLASS :</label>
              <div class="controls">
                <select name="class">
                  <?php $classes_set = find_all_classes(); ?>
                  <?php while ($class= mysqli_fetch_assoc($classes_set)) { ?>
                    <option><?php echo htmlentities($class["class"]) ?></option>
                  <?php } ?>
                  <?php mysqli_free_result($classes_set); ?>
                </select>
              </div>
            </div><!--control-group-->

            <div class="control-group">
              <label class="control-label">STREAM :</label>
              <div class="controls">
                <select name="stream">
                  <?php $stream_set = find_all_classes(); ?>
                  <?php while ($stream= mysqli_fetch_assoc($stream_set)) { ?>
                    <option><?php echo htmlentities($stream["stream"]) ?></option>
                  <?php } ?>
                  <?php mysqli_free_result($stream_set); ?>
                </select>
              </div>
            </div><!--control-group-->

            <div class="control-group">
              <label class="control-label">POSITION :</label>
              <div class="controls">
                <input type="text" name="position" class="span11" placeholder="Enter students role or position..." />
              </div>
            </div><!--control-group-->


            <div class="form-actions">
              <button name="submit" type="submit" class="btn btn-success">
                <i class="icon-download-alt"></i> Save
              </button>

             
            </div>
          </form>
        </div><!--widget-content nopadding-->
      </div><!--widget-box-->
      <?php } ?>
      <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <span class="icon_right">
              <form action="" method="POST">
                <button type="submit" name="add" class="btn btn-mini btn-success">
                  <i class="icon-plus"></i>
                </button>

                 <a href="" class="btn btn-mini btn-default"><i class="icon-refresh"></i></a>
              </form>
            </span>

             <h5>Students board</h5>
          </div>

          <!--all students table-->
         <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>REGISTRATION #</th>
                    <th>SURNAME</th>
                    <th>FULL NAMES</th>
                    <th>CLASS</th>
                    <th>STREAM</th>
                    <th>GENDER</th>
                    <th>POSITION</th>
                    <th>ACTION </th>
                  </tr>
                </thead>
                <?php $student_set = find_all_students_board(); ?>
                <?php while($students = mysqli_fetch_assoc($student_set)){?>
                <tbody>
                   <td>
                    <?php echo htmlentities($students["registration"]); ?>
                    </td>

                    <td>
                    <?php echo htmlentities($students["surname"]); ?>
                    </td>

                    <td>
                   <?php echo htmlentities($students["fullnames"]); ?>
                    </td>

                    <td>
                    <?php echo htmlentities($students["class"]); ?>
                    </td>

                    <td>
                       <?php echo htmlentities($students["stream"]); ?>
                    </td>

                     <td>
                    <?php echo htmlentities($students["gender"]); ?>
                    </td>

                    <td>
                    <?php echo htmlentities($students["position"]); ?>
                    </td>
                     <td>
                      <div class="fr">
                        <a href="board/edit.php?board=<?php echo urlencode($students["id"]); ?>" class="btn btn-mini btn-info">
                          <i class="icon-edit"></i>
                        </a>

                        <a href="board/delete.php?board=<?php echo urlencode($students["id"]); ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure..?!')">
                          <i class="icon-trash"></i>
                        </a>
                      </div>
                     
                    </td>
                  
                </tbody>
          
                <?php }  ?>

                <?php mysqli_free_result($student_set); ?>
         
               </table>
            </div><!--widget-content tab-content nopadding-->
          </div>
        </div><!--Widget-Box-->

       
      </div><!--span12-->
    </div><!--row-fluid-->
   
  </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include '../../../includes/system/footer.php'; ?>