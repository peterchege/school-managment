<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../include/admin_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="interviews.php" class="current">Interviews</a>
        </div>
        <h1>Students Interview.</h1>
    </div><!--content-header-->

    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php echo message(); ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-list"></i>
                        </span>
                        <?php $layout_context = $_SESSION['usertype']; ?>
                        <?php if($layout_context == 'Admin'){ ?>
                            <span class="icon_right">
                                <a href="interviews/new_interview.php" class="btn btn-mini btn-success">
                                    <i class="icon-plus"></i>
                                </a>
                            </span>
                        <?php } ?>
                        <h5>All interviews</h5>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-striped with-check">
                            <thead>
                            <tr>
                                <th>DAY</th>
                                <th>DATE</th>
                                <th>CLASS</th>
                                <th>STARTING - ENDING TIME</th>
                                <th>VIEW</th>
                                <th>STUDENTS <i class="icon-user"></i></th>
                            </tr>
                            </thead>

                            <?php $interview_set= find_all_interviews(); ?>
                            <?php while($interview= mysqli_fetch_assoc($interview_set)){?>
                                <tbody>
                                <tr>
                                    <td><?php echo htmlentities($interview["day"]); ?></td>
                                    <td><?php echo htmlentities($interview["int_date"]); ?></td>
                                    <td><?php echo htmlentities($interview["class"]); ?></td>
                                    <td><?php echo htmlentities($interview["start_time"]); ?> - <?php echo htmlentities($interview["end_time"]) ?></td>
                                    <td>
                                        <span class="profile">
                                            <a href="interviews/profile.php?interview=<?php echo urlencode($interview["id"]); ?>" class="btn-link">
                                                open <i class="icon-folder-open"></i>
                                            </a>
                                        </span>
                                    </td>

                                    <td>
                                        <div class="fr">
                                            <a href="students/students.php?interview=<?php echo htmlentities($interview['id']); ?>" class="btn btn-mini btn-primary">
                                                view
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            <?php } ?>
                            <?php mysqli_free_result($interview_set); ?>
                        </table>
                    </div><!--widget-content-->
                </div><!---widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../includes/system/footer.php'; ?>