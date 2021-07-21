<?php require_once'../../../../includes/initialization.php';?>
<?php require_once '../../includes/transport_function.php'; ?>
<?php 
   $current_transport = find_fee_by_id($_GET["transport"]); 
  if(!$current_transport){
    //student id doesnot exist 
    redirect_to('../transport.php');
}
?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
     $required_fields = array("vehicle");
    validate_presences($required_fields);

    if(empty($errors)){
       //3. get objectes and store them to variables
      $id = $current_transport["id"];
      $vehicle= mysqli_sec($_POST["vehicle"]);
      $plate_number= mysqli_sec($_POST["plate_number"]);
      $route= mysqli_sec($_POST["route"]);
      $amount= mysqli_sec($_POST["amount"]);

       //perform insertion query 
      $query = "UPDATE transport SET ";
      $query .= "vehicle= '{$vehicle}', plate= '{$plate_number}', ";
      $query .= "route= '{$route}', amount= '{$amount}' ";
      $query .= "WHERE id= {$id} ";
      $query .= "LIMIT 1";
      $results = mysqli_query($connection, $query);

       if($results && mysqli_affected_rows($connection)==1){
         //successfull
        $_SESSION["message"] = "You have successfully updated a class";
        redirect_to("../transport.php");
       }else{
         //failed
        $_SESSION["error_message"] = "There was aproblem in adding a class to the student";
       }

    }

  }else{
    //there was a problem during submission
  }
    
?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav();; ?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="../transport.php" class="current">Transportation</a> 
    </div>
    <h1>Transportation schedule.</h1>
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

           <form action="edit.php?transport=<?php echo urlencode($current_transport["id"]); ?>" method="POST" class="form-horizontal">
              <!--vehicle-->
              <div class="control-group">
                    <label class="control-label">VEHICLE TYPE :</label>
                  <div class="controls">
                      <input type="text" name="vehicle" class="span11" placeholder="Enter vehicle type.." value="<?php echo htmlentities($current_transport["vehicle"]); ?>" >
                    </div>
                </div><!--control-group-->


                <!--plate-->
                <div class="control-group">
                  <label class="control-label">PLATE NUMBER :</label>
                  <div class="controls">
                  <input type="text" name="plate_number" class="span11" placeholder="Enter the vehicle plate number.." value="<?php echo htmlentities($current_transport["plate"]); ?>" >
                  </div>
                </div><!--control-group-->

                <!--route-->
                <div class="control-group">
                  <label class="control-label">ROUTE :</label>
                  <div class="controls">
                     <input type="text" name="route" class="span11" placeholder="Enter the route the vehicle suppose to take..." value="<?php echo htmlentities($current_transport["route"]); ?>">
                  </div>
                </div><!--control-group-->

                 <!--amount-->
                <div class="control-group">
                  <label class="control-label">FEE :</label>
                  <div class="controls">
                     <input type="text" name="amount" class="span11" placeholder="Enter the total transportation fee..." value="<?php echo htmlentities($current_transport["amount"]); ?>">
                  </div>
                </div><!--control-group-->


                <div class="form-actions">
                    <button name="submit" type="submit" class="btn btn-success">
                    <i class="icon-download-alt"></i> Update
                    </button>

                    <a href="../transport.php" class="btn btn-danger">
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

