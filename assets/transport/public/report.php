<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/transport_function.php'; ?>
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
            <a href="report.php" class="current">Reports</a>
        </div>
        <h1>Reports.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php echo message(); ?>
                <div class="widget-box">
                    <div class="widget-content">
                        <form action="report.php" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">BETWEEN DATE:</label>

                                <div class="controls controls-row">

                                    <select name="status" class="span2 m-wrap">
                                        <option></option>
                                        <option>FULL PAID</option>
                                        <option>WITH BALANCE</option>
                                    </select>

                                    <input name="start_date" type="text" data-date="2017-04-08" data-date-format="yyyy-mm-dd" value="" class="datepicker span3 m-wrap" placeholder="first date">

                                    <input name="end_date" type="text" data-date="2017-04-08" data-date-format="yyyy-mm-dd" value="" class="datepicker span2 m-wrap" placeholder="end date">

                                    <button type="submit" name="enter" class="btn btn-primary span2 m-wrap">
                                        <i class="icon-calendar"></i> SEARCH
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--widget-box-->

                <div class="widget-box">
                    <?php error_reporting(0);
                    if(isset($_POST['range'])) {
                        $fee_set = find_all_payments();
                        $payments_rows = mysqli_num_rows($fee_set);
                        if ($payments_rows>= 1)  {
                            $file = "exports/". strtotime(now) . ".csv";
                            $fileOpen = fopen($file, "w");
                            $all_fees_set = mysqli_fetch_assoc($fee_set);
                            $line = 0;

                            foreach ($all_fees_set as $name => $value) {
                                $line++;
                                if ($line < 22) {
                                    $label .= $name . ",";
                                }else{
                                    $label .= $name . "\n";
                                }
                            }
                            fputs($fileOpen, $label);

                            $fee_payments_set = find_payments_by_status_and_date_range($_SESSION['status'], $_SESSION['strt'], $_SESSION['end']);
                            while($fee_payments = mysqli_fetch_assoc($fee_payments_set)){
                                $data=$fee_payments ["id"] .",".$fee_payments['student_admin'] . "," . $fee_payments["registration"] .",".
                                    $fee_payments ["fullnames"] .",". $fee_payments["gender"] .",".
                                    $fee_payments["school"] ."," . $fee_payments['class'] . "," . $fee_payments["gname"] ."," . $fee_payments ["phone"] ."," .
                                    $fee_payments["email"] ."," .   $fee_payments["type"] .",". $fee_payments["options"] . ",". $fee_payments["route"] . "," .
                                    $fee_payments["payments"] . "," . $fee_payments["amount"] . ",". $fee_payments["paid"] . ",". $fee_payments["balance"] . ",".
                                    $fee_payments["total"] . "," . $fee_payments["status"] . ",". $fee_payments["method"] . "," . $fee_payments['date']. "," . $fee_payments['term'] . "\n";
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
                    }elseif(isset($_POST['date-range'])){
                        $fee_set = find_all_payments();
                        $payments_rows = mysqli_num_rows($fee_set);
                        if ($payments_rows>= 1)  {
                            $file = "exports/". strtotime(now) . ".csv";
                            $fileOpen = fopen($file, "w");
                            $all_fees_set = mysqli_fetch_assoc($fee_set);
                            $line = 0;

                            foreach ($all_fees_set as $name => $value) {
                                $line++;
                                if ($line < 22) {
                                    $label .= $name . ",";
                                }else{
                                    $label .= $name . "\n";
                                }
                            }
                            fputs($fileOpen, $label);

                            $fee_payments_set = find_payments_by_date_range($_SESSION['strt'], $_SESSION['end']);
                            while($fee_payments = mysqli_fetch_assoc($fee_payments_set)){
                                $data=$fee_payments ["id"] .",".$fee_payments['student_admin'] . "," . $fee_payments["registration"] .",".
                                    $fee_payments ["fullnames"] .",". $fee_payments["gender"] .",".
                                    $fee_payments["school"] ."," . $fee_payments['class'] . "," . $fee_payments["gname"] ."," . $fee_payments ["phone"] ."," .
                                    $fee_payments["email"] ."," .   $fee_payments["type"] .",". $fee_payments["options"] . ",". $fee_payments["route"] . "," .
                                    $fee_payments["payments"] . "," . $fee_payments["amount"] . ",". $fee_payments["paid"] . ",". $fee_payments["balance"] . ",".
                                    $fee_payments["total"] . "," . $fee_payments["status"] . ",". $fee_payments["method"] . "," . $fee_payments['date']. "," . $fee_payments['term'] . "\n";
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
                </div>

                <?php if(isset($_POST['enter'])){?>
                    <?php

                    $status = mysqli_sec($_POST['status']);
                    $_SESSION['status'] = $status;

                    $start_date = mysqli_sec($_POST['start_date']);
                    $_SESSION['strt'] = $start_date;

                    $end_date = mysqli_sec($_POST['end_date']);
                    $_SESSION['end'] = $end_date;

                    ?>
                    <?php if(!empty($status) && !empty($start_date) && !empty($end_date)){ ?>
                        <div class="widget-box">
                            <div class="widget-title">
                            <span class="icon">
                                <i class="icon-th"></i>
                            </span>

                            <span class="icon_right">
                                <a href="report.php" class="btn btn-mini btn-default">
                                    <i class="icon-refresh"></i> REFRESH
                                </a>
                            </span>

                             <span class="icon_right">
                                <a href="students/status-range.php" class="btn btn-mini btn-primary" target="_blank">
                                    PRINT <i class="icon-print"></i>
                                </a>
                            </span>

                             <span class="icon_right">
                                 <form action="report.php" method="post" class="form-horizontal">
                                     <button type="submit" name="range" class="btn btn-mini btn-info">
                                         <i class="icon-external-link"></i> EXPORT
                                     </button>
                                 </form>
                            </span>
                            </div>

                            <div class="widget-content">
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
                                    <?php $payments_set = find_payments_by_status_and_date_range($status, $start_date, $end_date); ?>
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
                            <div class="widget-footer">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>TOTAL PAYMENTS</th>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php }elseif(empty($status) && !empty($start_date) && !empty($end_date)){ ?>
                        <div class="widget-box">
                            <div class="widget-title">
                            <span class="icon">
                                <i class="icon-th"></i>
                            </span>

                            <span class="icon_right">
                                <a href="report.php" class="btn btn-mini btn-default">
                                    <i class="icon-refresh"></i> REFRESH
                                </a>
                            </span>

                             <span class="icon_right">
                                <a href="students/range.php" class="btn btn-mini btn-primary" target="_blank">
                                    PRINT <i class="icon-print"></i>
                                </a>
                            </span>

                             <span class="icon_right">
                                 <form action="report.php" method="post" class="form-horizontal">
                                     <button type="submit" name="date-range" class="btn btn-mini btn-info">
                                         <i class="icon-external-link"></i> EXPORT
                                     </button>
                                 </form>
                            </span>
                            </div>

                            <div class="widget-content">
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
                                    <?php $payments_set = find_payments_by_date_range($start_date, $end_date); ?>
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
                            <div class="widget-footer">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>TOTAL PAYMENTS</th>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    <?php } ?>
                <?php }else{ ?>

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