<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php require_once '../../includes/class_function.php'; ?>
<?php require_once'../../../../includes/navigation.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php confirm_other_folder_logged_in(); ?>
<?php 
  $current_class = find_class_by_id($_GET["class"]);
  if(!$current_class){
    redirect_to("../classes.php");
  }


?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("class");
    validate_presences($required_fields);

    if(empty($errors)){
      //3. get objectes and store them to variables
      $id = $current_class["id"];
      $stream= mysqli_sec($_POST["stream"]);
      $class= mysqli_sec($_POST["class"]);
      $teacher= mysqli_sec($_POST["class_teacher"]);

      //perform insertion query 
      $query = "UPDATE classes SET ";
      $query .= "stream= '{$stream}', class= '{$class}', teacher= '{$teacher}' ";
      $query .= "WHERE id= {$id} ";
      $query .= "LIMIT 1";
      $results = mysqli_query($connection, $query);

      if($results && mysqli_affected_rows($connection)==1){
        //successfull
        $_SESSION["message"] = "You have successfully updated a class";
        redirect_to("../classes.php");
      }else{
        //failed
        $_SESSION["message"] = "There was aproblem in adding a class to the student";
      }

    }

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
    <a href="../classes.php" class="current">Classes</a> 
    </div>
    <h1>Students.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
	<hr>
     <div class="row-fluid">
      <?php echo message(); ?>
       <div class="widget-box">
         <div class="widget-title">
            <span class="icon"><i class="icon-user"></i></span>
            <h5>Student profile</h5>
         </div><!--title-->
         <div class="widget-content nopadding">

            <form action="edit.php?class=<?php echo urlencode($current_class["id"]);?>" method="POST" class="form-horizontal">
              <!--class-->
                <div class="control-group">
                      <label class="control-label">CLASS :</label>
                    <div class="controls">
                        <input type="text" name="class" value="<?php echo htmlentities($current_class["class"]);?>" class="span11"/>
                      </div>
                  </div><!--control-group-->


                  <!--stream-->
                  <div class="control-group">
                    <label class="control-label">STREAM :</label>
                    <div class="controls">
                    <input type="text" name="stream" value="<?php echo htmlentities($current_class["stream"]);?>" class="span11"/>
                    </div>
                  </div><!--control-group-->

                  <!--photo-->
                  <div class="control-group">
                    <label class="control-label">CLASS TEACHER :</label>
                    <div class="controls">
                       <input type="text" name="class_teacher" value="<?php echo htmlentities($current_class["teacher"]);?>" class="span11" placeholder="Enter the class teacher..." />
                    </div>
                  </div><!--control-group-->

                  <div class="form-actions">
                      <button name="submit" type="submit" class="btn btn-success">
                      <i class="icon-download-alt"></i> Update
                      </button>

                      <a href="../classes.php" class="btn btn-danger">
                      <i class="icon-exclamation-sign"></i> Cancel
                      </a>
                  </div>


            </form>
        </div><!--widget-content-->
       </div><!--widget-box-->

       <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>

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
                        <a href="../students/students.php?class=<?php echo urlencode($classes["id"]);?>">
                          <span class="icon">
                            students <i class="icon-user-md"></i>
                          </span>
                        </a>
                    </td>

                  
                      
                    </tr>
                    <?php } ?>
                  <?php mysqli_free_result($classes_set); ?>
                    
                  </tbody>
                  
               </table>
            </div><!--widget-content tab-content nopadding-->
          </div>
        </div><!--Widget-Box-->
     </div><!--row-fluid-->
  </div><!--container-fluid-->
</div><!--container-->
<?php include'../../../../includes/system/footer.php'; ?>