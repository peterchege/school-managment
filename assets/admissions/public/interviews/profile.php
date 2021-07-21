<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../include/admin_function.php'; ?>
<?php confirm_other_folder_logged_in(); ?>
<?php $current_interview_id = find_interview_by_id($_GET["interview"]); ?>
<?php if(!$current_interview_id){ redirect_to("../interviews.php"); } ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo navigation_nav(); ?>
<div id="content">
	<div id="content-header">
		<div id="breadcrumb">
			<a href="../../../home.php" title="Go to Home" class="tip-bottom">
				<i class="icon-home"></i> Home
			</a>
			<a href="../interviews.php" class="current">Interviews</a>
		</div>
		<h1>Students Interview.</h1>
	</div><!--content-header-->

	<div class="container-fluid"><hr>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<?php echo message(); ?>
					<div class="widget-title">
						<span class="icon"><i class="icon-list"></i></span>
						<?php $layout_context = $_SESSION['usertype']; ?>
						<?php if($layout_context == 'Admin'){ ?>
							<span class="icon_right">
								<div class="fr">
									<a href="edit_interview.php?interview=<?php echo urlencode($current_interview_id["id"]); ?>" class="btn btn-primary btn-mini">
										<i class="icon-edit"></i>
									</a>
									<a href="delete.php?interview=<?php echo urlencode($current_interview_id["id"]); ?>" onclick= "return confirm('Are you Sure you..?!');" class="btn btn-danger btn-mini">
										<i class="icon-trash"></i>
									</a>
								</div>
							</span>

							<span class="icon_right">
								<a href="../interviews.php" class="btn btn-warning btn-mini">
									<i class="icon-arrow-left"></i> Back
								</a>
							</span>
						<?php } ?>
						<h5>View Interview.</h5>
					</div><!--widget title-->

					<div class="widget-content nopadding">
						<ul class="recent-posts">
							<li>
								<div class="user-thumb"> <img width="40" height="40" alt="User" src="img/demo/av1.jpg"> </div>
								<div class="article-post">
									<div class="fr">
										<div class="btn-group">
											<a href="../students/students.php?interview=<?php echo urlencode($current_interview_id["id"]); ?>" class="btn btn-info btn-mini">
												<i class="icon-group"></i> Students.
											</a>
										</div>
									</div>

									<span class="user-info"> By: <?php echo htmlentities($current_interview_id["supervisor"]) ?> / Date: <?php echo htmlentities($current_interview_id["int_date"]);?> / Time:<?php echo htmlentities($current_interview_id["start_time"]) ?> Hrs </span><br/>
									<table class="table">
										<tbody>
										<tr>
											<th>Class :</th>
											<td><?php echo htmlentities($current_interview_id["class"]) ?></td>
										</tr>

										<tr>
											<th>Venue :</th>
											<td><?php echo htmlentities($current_interview_id["venue"]) ?></td>
										</tr>

										<tr>
											<th>Day :</th>
											<td><?php echo htmlentities($current_interview_id["day"]) ?></td>
										</tr>

										<tr>
											<th>Period :</th>
											<td><?php echo htmlentities($current_interview_id["period"]) ?></td>
										</tr>

										<tr>
											<th>Starting - Ending Time :</th>
											<td><?php echo htmlentities($current_interview_id["start_time"]); ?> - <?php echo htmlentities($current_interview_id["end_time"]); ?> (in hrs)</td>
										</tr>

										<tr>
											<th>Supervisor :</th>
											<td><?php echo htmlentities($current_interview_id["supervisor"]); ?></td>
										</tr>

										<tr>
											<th>Term :</th>
											<td><?php echo htmlentities($current_interview_id["Term"]); ?></td>
										</tr>

										<tr>
											<th>Status :</th>
											<td><?php echo htmlentities($current_interview_id["status"]); ?></td>
										</tr>
										</tbody>
									</table>
								</div><!--article-post-->
							</li>
							<li></li>
						</ul>
					</div><!--widget-content nopadding-->
				</div><!--widget-box-->
			</div><!--span12-->
		</div><!--row-fluid-->
	</div><!--container-fluid-->
</div><!--content-->
<?php include'../../../../includes/system/footer.php'; ?>
