<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/fee_function.php'; ?>
<?php if(isset($_GET['cat'])){
	$current_cat = find_expense_by_id($_GET['cat']);
} ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?> 
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="../../home.php" title="Go to Home" class="tip-bottom">
			<i class="icon-home"></i> Home</a>
			<a href="expenses.php" class="current">Expense</a> 
		</div>
		<h1>Expenses.</h1>
	</div><!--content-header-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<?php $layout_context = $_SESSION['usertype']; ?>
				<?php if($layout_context == 'Admin'){?>
			<?php echo message(); ?>
				<?php } ?>
			<?php if (isset($_POST["add"])) { ?>
				<div class="widget-box">
					<div class="widget-content">
						<form action="expenses/new_expense.php" method="POST" class="form-horizontal">
     
			              	<div class="control-group">
			                  <label class="control-label">EXPENSE :</label>
			                  <div class="controls">
			                      <input type="text" name="expense" class="span11" placeholder="Enter the expense.." >
			                    </div>
			                </div><!--control-group-->

			                <div class="control-group">
			                  <label class="control-label">DESCRIPTION :</label>
			                  <div class="controls">
			                     <textarea name="description" placeholder="Enter description of the stated expense" class="span11">

								 </textarea>
			                  </div>
			                </div><!--control-group-->

							<div class="control-group">
								<label class="control-label">YEAR :</label>
								<div class="controls">
									<input type="text" name="year" class="span11" placeholder="Enter the expense year.." >
								</div>
							</div><!--control-group-->


			                <div class="form-actions">
			                    <button name="submit" type="submit" class="btn btn-success">
			                    <i class="icon-download-alt"></i> Save
			                    </button>
			                </div>


			            </form>
					</div><!--widget-content-->
				</div>
			<?php }elseif(isset($_POST['edit'])){?>
				<div class="widget-box">
					<div class="widget-content">
						<form action="expenses/edit.php?cat=<?php echo urlencode($current_cat['id']); ?>" method="POST" class="form-horizontal">

							<div class="control-group">
								<label class="control-label">EXPENSE :</label>
								<div class="controls">
									<input type="text" value="<?php echo htmlentities($current_cat['expense']); ?>" name="expense" class="span11" placeholder="Enter the expense.." >
								</div>
							</div><!--control-group-->

							<div class="control-group">
								<label class="control-label">DESCRIPTION :</label>
								<div class="controls">
			                     <textarea name="description" placeholder="Enter description of the stated expense" class="span11">
									<?php echo htmlentities($current_cat['description']); ?>
								 </textarea>
								</div>
							</div><!--control-group-->

							<div class="control-group">
								<label class="control-label">YEAR :</label>
								<div class="controls">
									<input type="text" name="year" value="<?php echo htmlentities($current_cat['year']); ?>" class="span11" placeholder="Enter the expense year.." >
								</div>
							</div><!--control-group-->


							<div class="form-actions">
								<button name="submit" type="submit" class="btn btn-success">
									<i class="icon-download-alt"></i> UPDATE
								</button>
							</div>


						</form>
					</div><!--widget-content-->
				</div>
			<?php } ?>
				<!--table-->
				<div class="widget-box">
					<div class="widget-title"> 
		        		<span class="icon"> 
		        			<i class="icon-align-justify"></i> 
		        		</span>
						<?php if($layout_context == 'Admin'){?>
		        		<span class="icon_right">
		        			<form action="expenses.php" method="POST">
		        				<button type="submit" name="add" class="btn btn-mini btn-success">
		        					<i class="icon-plus"></i> ADD
		        				</button>

		        				<a href="" class="btn btn-mini btn-default"><i class="icon-refresh"></i></a>
		        			</form>
		        			
		        		</span>
						<?php } ?>
		        		<h5>Expenses</h5>
	        		</div><!--widget title-->
	        		<div class="widget-content nopadding">
	        			
	     				<table class="table table-bordered table-striped">
	     					<thead>
	     						<tr>
	     							<th>EXPENSES</th>
									<th>DESCRIPTION</th>
									<th>YEAR</th>
									<th>VIEW</th>
									<?php if($layout_context == 'Admin'){?>
	     								<th>ACTIONS</th>
									<?php } ?>
	     						</tr>
	     					</thead>
	     					<?php $expense_set = find_all_exp_cat(); ?>
	     					<?php 
	     					while($expense = mysqli_fetch_assoc($expense_set)){ 
	     					?>
	     					<tbody>
	     						<tr>
	     							<td>
										<?php echo htmlentities($expense["expense"]);?>
	     							</td>

	     							<td>
	     						<?php echo htmlentities($expense["description"]);?>
	     							</td>

									<td>
										<?php echo htmlentities($expense["year"]);?>
									</td>

									<td>
										<div class="fr">
											<a href="expenses/expense.php?cat=<?php echo urlencode($expense['id']); ?>" class="btn btn-mini btn-info">
												<i class="icon-filter"></i> View
											</a>
										</div>
									</td>

									<?php if($layout_context == 'Admin'){?>
	     							<td>
	     								<div class="fr">
											<form action="expenses.php?cat=<?php echo urlencode($expense['id']); ?>" method="post" class="form-horizontal">
												<button type="submit" name="edit" class="btn btn-primary btn-mini">
													<i class="icon-edit"></i>
												</button>

												<a href="expenses/delete.php?cat=<?php echo urlencode($expense['id']); ?>" onclick= "return confirm('Are you Sure..?!');" class="btn btn-danger btn-mini">
													<i class="icon-trash"></i>
												</a>
											</form>
                       					</div>
	     							</td>
									<?php } ?>
	     						</tr>
	     					</tbody>
	     					<?php } ?>
	     					<?php mysqli_free_result($expense_set); ?>
	     				</table>

	        		</div><!--widget-content nopadding-->
	        	</div><!--widget box-->
			</div><!--span12-->
		</div><!--row-fluid-->
	</div><!--container-fluid-->
</div><!--content-->
<?php include '../../../includes/system/form_footer.php'; ?>