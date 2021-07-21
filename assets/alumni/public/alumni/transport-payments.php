<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/alumni_function.php'; ?>
<?php find_selected_fields(); ?>
<?php
if (!$current_alumni_id) {
    redirect_to('../alumni.php');
}
?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="../alumni.php" class="current">Alumni </a>
        </div>
        <h1>Student payments statement.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <?php
                    error_reporting(0);
                    if(isset($_POST['export'])) {
                        $fee_set = find_all_payments();
                        $payments_rows = mysqli_num_rows($fee_set);
                        if ($payments_rows>= 1){
                            $file = "exports/". strtotime(now) . ".csv";
                            $fileOpen = fopen($file, "w");
                            $all_fees_set = mysqli_fetch_assoc($fee_set);
                            $line = 0;
                            foreach ($all_fees_set as $name => $value) {
                                $line++;
                                if ($line < 20) {
                                    $label .= $name . ",";
                                }else{
                                    $label .= $name . "\n";
                                }

                            }
                            fputs($fileOpen, $label);
                            $fee_payments_set = find_total_student_amount($current_alumni_id['admin_number']);
                            while($fee_payments = mysqli_fetch_assoc($fee_payments_set)){
                                $data=$fee_payments ["id"] .",".$fee_payments['student_admin'] . "," . $fee_payments["registration"] .",". $fee_payments["surname"] .",".
                                    $fee_payments ["fullnames"] .",". $fee_payments["gender"] .",".
                                    $fee_payments["class"] ."," . $fee_payments['school'] . "," . $fee_payments["gname"] ."," . $fee_payments ["phone"] ."," .
                                    $fee_payments["email"] ."," .   $fee_payments["type"] .",". $fee_payments["options"] . ",".
                                    $fee_payments["amount"] . ",". $fee_payments["paid"] . ",". $fee_payments["balance"] . ",".
                                    $fee_payments["status"] . ",". $fee_payments["method"] . "," . $fee_payments['date']. "," . $fee_payments['term'] . "\n";
                                fputs($fileOpen, $data);
                            }

                            echo "<div class=\"alert alert-success\">";
                            echo "<button class=\"close\" id=\"#gritter-notify\" data-dismiss=\"alert\">×</button>";
                            echo "<strong><a href='$file'>Download.</a></strong>";
                            echo "</div>";
                            echo "</div>";
                        }else{
                            $_SESSION["error_message"] = "You do not have any data to export";
                        }
                    }
                    ?>
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-suitcase"></i>
                        </span>
                        <span class="icon_right">
                            <form method="post" class="form-horizontal">
                                <button type="submit" name="export" class="btn btn-mini btn-primary">
                                    EXPORT <i class="icon-share-alt"></i>
                                </button>
                            </form>
                        </span>

                         <span class="icon_right">
                            <a href="" class="btn btn-mini btn-default">
                                <i class="icon-print"></i> REFRESH
                            </a>
                        </span>

                        <span class="icon_right">
                            <a href="reports/statement.php?alumni=<?php echo urlencode($current_alumni_id['id']); ?>" class="btn btn-mini btn-info" target="_blank">
                                PRINT <i class="icon-print"></i>
                            </a>
                        </span>

                        <span class="icon_right">
                            <a href="../alumni.php" class="btn btn-mini btn-warning">
                                FORMER STUDENTS <i class="icon-group"></i>
                            </a>
                        </span>

                        <h5>Payments statement</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-invoice-full">
                            <thead>
                            <tr>
                                <th class="head0 right">FEE TYPE</th>
                                <th class="head1 right">OPTIONS</th>
                                <th class="head1 right">PAID AMOUNT</th>
                                <th class="head0 right">BALANCE</th>
                                <th class="head1 right">DATE</th>
                                <th class="head0 right">TERM</th>
                            </tr>
                            </thead>

                            <?php $total_paid = 0; ?>
                            <?php $payments_set = find_transport_payments($current_alumni_id['admin_number']); ?>
                            <?php while($payments= mysqli_fetch_assoc($payments_set)){ ?>
                                <tbody>
                                <td><?php echo htmlentities($payments['type']); ?></td>
                                <td><?php echo htmlentities($payments['options']); ?></td>
                                <td>
                                    <?php
                                    $total_paid += $payments['paid'];
                                    echo htmlentities($payments['paid']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo htmlentities($payments['balance']);
                                    ?>
                                </td>
                                <td><?php echo htmlentities($payments['date']); ?></td>
                                <td><?php echo htmlentities($payments['term']); ?></td>
                                </tbody>
                            <?php } ?>
                        </table><!--table table-bordered table-invoice-full-->
                    </div><!--widget-content nopadding-->
                </div>

                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-invoice-full">
                            <tbody>

                            <tr>
                                <td class="msg-invoice" width="85%"><h4>TOTAL STUDENT PAYMENTS: </h4><hr>
                                    <a href="" class="tip-bottom" title="Paid by ">

                                    </a>
                                </td>
                                <td class="right"><strong>AMOUNT:</strong> <br>
                                    <strong>PAID:</strong> <br>
                                    <strong>BALANCE:</strong></td>
                                <td class="right">
                                    <?php $total_amount = 0;  ?>
                                    <?php $total_amount_set = find_total_student_amount($current_alumni_id['admin_number']); ?>
                                    <?php while($amount = mysqli_fetch_assoc($total_amount_set)){ ?>
                                        <?php $total_amount += $amount['amount']; ?>
                                    <?php } ?>
                                    <?php  $total_balance = $total_amount - $total_paid; ?>
                                    <strong><?php echo $total_amount; ?><br>
                                        <?php echo $total_paid; ?><br>
                                        <?php echo $total_balance; ?>
                                    </strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="pull-right">
                            <a href="profile.php?alumni=<?php echo urlencode($current_alumni_id['id']); ?>" class="btn btn-success pull-right">
                                <i class="icon-user"></i> PROFILE
                            </a>
                        </div>
                    </div><!--widget-content nopadding-->
                </div><!--widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--continer fluid-->
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