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
            <a href="fees.php" class="current">Fees</a>
        </div>
        <h1>Manage Fees.</h1>
    </div><!--content-header-->
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <?php $layout_context = $_SESSION['usertype']; ?>
                <?php if($layout_context == 'Admin'){?>
                <?php echo message(); ?>
                <?php } ?>
                <div class="widget-box">
                <?php if(isset($_POST['add'])){ ?>
                    <div class="widget-content nopadding">
                        <form action="manage_fee/add_fee.php" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">FEE TYPE:</label>
                                <div class="controls">
                                    <input type="text" name="fee" placeholder="Enter the fee type" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">DESCRIPTION:</label>
                                <div class="controls">
                                    <textarea name="description" placeholder="Enter the fee description" class="span11">

                                    </textarea>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="add_fee" class="btn btn-success">
                                    <i class="icon-download-alt"></i> SAVE
                                </button>
                            </div>
                        </form>
                    </div>
                <?php }elseif(isset($_POST['edit'])){ ?>
                    <div class="widget-content nopadding">
                        <?php $current_fee = find_all_fee_by_id($_GET['fee']); ?>
                        <form action="manage_fee/edit.php?fee=<?php echo urlencode($current_fee['id']); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">FEE TYPE:</label>
                                <div class="controls">
                                    <input type="text" name="fee" value="<?php echo htmlentities($current_fee['type']); ?>" placeholder="Enter the fee type" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">DESCRIPTION:</label>
                                <div class="controls">
                                    <textarea name="description" value="<?php echo htmlentities($current_fee['id']); ?>" placeholder="Enter the fee description" class="span11">
                                        <?php echo htmlentities($current_fee['description']); ?>
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="edit_fee" class="btn btn-success">
                                    <i class="icon-download-alt"></i> UPDATE
                                </button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                </div>
                <!--table-->
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-align-justify"></i>
                        </span>
                        <?php if($layout_context == 'Admin'){?>
                        <span class="icon_right">
                           <form action="fees.php" method="post" class="form-horizontal">
                               <button type="submit" name="add" class="btn btn-mini btn-success">
                                   <i class="icon-plus"></i>
                               </button>
                           </form>
                        </span>

                        <span class="icon_right">
                            <a href="fees.php" class="btn btn-mini btn-default">
                                <i class="icon-refresh"></i>
                            </a>
                        </span>
                        <?php } ?>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>FEE TYPE:</th>
                                <th>DESCRIPTION</th>
                                <?php if($layout_context == 'Admin'){?>
                                <th>OPERATIONS</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <?php $fee_set = find_all_fees(); ?>
                            <?php while($fees = mysqli_fetch_assoc($fee_set)){ ?>
                            <tbody>
                                <td><?php echo htmlentities($fees['type']); ?></td>
                                <td><?php echo htmlentities($fees['description']); ?></td>
                                <?php if($layout_context == 'Admin'){?>
                                <td>
                                    <div class="fr">
                                        <form action="fees.php?fee=<?php echo urlencode($fees['id']); ?>" method="post" class="form-horizontal">

                                            <button type="submit" name="edit" class="btn btn-mini btn-info">
                                                <i class="icon-edit"></i> EDIT
                                            </button>

                                            <a href="manage_fee/delete.php?fee=<?php echo urlencode($fees['id']); ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure!?');">
                                                DELETE <i class="icon-trash"></i>
                                            </a>
                                        </form>

                                    </div>
                                </td>
                                <?php } ?>
                            </tbody>
                            <?php } ?>
                            <?php mysqli_free_result($fee_set); ?>
                         </table>

                    </div>
                </div><!--widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<?php include '../../../includes/system/alt_footer.php'; ?>