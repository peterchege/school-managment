<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php 
	//1. confirm that the form has been submitted
	if(isset($_POST["submit"])){
		//2. validate the form 
		$required_fields = array("type", "options", "school", "year");
		validate_presences($required_fields);

		//check whether there was any errors 
		if(empty($errors)){
			//there was  no error get store objects in variables
			//2. store objects in variables
			$fee_type = mysqli_sec($_POST["type"]);
			$options = mysqli_sec($_POST["options"]);
			$amount = mysqli_sec($_POST["amount"]);
			$school = mysqli_sec($_POST["school"]);
			$term = mysqli_sec($_POST["term"]);
			$year = mysqli_sec($_POST["year"]);

			//check to make sure the fee structure is not equal to transport or lunch fee
			$fee_type_set = find_all_fee_structure();
			while($fee = mysqli_fetch_assoc($fee_type_set)){
				if($fee_type == 'TRANSPORT FEE' || $fee_type == 'LUNCH FEE'){
					$_SESSION['error_message'] = 'You cannot enter the fee type on this structure';
				}else{
//					//perform insertion query
//					//3. perform insertion query
					$query = "INSERT INTO fee_structure (";
					$query .= "school, type, ";
					$query .= "options, amount, ";
					$query .= "term, year ";
					$query .= ") VALUES (";
					$query .= "'{$school}', '{$fee_type}', ";
					$query .= "'{$options}', '{$amount}', ";
					$query .= "'{$term}', '{$year}'";
					$query .= ")";
					$results = mysqli_query($connection, $query);
					//confirm if the query took place
					if($results){
						$_SESSION["message"] = "You have successfully added a new structure";
						redirect_to("../structure.php");
					}else{
						//failure
						$_SESSION["error_message"] = "There was a problem in adding a new fee structure";
					}
				}
			}
		}

	}else{

		//there was a problem in trying to submit the form 

	}

?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav();; ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="../../home.php" title="Go to Home" class="tip-bottom">
			<i class="icon-home"></i> Home</a>
			<a href="../structure.php" class="current">Fee Structure</a> 
		</div>
		<h1>Fee structure.</h1>
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
		        		<a href="../structure.php" class="btn btn-mini btn-warning" ><i class="icon-arrow-left"></i></a>	
		        		</span>

		        		<h5>New Structure</h5>
	        		</div><!--widget title-->

	        		<div class="widget-content nopadding">
	        			
        			<form action="new_structure.php" method="POST" class="form-horizontal">
       
        				<div class="control-group">
							<label class="control-label">FEE TYPE :</label>
							<div class="controls">
								<select name="type" class="span11">
									<?php $feetype_set = find_all_fees(); ?>
									<?php while($feetype = mysqli_fetch_assoc($feetype_set)){ ?>
										<option><?php echo htmlentities($feetype['type']); ?></option>
									<?php } ?>
									<?php mysqli_free_result($feetype_set); ?>
								</select>
							</div><!--controls-->
    		 			</div><!--control-group-->

    		 			<div class="control-group">
							<label class="control-label">PAYMENTS OPTIONS :</label>
							<div class="controls">
								<select name="options" class="span11">
									<option>ONCE</option>
									<option>OPTIONAL</option>
									<option>MUST</option>
								</select>
							</div><!--controls-->
						</div><!--control-group-->



    		 			<div class="control-group">
							<label class="control-label">SCHOOL :</label>
							<div class="controls">
								<select name="school" class="span11">
									<option>Play Group</option>									}
									<option>PRE SCHOOL</option>
									<option>LOWER</option>
									<option>UPPER</option>
									<option>CLASS 8</option>
								</select>
							</div><!--controls-->
						</div><!--control-group-->

						

						<div class="control-group">
							<label class="control-label">TERM  :</label>
							<div class="controls">
								<select name="term" class="span7">
									<option></option>
									<option>ONE</option>
									<option>TWO</option>
									<option>THREE</option>
								</select>
							</div><!--controls-->
						</div><!--control-group-->

						<div class="control-group">
							<label class="control-label">AMOUNT :</label>
							<div class="controls">
								<input type="text" name="amount" placeholder="Enter amount should be paid in this term.." class="span11">
							</div><!--controls-->
						</div><!--control-group-->



						<div class="control-group">
							<label class="control-label">ACADEMIC YEAR :</label>
							<div class="controls">
								<input type="text" name="year" placeholder="Enter the academic year for the fee collection.." class="span11" >
							</div><!--controls-->
						</div><!--control-group-->

						<div class="form-actions">
							<button name="submit" type="submit" class="btn btn-success">
							<span class="icon"><i class="icon-download-alt"></i></span> Save
							</button>
						</div>

        			</form>

	        		</div><!--widget-content nopadding"-->

				</div><!--widet-box-->
			</div><!--span12-->
		</div><!--row-fluid-->
	</div><!--container-fluid-->
</div><!--content-->
<?php include '../../../../includes/system/footer.php'; ?>

