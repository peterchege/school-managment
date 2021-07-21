<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/lunch_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php if(isset($_GET['lunch'])){
    $current_lunch_id = find_lunch_by_id($_GET['lunch']);
} ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home</a>
            <a href="lunch.php" class="current">lunch </a>
        </div>
        <h1>Lunch Schedule.</h1>
    </div><!--content-header-->

    <div class="container-fluid"><hr/>
        <div class="row-fluid">
            <div class="span12">
                <?php $layout_context = $_SESSION['usertype']; ?>
                <?php if($layout_context == 'Admin'){?>
                    <?php echo message(); ?>
                <?php } ?>
                <?php //echo form_errors($errors); ?>
                <?php if(isset($_POST["add_new"])){ ?>
                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon"><i class="icon-user"></i></span>
                            <h5>Student profile</h5>
                        </div><!--title-->
                        <div class="widget-content nopadding">
                            <form action="lunch/add_lunch.php" method="POST" class="form-horizontal">
                                <!--vehicle-->
                                <div class="control-group">
                                    <label class="control-label">FOOD :</label>
                                    <div class="controls">
                                        <input type="text" name="food" class="span11" placeholder="Enter food.." >
                                    </div>
                                </div><!--control-group-->


                                <!--plate-->
                                <div class="control-group">
                                    <label class="control-label">DAY :</label>
                                    <div class="controls">
                                        <select name="day" class="span7">
                                            <option>SUNDAY</option>
                                            <option>MONDAY</option>
                                            <option>TUESDAY</option>
                                            <option>WEDNESDAY</option>
                                            <option>THURSDAY</option>
                                            <option>FRIDAY</option>
                                            <option>SATURDAY</option>
                                        </select>
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
                <?php }elseif(isset($_POST['edit'])){ ?>
                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon"><i class="icon-user"></i></span>
                            <h5>Student profile</h5>
                        </div><!--title-->
                        <div class="widget-content nopadding">
                            <form action="lunch/edit_lunch.php?lunch=<?php echo urlencode($current_lunch_id['id']); ?>" method="POST" class="form-horizontal">
                                <!--vehicle-->
                                <div class="control-group">
                                    <label class="control-label">FOOD :</label>
                                    <div class="controls">
                                        <input type="text" value="<?php echo htmlentities($current_lunch_id['food']) ?>" name="food" class="span11" placeholder="Enter vehicle type.." >
                                    </div>
                                </div><!--control-group-->


                                <!--plate-->
                                <div class="control-group">
                                    <label class="control-label">DAY :</label>
                                    <div class="controls">
                                        <select name="day" class="span7">
                                            <option>SUNDAY</option>
                                            <option>MONDAY</option>
                                            <option>TUESDAY</option>
                                            <option>WEDNESDAY</option>
                                            <option>THURSDAY</option>
                                            <option>FRIDAY</option>
                                            <option>SATURDAY</option>
                                        </select>
                                    </div>
                                </div><!--control-group-->


                                <div class="form-actions">
                                    <button name="edit_lunch" type="submit" class="btn btn-success">
                                        <i class="icon-download-alt"></i> Save
                                    </button>

                                </div>
                            </form>
                        </div><!--widget-content-->
                    </div><!--widget-box-->
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-th"></i>
                        </span>

                        <?php if($layout_context == 'Admin'){?>
                            <span class="icon_right">
                                <form action="" method="POST" class="form-horizontal">
                                    <button type="submit" name="add_new" class="btn btn-mini btn-success">
                                        <i class="icon-plus"></i>
                                    </button>
                                </form>
                            </span>

                            <span class="icon_right">
                                <a href="lunch.php" class="btn btn-mini btn-default">
                                    <i class="icon-refresh"></i> REFRESH
                                </a>
                            </span>

                        <?php } ?>


                        <h5>Lunch table</h5>
                    </div>

                    <!--all students table-->
                    <div class="widget-content nopadding">

                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>FOOD</th>
                                <th>DAY</th>
                                <?php if($layout_context == 'Admin'){?>
                                    <th>ACTIONS</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $lunch_set = find_all_lunch(); ?>
                            <?php while($lunch = mysqli_fetch_assoc($lunch_set)){ ?>

                                <tr>
                                    <td>
                                        <?php echo htmlentities($lunch["food"]); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlentities($lunch["day"]); ?>
                                    </td>

                                    <?php if($layout_context == 'Admin'){?>
                                        <td>
                                            <form action="lunch.php?lunch=<?php echo urlencode($lunch['id']); ?>" method="post" class="form-horizontal">
                                                <button type="submit" name="edit" class="btn btn-mini btn-info">
                                                    EDIT <i class="icon-pencil"></i>
                                                </button>

                                                <a href="lunch/delete.php?lunch=<?php echo urlencode($lunch["id"]); ?>" onclick= "return confirm('Are you sure..?!');" class="btn btn-mini btn-danger">
                                                    <i class="icon-trash"></i> DELETE
                                                </a>
                                            </form>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <?php mysqli_free_result($lunch_set); ?>

                            </tbody>

                        </table>
                    </div><!--widget-content tab-content nopadding-->
                </div>
            </div><!--Widget-Box-->
        </div><!--span12-->
    </div><!--row-fluid-->

</div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../includes/system/footer.php'; ?>
