<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php $current_student = find_student_by_adm($_GET['student']); ?>
<?php
    if(!$current_student){
        redirect_to('../test_pay.php');
    }
?>
<?php $current_student_parents = find_parents_for_student($current_student['admin']); ?>
<?php  ?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_login_time(); ?>
<?php echo navigation_nav();; ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home</a>
            <a href="../manage_fee.php" class="current">Fees</a>
        </div>
        <h1>Manage Fees.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
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
                            </div>
                            <div class="span6">
                                <table class="table table-bordered table-invoice">
                                    <tbody>
                                    <tr>
                                    <tr>
                                        <td class="width30">Invoice ID:</td>
                                        <td class="width70"><strong>TD-6546</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Issue Date:</td>
                                        <td><strong>March 23, 2013</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Due Date:</td>
                                        <td><strong>April 01, 2013</strong></td>
                                    </tr>
                                    <?php $students_parents = find_parents_for_student($_GET['student']); ?>
                                    <td class="width30">Students Info:</td>
                                    <td class="width70"><strong><?php echo htmlentities($current_student['full_names']); ?>.</strong> <br>
                                        <?php echo htmlentities($current_student_parents['address']); ?> <br>
                                        Contact No: <?php echo htmlentities($current_student_parents['phone']); ?><br>
                                        Email: <?php echo htmlentities($current_student_parents['email']); ?> </td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
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
                                    <?php $invoice_set = find_payments_for_student($current_student['admin']); ?>
                                    <?php while($invoice = mysqli_fetch_assoc($invoice_set)){ ?>
                                    <tbody>
                                    <tr>
                                        <td><?php echo htmlentities($invoice['type']); ?></td>
                                        <td class="right" name="amount"><?php echo htmlentities($invoice['amount']); ?></td>
                                        <td class="right" name="paid"><?php echo htmlentities($invoice['paid']); ?></td>
                                        <td class="right" name = "balance"><strong><?php echo htmlentities($invoice['balance']); ?></strong></td>
                                    </tr>

                                    </tbody>
                                    <?php } ?>
                                    <?php mysqli_free_result($invoice_set); ?>
                                </table>

                                <table class="table table-bordered table-invoice-full">
                                    <tbody>
                                    <tr>
                                        <td class="msg-invoice" width="85%"><h4>Payment method: </h4>
                                            <a href="#" class="tip-bottom" title="Wire Transfer">Wire transfer</a> |  <a href="#" class="tip-bottom" title="Bank account">Bank account #</a> |  <a href="#" class="tip-bottom" title="SWIFT code">SWIFT code </a>|  <a href="#" class="tip-bottom" title="IBAN Billing address">IBAN Billing address </a></td>
                                        <td class="right"><strong>Subtotal</strong> <br>
                                            <strong>Tax (5%)</strong> <br>
                                            <strong>Discount</strong></td>
                                        <td class="right"><strong>$7,000 <br>
                                                $600 <br>
                                                $50</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="pull-right">
                                    <h4><span>Amount Due:</span> $7,650.00</h4>
                                    <br>
                                    <a class="btn btn-primary btn-large pull-right" href="">Pay Invoice</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/matrix.js"></script>
</body>
</html>
