<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/student_function.php'; ?>
<?php find_selected_fields(); ?>
<?php
if (!$current_student_admin) {
    redirect_to("students.php");
}
?>
<?php $upload_dir = "admit_students/img/profile/"; ?>
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

            <a href="students.php" class="current">
                students
            </a>
        </div>
        <h1>Students.</h1>
    </div><!--content-header-->

    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <?php $layout_context = $_SESSION['usertype'] ?>
            <?php if($layout_context == 'Admin' || 'Accountant'){?>
                <?php echo message(); ?>
            <?php } ?>
            <?php if(isset($_POST['move'])){ ?>
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <form action="students/move_to_alumni.php?student=<?php echo urlencode($current_student_admin["admin"]); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">CATEGORY: </label>
                                <div class="controls">
                                    <select name="category">
                                        <option></option>
                                        <option>TRANSFERED</option>
                                        <option>ALUMNI</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">DATE LEFT: </label>
                                <div class="controls">
                                    <input type="text" data-date="2013-02-01" data-date-format="yyyy-mm-dd" name="date_left" value="" class="datepicker span11">
                                    <span class="help-block">Enter the date left</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">YEAR: </label>
                                <div class="controls">
                                    <input type="text" name="year_left"  class="span4">
                                    <span class="help-block">Enter the year left</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">REASONS FOR LIVING:</label>
                                <div class="controls">
                                    <textarea name="reasons" class="span11"></textarea>
                                    <span class="help-block">Enter the reason for living</span>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-info">
                                   <i class="icon-exclamation-sign"></i> ENTER
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            <?php } ?>

            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-user"></i></span>
                    <div class="fr">
                        <form action="profile.php?student=<?php echo urlencode($current_student_admin["admin"]); ?>" method="post" class="form-horizontal">
                            <a href="" class="btn btn-mini btn-default">
                                REFRESH <i class="icon-refresh"></i>
                            </a>
                            <a href="students.php" class="btn btn-warning btn-mini">
                                <i class="icon-arrow-left"></i> BACK
                            </a>
                            <?php if($layout_context == 'Admin' || 'Accountant'){?>
                                <a href="admit_students/edit.php?student=<?php echo urlencode($current_student_admin["admin"]);  ?>" class="btn btn-info btn-mini">
                                    EDIT <i class="icon-edit"></i>
                                </a>

                                <button type="submit" name="move" class="btn btn-mini btn-danger" onclick= "return confirm('Are you Sure you move current student..?!');">
                                    <i class="icon-eject"></i> MOVE TO ALUMNI
                                </button>
									<?php if($layout_context == 'Admin'){?>
                                <a href="admit_students/delete.php?student=<?php echo urlencode($current_student_admin["admin"]); ?>" onclick= "return confirm('Are you Sure you want delete current student..?!');" class="btn btn-danger btn-mini">
                                    DELETE <i class="icon-trash"></i>
                                </a>
                                	<?php } ?>
                            <?php } ?>
                        </form>

                    </div>
                    <h5>Student profile</h5>
                </div>
                <div class="widget-content nopadding"><!--profile picture-->
                    <div class="widget-box">
                        <div class="widget-title">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab1">PROFILE</a></li>
                                <li><a data-toggle="tab" href="#tab2">GURDIANS</a></li>
                                <li><a data-toggle="tab" href="#tab3">SIBLINGS</a></li>
                            </ul>
                        </div><!--widget-title-->

                        <div class="widget-content tab-content">
                            <div id="tab1" class="tab-pane active">
                                <div class="span4">
                                    <div class="widget-box">
                                        <div class="widget-content">
                                            <?php
                                            if(!$current_student_admin["pic"]){
                                                echo "<img src='img/profile/default-profile.jpg'>";
                                            }else{
                                                echo "<img src=".$upload_dir.$current_student_admin["pic"].">";
                                            }
                                            ?>
                                            <!--<img src="<?php echo $upload_dir.$current_student_admin["pic"]; ?>">-->
                                        </div>
                                    </div>
                                </div><!--span4-->

                                <div class="span8">
                                    <div class="widget-box">
                                        <div class="widget-title">
                                            <span class="icon_right">
                                                <a href="payments/invoice.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" class="btn btn-mini btn-success">
                                                    <i class="icon-money"></i> PAYMENTS
                                                </a>

                                            </span><!--icon-->

                                            <span class="icon_right">
                                                <a href="stocks/stocks.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" class="btn btn-mini btn-primary">
                                                    STOCKS <i class="icon-file-alt"></i>
                                                </a>

                                            </span><!--icon-->

                                            <span class="icon_right">
                                                <a href="transport/transport-invoice.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" class="btn btn-mini btn-primary">
                                                    <i class="icon-truck"></i> TRANSPORT
                                                </a>

                                            </span><!--icon-->

                                            <span class="icon_right">
                                                <a href="lunch/lunch-invoice.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" class="btn btn-mini btn-primary">
                                                    LUNCH <i class="icon-gift"></i>
                                                </a>

                                            </span><!--icon-->
                                        </div><!--widget-title-->
                                        <!--table info -->
                                        <div class="widget-content nopadding">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th>REGISTRATION NUMBER :</th>
                                                    <td><?php echo htmlentities($current_student_admin["registration"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>SURNAME :</th>
                                                    <td><?php echo htmlentities($current_student_admin["sirname"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>FULL NAME :</th>
                                                    <td><?php echo htmlentities($current_student_admin["full_names"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>DATE OF BIRTH :</th>
                                                    <td><?php echo htmlentities($current_student_admin["dob"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>GENDER :</th>
                                                    <td><?php echo htmlentities($current_student_admin["gender"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>JOINED :</th>
                                                    <td><?php echo htmlentities($current_student_admin["date_of_adm"]);?></td>
                                                </tr>
                                                </tbody>
                                            </table><br>
                                        </div><!--widget-content nopadding-->
                                    </div><!--widget-box-->
                                </div><!--span8-->

                                <div class="span11">
                                    <div class="widget-box">
                                        <div class="widget-content">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th>SCHOOL :</th>
                                                    <td><?php echo htmlentities($current_student_admin["school"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>CLASS :</th>
                                                    <td><?php echo htmlentities($current_student_admin["class"]);?></td>
                                                </tr>

                                                <tr>
                                                    <th>STREAM :</th>
                                                    <td><?php echo htmlentities($current_student_admin["stream"]);?></td>
                                                </tr>


                                                <tr>
                                                    <th>SKILLS :</th>
                                                    <td><?php echo htmlentities($current_student_admin["Skills"]);?></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!--widget box-->
                                </div><!--span12-->

                                <div class="span11">
                                    <div class="widget-box">
                                        <div class="widget-title">
                                            <span class="icon">
                                                <i class="icon-globe"></i>
                                            </span>
                                            <h5>LOCATION</h5>
                                        </div>
                                        <div class="widget-content">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td><?php echo htmlentities($current_student_admin["nationality"]);?></td>
                                                    <th>NATIONALITY :</th>
                                                </tr>

                                                <tr>

                                                    <td><?php echo htmlentities($current_student_admin["county"]);?></td>
                                                    <th>COUNTY :</th>
                                                </tr>

                                                <tr>
                                                    <td><?php echo htmlentities($current_student_admin["residence"]);?></td>
                                                    <th>RESIDENTIAL AREA :</th>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!--tab1" class="tab-pane active-->

                            <div id="tab2" class="tab-pane">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon"><i class="icon-th"></i></span>
                                        <span class="icon_right">

                                                <a href="parents/new_parent.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" class="btn btn-mini btn-primary">
                                                    <i class="icon-plus"></i> ADD
                                                </a>

                                        </span>
                                        <h5>Students relatives</h5>
                                    </div>
                                    <div class="widget-content nopadding">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Full Names</th>
                                                <th>Phone Number</th>
                                                <th>Office Number</th>
                                                <th>Email</th>
                                                <th>Relation</th>
                                                <th>Profile</th>
                                            </tr>
                                            </thead>
                                            <?php $parent_set= find_parents_for_student($_GET["student"]); ?>
                                            <?php while($parent= mysqli_fetch_assoc($parent_set)){ ?>
                                            <tbody>
                                            <tr>
                                                <td><?php echo htmlentities($parent["full_names"]); ?></td>
                                                <td><?php echo htmlentities($parent["phone"]); ?></td>
                                                <td><?php echo htmlentities($parent["altphone"]); ?></td>
                                                <td><?php echo htmlentities($parent["email"]); ?></td>
                                                <td><?php echo htmlentities($parent["relationship"]); ?></td>
                                                <td>
                                                    <a href="../../parents/public/parents/profile.php?parent=<?php echo urlencode($parent["id"]); ?>">
                                                        <span class="profile"><i class="icon-user"></i></span> Profile
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php } ?>
                                            <?php mysqli_free_result($parent_set); ?>
                                        </table><!--table table-bordered table-striped-->
                                    </div>
                                </div><!--widget-box-->
                            </div><!--tab2" class="tab-pane-->

                            <div id="tab3" class="tab-pane">
                                <?php if(isset($_POST['add_sibling'])){?>
                                <div class="widget-box">
                                    <div class="widget-content nopadding">
                                        <form action="siblings/new_sibling.php?student=<?php echo urlencode($current_student_admin["admin"]); ?>" method="POST" class="form-horizontal">
                                            <!--full_names-->
                                            <div class="control-group">
                                                <label class="control-label">FULL NAMES :</label>
                                                <div class="controls">
                                                    <input type="text" name="full_names" class="span11" placeholder="Enter the fullnames of the sibling">
                                                </div>
                                            </div><!--control-group-->

                                            <!--age-->
                                            <div class="control-group">
                                                <label class="control-label">AGE :</label>
                                                <div class="controls">
                                                    <input type="text" name="age" class="span11" placeholder="Enter the age of the sibling">
                                                </div>
                                            </div><!--control-group-->

                                            <!--gender-->
                                            <div class="control-group">
                                                <label class="control-label">GENDER :</label>
                                                <div class="controls">
                                                    <select name="gender">
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>
                                            </div><!--control-group-->


                                            <!--relationship-->
                                            <div class="control-group">
                                                <label class="control-label">RELATIONSHIP :</label>
                                                <div class="controls">
                                                    <input type="text" name="relationship" class="span11" placeholder="What is the relationship ">
                                                </div>
                                            </div><!--control-group-->

                                            <!--occupation-->
                                            <div class="control-group">
                                                <label class="control-label">SCHOOL :</label>
                                                <div class="controls">
                                                    <input type="text" name="school" class="span11" placeholder="Enter the school of study of the sibling">
                                                </div>
                                            </div><!--control-group-->



                                            <div class="form-actions">
                                                <button name="submit" type="submit" class="btn btn-success">
                                                    <i class="icon-download-alt"></i> Save
                                                </button>

                                                <a href="" type="submit" class="btn btn-default">
                                                    <i class="icon-refresh"></i>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon"><i class="icon-th"></i></span>
                                        <span class="icon_right">
                                            <form action="" method="POST" class="form-horizontal">
                                                <?php if($layout_context == 'Admin'){ ?>
                                                    <button type="submit" name="add_sibling" class="btn btn-mini btn-primary">
                                                        <i class="icon-plus"></i> ADD
                                                    </button>
                                                <?php } ?>
                                            </form>
                                        </span>
                                        <h5>Students siblings</h5>
                                    </div>

                                    <div class="widget-content nopadding">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Full Names</th>
                                                <th>Relationship</th>
                                                <th>Profile</th>
                                            </tr>
                                            </thead>
                                            <?php $sibling_set= find_siblings_for_student($_GET["student"]); ?>
                                            <?php while($sibling= mysqli_fetch_assoc($sibling_set)){ ?>
                                            <tbody>
                                            <tr>
                                                <td><?php echo htmlentities($sibling["full_names"]); ?></td>
                                                <td><?php echo htmlentities($sibling["relationship"]); ?></td>
                                                <td>
                                                    <a href="siblings/profile.php?sibling=<?php echo urlencode($sibling["id"]); ?>">
                                                        <span class="profile"><i class="icon-user"></i></span> profile
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php } ?>
                                            <?php mysqli_free_result($sibling_set); ?>
                                        </table>
                                    </div>
                                </div>
                            </div><!--tab3" class="tab-pane-->
                        </div><!--widget-content tab-content-->
                    </div><!--widget box two-->

                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon">
                                <i class="icon-list"></i>
                            </span>
                            <h5>Students Background</h5>
                        </div>
                        <div class="widget-content">
                            <?php echo nl2br(htmlentities($current_student_admin["background"])); ?>
                        </div>
                    </div>
                </div><!--content-->
            </div><!--wbox-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<<?php include '../../../includes/system/table_footer.php'; ?>

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
