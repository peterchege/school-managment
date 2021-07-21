<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php find_selected_fields(); ?>
<?php if(!$current_student_admin){ redirect_to('../students.php'); } ?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home</a>
            <a href="../students.php" class="current">Students</a>
        </div>
        <h1>Student Transport payments.</h1>
    </div><!--content-header-->

    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php $layout_context = $_SESSION['usertype']; ?>
                <?php if($layout_context == 'Admin'){?>
                    <?php echo message(); ?>
                    <?php echo form_errors($errors); ?>
                <?php } ?>

                <?php if(isset($_POST['add_transport'])){?>
                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <form action="transport-payments.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" method="post" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">FEE TYPE: </label>
                                    <div class="controls">
                                        <input type="text" value="TRANSPORT FEE" name="type" placeholder="Enter fee type" class="span11">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">ROUTE: </label>
                                    <div class="controls">
                                        <select name="route" class="span5">
                                            <option></option>
                                            <?php $route_set = find_transport_fee_structure();?>
                                            <?php while($route = mysqli_fetch_assoc($route_set)){?>
                                                <option><?php echo htmlentities($route['route']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">PAYMENTS: </label>
                                    <div class="controls">
                                        <select name="payments" class="span5">
                                            <option></option>
                                            <option>TO</option>
                                            <option>FROM</option>
                                            <option>TO AND FROM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">PAID: </label>
                                    <div class="controls">
                                        <input type="text" name="paid" placeholder="Enter amount paid" class="span11">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">METHOD: </label>
                                    <div class="controls">
                                        <select name="method" class="span5">
                                            <option>BANK SLIP</option>
                                            <option>CHEQUE</option>
                                            <option>M-PESA</option>
                                            <option>CASH</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">DATE:</label>
                                    <div class="controls">
                                        <input name="date" type="text" data-date="2017-04-14" data-date-format="yyyy-mm-dd" class="datepicker span11">
                                        <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">TERM:</label>
                                    <div class="controls">
                                        <select name="term" class="span11">
                                            <option <?php if($_SESSION['login_term']=='ONE'){ echo 'selected';} ?>>ONE</option>
                                            <option <?php if($_SESSION['login_term']=='TWO'){ echo 'selected'; } ?>>TWO</option>
                                            <option <?php if($_SESSION['login_term']=='THREE'){echo 'selected';} ?>>THREE</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <button type="submit" name="create" class="btn btn-primary">
                                        <i class="icon-money"></i> PAY
                                    </button>

                                </div>

                            </form>
                        </div>
                    </div>
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <a href="../profile.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" class="btn btn-mini btn-info">
                                <i class="icon-user"></i> PROFILE
                            </a>
                        </span>

                        <span class="icon_right">
                            <form action="transport-invoice.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" method="post" class="form-horizontal">
                                <button type="submit" name="add_transport" class="btn btn-mini btn-info">
                                    ADD <i class="icon-plus-sign"></i>
                                </button>
                            </form>
                        </span>

                        <span class="icon_right">
                            <a href="transport-invoice.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" class="btn btn-mini btn-default">
                                REFRESH <i class="icon-refresh"></i>
                            </a>
                        </span>

                        <span class="icon_right">
                            <a href="../students.php" class="btn btn-mini btn-warning">
                                <i class="icon-arrow-left"></i> BACK
                            </a>
                        </span>

                        <span class="icon_right">
                            <a href="../payments/invoice.php?student=<?php echo htmlentities($current_student_admin['admin']); ?>" class="btn btn-mini btn-info">
                                PAYMENTS <i class="icon-money"></i>
                            </a>
                        </span>

                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>FEE TYPE.</th>
                                <th>OPTIONS.</th>
                                <th>ROUTE</th>
                                <th>PAYMENTS</th>
                                <th>AMOUNT.</th>
                                <th>PAID AMOUNT.</th>
                                <th>BALANCE.</th>
                                <th>STATUS</th>
                                <th>PAY</th>
                                <th>CHECK</th>
                                <th>RECEIPTS</th>
                                <th>MOVE RECORDS</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>

                            <?php $transport_payments_set = find_transport_payments_for_student($current_student_admin['admin'], $_SESSION['login_term']); ?>
                            <tbody>
                            <?php while($transport_payments = mysqli_fetch_assoc($transport_payments_set)){?>
                                <tr>
                                    <td><?php echo htmlentities($transport_payments['type']); ?></td>
                                    <td><?php echo htmlentities($transport_payments['options']); ?></td>
                                    <td><?php echo htmlentities($transport_payments['route']); ?></td>
                                    <td><?php echo htmlentities($transport_payments['payments']); ?></td>
                                    <td><?php echo htmlentities($transport_payments['amount']); ?></td>
                                    <td><?php echo htmlentities($transport_payments['paid']); ?></td>
                                    <td><?php echo htmlentities($transport_payments['balance']); ?></td>
                                    <td><?php echo htmlentities($transport_payments['status']); ?></td>
                                    <td>
                                        <a href="make-transport-payments.php?payments=<?php echo urlencode($transport_payments['id']); ?>" class="btn btn-mini btn-success">
                                            <i class="icon-money"></i> PAY
                                        </a>
                                    </td>

                                    <td>
                                        <a href="confirm-transport.php?payments=<?php echo htmlentities($transport_payments['id']); ?>" class="btn btn-mini btn-warning">
                                            CHECK <i class="icon-eye-open"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="receipt.php?payments=<?php echo urlencode($transport_payments['id']); ?>" class="btn btn-link" target="_blank">
                                            <i class="icon-credit-card"></i> ISSUE
                                        </a>
                                    </td>

                                    <td>
                                        <form action="move-to-alumni.php?payments=<?php echo urlencode($transport_payments['id']); ?>" method="post" class="form-horizontal">
                                            <button type="submit" name="move"  class="btn btn-mini btn-warning" onclick="return confirm('Are you sure you wnat to move data..??');">
                                                <i class="icon-folder-open-alt"></i> MOVE
                                            </button>
                                        </form>
                                    </td>

                                    <td>
                                        <a href="delete-transport.php?payments=<?php echo urlencode($transport_payments['id']); ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure..??');">
                                            DELETE <i class="icon-trash"></i>
                                        </a>
                                    </td>

                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div><!--widget-content nopadding-->
                </div><!--widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->

</div><!--content-->
<?php include '../../../../includes/system/table_footer.php'; ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.ui.custom.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-colorpicker.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/jquery.toggle.buttons.js"></script>
<script src="../js/masked.js"></script>
<script src="../js/jquery.uniform.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/matrix.js"></script>
<script src="../js/matrix.form_common.js"></script>
<script src="../js/wysihtml5-0.3.0.js"></script>
<script src="../js/jquery.peity.min.js"></script>
<script src="../js/bootstrap-wysihtml5.js"></script>
<script>
    $('.textarea_editor').wysihtml5();
</script>
</body>
</html>

