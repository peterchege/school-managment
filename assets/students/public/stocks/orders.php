<?php require_once '../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_stock = find_all_stocks_by_id($_GET['stock']) ?>
<?php if (!$current_stock) {redirect_to("../students.php");} ?>
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
        <h1>Make your orders.</h1>
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
                        <h5>MAKE AN ORDER.</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="make-orders.php?stock=<?php echo urlencode($current_stock['id']); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">STOCK: </label>
                                <div class="controls">
                                    <input type="text" name="stock" value="<?php echo htmlentities($current_stock['stock']); ?>" placeholder="Enter the stock being ordered." class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">QUANTITY: </label>
                                <div class="controls">
                                    <input type="text" name="quantity" placeholder="Enter the quantity of stock being ordere." class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">PAID AMOUNT:</label>
                                <div class="controls">
                                    <input type="text" name="paid" placeholder="Enter the paid amount for the stock." class="span11">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">METHOD:</label>
                                <div class="controls">
                                    <select name="method" class="span3">
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
                                    <span class="help-block">Enter the date paid.</span>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="order" class="btn btn-primary">
                                    ORDER <i class="icon-ok"></i>
                                </button>

                                <a href="stocks.php?student=<?php echo urlencode($current_stock['student_admin']); ?>" class="btn btn-danger">
                                    <i class="icon-exclamation-sign"></i> CANCEL
                                </a>
                            </div>

                        </form>
                    </div>
                </div><!--widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<?php include '../../../../includes/system/table_footer.php'; ?>
<script src="../students/js/jquery.min.js"></script>
<script src="../students/js/jquery.ui.custom.js"></script>
<script src="../students/js/bootstrap.min.js"></script>
<script src="../students/js/bootstrap-colorpicker.js"></script>
<script src="../students/js/bootstrap-datepicker.js"></script>
<script src="js/jquery.toggle.buttons.js"></script>
<script src="../students/js/masked.js"></script>
<script src="../students/js/jquery.uniform.js"></script>
<script src="../students/js/select2.min.js"></script>
<script src="../students/js/matrix.js"></script>
<script src="../students/js/matrix.form_common.js"></script>
<script src="../students/js/wysihtml5-0.3.0.js"></script>
<script src="../students/js/jquery.peity.min.js"></script>
<script src="../students/js/bootstrap-wysihtml5.js"></script>
<script>
    $('.textarea_editor').wysihtml5();
</script>
</body>
</html>
