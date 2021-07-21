<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../include/admin_function.php'; ?>
<?php confirm_other_folder_logged_in(); ?>

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
                <?php echo message(); ?>
                <?php if (isset($_POST["add"])) { ?>
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <form action="new_student.php?interview=<?php echo urlencode($current_interview_id["id"]); ?>" method="POST" class="form-horizontal">
                            <!--class-->
                            <div class="control-group">
                                <label class="control-label">SURNAME :</label>
                                <div class="controls">
                                    <input type="text" name="surname" class="span11" placeholder="Enter the students surname.." />
                                </div>
                            </div><!--control-group-->

                            <!--stream-->
                            <div class="control-group">
                                <label class="control-label">FULLNAMES :</label>
                                <div class="controls">
                                    <input type="text" name="fullnames" class="span11" placeholder="Enter the students fullnames.." />
                                </div>
                            </div><!--control-group-->

                            <!--photo-->
                            <div class="control-group">
                                <label class="control-label">AGE :</label>
                                <div class="controls">
                                    <input type="text" name="age" class="span11" placeholder="Enter the students age." />
                                </div>
                            </div><!--control-group-->

                            <div class="control-group">
                                <label class="control-label">GENDER :</label>
                                <div class="controls">
                                    <input type="text" name="gender" class="span11" placeholder="Enter the students gender.." />
                                </div>
                            </div><!--control-group-->

                            <div class="control-group">
                                <label class="control-label">CLASS :</label>
                                <div class="controls">
                                    <input type="text" name="class" class="span11" placeholder="Enter the students class.." />
                                </div>
                            </div><!--control-group-->

                            <div class="form-actions">
                                <button name="submit" type="submit" class="btn btn-success">
                                    <i class="icon-download-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div><!--widget-content-->
                </div><!--widget-box-->
                <?php } ?>

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"> <i class="icon-list"></i> </span>
                        <?php $layout_context = $_SESSION['usertype']; ?>
                        <?php if($layout_context == 'Admin'){ ?>
                            <span class="icon_right">
                                <form action="students.php?interview=<?php echo urlencode($current_interview_id['id']); ?>" method="post" class="form-horizontal">
                                    <a href="" class="btn btn-mini btn-refresh">
                                        <i class="icon-refresh"></i>
                                    </a>

                                    <button type="submit" name="add" class="btn btn-mini btn-success">
                                        <i class="icon-plus"></i>
                                    </button>
                                </form>
                            </span>
                        <?php } ?>
                        <span class="icon_right">
                            <a href="../interviews/profile.php?interview=<?php echo urlencode($current_interview_id["id"]); ?>" class="btn btn-mini btn-warning">
                                <i class="icon-arrow-left"></i> INTERVIEW
                            </a>
                        </span>

                        <span class="icon_right">
                            <a href="../interviews.php" class="btn btn-mini btn-danger">
                                <i class="icon-exclamation-sign"></i> BACK
                            </a>
                        </span>

                        <h5>students taking interview</h5>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>SURNAME</th>
                                <th>FULLNAMES</th>
                                <th>AGE</th>
                                <th>GENDER</th>
                                <th>CLASS</th>
                                <th>PAID</th>
                                <th>BALANCE</th>
                                <th>STATUS</th>
                                <th>PAYMENTS</th>
                                <th>REVIEW</th>
                                <?php if($layout_context == 'Admin'){ ?>
                                    <th>ACTIONS</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <?php $students_set = find_students_doing_interview($current_interview_id["id"]);  ?>
                            <?php while ($students = mysqli_fetch_assoc($students_set)) { ?>
                            <tbody>
                            <tr>
                                <td><?php echo htmlentities($students["surname"]); ?></td>
                                <td><?php echo htmlentities($students["fullnames"]); ?></td>
                                <td><?php echo htmlentities($students["age"]); ?></td>
                                <td><?php echo htmlentities($students["gender"]); ?></td>
                                <td><?php echo htmlentities($students["class"]); ?></td>
                                <td><?php echo htmlentities($students["paid"]); ?></td>
                                <td><?php echo htmlentities($students["balance"]); ?></td>
                                <td><?php echo htmlentities($students["status"]); ?></td>
                                <td>
                                    <form action="payments.php" method="post" class="form-horizontal">
                                        <button type="submit" name="pay" class="btn btn-mini btn-primary">
                                            <i class="icon-money"></i> PAY
                                        </button>
                                    </form>
                                </td>
                                <td><a href="students.php?interview=<?php echo urlencode($current_interview_id['id']); ?>" class="btn btn-mini btn-link">
                                        <i class="icon-envelope-alt"></i> INT
                                    </a></td>
                                <?php if($layout_context == 'Admin'){ ?>
                                    <td>
                                        <a href="edit_student.php?student=<?php echo urlencode($students["id"]); ?>" class="btn btn-mini btn-info">
                                            <i class="icon-edit"></i>
                                        </a>

                                        <a href="delete_student.php?student=<?php echo urlencode($students["id"]); ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure!..')">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div><!--widget-content-->
                </div><!--widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<?php include '../../../../includes/system/footer.php'; ?>


