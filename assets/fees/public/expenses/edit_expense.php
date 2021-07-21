<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php $current_expense = find_expenses_for_cat_by_id($_GET['expense']); ?>
<?php if(!$current_expense){
    redirect_to('../expenses.php');
}
?>
<?php
//1. confirm that the form has been submitted
if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("expense");
    validate_presences($required_fields);

    if(empty($errors)){
        //3. get objectes and store them to variables
        $id = $current_expense["id"];
        $expense= mysqli_sec($_POST["expense"]);
        $amount= mysqli_sec($_POST["amount"]);
        $date= mysqli_sec($_POST['date']);
        $payment_date= mysqli_sec($_POST['payment_date']);
        $paid= mysqli_sec($_POST["paid"]);
        $balance= mysqli_sec($_POST["balance"]);

        //perform insertion query 
        $query = "UPDATE expense SET ";
        $query .= "expense= '{$expense}', date= '{$date}', pay_date= '{$payment_date}', ";
        $query .= "amount= '{$amount}', paid= '{$paid}', balance= '{$balance}' ";
        $query .= "WHERE id= {$id} ";
        $query .= "LIMIT 1";
        $results = mysqli_query($connection, $query);

        if($results && mysqli_affected_rows($connection) == 1){
            $_SESSION["message"] = "You have successfully updated the expense";
            redirect_to("expense.php?cat=".urlencode($current_expense['cat_id']));
        }else{
            //failure
            $_SESSION["error_message"] = "There was a problem in updating the expense";

        }

    }

}else{
    //there was problem during submission

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
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <form action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">EXPENSE:</label>
                                <div class="controls">
                                    <input type="text" name="expense" placeholder="Enter the expense" value="<?php echo htmlentities($current_expense['expense']); ?>" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">AMOUNT:</label>
                                <div class="controls">
                                    <input type="text" id="amount" name="amount"  value="<?php echo htmlentities($current_expense['amount']) ?>" placeholder="Enter the expense amount" class="span11" onkeyup="sum();">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">DATE:</label>
                                <div class="controls">
                                    <input type="text" name="date" data-date="2013-02-01" data-date-format="yyyy-mm-dd" value="<?php echo htmlentities($current_expense['date']) ?>" class="datepicker span11">
                                    <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">PAYMENT DATE:</label>
                                <div class="controls">
                                    <input type="text" name="payment_date" data-date="2013-02-01" data-date-format="yyyy-mm-dd"  value="<?php echo htmlentities($current_expense['pay_date']) ?>" class="datepicker span11">
                                    <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">PAID AMOUNT:</label>
                                <div class="controls">
                                    <input type="text" id="paid" value="<?php echo htmlentities($current_expense['paid']) ?>" name="paid" placeholder="Enter the paid amount" class="span11" onkeyup="sum();">
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
                                    <input type="text" id="balance" value="<?php echo htmlentities($current_expense['balance']) ?>" name="balance" placeholder="Enter the remaining balance" class="span11">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-success">
                                    <i class="icon-download-alt"></i> UPDATE
                                </button>


                                <a href="expense.php?cat=<?php echo urlencode($current_expense['cat_id']);?>" class="btn btn-danger">
                                    <i class="icon-exclamation-sign"></i> CANCEL
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

