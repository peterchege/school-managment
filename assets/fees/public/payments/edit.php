<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../../../includes/functions.php'; ?>
<?php require_once '../../../../includes/navigation.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php 
  $current_payments = find_payments_by_id($_GET["payments"]); 
  if(!$current_payments){
    //student id doesnot exist 
    redirect_to('../payments.php');
  }
?>
<?php 
	//1. confirm that the form has been submitted
	if(isset($_POST["submit"])){
		//submission was successfull 
		//1. validate the form 
		$required_fields = array("registration", "surname", "fullnames", "fee_type", "amount", "paid", "balance", "method");
		validate_presences($required_fields);

		//check whether there was any errors 
		if(empty($errors)){
			//there was  no error get store objects in variables
			//2. store objects in variables
			$id = $current_payments["id"];
			$registration= mysqli_sec($_POST["registration"]);
			$surname = mysqli_sec($_POST["surname"]);
			$fullnames = mysqli_sec($_POST["fullnames"]);
			$fee_type = mysqli_sec($_POST["fee_type"]);
			$amount = mysqli_sec($_POST["amount"]);
			$paid = mysqli_sec($_POST["paid"]);
			$balance = mysqli_sec($_POST["balance"]);
			$method = mysqli_sec($_POST["method"]);

			
			//3. perform insertion query
			//$sql = "INSERT INTO fee_payments (`registration`, `surname`, `fullnames`,`fee_type`, `amount`, `paid`,`balance`, `method`)
           // VALUES ('{$registration}','{$surname}','{$fullnames}','{$fee_type}','{$amount}','{$paid}','{$balance}','{$method}')";
			$query = "UPDATE fee_payments SET paid='{$paid}'  WHERE id=$id LIMIT 1";
			//$query = "UPDATE fee_payments SET ";
			//$query .= "registration= '{$registration}', surname= '{$surname}', ";
			//$query .= "fullnames= '{$fullnames}' ";
			//$query .= "fee_type= '{$fee_type}' ";
			//$query .= "amount= '{$amount}', paid= '{$paid}' ";
			//$query .= "balance= '{$balance}', method= '{$method}' ";
			//$query .= "WHERE id= {$id} ";
			//$query .= "LIMIT 1";
			$results = mysqli_query($connection, $query);

			//confirm if the query took place
			if($results && mysqli_affected_rows($connection) == 1){
				$_SESSION["message"] = "You have successfully Updated fee payments";
				redirect_to("../payments.php");
			}else{
				//failure
				$_SESSION["error_message"] = "There was a problem in updating fee payments";
			}
		}

	}else{

		//there was a problem in trying to submit the form 

	}

?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo navigation_nav();; ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="../../../../home.php" title="Go to Home" class="tip-bottom">
			<i class="icon-home"></i> Home</a>
			<a href="../payments.php" class="current">Payments</a> 
		</div>
		<h1>Fee payments.</h1>
	</div><!--content-header-->
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="span12">
				<?php echo message(); ?>
				<?php echo form_errors($errors); ?>
				<div class="widget-box">
				
					<div class="widget-title"> 
		        		<span class="icon"> 
		        			<i class="icon-align-justify"></i> 
		        		</span>

		        		<span class="icon_right"> 
		        		<a href="../payments.php" class="btn btn-mini btn-warning" ><i class="icon-arrow-left"></i></a>	
		        		</span>

		        		<h5>Update Fee Payments</h5>
	        		</div><!--widget title-->

	        		<div class="widget-content nopadding">
	        			
        			<form action="edit.php?payments=<?php echo urlencode($current_payments["id"]); ?>" method="POST" class="form-horizontal">

        				<div class="control-group">
							<label class="control-label">REGISTRATION : </label>
							<div class="controls">
								<input type="text" readonly name="registration" placeholder="Enter students registration..." value="<?php echo htmlentities($current_payments["registration"]); ?>" class="span11">
							</div><!--controls-->
						</div><!--control-group-->

						<div class="control-group">
							<label class="control-label">SURNAME :</label>
							<div class="controls">
								<input type="text" readonly name="surname" placeholder="Enter students surname..." value="<?php echo htmlentities($current_payments["surname"]); ?>" class="span11">
							</div><!--controls-->
						</div><!--control-group-->

						<div class="control-group">
							<label class="control-label">FULL NAMES :</label>
							<div class="controls">
								<input type="text" readonly name="fullnames" placeholder="Enter students fullnames..." value="<?php echo htmlentities($current_payments["fullnames"]); ?>" class="span11">
							</div><!--controls-->
						</div><!--control-group-->
       
        				<div class="control-group">
							<label class="control-label">FEE TYPE :</label>
							<div class="controls">
								<select name="fee_type" readonly class="span11">                                                                    
									<?php 
										$type_set = find_all_fee_structure();
										while($type = mysqli_fetch_assoc($type_set)){ ?>
										<option readonly value="<?php echo htmlentities($current_payments['fee_type']); ?>">
										<?php echo htmlentities($type["type"]); ?>
										</option>
										<?php }?>
									<?php mysqli_free_result($type_set); ?>
								</select>
							</div><!--controls-->
    		 			</div><!--control-group-->

    		 			<div class="control-group">
							<label class="control-label">AMOUNT :</label>
							<div class="controls">
								<input type="text" readonly name="amount" placeholder="Enter amount should be paid.." value="<?php echo htmlentities($current_payments["amount"]); ?>" class="span11">
							</div><!--controls-->
						</div><!--control-group-->

						<div class="control-group">
							<label class="control-label">PAID :</label>
							<div class="controls">
								<input type="text" name="paid" placeholder="Enter the amount the student has paid.."  value="<?php echo htmlentities($current_payments["paid"]); ?>"class="span11">
							</div><!--controls-->
						</div><!--control-group-->
					<?php $bal = (int)$current_payments["amount"] - (int)$current_payments["paid"]; ?>
						<div class="control-group">
							<label class="control-label">BALANCE : </label>
							<div class="controls">
								<input type="text" readonly name="balance" placeholder="Enter the balance remaining.." value="<?php echo $bal; ?>" class="span11">
							</div><!--controls-->
						</div><!--control-group-->

						<div class="control-group">
							<label class="control-label">PAYMENT METHOD :</label>
							<div class="controls">
								<input type="text" name="method" placeholder="Enter the method used in payments.." value="<?php echo htmlentities($current_payments["method"]); ?>" class="span11">
							</div><!--controls-->
						</div><!--control-group-->

						<div class="control-group">
							<label class="control-label">DATE : </label>
							<div class="controls">
								<div  data-date="12-02-2012" class="input-append date datepicker">
									<input type="text" value="<?php echo htmlentities($current_payments['date']); ?>" name="date"  data-date-format="mm-dd-yyyy" class="span11" >
									<span class="add-on"><i class="icon-th"></i></span> </div>
							</div>
						</div>


						<div class="form-actions">
							<button name="submit" type="submit" class="btn btn-success">
							<span class="icon"><i class="icon-download-alt"></i></span> Update
							</button>

							<a href="../payments.php" class="btn btn-danger">
							<i class="icon-exclamation-sign"></i> Cancel
							</a>
						</div>
        			</form>

	        		</div><!--widget-content nopadding"-->

				</div><!--widet-box-->
			</div><!--span12-->
		</div><!--row-fluid-->
	</div><!--container-fluid-->
</div><!--content-->
<?php include '../../../../includes/system/table_footer.php'; ?>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.toggle.buttons.js"></script>
<script src="js/masked.js"></script>
<script src="js/jquery.uniform.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.form_common.js"></script>
<script src="js/wysihtml5-0.3.0.js"></script>
<script src="js/jquery.peity.min.js"></script>
<script src="js/bootstrap-wysihtml5.js"></script>
<script>
	$('.textarea_editor').wysihtml5();
</script>
</body>
</html>

