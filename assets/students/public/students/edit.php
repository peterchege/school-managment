<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php $current_fee = find_fee_by_id($_GET["fee"]); ?>
<?php
	if(!$current_fee){
    	//student id doesnot exist 
    	redirect_to('../students.php');
  	}
?>
<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
   $required_fields = array("fee", "status", "expected_amount", "paid_amount", "balance", "term", "year");
    validate_presences($required_fields);

  //check whether there was any errors
  if(empty($errors)){
    //get objects from the form 
     //this is the path to store the uploaded image 
    
    //3. get objects info from the form 
	$id = $current_fee["id"];
	$fee = mysqli_sec($_POST["fee"]);
	$status = mysqli_sec($_POST["status"]);
	$expected_amount = mysqli_sec($_POST["expected_amount"]);
	$paid_amount = mysqli_sec($_POST["paid_amount"]);
	$balance = mysqli_sec($_POST["balance"]);
	$term = mysqli_sec($_POST["term"]);
	$year = mysqli_sec($_POST["year"]);

	    //perform the update query 
    $query = "UPDATE students_pay SET ";
    $query .= "fee_type= '{$fee}', pay_status= '{$status}', ";
    $query .= "exp_amount= '{$expected_amount}', paid_amount= '{$paid_amount}', ";
    $query .= "balance= '{$balance}', term= '{$term}', year= '{$year}' ";
    $query .= "WHERE id= {$id} ";
    $query .= "LIMIT 1";
    $results = mysqli_query($connection, $query);

    //check whether the query took place
    if($results && mysqli_affected_rows($connection)==1){
      //it was successfull 
      $_SESSION["message"]= "Student fee type update was successfull";
      redirect_to("payments.php?student=". urlencode($current_fee["student_adm"]));

    }else{
      //update has failed
      $_SESSION["error_message"]= "There was an error in updating the student fee type";

    }

  }
}else{
  //form has not been submitted
  //probably a get request 
}


?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="../students.php" class="current">students </a> 
    </div>
    <h1><a href="../payments/payments.php?student=<?php echo urlencode($current_fee["student_adm"]); ?>" class="btn btn-default"><i class="icon-arrow-left"></i></a>Student payments.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
   	<hr/>
  	<div class="row-fluid">
      <div class="span12">
      <?php echo message(); ?>
      <?php echo form_errors(errors()); ?>
         <div class="widget-box">
           <div class="widget-title">
              <span class="icon"><i class="icon-user"></i></span>
              <h5>Add fee type</h5>
           </div><!--title-->
           <div class="widget-content nopadding">
              <form action="edit.php?fee=<?php echo urlencode($current_fee["id"]); ?>" method="POST" class="form-horizontal">
                <!--class-->
                <div class="control-group">
                    <label class="control-label">FEE TYPE :</label>
                    <div class="controls">
                        <input type="text" name="fee" class="span11" placeholder="Enter fee type.." value="<?php echo htmlentities($current_fee["fee_type"]); ?>">
                      </div>
                  </div><!--control-group-->


                  <!--stream-->
                  <div class="control-group">
                    <label class="control-label">PAYMENTS STATUS :</label>
                    <div class="controls">
                      <select name="status" class="span11">
                        <option
                        <?php 
                        	if($current_fee["pay_status"] == 'PAID'){
                        		echo "selected";
                        	}

                        ?>
                        >PAID</option>

                        <option
                        <?php 
                        	if($current_fee["pay_status"] == 'HALF PAID'){
                        		echo "selected";
                        	}

                        ?>

                        >HALF PAID</option>

                        <option
                        <?php 
                        	if($current_fee["pay_status"] == 'NOT PAID'){
                        		echo "selected";
                        	}

                        ?>
                        >NOT PAID</option>

                      </select>
                    </div>
                  </div><!--control-group-->

                  <!--photo-->
                  <div class="control-group">
                    <label class="control-label">EXPECTED AMOUNT :</label>
                    <div class="controls">
                       <input type="text" name="expected_amount" class="span11" placeholder="Enter the expected amount to paid.. " value="<?php echo htmlentities($current_fee["exp_amount"]); ?>">
                    </div>
                  </div><!--control-group-->

                  <div class="control-group">
                    <label class="control-label">PAID AMOUNT :</label>
                    <div class="controls">
                       <input type="text" name="paid_amount" class="span11" placeholder="Enter the amount paid..." value="<?php echo htmlentities($current_fee["paid_amount"]); ?>">
                    </div>
                  </div><!--control-group-->

                  <div class="control-group">
                    <label class="control-label">BALANCE :</label>
                    <div class="controls">
                       <input type="text" name="balance" class="span11" placeholder="Enter remaining balance..." value="<?php echo htmlentities($current_fee["balance"]); ?>">
                    </div>
                  </div><!--control-group-->

                   <div class="control-group">
                    <label class="control-label">ACADEMIC TERM :</label>
                    <div class="controls">
                       <input type="text" name="term" class="span11" placeholder="Enter current term..." value="<?php echo htmlentities($current_fee["term"]); ?>">
                    </div>
                  </div><!--control-group-->

                   <div class="control-group">
                    <label class="control-label">ACADEMIC YEAR :</label>
                    <div class="controls">
                       <input type="text" name="year" class="span11" placeholder="Enter the current academic year..." value="<?php echo htmlentities($current_fee["year"]); ?>">
                    </div>
                  </div><!--control-group-->

                  <div class="form-actions">
                      <button name="submit" type="submit" class="btn btn-success">
                      <i class="icon-download-alt"></i> Update
                      </button>

                      <a href="../payments/payments.php?student=<?php echo urlencode($current_fee["student_adm"]); ?>" class="btn btn-danger">
                      <i class="icon-exclamation-sign"></i> Cancel
                      </a>
                  </div>


              </form>
          </div><!--widget-content-->
       </div><!--widget-box-->
     </div><!--row-fluid-->
  </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include '../../../../includes/system/footer.php'; ?>