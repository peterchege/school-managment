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
            <a href="lunch.php" class="current">Transport Structure</a>
        </div>
        <h1>Transport payments structure.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php $layout_context = $_SESSION['usertype']; ?>
                <?php if($layout_context == 'Admin'){?>
                    <?php echo message(); ?>
                <?php } ?>
                <!--table-->
                <?php if(isset($_POST['lunch_select'])){?>
                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <form action="transport/add_transport.php" method="post" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">FEE TYPE:</label>
                                    <div class="controls">
                                        <input type="text" name="type" placeholder="Enter fee type" value="TRANSPORT FEE" class="span11">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">OPTIONS:</label>
                                    <div class="controls">
                                        <input type="text" name="option" placeholder="Enter payments options" value="OPTIONAL"  class="span11">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">ROUTE:</label>
                                    <div class="controls">
                                        <input type="text" name="route" placeholder="Enter route"  class="span11">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">AMOUNT:</label>
                                    <div class="controls">
                                        <input type="text" name="amount" placeholder="Enter the transport fee amount" class="span11">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">PAYMENTS:</label>
                                    <div class="controls">
                                        <select name="payments" class="span3">
                                            <option>TO</option>
                                            <option>FROM</option>
                                            <option>TO AND FROM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">TERM:</label>
                                    <div class="controls">
                                        <select name="term" class="span5">
                                            <option <?php if($_SESSION['login_term'] == 'ONE'){ echo 'selected'; } ?>>ONE</option>
                                            <option <?php if($_SESSION['login_term'] == 'TWO'){ echo 'selected'; } ?>>TWO</option>
                                            <option <?php if($_SESSION['login_term'] == 'THREE'){ echo 'selected'; } ?>>THREE</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">YEAR:</label>
                                    <div class="controls">
                                        <input type="text" name="year" placeholder="Enter the year" value="<?php echo date('Y'); ?>" class="span11">
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" name="submit" class="btn btn-info">
                                        <i class="icon-ok-sign"></i> Enter
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                <?php } ?>

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-align-justify"></i>
                        </span>
                        <?php if($layout_context == 'Admin'){?>
                            <span class="icon_right">
                                <form action="transport.php" method="post" class="form-horizontal">
                                    <button type="submit" name="lunch_select" class="btn btn-mini btn-info">
                                        <i class="icon-plus"></i> ADD
                                    </button>
                                </form>
                            </span>

                            <span class="icon_right">
                                <a href="" class="btn btn-mini btn-default">
                                    <i class="icon-refresh"></i> REFRESH
                                </a>
                            </span>
                        <?php } ?>
                        <h5>Transport Structure</h5>
                    </div>

                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>FEE</th>
                                <th>OPTIONS</th>
                                <th>ROUTE</th>
                                <th>AMOUNT</th>
                                <th>PAYMENTS</th>
                                <th>YEAR</th>
                                <?php if($layout_context == 'Admin'){?>
                                    <th>ACTIONS</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <?php $structure_set = find_transport_fee_structure();  ?>
                            <?php while($structure = mysqli_fetch_assoc($structure_set)){ ?>
                                <tbody>
                                <tr>
                                    <td><?php echo htmlentities($structure['type']); ?></td>
                                    <td><?php echo htmlentities($structure['options']); ?></td>
                                    <td><?php echo htmlentities($structure['route']); ?></td>
                                    <td><?php echo htmlentities($structure['amount']); ?></td>
                                    <td><?php echo htmlentities($structure['payments']); ?></td>
                                    <td><?php echo htmlentities($structure['year']); ?></td>
                                    <?php if($layout_context == 'Admin'){?>
                                        <td>
                                            <div class="fr">
                                                <a href="transport/edit.php?transport=<?php echo urlencode($structure["id"]); ?>" class="btn btn-primary btn-mini">
                                                    <i class="icon-edit"></i> EDIT
                                                </a>

                                                <a href="transport/delete.php?transport=<?php echo urlencode($structure['id']); ?>" onclick= "return confirm('Are you Sure..?!');" class="btn btn-danger btn-mini">
                                                    DELETE <i class="icon-trash"></i>
                                                </a>
                                            </div>
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
<?php include '../../../includes/system/footer.php'; ?>
