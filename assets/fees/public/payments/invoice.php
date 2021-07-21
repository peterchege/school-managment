<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php
    $current_payments =find_payments_by_id($_GET["payments"]);
    if (!$current_payments) {
        redirect_to("../payments.php");
    }

?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo navigation_nav(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home</a>
            <a href="../payments.php" class="current">Payments</a>
        </div>
        <h1>Fee payments.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php echo message(); ?>
                <?php echo form_errors($errors); ?>
                <?php if(isset($_POST['edit'])){?>
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <form action="edit_payments.php?payments=<?php echo urlencode($current_payments['id']); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">FEE TYPE :</label>
                                <div class="controls">
                                    <select name="fee_type" class="span11">
                                        <?php
                                        $type_set = find_all_fees();
                                        while($type = mysqli_fetch_assoc($type_set)){ ?>
                                            <option value="<?php echo htmlentities($current_payments['type']); ?>">
                                                <?php echo htmlentities($type["type"]); ?>
                                            </option>
                                        <?php }?>
                                        <?php mysqli_free_result($type_set); ?>
                                    </select>
                                </div><!--controls-->
                            </div><!--control-group-->

                            <div class="control-group">
                                <label class="control-label">PAYMENTS :</label>
                                <div class="controls">
                                    <select name="payments" class="span11">
                                        <option
                                            <?php if($current_payments["pay_status"] == 'PAID'){
                                                echo "selected";
                                            } ?>
                                            >PAID</option>
                                        <option
                                            <?php if($current_payments["pay_status"] == 'HALF PAID'){
                                                echo "selected";
                                            } ?>
                                            >HALF PAID</option>
                                        <option
                                            <?php if($current_payments["pay_status"] == 'UNPAID'){
                                                echo "selected";
                                            } ?>

                                            >UNPAID</option>
                                    </select>
                                </div><!--controls-->
                            </div><!--control-group-->

                            <script>

                                function sum() {
                                    var txtFirstNumberValue = document.getElementById('txt1').value;
                                    var txtSecondNumberValue = document.getElementById('txt2').value;
                                    var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
                                    if (!isNaN(result)) {
                                        document.getElementById('txt3').value = result;
                                    }
                                }

                            </script>

                            <div class="control-group">
                                <label class="control-label">AMOUNT :</label>
                                <div class="controls">
                                    <input type="text" id="txt1" name="amount" placeholder="Enter amount should be paid.." value="<?php echo htmlentities($current_payments["amount"]); ?>" class="span11" onkeyup="sum();">
                                </div><!--controls-->
                            </div><!--control-group-->

                            <div class="control-group">
                                <label class="control-label">PAID :</label>
                                <div class="controls">
                                    <input type="text" id="txt2" name="paid" placeholder="Enter the amount the student has paid.."  value="<?php echo htmlentities($current_payments["paid"]); ?>"class="span11" onkeyup="sum();">
                                </div><!--controls-->
                            </div><!--control-group-->

                            <div class="control-group">
                                <label class="control-label">BALANCE :</label>
                                <div class="controls">
                                    <input type="text" id="txt3" name="balance" placeholder="Enter the balance remaining.." value="<?php echo htmlentities($current_payments["balance"]); ?>" class="span11">
                                </div><!--controls-->
                            </div><!--control-group-->

                            <div class="control-group">
                                <label class="control-label">PAYMENT METHOD :</label>
                                <div class="controls">
                                    <input type="text" name="method" placeholder="Enter the method used in payments.." value="<?php echo htmlentities($current_payments["method"]); ?>" class="span11">
                                </div><!--controls-->
                            </div><!--control-group-->

                            <div class="control-group">
                                <label class="control-label">DATE : </label>
                                <div class="controls">
                                    <div  data-date="2012-02-12" class="input-append date datepicker">
                                        <input type="text" value="<?php echo htmlentities($current_payments['date']); ?>" name="date"  data-date-format="yyyy-mm-dd" class="span11" >
                                        <span class="add-on"><i class="icon-th"></i></span> </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button name="submit" type="submit" class="btn btn-success">
                                    <span class="icon"><i class="icon-download-alt"></i></span> Update
                                </button>

                            </div>

                        </form>
                    </div>
                </div>
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"> <i class="icon-briefcase"></i> </span>
                        <span class="icon_right">
                            <form action="../../../receipts/invoice.php?payments=<?php echo urlencode($current_payments['id']); ?>" method="post" target="_blank">
                                <button type="submit" name="print" class="btn btn-mini btn-info">
                                    PRINT <i class="icon-print"></i>
                                </button>
                            </form>
                        </span>

                        <span class="icon_right">
                            <a href="" class="btn btn-mini btn-default">
                                <i class="icon-refresh"></i>
                            </a>
                        </span>

                        <h5 >BABA DOGO SACRED SCHOOL</h5>
                    </div>
                    <div class="widget-content">
                        <div class="row-fluid">
                            <div class="span6">
                                <table class="">
                                    <tbody>
                                    <tr>
                                        <td><h4>SACRED SCHOOL</h4></td>
                                    </tr>
                                    <tr>
                                        <td>Nairobi</td>
                                    </tr>
                                    <tr>
                                        <td>Baba Dogo</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile Phone: +254160857988</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!--span6-->

                            <div class="span6">
                                <table class="table table-bordered table-invoice">
                                    <tbody>
                                    <tr>
                                    <tr
                                        <td class="width30">Invoice ID:</td>
                                        <td class="width70" name="invoice"><strong><?php echo htmlentities($current_payments['registration']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Issue Date:</td>
                                        <td name="issue"><strong><?php echo htmlentities($current_payments['date']); ?></strong></td>
                                    </tr>

                                    <td class="width30">Students Info:</td>
                                    <td class="width70"><strong><?php echo htmlentities($current_payments['fullnames']); ?>.</strong> <br>

                                        Contact No: <?php echo htmlentities($current_payments['phone']); ?><br>
                                        Email: <?php echo htmlentities($current_payments['email']); ?></td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div><!--span6-->
                        </div><!--row-fluid-->
                        <div class="row-fluid">
                            <div class="span12">
                                <table class="table table-bordered table-invoice-full">
                                    <thead>
                                        <tr>
                                            <th class="head0">FEE TYPE</th>
                                            <th class="head1 right">AMOUNT</th>
                                            <th class="head1 right">PAID AMOUNT</th>
                                            <th class="head0 right">BALANCE</th>
                                        </tr>
                                    </thead>
                                    <?php $registration = $current_payments['registration']; ?>
                                    <?php $invoice_set = find_all_students_payments($registration); ?>
                                    <?php
                                        $total_amount = 0;
                                        $total_paid = 0;
                                        $total_balance = 0;
                                    ?>
                                    <?php while($invoice = mysqli_fetch_assoc($invoice_set)){?>
                                    <tbody>
                                        <td><?php echo htmlentities($invoice["type"]); ?></td>
                                        <td><?php echo htmlentities($invoice["amount"]); ?></td>
                                        <td><?php echo htmlentities($invoice["paid"]); ?></td>
                                        <td><?php echo htmlentities($invoice["balance"]); ?></td>

                                    </tbody>
                                    <?php
                                        $total_amount += $invoice['amount'];
                                        $total_paid += $invoice['paid'];
                                        $total_balance += $invoice['balance'];
                                    ?>
                                    <?php } ?>
                                    <?php mysqli_free_result($invoice_set); ?>
                                </table><!--table table-bordered table-invoice-full-->

                                <table class="table table-bordered table-invoice">
                                    <tbody>
                                    <tr>
                                        <td class="msg-invoice" width="85%"><h4>Payment method: </h4><hr>
                                            <a href="" class="tip-bottom" title="Paid by <?php echo htmlentities($current_payments['method']); ?>">
                                                <?php echo htmlentities($current_payments['method']); ?>
                                            </a>
                                        </td>
                                        <td class="right"><strong>AMOUNT:</strong> <br>
                                            <strong>PAID:</strong> <br>
                                            <strong>BALANCE:</strong></td>
                                        <td class="right"><strong>$<?php echo htmlentities($total_amount); ?> <br>
                                                <?php echo htmlentities($total_paid); ?> <br>
                                                <?php echo htmlentities($total_balance); ?></strong></td>
                                    </tr>
                                    </tbody>
                                </table><!--table table-bordered table-invoice-->

                                <div class="pull-right">
                                    <h4><span>Due Amount:</span> <?php echo htmlentities($total_balance); ?>.00</h4>
                                    <br>
                                    <div class="fr">
                                        <a class="btn btn-primary btn-large" href="../payments.php">
                                            <i class="icon-arrow-left"></i> BACK TO PAYMENTS
                                        </a>
                                </div>
                                </div><!--pull-right-->

                            </div><!--span12-->
                        </div><!--row-fluid-->
                    </div><!--widget-content-->
                </div><!--widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--container-->
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



