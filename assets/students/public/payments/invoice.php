<?php require_once '../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php find_selected_fields(); ?>
<?php if(!$current_student_admin){redirect_to('../students.php');} ?>
<?php if(isset($_GET['student'])){$current_parent = find_current_parent($_GET['student']);} ?>
<?php confirm_other_folder_logged_in(); ?>
<?php $total_payments_set = find_payments_student_made($_GET['student']); ?>
<?php
$total_amount = 0;
$total_paid = 0;
?>
<?php while($total_payments = mysqli_fetch_assoc($total_payments_set)){
    $total_amount += (int)$total_payments['amount'];
    $total_paid += $total_payments['paid'];

} ?>
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
                <div class="widget-box">
                    <?php if(isset($_POST['add'])){ ?>
                        <div class="widget-content nopadding">
                            <form action="payments.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" method="post" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label"> FEE TYPE:</label>
                                    <div class="controls">
                                        <select name="type" class="span11">
                                            <option></option>
                                            <?php $fees_set = find_structure_by_type_school_and_term($current_student_admin['school'], $_SESSION['term_set']);  ?>
                                            <?php while($fees = mysqli_fetch_assoc($fees_set)){ ?>
                                                <option><?php echo htmlentities($fees['type']); ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">INITIAL BALANCE</label>
                                    <div class="controls">
                                        <input type="text" id="initial" value="<?php echo htmlentities($_SESSION['total_balance']); ?>" name="initial;" placeholder="Enter the students initial balance." class="span11" onkeyup="sum();">
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">PAID AMOUNT:</label>
                                    <div class="controls">
                                        <input type="text" id="paid" name="paid" placeholder="Enter the paid amount." class="span11" >
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">PAYMENTS:</label>
                                    <div class="controls">
                                        <select name="method">
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
                                        <input name="date" type="text" data-date="2017-04-14" data-date-format="yyyy-mm-dd" value="<?php echo htmlentities(date('Y-m-d')); ?>" class="datepicker span11">
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
                                        <i class="icon-money"></i> CREATE
                                    </button>

                                    <button type="submit" class="btn btn-default">
                                        <i class="icon-refresh"></i> REFRESH
                                    </button>
                                </div>

                            </form>
                        </div>
                    <?php }?>
                </div>
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <form action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">TERM: </label>
                                <div class="controls controls-row">
                                    <select name="term_set" class="span7 m-wrap">
                                        <option></option>
                                        <option>ONE</option>
                                        <option>TWO</option>
                                        <option>THREE</option>
                                    </select>
                               
                                    <button type="submit" name="term" class="span2 m-wrap btn btn-primary">
                                        <i class="icon-ok-sign"></i> Ok
                                    </button>


                                    <a href="../students.php" class="span2 m-wrap btn btn-warning">
                                        <i class="icon-arrow-left"></i> BACK
                                    </a>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <?php
                if(empty($_POST['term_set'])){
                    $term = $_SESSION['login_term'];
                }else{
                    $term = mysqli_sec($_POST['term_set']);
                }
                $_SESSION['term_set'] = $term;
                ?>
                <div class="widget-box">
                    <div class="widget-title">
                            <span class="icon"> <i class="icon-briefcase"></i> </span>
                        <span class="icon_right">
                            <a href="../../../receipts/pay_invoice.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" class="btn btn-mini btn-info" target="_blank">
                                PRINT <i class="icon-print"></i>
                            </a>
                        </span>

                        <span class="icon_right">
                            <form action="" method="post" class="form-horizontal">
                                <button type="submit" name="add" class="btn btn-mini btn-">
                                    CREATE <i class="icon-plus-sign"></i>
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
                                        <tr>
                                            <td>TERM: <?php echo htmlentities($_SESSION['term_set']); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!--span6-->

                                <div class="span6">
                                    <table class="table table-bordered table-invoice">
                                        <tbody>
                                        <tr>
                                        <tr>
                                            <td class="width30">REGISTRATION NUMBER:</td>
                                            <td class="width70" name="invoice"><strong><?php echo htmlentities($current_student_admin['registration']) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Issue Date:</td>
                                            <td name="issue"><strong><?php echo date('Y-m-d'); ?></strong></td>
                                        </tr>

                                        <td class="width30">Students Info:</td>
                                        <td class="width70"><strong><?php echo htmlentities($current_student_admin['full_names']); ?></strong> <br>
                                            Class: <?php echo htmlentities($current_student_admin['class']); ?><br>
                                            Contact No: <?php echo htmlentities($current_parent['phone']); ?><br>
                                            Email: <?php echo htmlentities($current_parent['email']); ?></td>
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
                                            <th class="head0 right">FEE TYPE</th>
                                            <th class="head1 right">OPTIONS</th>
                                            <th class="head0 right">AMOUNT</th>
                                            <th class="head1 right">PAID AMOUNT</th>
                                            <th class="head0 right">BALANCE</th>
                                            <th class="head1 right">PAYMENTS</th>
                                            <th class="head0 right">DATE</th>
                                            <th class="head1 right">TERM</th>
                                            <th class="head0 right">PAY</th>
                                            <th class="head1 right">CONFIRM</th>
                                            <th class="head0 right">RECEIPTS</th>
                                            <th class="head1 right">TRANSFER RECORDS</th>
                                        </tr>
                                        </thead>
                                        <?php $payments_set = find_all_payments_for_students($_GET['student'], $term); ?>
                                        <?php
                                        $total_term_amount = 0;
                                        $total_term = 0;
                                        $total_term_paid = 0;
                                        ?>
                                        <?php while($payments= mysqli_fetch_assoc($payments_set)){ ?>
                                            <tbody>
                                            <td><?php echo htmlentities($payments['type']); ?></td>
                                            <td><?php echo htmlentities($payments['options']); ?></td>
                                            <td><?php $amount_set = find_structure_amount($payments['amount']); ?>
                                                <?php  while($amount = mysqli_fetch_assoc($amount_set)){$total_term += $amount['amount']; }
                                                $total_term_amount += (int)$payments['amount'];
                                                echo htmlentities($payments['amount']);
                                                ?>
                                            </td>
                                            <td><?php $total_term_paid += $payments['paid'];echo htmlentities($payments['paid']); ?></td>
                                            <td><?php echo htmlentities($payments['balance']); ?></td>
                                            <td><?php echo htmlentities($payments['status']); ?></td>
                                            <td><?php echo htmlentities($payments['date']); ?></td>
                                            <td><?php echo htmlentities($payments['term']); ?></td>
                                            <td>
                                                <a href="make_payments.php?payments=<?php echo urlencode($payments['id']); ?>" class="btn btn-mini btn-success">
                                                    PAY <i class="icon-money"></i>
                                                </a>
                                            </td>
                                            
                                            <td>
                                                <a href="confirm.php?payments=<?php echo htmlentities($payments['id']); ?>" class="btn btn-mini btn-warning">
                                                    CHECK <i class="icon-eye-open"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="../../../receipts/receipts.php?payments=<?php echo urlencode($payments['id']); ?>&paid=<?php echo $total_paid; ?>&tamount=<?php echo $total_amount; ?>" class="btn btn-link" target="_blank">
                                                    <i class="icon-credit-card"></i> ISSUE
                                                </a>
                                            </td>
                                            <td>
                                                <div class="fr">
                                                    <form action="move-payments.php?payments=<?php echo urlencode($payments['id']); ?>" method="post" class="form-horizontal">
                                                        <button name="move" type="submit" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure..?');">
                                                            <i class="icon-cogs"></i> MOVE
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            </tbody>
                                        <?php } ?>
                                    </table><!--table table-bordered table-invoice-full-->

                                    <table class="table table-bordered table-invoice">
                                        <tbody>

                                        <tr>
                                            <td class="msg-invoice" width="85%"><h4>TERM: </h4><hr>
                                                <a href="" class="tip-bottom" title="Paid by ">
                                                    <?php echo htmlentities($_SESSION['term_set']); ?>
                                                </a>
                                            </td>
                                            <td class="right"><strong>AMOUNT:</strong> <br>
                                                <strong>PAID:</strong> <br>
                                                <strong>BALANCE:</strong></td>
                                            <td class="right">
                                                <?php  $total_term_balance = $total_term_amount - $total_term_paid; ?>
                                                <strong><?php echo $total_term_amount; ?><br>
                                                    <?php echo $total_term_paid; ?><br>
                                                    <?php echo $total_term_balance; ?>
                                                </strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered table-invoice">
                                        <tbody>

                                        <tr>
                                            <td class="msg-invoice" width="85%"><h4>TOTAL PAYMENTS: </h4><hr>
                                                <a href="" class="tip-bottom" title="Paid by ">
                                                    <?php echo date('Y'); ?>
                                                </a>
                                            </td>
                                            <td class="right"><strong>AMOUNT:</strong> <br>
                                                <strong>PAID:</strong> <br>
                                                <strong>BALANCE:</strong></td>
                                            <td class="right"><strong><?php echo $total_amount; ?><br>
                                                    <?php echo $total_paid; ?><br>
                                                    <?php
                                                    $total_balance = $total_amount - $total_paid;
                                                    $_SESSION['total_balance'] = $total_balance;
                                                    echo $total_balance; ?></strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>



                                    <div class="pull-left">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <h4>
                                                        <a href="../lunch/lunch-invoice.php?student=<?php echo urlencode($current_student_admin['admin']);?>" name="lunch" class="btn btn-mini btn-info">
                                                            LUNCH FEE
                                                        </a>
                                                    </h4>
                                                </td>
                                                <td>
                                                    <h4>
                                                        <a href="../transport/transport-invoice.php?student=<?php echo urlencode($current_student_admin['admin']);?>" type="submit" name="transport" class="btn btn-mini btn-primary">
                                                            TRANSPORT FEE
                                                        </a>
                                                    </h4>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php $tbalance = (int)$total_balance ?>
                                    <div class="pull-right">
                                        <h4><span>Due Amount:</span> <?php echo htmlentities($total_balance); ?>.00</h4>
                                        <br>
                                        <div class="fr">
										
										<a class="btn btn-primary btn-large" href="make_payments.php?payments=<?php echo urlencode($payments['id']); ?>">
                                                CLEAR BALANCE <i class="icon-credit-card"></i>
                                            </a>
                                            <a class="btn btn-primary btn-large" href="../students.php">
                                                STUDENTS <i class="icon-arrow-left"></i>
                                            </a>

                                            <a href="../profile.php?student=<?php echo urlencode($current_student_admin['admin']); ?>" class="btn btn-info btn-large">
                                                <i class="icon-user"></i> PROFILE
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


