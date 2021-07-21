<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php $current_class = find_class_for_student($_GET["student"]); ?>
<?php 
 if (isset($_POST["set"])) {
 	$student_adm = $_GET["student"];
 	$class = mysqli_sec($_POST["class"]);
 	$stream = mysqli_sec($_POST["stream"]);
 	$teacher = mysqli_sec($_POST["teacher"]);

 	$query = "INSERT INTO student_class( ";
 	$query .= "student_adm, stream, class, teacher";
 	$query .= ")VALUES(";
 	$query .= "{$student_adm}, '{$class}', ";
 	$query .= "'{$stream}', '{$teacher}'";
 	$query .= ")";
 	$results = mysqli_query($connection, $query);

 	if ($results) {
 		$_SESSION["message"] = "You have successfully set up a class for the student";
 	}else{
 		$_SESSION["error_message"] = "There was a problem in setting up the class";

 	}


 }else{
 	//there was a problem in submitting data
 }
?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo  navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="../students.php" class="current">students</a> 
    </div>
    <h1>Students.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
   <hr/>

    <div class="row-fluid">
    <div class="span12">
       <?php echo message(); ?>
       <?php if(isset($_POST["add"])){ ?>

      
        <div class="widget-box">
         <div class="widget-content nopadding">
            <form action="class.php?student=<?php echo urlencode($_GET["student"]);?>" method="POST" class="form-horizontal">
              <!--class-->
              <div class="control-group">
                    <label class="control-label">CLASS :</label>
                  <div class="controls">
                      <select name="class">
                      <option <?php echo 'selected'; ?>>Select a class..</option>
                      	<?php 
                      		$all_clases = find_all_classes();
                      		while ($classes = mysqli_fetch_assoc($all_clases)){
                      	?>
                      			<option><?php echo htmlentities($classes["class"]) ?></option>
                      	<?php } ?>
                      	<?php mysqli_free_result($all_clases); ?>
                      </select>
                    </div>
                </div><!--control-group-->


                <!--stream-->
                <div class="control-group">
                  <label class="control-label">STREAM :</label>
                  <div class="controls">
                 	<select name="stream">
                 		<option <?php echo 'selected'; ?>>Select a stream..</option>
                      	<?php 
                      		$all_streams = find_all_classes();
                      		while ($streams = mysqli_fetch_assoc($all_streams)){
                      	?>
                      			<option><?php echo htmlentities($streams["stream"]) ?></option>
                      	<?php } ?>
                      	<?php mysqli_free_result($all_streams); ?>
                 	</select>
                  </div>
                </div><!--control-group-->

                <!--photo-->
                <div class="control-group">
                  <label class="control-label">CLASS TEACHER :</label>
                  <div class="controls">
                    <select name="teacher">
                    	<option <?php echo 'selected'; ?>>Select a class teacher..</option>
                      	<?php 
                      		$all_teachers = find_all_classes();
                      		while ($teacher = mysqli_fetch_assoc($all_teachers)){
                      	?>
                      			<option><?php echo htmlentities($teacher["teacher"]) ?></option>
                      	<?php } ?>
                      	<?php mysqli_free_result($all_teachers); ?>
                    </select>
                  </div>
                </div><!--control-group-->

                <div class="control-group">
                    <button name="set" type="submit" class="btn btn-mini btn-success">
                    <i class="icon-signin"></i> Set
                    </button>

                    <a href="" class="btn btn-mini btn-default"><i class="icon-refresh"></i></a>
                </div>


            </form>
        </div><!--widget-content-->
        </div><!--Widget-Box-->	
       <?php } ?>
   		<div class="widget-box">
          <!--all students table-->
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <span class="icon_right">
            <form action="" method="POST" class="form-horizontal">
              <button type="submit" name="add" class="btn btn-mini btn-success">
                <i class="icon-plus"></i>
              </button>

              <a href="../profile.php?student=<?php echo urlencode($_GET["student"]); ?>" class="btn btn-mini btn-warning"><i class="icon-arrow-left"></i></a>
            </form>
          </span>
             <h5>set up a class for the student</h5>
          </div>
         <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th>CLASS</th>
                      <th>STREAM</th>
                      <th>CLASS TEACHER</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                      <?php echo htmlentities($current_class["class"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($current_class["stream"]); ?>
                      </td>

                      <td>
                     <?php echo htmlentities($current_class["teacher"]); ?>
                      </td> 
                    </tr>
                    
              
                    
                  </tbody>
                  
               </table>
            </div><!--widget-content tab-content nopadding-->
          </div>
        </div><!--Widget-Box-->
      </div><!--span12-->
    </div><!--row-fluid-->
   
  </div><!--container-fluid-->

 </div><!--content-->
<?php include'../../../../includes/system/footer.php'; ?>