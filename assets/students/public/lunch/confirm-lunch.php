<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_payments= find_payments_by_id($_GET['payments']) ?>
<?php if (!$current_payments) { redirect_to("../students.php"); } ?>
<?php
$id = mysqli_sec($current_payments['id']);
$student_admin = mysqli_sec($current_payments['student_admin']);
$registration= mysqli_sec($current_payments['registration']);
$surname = mysqli_sec($current_payments['surname']);
$fullnames = mysqli_sec($current_payments['fullnames']);
$gender = mysqli_sec($current_payments['gender']);
$class = mysqli_sec($current_payments['class']);
$school = mysqli_sec($current_payments['school']);
$parent = mysqli_sec($current_payments['gname']);
$phone = mysqli_sec($current_payments['phone']);
$email = mysqli_sec($current_payments['email']);
$type = mysqli_sec($current_payments['type']);
$options = mysqli_sec($current_payments['options']);
$amount = mysqli_sec($current_payments['amount']);
$term = mysqli_sec($current_payments['term']);
?>
<?php
$current_lunch_fee_structure = find_lunch_fee_structure_type($_SESSION['payments_method'], $term);
$type_set = $current_lunch_fee_structure['type'];
$payment_option = $current_lunch_fee_structure['options'];
$amount_set = $current_lunch_fee_structure['amount'];


?>
<?php
//check if the form was submitted
if(isset($_POST['pay'])){
    $total_paid = mysqli_sec($_POST['paid_amount']);
    $paid = mysqli_sec($total_paid);
    $total = mysqli_sec($_POST['total']);
    $balance = $amount_set - $total;
    $payments = mysqli_sec($_POST['payments']);
    $method = mysqli_sec($_POST['method']);
    $date = mysqli_sec($_POST['date']);

?>
<?php if($balance == 0){$status = 'FULL PAID';}else{$status = 'WITH BALANCE';} ?>
<?php
    //validate presences
    $required_fields = array('paid_amount');
    validate_presences($required_fields);

    if(empty($errors)){
        //perform query
        $query = "UPDATE fee_payments SET ";
        $query .= "student_admin = '{$student_admin}', registration = '{$registration}', ";
        $query .= "surname = '{$surname}', fullnames = '{$fullnames}', ";
        $query .= "gender = '{$gender}', class = '{$class}', ";
        $query .= "school = '{$school}', gname= '{$parent}', ";
        $query .= "phone = '{$phone}', email = '{$email}', ";
        $query .= "options = '{$options}', amount = '{$amount}', ";
        $query .= "paid = '{$paid}', balance = '{$balance}', total = '{$total}', ";
        $query .= "status = '{$status}', method = '{$method}', ";
        $query .= "date = '{$date}', term = '{$term}' ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";
        $results = mysqli_query($connection, $query);

        //check if the query took place and the number of affected rrows was one
        if($results && mysqli_affected_rows($connection)==1){
            $_SESSION['message'] = 'You have successfully made the payments';
            redirect_to('lunch-invoice.php?student='.urlencode($current_payments['student_admin']));

        }else{
            $_SESSION['error_message'] = 'There was a problem in making payments';

        }
    }
}else{}
?>
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
                        <form action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"> FEE TYPE</label>
                                <div class="controls">
                                    <input type="text" name="type" disabled="" value="<?php echo htmlentities($type_set); ?>" placeholder="Enter the fee type." class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">PAYMENTS: </label>
                                <div class="controls">
                                    <input type="text" name="payments" value="<?php echo htmlentities($_SESSION['payments_method']); ?>" placeholder="Enter the fee type." class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">PAID AMOUNT:</label>
                                <div class="controls">
                                    <input type="text" id="paid" name="paid_amount" value="<?php echo htmlentities($current_payments['paid']) ?>" placeholder="Enter the paid amount." class="span11" onkeyup="sum();">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">TOTAL PAID AMOUNT:</label>
                                <div class="controls">
                                    <input type="text" name="total" value="<?php echo htmlentities($current_payments['total']) ?>" placeholder="Enter the paid amount." class="span11" onkeyup="sum();">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">PAYMENTS:</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo htmlentities($current_payments['status']); ?>" name="payments" disabled="" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">METHOD:</label>
                                <div class="controls">
                                    <select name="method">
                                        <option <?php if($current_payments['method'] == 'CASH'){echo 'selected';} ?> >CASH</option>
                                        <option <?php if($current_payments['method'] == 'CHEQUE'){echo 'selected';} ?>>CHEQUE</option>
                                        <option <?php if($current_payments['method'] == 'M-PESA'){ echo 'selected';}?>>M-PESA</option>
                                        <option <?php if($current_payments['method'] == 'BANK SLIP'){ echo 'selected'; } ?>>BANK SLIP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">DATE:</label>
                                <div class="controls">
                                    <input name="date" type="text" data-date="2017-04-14" data-date-format="yyyy-mm-dd" value="<?php echo htmlentities($current_payments['date']); ?>" class="datepicker span11">
                                    <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="pay" class="btn btn-primary">
                                    <i class="icon-money"></i> CHECK    </button>

                                <a href="lunch-invoice.php?student=<?php echo urlencode($current_payments['student_admin']); ?>" class="btn btn-danger">
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
