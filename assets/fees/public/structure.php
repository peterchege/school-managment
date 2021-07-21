<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/fee_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?> 
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="../../home.php" title="Go to Home" class="tip-bottom">
			<i class="icon-home"></i> Home</a>
			<a href="structure.php" class="current">Fee Structure</a> 
		</div>
		<h1>Fee structure.</h1>
	</div><!--content-header-->
	<div class="container-fluid">
		<hr>

		<div class="row-fluid">
		  <div class="span12">
			  <?php $layout_context = $_SESSION['usertype']; ?>
			  <?php if($layout_context == 'Admin'){?>
				<?php echo message(); ?>
				<?php } ?>
			<?php 
			error_reporting(0);
			if (isset($_POST["ExSubmit"])) 
			{
				$fee_structure_set = find_all_fee_structure();
				$structure_rows = mysqli_num_rows($fee_structure_set);
				if ($structure_rows>= 1)  
				{
					$file = "exports/". strtotime(now) . ".csv";
					$fileOpen = fopen($file, "w");

					$all_structure_set = mysqli_fetch_assoc($fee_structure_set);

					$line = 0;
					foreach ($all_structure_set as $name => $value) 
					{
						$line++;
						
						if ($line < 7) {
							$label .= $name . ",";
						}else{
							$label .= $name . "\n";
						}

					}
					fputs($fileOpen, $label);
					$fee_set = find_structure_by_term_and_school($_SESSION['school'], $_SESSION['term']);
					while($fee = mysqli_fetch_assoc($fee_set))
					{
						$data=$fee["id"] .",". $fee["school"] .",".
							$fee["type"] .",". $fee["options"] .",".
							$fee["amount"] .",". $fee["term"] .",".
							$fee["year"] ."\n";

						fputs($fileOpen, $data);

					}
					echo "<div class=\"alert alert-success\">";
					echo "<button class=\"close\" data-dismiss=\"alert\">×</button>";
					echo "<strong><a href='$file'>Download.</a></strong>";
					echo "</div>";
					echo "</div>";

					
				}else{
					$_SESSION["error_message"] = "You do not have any data to export";
				}
			}else{
				//submission button was not clicked

			}

			?>


			<div class="widget-box">
				<div class="widget-content">
					<div class="controls controls-row">
					<form action="structure.php" method="POST" class="form-horizontal">
						<select name="school" class="span4 m-wrap">
							<option></option>
							<option>PLAY GROUP</option>
							<option>PRE SCHOOL</option>
							<option>LOWER</option>
							<option>UPPER</option>
							<option>CLASS 8</option>

						</select>


						<select name="term" class="span4 m-wrap">
							<option></option>
							<option>ONE</option>
							<option>TWO</option>
							<option>THREE</option>
						</select>



						<button type="submit" name="Tsubmit" class="span2 m-wrap btn btn-primary">
						<span><i class="icon-upload-alt"></i></span> submit
						</button>
					</form>
					</div><!--controls controls-row-->
				</div><!--widget-content-->
			</div>

				<!--table-->
	<?php if(isset($_POST["Tsubmit"])){ ?>
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
		    	<i class="icon-align-justify"></i>
		    </span>
			<?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){?>
		    <span class="icon_right">
				<form action="" method="POST" class="form-horizontal">
					<button name="ExSubmit" type="submit" class="btn btn-mini btn-default">
						<i class="icon-external-link"></i> EXPORT
					</button>
				</form>
		    </span>
			<span class="icon_right">
				<a href="structure/new_structure.php" class="btn btn-mini btn-info">
					<i class="icon-plus"></i> ADD
				</a>
		    </span>

			<span class="icon_right">
				<a href="" class="btn btn-mini btn-default">
					<i class="icon-refresh"></i> REFRESH
				</a>
		    </span>
			<?php } ?>
		    <h5>Fee structure</h5>
		</div>
		<div class="widget-content nopadding">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>FEE</th>
						<th>OPTIONS</th>
						<th>TERM</th>
						<th>AMOUNT</th>
						<th>SCHOOL</th>
						<?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){?>
						<th>ACTIONS</th>
						<?php } ?>
					</tr>
	     		</thead>
	     		<?php
					$school = mysqli_sec($_POST["school"]);
					$term = mysqli_sec($_POST["term"]);
					$_SESSION['school'] = mysqli_sec($_POST["school"]);
					$_SESSION['term'] = mysqli_sec($_POST["term"]);
					$info_set = find_structure_by_term_and_school($school, $term);
	     		?>
				<?php while($current_info = mysqli_fetch_assoc($info_set)){ ?>
					<tbody>
						<td><?php echo htmlentities($current_info["type"]); ?></td>
						<td><?php echo htmlentities($current_info["options"]); ?></td>
						<td><?php echo htmlentities($current_info["term"]); ?></td>
						<td><?php echo htmlentities($current_info["amount"]); ?></td>
						<td><?php echo htmlentities($current_info["school"]); ?></td>
						<?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){?>
						<td>
							<div class="fr">
								<a href="structure/edit.php?structure=<?php echo urlencode($current_info["id"]); ?>" class="btn btn-primary btn-mini">
									<i class="icon-wrench"></i>
								</a>

								<a href="structure/delete.php?structure=<?php echo urlencode($current_info["id"]); ?>" onclick= "return confirm('Are you Sure..?!');" class="btn btn-danger btn-mini">
									<i class="icon-trash"></i>
								</a>
							</div>
						</td>
						<?php } ?>
	     			</tbody>
				<?php } ?>
				<?php mysqli_free_result($info_set); ?>
			</table>
		</div><!--widget-content nopadding-->
	</div>
	<?php }else{ ?>
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
		    	<i class="icon-align-justify"></i>
		    </span>
			<?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){?>
			<span class="icon_right">
				<a href="structure/new_structure.php" class="btn btn-mini btn-info">
					<i class="icon-plus"></i> ADD
				</a>
		    </span>

			<span class="icon_right">
				<a href="" class="btn btn-mini btn-default">
					<i class="icon-refresh"></i> REFRESH
				</a>
		    </span>
			<?php } ?>
			<h5>Fee Structure</h5>
		</div>

		<div class="widget-content nopadding">
			<table class="table table-bordered table-striped">
				<thead>
				<tr>
					<th>FEE</th>
					<th>OPTIONS</th>
					<th>TERM</th>
					<th>AMOUNT</th>
					<th>SCHOOL</th>
					<?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){?>
					<th>ACTIONS</th>
					<?php } ?>
				</tr>
				</thead>
				<?php $structure_set = find_all_fee_structure();  ?>
				<?php while($structure = mysqli_fetch_assoc($structure_set)){ ?>
				<tbody>
					<td><?php echo htmlentities($structure['type']); ?></td>
					<td><?php echo htmlentities($structure['options']); ?></td>
					<td><?php echo htmlentities($structure['term']); ?></td>
					<td><?php echo htmlentities($structure['amount']); ?></td>
					<td><?php echo htmlentities($structure['school']); ?></td>
					<?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){?>
					<td>
						<div class="fr">
							<a href="structure/edit.php?structure=<?php echo urlencode($structure["id"]); ?>" class="btn btn-primary btn-mini">
								<i class="icon-wrench"></i>
							</a>

							<a href="structure/delete.php?structure=<?php echo urlencode($structure["id"]); ?>" onclick= "return confirm('Are you Sure..?!');" class="btn btn-danger btn-mini">
								<i class="icon-trash"></i>
							</a>
						</div>
					</td>
					<?php } ?>
				</tbody>
				<?php } ?>
			</table>
		</div>
	</div>
	<?php } ?>
</div><!--span12-->
</div><!--row-fluid-->
</div><!--container-fluid-->
</div><!--content-->
<?php include '../../../includes/system/footer.php'; ?>