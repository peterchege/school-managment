<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php 
$current_structure = find_structure_by_id($_GET["structure"]);
if(!$current_structure){
	//id doesnot exist
	redirect_to("../structure.php");
}

?>
<?php 
	//1. confirm that the form has been submitted
	if(isset($_POST["submit"])){
		//submission was successfull 
		//2. validate the form 
		$required_fields = array("type", "options", "school", "year");
		validate_presences($required_fields);

		//check whether there was any errors 
		if(empty($errors)){
			//there was  no error get store objects in variables
			//2. store objects in variables
			$id = $current_structure["id"];
			$fee_type = mysqli_sec($_POST["type"]);
			$options = mysqli_sec($_POST["options"]);
			$amount = mysqli_sec($_POST["amount"]);
			$school = mysqli_sec($_POST["school"]);
			$term = mysqli_sec($_POST["term"]);
			$year = mysqli_sec($_POST["year"]);

			//3. perform insertion query 
			$query = "UPDATE fee_structure SET ";
			$query .= "type ='{$fee_type}', options = '{$options}', ";
			$query .= "amount = '{$amount}', school= '{$school}', ";
			$query .= "term = '{$term}', year = '{$year}' ";
			$query .= "WHERE id= {$id} ";
			$query .= "LIMIT 1";
			$results = mysqli_query($connection, $query);

			//confirm if the query took place
			if($results && mysqli_affected_rows($connection) == 1){
				$_SESSION["message"] = "You have successfully updated the structure";
				redirect_to("../structure.php");
			}else{
				//failure
				$_SESSION["error_message"] = "There was a problem in updating the fee structure";
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

		        		<h5>Update Structure</h5>
	        		</div><!--widget title-->

	        		<div class="widget-content nopadding">
	        			
        			<form action="edit.php?structure=<?php echo urlencode($current_structure["id"]); ?>" method="POST" class="form-horizontal">
       
        				<div class="control-group">
							<label class="control-label">FEE TYPE :</label>
							<div class="controls">
								<select name="type" class="span11">
									<option>
										<?php echo htmlentities($current_structure['type']); ?>
									</option>

									<?php $feetype_set = find_all_fees(); ?>
									<?php while($feetype = mysqli_fetch_assoc($feetype_set)){ ?>
										<option>
											<?php echo htmlentities($feetype['type']); ?>
										</option>
									<?php } ?>
									<?php mysqli_free_result($feetype_set); ?>
								</select>

							</div><!--controls-->
    		 			</div><!--control-group-->

    		 			<div class="control-group">
							<label class="control-label">PAYMENTS OPTIONS :</label>
							<div class="controls">
								<select name="options" class="span11">
									<option
										<?php
										if($current_structure['options'] == 'ONCE'){
											echo 'selected';
										}
										?>
										>ONCE</option>

									<option
										<?php
										if($current_structure['options'] == 'OPTIONAL'){
											echo 'selected';
										}
										?>
										>OPTIONAL</option>

									<option
										<?php
										if($current_structure['options'] == 'MUST'){
											echo 'selected';
										}
										?>>MUST</option>
								</select>
							</div><!--controls-->
						</div><!--control-group-->



    		 			<div class="control-group">
							<label class="control-label">SCHOOL :</label>
							<div class="controls">
								<select name="school" class="span11">
									<option

									<?php 
										if($current_structure["school"] == 'PRE SCHOOL'){
											echo "selected";
										}


									?>



									>PRE SCHOOL</option>

									<option

									<?php 
										if($current_structure["school"] == 'LOWER'){
											echo "selected";
										}


									?>


									>LOWER</option>

									<option

									<?php 
										if($current_structure["school"] == 'UPPER'){
											echo "selected";
										}


									?>



									>UPPER</option>
								</select>
							</div><!--controls-->
						</div><!--control-group-->

						

						<div class="control-group">
							<label class="control-label">TERM :</label>
							<div class="controls">
								<input type="text" name="term" placeholder="Enter amount should be paid in this term.." class="span11" value="<?php echo htmlentities($current_structure["term"]); ?>">
							</div><!--controls-->
						</div><!--control-group-->

						<div class="control-group">
							<label class="control-label">AMOUNT :</label>
							<div class="controls">
								<input type="text" name="amount" placeholder="Enter amount should be paid in this term.." class="span11" value="<?php echo htmlentities($current_structure["amount"]); ?>">
							</div><!--controls-->
						</div><!--control-group-->

						<div class="control-group">
							<label class="control-label">ACADEMIC YEAR :</label>
							<div class="controls">
								<input type="text" name="year" placeholder="Enter the academic year for the fee collection.." class="span11" value="<?php echo htmlentities($current_structure["year"]); ?>" >
							</div><!--controls-->
						</div><!--control-group-->

						<div class="form-actions">
							<button name="submit" type="submit" class="btn btn-success">
							<span class="icon"><i class="icon-download-alt"></i></span> Update
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

