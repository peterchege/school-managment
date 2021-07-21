<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_payments= find_trans_payments_by_id($_GET['payments']) ?>
<?php if(!$current_payments) {redirect_to("../students.php");} ?>
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
        <h1>Student Invoice.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php echo message(); ?>
                <?php echo form_errors(errors()); ?>
                <div class="widget-box">
                    <div class="widget-title">
                       <span class="icon">
                        <i class="icon-barcode"></i>
                       </span>

                        <span class="icon_right">
                            <a href="" class="btn btn-mini btn-default">
                                REFRESH <i class="icon-refresh"></i>
                            </a>
                       </span>
                        <h5>MAKE ALL PAYMENTS.</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="transport-paid.php?payments=<?php echo urlencode($current_payments['id']); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">FEE TYPE: </label>
                                <div class="controls">
                                    <input type="text" name="type" disabled="" value="<?php echo htmlentities($current_payments['type']); ?>" placeholder="Enter the fee type." class="span11">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">INITIAL PAYMENTS:</label>
                                <div class="controls">
                                    <input type="text" name="initial_paid" value="<?php echo htmlentities($current_payments['total']); ?>" placeholder="Enter the initial balance." class="span11">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">PAID AMOUNT:</label>
                                <div class="controls">
                                    <input type="text" name="paid_amount" placeholder="Enter the paid amount." class="span11" onkeyup="sum();">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">METHOD:</label>
                                <div class="controls">
                                    <select name="method">
                                        <option>BANK SLIP</option>
                                        <option>CASH</option>
                                        <option>CHEQUE</option>
                                        <option>M-PESA</option>

                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">DATE:</label>
                                <div class="controls">
                                    <input name="date" type="text" data-date="2017-04-14" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d'); ?>" class="datepicker span11">
                                    <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="pay" class="btn btn-primary">
                                    <i class="icon-money"></i> PAY
                                </button>

                                <a href="transport-invoice.php?student=<?php echo urlencode($current_payments['student_admin']); ?>" class="btn btn-danger">
                                    CANCEL <i class="icon-exclamation-sign"></i>
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

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
