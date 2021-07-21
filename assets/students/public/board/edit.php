<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php 
   $current_student = find_board_by_id($_GET["board"]); 
  if(!$current_student){
    //student id doesnot exist 
    redirect_to('../board.php');
}
?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("registration", "surname", "fullnames", "gender", "class", "position");
    validate_presences($required_fields);

    if(empty($errors)){
      //3. get objectes and store them to variables
      $id = $current_student["id"];
      $registration= mysqli_sec($_POST["registration"]);
      $surname= mysqli_sec($_POST["surname"]);
      $fullnames= mysqli_sec($_POST["fullnames"]);
      $gender= mysqli_sec($_POST["gender"]);
      $class= mysqli_sec($_POST["class"]);
      $stream= mysqli_sec($_POST["stream"]);
      $position= mysqli_sec($_POST["position"]);

       //perform insertion query 
      $query = "UPDATE student_board SET ";
      $query .= "registration= '{$registration}', surname= '{$surname}', ";
      $query .= "fullnames= '{$fullnames}', gender= '{$gender}', ";
      $query .= "class= '{$class}', stream= '{$stream}', ";
      $query .= "position= '{$position}' ";
      $query .= "WHERE id= {$id} ";
      $query .= "LIMIT 1";
      $results = mysqli_query($connection, $query);

       if($results && mysqli_affected_rows($connection)==1){
         //successfull
        $_SESSION["message"] = "You have successfully updated a student information";
        redirect_to("../board.php");
       }else{
         //failed
        $_SESSION["error_message"] = "There was aproblem in trying to update student information";
       }

    }

  }else{
    //there was a problem during submission
  }
    
?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo navigation_nav(); ?>

<div id="content">
 <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="../board.php" class="current">students board</a> 
    </div>
    <h1>Students.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
  <hr>
     <div class="row-fluid">
      <div class="span12">
      <?php echo message(); ?>
       <div class="widget-box">
         <div class="widget-title">
            <span class="icon"><i class="icon-user"></i></span>
            <h5>Transportation</h5>
         </div><!--title-->
         <div class="widget-content nopadding">

         <form action="edit.php?board=<?php echo urlencode($current_student["id"]); ?>" method="POST" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">REGISTRATION # :</label>
              <div class="controls">
                <input type="text" name="registration" class="span11" placeholder="Enter the registration number" value="<?php echo htmlentities($current_student["registration"]); ?>">
              </div>
            </div><!--control-group-->


                <!--plate-->
            <div class="control-group">
              <label class="control-label">SURNAME :</label>
              <div class="controls">
                <input type="text" name="surname" class="span11" placeholder="Enter students surname" value="<?php echo htmlentities($current_student["surname"]); ?>">
              </div>
            </div><!--control-group-->

                <!--route-->
            <div class="control-group">
              <label class="control-label">FULLNAMES :</label>
              <div class="controls">
                <input type="text" name="fullnames" class="span11" placeholder="Enter students fullnames" value="<?php echo htmlentities($current_student["fullnames"]); ?>">
              </div>
            </div><!--control-group-->

                 <!--amount-->
            <div class="control-group">
              <label class="control-label">GENDER :</label>
              <div class="controls">
                <select name="gender">
                  <option
                  <?php 
                    if ($current_student["gender"] == 'MALE') {
                      echo "selected";
                    }
                  ?>
                  >MALE</option>
                  <option
                     <?php 
                    if ($current_student["gender"] == 'FEMALE') {
                      echo "selected";
                    }
                  ?>
                  >FEMALE</option>
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
                <input type="text" name="position" class="span11" placeholder="Enter students position" value="<?php echo htmlentities($current_student["position"]); ?>">
              </div>
            </div><!--control-group-->


            <div class="form-actions">
              <button name="submit" type="submit" class="btn btn-success">
                <i class="icon-download-alt"></i> Update
              </button>
              <a href="../board.php" class="btn btn-danger">
                <i class="icon-exclamation-sign"></i> Cancel
              </a>
            </div>
          </form>
        </div><!--widget-content-->
       </div><!--widget-box-->
       </div>
     </div><!--row-fluid-->

  </div><!--container-fluid-->
</div><!--container-->
<?php include '../../../../includes/system/footer.php'; ?>

