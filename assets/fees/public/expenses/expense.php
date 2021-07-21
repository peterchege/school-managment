<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once '../../../../includes/navigation.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php $current_cat = find_expense_by_id($_GET['cat']); ?>
<?php if(!$current_cat){
    redirect_to('../expenses.php');
}
?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav();; ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home</a>
            <a href="../expenses.php" class="current">Expenses</a>
        </div>
        <h1>Expenses.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php echo message(); ?>
                <?php if(isset($_POST['add'])){?>
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <form action="new_expense_cat.php?cat=<?php echo urlencode($current_cat['id']); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">EXPENSE:</label>
                                <div class="controls">
                                    <input type="text" name="expense" placeholder="Enter the expense" value="<?php echo htmlentities($current_cat['expense']); ?>" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">AMOUNT:</label>
                                <div class="controls">
                                    <input type="text" id="amount" name="amount" placeholder="Enter the expense amount" class="span11" onkeyup="sum();">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">DATE:</label>
                                <div class="controls">
                                    <input type="text" name="date" data-date="2013-02-01" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d'); ?>" class="datepicker span11">
                                    <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">PAYMENT DATE:</label>
                                <div class="controls">
                                    <input type="text" name="payment_date" data-date="2013-02-01" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d'); ?>" class="datepicker span11">
                                    <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">PAID AMOUNT:</label>
                                <div class="controls">
                                    <input type="text" id="paid" name="paid" placeholder="Enter the paid amount" class="span11" onkeyup="sum();">
                                </div>
                            </div>
                            <script>

                                function sum() {
                                    var txtFirstNumberValue = document.getElementById('amount').value;
                                    var txtThirdNumberValue = document.getElementById('paid').value;
                                    var result = parseInt(txtFirstNumberValue) - parseInt(txtThirdNumberValue);
                                    if (!isNaN(result)) {
                                        document.getElementById('balance').value = result;
                                    }
                                }

                            </script>

                            <div class="control-group">
                                <label class="control-label">BALANCE:</label>
                                <div class="controls">
                                    <input type="text" id="balance" name="balance" placeholder="Enter the remaining balance" class="span11">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-success">
                                    <i class="icon-download-alt"></i> SAVE
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-filter"></i>
                        </span>

                        <span class="icon_right">
                            <form action="" method="post" class="form-horizontal">
                                <button type="submit" name="add" class="btn btn-mini btn-primary">
                                    <i class="icon-plus"></i>ADD
                                </button>
                            </form>
                        </span>

                         <span class="icon_right">
                            <a href="" class="btn btn-mini btn-inverse">
                                <i class="icon-refresh"></i> REFRESH
                            </a>
                        </span>

                        <span class="icon_right">
                            <a href="../expenses.php" class="btn btn-mini btn-warning">
                                BACK <i class="icon-arrow-left"></i>
                            </a>
                        </span>

                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th>EXPENSE</th>
                                <th>AMOUNT</th>
                                <th>ISSUED DATE</th>
                                <th>PAYMENTS DATE</th>
                                <th>PAID AMOUNT</th>
                                <th>BALANCE</th>
                                <th>ACTIONS</th>
                            </tr>
                            </thead>
                            <?php $expense_set = find_expenses_for_cat($current_cat['id']); ?>
                            <?php while($expense = mysqli_fetch_assoc($expense_set)){ ?>
                                <tbody>
                                <tr>
                                    <td><?php echo htmlentities($expense['expense']); ?></td>
                                    <td><?php echo htmlentities($expense['amount']); ?></td>
                                    <td><?php echo htmlentities($expense['date']); ?></td>
                                    <td><?php echo htmlentities($expense['pay_date']); ?></td>
                                    <td><?php echo htmlentities($expense['paid']); ?></td>
                                    <td><?php echo htmlentities($expense['balance']); ?></td>
                                    <td>
                                        <a href="edit_expense.php?expense=<?php echo urlencode($expense['id']); ?>" class="btn btn-mini btn-primary">
                                            <i class="icon-edit"></i> EDIT
                                        </a>

                                        <a href="delete_expense.php?expense=<?php echo urlencode($expense['id']); ?>" onclick= "return confirm('Are you Sure..?!');" class="btn btn-danger btn-mini">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>

                            <?php } ?>
                            <?php mysqli_free_result($expense_set); ?>
                        </table>
                    </div>
                </div><!--widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<?php include '../../../../includes/system/table_footer.php'; ?>
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



