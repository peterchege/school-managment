<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/report_functions.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="daily.php" class="current">Daily Reports</a>
        </div>
        <h1>Reports by Date and also Status.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php echo message(); ?>
                <div class="widget-box">
                    <div class="widget-content">
                        <form action="daily.php" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">REPORTS BY DATE:</label>
                                <div class="controls controls-row">

                                    <input name="date" type="text" data-date="2017-04-08" data-date-format="yyyy-mm-dd" class="datepicker span3 m-wrap" placeholder="select date..">

                                    <select name="status" class="span2 m-wrap">
                                        <option></option>
                                        <option>FULL PAID</option>
                                        <option>WITH BALANCE</option>
                                    </select>

                                    <button type="submit" name="enter" class="btn btn-primary span2 m-wrap">
                                        <i class="icon-magnet"></i> SEARCH
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--widget-box-->

                <div class="widget-box">
                    <div class="widget-content">
                        <?php error_reporting(0);
                        if(isset($_POST['date_export'])) {
                            $fee_set = find_all_payments();
                            $payments_rows = mysqli_num_rows($fee_set);
                            if ($payments_rows>= 1)  {
                                $file = "exports/". strtotime(now) . ".csv";
                                $fileOpen = fopen($file, "w");
                                $all_fees_set = mysqli_fetch_assoc($fee_set);
                                $line = 0;

                                foreach ($all_fees_set as $name => $value) {
                                    $line++;
                                    if ($line < 21) {
                                        $label .= $name . ",";
                                    }else{
                                        $label .= $name . "\n";
                                    }
                                }
                                fputs($fileOpen, $label);

                                $fee_payments_set = find_daily_payments($_SESSION['daily_date']);
                                while($fee_payments = mysqli_fetch_assoc($fee_payments_set)){
                                    $data=$fee_payments ["id"] .",".$fee_payments['student_admin'] . "," . $fee_payments["registration"] .",". $fee_payments["surname"] .",".
                                        $fee_payments ["fullnames"] .",". $fee_payments["gender"] .",".
                                        $fee_payments["class"] ."," . $fee_payments['school'] . "," . $fee_payments["gname"] ."," . $fee_payments ["phone"] ."," .
                                        $fee_payments["email"] ."," .   $fee_payments["type"] .",". $fee_payments["options"] . ",".
                                        $fee_payments["amount"] . ",". $fee_payments["paid"] . ",". $fee_payments["total"] . ",". $fee_payments["balance"] . "," .
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
                        }elseif(isset($_POST['status_export'])){
                            $fee_set = find_all_payments();
                            $payments_rows = mysqli_num_rows($fee_set);
                            if ($payments_rows>= 1)  {
                                $file = "exports/". strtotime(now) . ".csv";
                                $fileOpen = fopen($file, "w");
                                $all_fees_set = mysqli_fetch_assoc($fee_set);
                                $line = 0;

                                foreach ($all_fees_set as $name => $value) {
                                    $line++;

                                    if ($line < 21) {
                                        $label .= $name . ",";
                                    }else{
                                        $label .= $name . "\n";
                                    }
                                }
                                fputs($fileOpen, $label);

                                $fee_payments_set = find_daily_payments_by_status($_SESSION['daily_date'], $_SESSION['daily_status']);
                                while($fee_payments = mysqli_fetch_assoc($fee_payments_set)){
                                    $data=$fee_payments ["id"] .",".$fee_payments['student_admin'] . "," . $fee_payments["registration"] .",". $fee_payments["surname"] .",".
                                        $fee_payments ["fullnames"] .",". $fee_payments["gender"] .",".
                                        $fee_payments["class"] ."," . $fee_payments['school'] . "," . $fee_payments["gname"] ."," . $fee_payments ["phone"] ."," .
                                        $fee_payments["email"] ."," .   $fee_payments["type"] .",". $fee_payments["options"] . ",".
                                        $fee_payments["amount"] . ",". $fee_payments["paid"] . ",". $fee_payments["total"] . ",". $fee_payments["balance"] . "," .
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

                        }elseif(isset($_POST['export'])) {
                            $fee_set = find_all_payments();
                            $payments_rows = mysqli_num_rows($fee_set);
                            if ($payments_rows >= 1) {
                                $file = "exports/" . strtotime(now) . ".csv";
                                $fileOpen = fopen($file, "w");
                                $all_fees_set = mysqli_fetch_assoc($fee_set);
                                $line = 0;

                                foreach ($all_fees_set as $name => $value) {
                                    $line++;

                                    if ($line < 21) {
                                        $label .= $name . ",";
                                    } else {
                                        $label .= $name . "\n";
                                    }
                                }
                                fputs($fileOpen, $label);

                                $fee_payments_set = find_daily_payments(date('Y-m-d'));
                                while ($fee_payments = mysqli_fetch_assoc($fee_payments_set)) {
                                    $data = $fee_payments ["id"] . "," . $fee_payments['student_admin'] . "," . $fee_payments["registration"] . "," . $fee_payments["surname"] . "," .
                                        $fee_payments ["fullnames"] . "," . $fee_payments["gender"] . "," .
                                        $fee_payments["class"] . "," . $fee_payments['school'] . "," . $fee_payments["gname"] . "," . $fee_payments ["phone"] . "," .
                                        $fee_payments["email"] . "," . $fee_payments["type"] . "," . $fee_payments["options"] . "," .
                                        $fee_payments["amount"] . "," . $fee_payments["paid"] . "," . $fee_payments["total"] . "," . $fee_payments["balance"] . "," .
                                        $fee_payments["status"] . "," . $fee_payments["method"] . "," . $fee_payments['date'] . "," . $fee_payments['term'] . "\n";
                                    fputs($fileOpen, $data);
                                }
                                echo "<div class=\"alert alert-success\">";
                                echo "<button class=\"close\" id=\"#gritter-notify\" data-dismiss=\"alert\">×</button>";
                                echo "<strong><a href='$file'>Download.</a></strong>";
                                echo "</div>";
                                echo "</div>";

                            } else {
                                $_SESSION["error_message"] = "You do not have any data to export";
                            }

                        }
                        ?>
                    </div>
                </div><!--widget-box-->

                <?php if(isset($_POST['enter'])){?>
                    <?php $date = mysqli_sec($_POST['date']); ?>
                    <?php $_SESSION['daily_date'] = $date; ?>
                    <?php $status = mysqli_sec($_POST['status']); ?>
                    <?php $_SESSION['daily_status']= $status; ?>
                    <?php if(!empty($date) && empty($status)){?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon"><i class="icon-th"></i></span>
                                <span class="icon_right">
                                    <a href="" type="submit" class="btn btn-mini btn-default">
                                        REFRESH <i class="icon-refresh"></i>
                                    </a>
                                </span>
                                <span class="icon_right">
                                    <a href="reports/daily-report.php" class="btn btn-mini btn-info" target="_blank">
                                        <i class="icon-print"></i> PRINT
                                    </a>
                                </span>
                                <span class="icon_right">
                                   <form method="post" class="form-horizontal">
                                       <button type="submit" name="date_export" class="btn btn-mini btn-info">
                                           <i class="icon-external-link"></i> EXPORT
                                       </button>
                                   </form>
                                </span>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATION. </th>
                                        <th>FULLNAMES. </th>
                                        <th>CLASS. </th>
                                        <th>TERM.</th>
                                        <th>FEE TYPE.</th>
                                        <th>PAYMENTS</th>
                                        <th>AMOUNT</th>
                                        <th>PAID AMOUNT</th>
                                        <th>BALANCE</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <?php $total_date_paid = 0; ?>
                                    <?php $selected_date_set = find_daily_payments($date); ?>
                                    <tbody>
                                    <?php while ($selected_date = mysqli_fetch_assoc($selected_date_set)) { ?>

                                        <tr>
                                            <td><?php echo htmlentities($selected_date['registration']); ?> </td>
                                            <td><?php echo htmlentities($selected_date['fullnames']); ?> </td>
                                            <td><?php echo htmlentities($selected_date['class']); ?> </td>
                                            <td><?php echo htmlentities($selected_date['term']); ?> </td>
                                            <td><?php echo htmlentities($selected_date['type']); ?> </td>
                                            <td><?php echo htmlentities($selected_date['status']); ?> </td>
                                            <td><?php echo htmlentities($selected_date['amount']); ?> </td>
                                            <td><?php echo htmlentities($selected_date['paid']); ?> </td>
                                            <?php $total_date_paid += $selected_date['paid'];  ?>
                                            <td><?php echo htmlentities($selected_date['balance']); ?> </td>
                                            <td><?php echo htmlentities($selected_date['date']); ?> </td>
                                        </tr>
                                    <?php } ?>
                                    <?php mysqli_free_result($selected_date_set); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="widget-footer nopadding">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>TOTAL PAID</th>
                                        <td><?php echo htmlentities($total_date_paid); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    <?php }elseif (!empty($date) && !empty($status)) { ?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon"><i class="icon-th"></i></span>
                                <span class="icon_right">
                                    <a href="" type="submit" class="btn btn-mini btn-default">
                                        REFRESH <i class="icon-refresh"></i>
                                    </a>
                                </span>
                                <span class="icon_right">
                                    <a href="reports/date-status-report.php" class="btn btn-mini btn-info" target="_blank">
                                        <i class="icon-print"></i> PRINT
                                    </a>
                                </span>
                                <span class="icon_right">
                                   <form method="post" class="form-horizontal">
                                       <button type="submit" name="status_export" class="btn btn-mini btn-info">
                                            EXPORT <i class="icon-external-link"></i>
                                       </button>
                                   </form>
                                </span>
                            </div>

                            <div class="widget-content nopadding">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATION. </th>
                                        <th>FULLNAMES. </th>
                                        <th>CLASS. </th>
                                        <th>TERM.</th>
                                        <th>FEE TYPE.</th>
                                        <th>PAYMENTS</th>
                                        <th>AMOUNT</th>
                                        <th>PAID AMOUNT</th>
                                        <th>BALANCE</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <?php $total_status_paid = 0; ?>
                                    <?php $current_status_set = find_daily_payments_by_status($date, $status); ?>
                                    <tbody>
                                    <?php while ($current_status = mysqli_fetch_assoc($current_status_set)) { ?>
                                        <tr>
                                            <td><?php echo htmlentities($current_status['registration']); ?> </td>
                                            <td><?php echo htmlentities($current_status['fullnames']); ?> </td>
                                            <td><?php echo htmlentities($current_status['class']); ?> </td>
                                            <td><?php echo htmlentities($current_status['term']); ?> </td>
                                            <td><?php echo htmlentities($current_status['type']); ?> </td>
                                            <td><?php echo htmlentities($current_status['status']); ?> </td>
                                            <td><?php echo htmlentities($current_status['amount']); ?> </td>
                                            <td><?php echo htmlentities($current_status['paid']); ?> </td>
                                            <?php $total_status_paid += $current_status['paid']; ?>
                                            <td><?php echo htmlentities($current_status['balance']); ?> </td>
                                            <td><?php echo htmlentities($current_status['date']); ?> </td>
                                        </tr>

                                    <?php } ?>
                                    <?php mysqli_free_result($current_status_set); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="widget-footer nopadding">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>TOTAL PAID: </th>
                                        <td><?php echo htmlentities($total_status_paid); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                <?php }else{?>
                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon"><i class="icon-th"></i></span>
                            <span class="icon_right">
                                <a href="" type="submit" class="btn btn-mini btn-default">
                                    REFRESH <i class="icon-refresh"></i>
                                </a>
                            </span>
                            <span class="icon_right">
                                <a href="reports/day-to-day-report.php" class="btn btn-mini btn-primary" target="_blank">
                                    <i class="icon-print"></i> PRINT
                                </a>
                            </span>
                            <span class="icon_right">
                                <form method="post" class="form-horizontal">
                                    <button type="submit" name="export" class="btn btn-mini btn-info">
                                        <i class="icon-external-link"></i> EXPORT
                                    </button>
                                </form>
                            </span>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>REGISTRATION. </th>
                                    <th>FULLNAMES. </th>
                                    <th>CLASS. </th>
                                    <th>TERM.</th>
                                    <th>FEE TYPE.</th>
                                    <th>PAYMENTS</th>
                                    <th>AMOUNT</th>
                                    <th>PAID AMOUNT</th>
                                    <th>BALANCE</th>
                                    <th>DATE</th>
                                </tr>
                                </thead>
                                <?php $total_paid = 0; ?>
                                <?php $payments_set = find_daily_payments(date('Y-m-d')); ?>
                                <tbody>
                                <?php while ($payments = mysqli_fetch_assoc($payments_set)) { ?>
                                <tr>
                                    <td><?php echo htmlentities($payments['registration']); ?> </td>
                                    <td><?php echo htmlentities($payments['fullnames']); ?> </td>
                                    <td><?php echo htmlentities($payments['class']); ?> </td>
                                    <td><?php echo htmlentities($payments['term']); ?> </td>
                                    <td><?php echo htmlentities($payments['type']); ?> </td>
                                    <td><?php echo htmlentities($payments['status']); ?> </td>
                                    <td><?php echo htmlentities($payments['amount']); ?> </td>
                                    <td><?php echo htmlentities($payments['paid']); ?> </td>
                                    <?php $total_paid += $payments['paid']; ?>
                                    <td><?php echo htmlentities($payments['balance']); ?> </td>
                                    <td><?php echo htmlentities($payments['date']); ?> </td>
                                </tr>
                                <?php } ?>
                                <?php mysqli_free_result($payments_set); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="widget-footer nopadding">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>TOTAL PAID: </th>
                                    <td><?php echo htmlentities($total_paid); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php } ?>
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->

</div><!--content-->
<?php require_once('../../../includes/system/table_footer.php'); ?>
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
