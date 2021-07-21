<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/fee_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php $layout_context = $_SESSION['usertype']; ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?> 
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> 
			<a href="../../home.php" title="Go to Home" class="tip-bottom">
				<i class="icon-home"></i> Home
			</a>
			<a href="payments.php" class="current">Payments</a> 
		</div>
		<h1>Fee Payments.</h1>
	</div><!--content-header-->
	<div class="container-fluid"><hr>
		<div class="row-fluid">
			<div class="span12">
				<?php if($layout_context == 'Admin'){?>
					<?php echo message(); ?>
				<?php } ?><!--table-->
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<a href="payments.php" class="btn btn-mini btn-default">
								<i class="icon-refresh"></i>
							</a>
						</span>

						<!--<div id="search">
							<form action="payments.php" method="post">
								<input type="text" name="search" placeholder="Search here..."/>
								<button name="lookup" type="submit" class="tip-bottom">
									<i class="icon-search icon-white"></i>
								</button>
							</form>
						</div>-->
						<h5>Fee payments</h5>
					</div><!--widget title-->

<div class="widget-content nopadding">
              <?php echo message(); ?>
              <table class="table table-bordered data-table">
                <thead>
					<tr>
                        <th>REGISTRATION</th>
                        <th>SURNAME</th>
                        <th>FULLNAMES</th>
                        <th>CLASS</th>
                        <th>TERM</th>
                        <th>FEE TYPE</th>
                        <th>PAYMENTS</th>
                        <th>PAID AMOUNT</th>
                        <th>BALANCE</th>
                        <th>ACTION</th>
                        <th>ACTION</th>							
                     </tr>
				</thead>
                <?php if(isset($_POST['lookup'])){?>
					<?php
						$search = mysqli_sec($_POST['search']);
						$search_results_set = find_all_payments_search($search);
					?>
					<?php if(mysqli_num_rows($search_results_set) > 0){?>
					<?php while($search_results = mysqli_fetch_assoc($search_results_set)){?>
                <tbody>
										<tr>
											<td><?php echo htmlentities($search_results['registration']);?></td>
											<td><?php echo htmlentities($search_results['surname']);?></td>
											<td><?php echo htmlentities($search_results['fullnames']); ?></td>
											<td><?php echo htmlentities($search_results['class']); ?></td>
											<td><?php echo htmlentities($search_results['term']); ?></td>
											<td><?php echo htmlentities($search_results['type']); ?></td>
											<td><?php echo htmlentities($search_results['status']); ?></td>
											<td><?php echo htmlentities($search_results['paid']); ?></td>
											<?php// $bal = (int)$search_results['amount'] - (int)$search_results['paid'];  ?>
											<td><?php echo htmlentities($search_results['balance']); ?></td>
                                            <td>
                                            	<a href="payments/edit.php?payments=<?php echo urlencode($search_results['id']) ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you Sure..?!');">
													EDIT <i class='icon-trash'></i>
												</a>
                                            </td>
											<td>
												<a href="payments/delete.php?payments=<?php echo urlencode($search_results['id']) ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you Sure..?!');">
													DELETE <i class='icon-trash'></i>
												</a>
											</td>
										</tr>
										</tbody>
<?php } ?>
									<?php mysqli_free_result($search_results_set); ?>
								<?php }else{ $_SESSION['error_message'] = 'No results were found'; }?>
							<?php }else{?>
								<tbody>
								<?php $payment_set = find_all_payments(); ?>
								<?php while($payments = mysqli_fetch_assoc($payment_set)){?>
									<tr>
										<td><?php echo htmlentities($payments['registration']); ?></td>
										<td><?php echo htmlentities($payments['surname']); ?></td>
										<td><?php echo htmlentities($payments['fullnames']); ?></td>
										<td><?php echo htmlentities($payments['class']); ?></td>
										<td><?php echo htmlentities($payments['term']); ?></td>
										<td><?php echo htmlentities($payments['type']); ?></td>
										<td><?php echo htmlentities($payments['status']); ?></td>
										<td><?php echo htmlentities($payments['paid']); ?></td>
										<td><?php echo htmlentities($payments['balance']); ?></td>
                                        <td>
                                            	<a href="payments/edit.php?payments=<?php echo urlencode($payments['id']) ?>" class="btn btn-mini btn-primary";>
													EDIT <i class='icon-edit'></i>
												</a>
                                            </td>
										<td>
											<a href="payments/delete.php?payments=<?php echo urlencode($payments['id']) ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you Sure..?!');">
												DELETE <i class='icon-trash'></i>
											</a>
										</td>
									</tr>
								<?php } ?>
								<?php mysqli_free_result($payment_set); ?>
								</tbody>
							<?php } ?>

              </table><!--table table-bordered data-table-->
            </div><!--widget-content nopadding-->
					
				</div><!--widget box-->
			</div><!--span12-->
		</div><!--row-fluid-->
	</div><!--container-fluid-->
</div><!--content-->
<?php include '../../../includes/system/alt_footer.php'; ?>