<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/alumni_function.php'; ?>
<?php find_selected_fields(); ?>
<?php
if (!$current_alumni_id) {
    redirect_to('../alumni.php');
}
?>
<?php $upload_dir = "img/profile/"; ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="../alumni.php" class="current">Alumni </a>
        </div>
        <h1>Students.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <?php $layout_context = $_SESSION['usertype']; ?>
            <?php if($layout_context == 'Admin'){?>
                <?php echo message(); ?>
            <?php } ?>
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-user"></i>
                    </span>
                    <div class="fr">
                        <a href="../alumni.php" class="btn btn-warning btn-mini">
                            <i class="icon-arrow-left"></i> BACK
                        </a>
                        <a href="edit.php?alumni=<?php echo urlencode($current_alumni_id["id"]);  ?>" class="btn btn-info btn-mini">
                            EDIT <i class="icon-edit"></i>
                        </a>
                        <a href="delete.php?alumni=<?php echo urlencode($current_alumni_id["id"]); ?>" onclick= "return confirm('Are you Sure you..?!');" class="btn btn-danger btn-mini">
                            <i class="icon-trash"></i>
                        </a>
                    </div>
                    <h5>Student profile</h5>
                </div>
                <div class="widget-content nopadding">
                    <!--profile picture-->
                    <div class="widget-box">
                        <div class="widget-title">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab1">Personal</a></li>
                                <li><a data-toggle="tab" href="#tab2">Activities</a></li>
                                <li><a data-toggle="tab" href="#tab3">Location</a></li>
                            </ul>
                        </div>

                        <div class="widget-content tab-content">
                            <div id="tab1" class="tab-pane active">
                                <div class="span4">
                                    <div class="widget-box">
                                        <div class="widget-content">
                                            <?php
                                            if(!$current_alumni_id["pic"]){
                                                echo "<img src='img/profile/default-profile.jpg'>";
                                            }else{
                                                echo "<img src=".$upload_dir.$current_alumni_id["pic"].">";
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div><!--span4-->

                                <div class="span8">
                                    <div class="widget-box">
                                        <div class="widget-title">
                                            <span class="icon_right">
                                                <div class="fr">
                                                    <a href="payments.php?alumni=<?php echo urlencode($current_alumni_id['id']); ?>&&reg=<?php echo htmlentities($current_alumni_id["registration"]);?>" class="btn btn-success btn-mini">
                                                        Payments <i class="icon-money"></i>
                                                    </a>
                                                </div><!--fr-->
                                            </span><!--icon-->

                                            <span class="icon_right">
                                                <div class="fr">
                                                    <a href="transport-payments.php?alumni=<?php echo urlencode($current_alumni_id['id']); ?>" class="btn btn-primary btn-mini">
                                                        <i class="icon-truck"></i> TRANSPORT
                                                    </a>
                                                </div><!--fr-->
                                            </span><!--icon-->

                                            <span class="icon_right">
                                                <div class="fr">
                                                    <a href="payments.php?alumni=<?php echo urlencode($current_alumni_id['id']); ?>" class="btn btn-info btn-mini">
                                                        LUNCH <i class="icon-gift"></i>
                                                    </a>
                                                </div><!--fr-->
                                            </span><!--icon-->

                                        </div><!--widget-title-->
                                        <!--table info -->
                                        <div class="widget-content nopadding">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th>REGISTRATION NUMBER :</th>
                                                    <td><?php echo htmlentities($current_alumni_id["registration"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>SURNAME :</th>
                                                    <td><?php echo htmlentities($current_alumni_id["surname"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>FULL NAME :</th>
                                                    <td><?php echo htmlentities($current_alumni_id["fullnames"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>JOINED :</th>
                                                    <td><?php echo htmlentities($current_alumni_id["date_of_adm"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>LEFT</th>
                                                    <td><?php echo htmlentities($current_alumni_id["date"]); ?></td>
                                                </tr>

                                                <tr>
                                                    <th>GENDER :</th>
                                                    <td><?php echo htmlentities($current_alumni_id["gender"]);?></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div><!--widget-content nopadding-->
                                    </div><!--widget-box-->
                                </div><!--span8-->
                            </div><!--tab1" class="tab-pane active-->

                            <div id="tab2" class="tab-pane">
                                <div class="widget-box">
                                    <div class="widget-content nopadding">

                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>DATE OF BIRTH :</th>
                                                <td><?php echo htmlentities($current_alumni_id["dob"]);?></td>
                                            </tr>

                                            <tr>
                                                <th>SKILLS :</th>
                                                <td><?php echo htmlentities($current_alumni_id["skills"]);?></td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div><!--widget-box-->
                            </div><!--tab2" class="tab-pane-->

                            <div id="tab3" class="tab-pane">
                                <div class="widget-box">
                                    <div class="widget-content nopadding">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>NATIONALITY :</th>
                                                <td><?php echo htmlentities($current_alumni_id["nationality"]);?></td>
                                            </tr>

                                            <tr>
                                                <th>COUNTY :</th>
                                                <td><?php echo htmlentities($current_alumni_id["county"]);?></td>
                                            </tr>

                                            <tr>
                                                <th>RESIDENTIAL AREA :</th>
                                                <td><?php echo htmlentities($current_alumni_id["residence"]);?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!--tab3" class="tab-pane-->
                        </div><!--widget-content tab-content-->
                    </div><!--widget box two-->

                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon"> <i class="icon-list"></i> </span>
                            <h5>Reasons For Transfer</h5>
                        </div>
                        <div class="widget-content">
                            <?php echo nl2br(htmlentities($current_alumni_id["background"])); ?>
                        </div>
                    </div>

                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon">
                                <i class="icon-user-md"></i>
                            </span>
                            <h5>Parents</h5>
                        </div>
                        <div class="widget-content">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th>FULL NAMES</th>
                                    <th>PHONE NUMBER</th>
                                    <th>OFFICE NUMBER</th>
                                    <th>EMAIL</th>
                                    <th>RELATIONSHIP</th>
                                    <th>PROFILE</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $parent_set = find_parents_for_alumni($current_alumni_id['admin_number']);  ?>
                                <?php while($parent = mysqli_fetch_assoc($parent_set)){?>
                                    <tr>
                                        <td><?php echo htmlentities($parent['full_names']); ?></td>
                                        <td><?php echo htmlentities($parent['phone']); ?></td>
                                        <td><?php echo htmlentities($parent['altphone']); ?></td>
                                        <td><?php echo htmlentities($parent['email']); ?></td>
                                        <td><?php echo htmlentities($parent['relationship']); ?></td>
                                        <td>
                                            <a href="../../../parents/public/parents/profile.php?parent=<?php echo urlencode($parent['id']); ?>" class="btn btn-mini btn-info">
                                                <i class="icon-user"></i> Profile
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--content-->
            </div><!--wbox-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../../includes/system/footer.php'; ?>
