<?php require_once'../../../includes/initialization.php'; ?>
<?php require_once '../includes/transport_function.php'; ?>
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

            <a href="transport.php" class="current">Transportation </a>
        </div>
        <h1>Transportation Schedule.</h1>
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
                            <form action="transport/new_transportation.php" method="POST" class="form-horizontal">
                                <!--vehicle-->
                                <div class="control-group">
                                    <label class="control-label">VEHICLE TYPE :</label>
                                    <div class="controls">
                                        <input type="text" name="vehicle" class="span11" placeholder="Enter vehicle type.." >
                                    </div>
                                </div><!--control-group-->

                                <!--plate-->
                                <div class="control-group">
                                    <label class="control-label">PLATE NUMBER :</label>
                                    <div class="controls">
                                        <input type="text" name="plate_number" class="span11" placeholder="Enter the vehicle plate number.." >
                                    </div>
                                </div><!--control-group-->

                                <!--route-->
                                <div class="control-group">
                                    <label class="control-label">ROUTE :</label>
                                    <div class="controls">
                                        <input type="text" name="route" class="span11" placeholder="Enter the route the vehicle suppose to take..." />
                                    </div>
                                </div><!--control-group-->

                                <!--amount-->
                                <div class="control-group">
                                    <label class="control-label">FEE :</label>
                                    <div class="controls">
                                        <input type="text" name="amount" class="span11" placeholder="Enter the total transportation fee..." />
                                    </div>
                                </div><!--control-group-->


                                <div class="form-actions">
                                    <button name="submit" type="submit" class="btn btn-success">
                                        <i class="icon-download-alt"></i> Save
                                    </button>

                                    <a href="" class="btn btn-default"><i class="icon-refresh"></i></a>
                                </div>

                            </form>
                        </div><!--widget-content-->
                    </div><!--widget-box-->
                <?php } ?>

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span>
                        <?php if($layout_context == 'Admin'){?>
                            <span class="icon_right">
                                <form action="transport.php" method="POST" class="form-horizontal">
                                    <button type="submit" name="add_new" class="btn btn-mini btn-success">
                                        <i class="icon-plus"></i>
                                    </button>
                                </form>
                            </span>
                        <?php } ?>
                        <h5>Transportation</h5>
                    </div>

                    <!--all students table-->
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>VEHICLE TYPE</th>
                                <th>PLATE NUMBER</th>
                                <th>ROUTE</th>
                                <th>FEE</th>
                                <?php if($layout_context == 'Admin'){?>
                                    <th>ACTIONS</th>
                                <?php } ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $transportation_set = find_all_transport(); ?>
                            <?php while($transportation = mysqli_fetch_assoc($transportation_set)){ ?>
                                <tr>
                                    <td><?php echo htmlentities($transportation["vehicle"]); ?></td>
                                    <td><?php echo htmlentities($transportation["plate"]); ?></td>
                                    <td><?php echo htmlentities($transportation["route"]); ?></td>
                                    <td><?php echo htmlentities($transportation["amount"]); ?></td>
                                    <?php if($layout_context == 'Admin'){?>
                                        <td>
                                            <a href="transport/edit.php?transport=<?php echo urlencode($transportation["id"]); ?>" class="btn btn-mini btn-info">
                                                <i class="icon-pencil"></i>
                                            </a>

                                            <a href="transport/delete.php?transport=<?php echo urlencode($transportation["id"]); ?>" onclick= "return confirm('Are you sure..?!');" class="btn btn-mini btn-danger">
                                                <i class="icon-trash"></i>
                                            </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <?php mysqli_free_result($transportation_set); ?>
                            </tbody>
                        </table>
                    </div><!--widget-content tab-content nopadding-->
                </div><!--Widget-Box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../includes/system/footer.php'; ?>
