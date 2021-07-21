<?php require_once('../../../includes/initialization.php') ?>
<?php require_once('../includes/inventories_function.php') ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="../../home.php" title="Go to Home" class="tip-bottom">
                    <i class="icon-home"></i> Home</a>
                <a href="payments.php" class="current">Payments</a>
            </div>
            <h1>Stocks payments.</h1>
        </div><!--content-header-->

        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <?php $layout_context = $_SESSION['usertype']; ?>
                    <?php if($layout_context == 'Admin'){?>
                        <?php echo message(); ?>
                    <?php } ?>
                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <div class="controls controls-row">
                                <form action="payments.php" method="post" class="form-horizontal">
                                    <select name="stock" class="span3 m-wrap">
                                        <option></option>
                                        <?php $stocks_set = find_all_stocks(); ?>
                                        <?php while($stocks=mysqli_fetch_assoc($stocks_set)){?>
                                            <option><?php echo htmlentities($stocks['stock']); ?></option>
                                        <?php } ?>
                                        <?php mysqli_free_result($stocks_set); ?>

                                    </select>


                                    <select name="term" class="span3 m-wrap">
                                        <option></option>
                                        <option>ONE</option>
                                        <option>TWO</option>
                                        <option>THREE</option>
                                    </select>


                                    <button type="submit" name="enter" class="btn btn-success span2 m-wrap">
                                        <i class="icon-ok-sign"></i> SELECT
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div><!--widget-box-->

                    <div class="widget-box">
                        <?php
                        error_reporting(0);
                        if(isset($_POST['stock_export'])) {
                            $fee_set = find_all_payments();
                            $payments_rows = mysqli_num_rows($fee_set);
                            if ($payments_rows >= 1) {
                                $file = "exports/" . strtotime(now) . ".csv";
                                $fileOpen = fopen($file, "w");

                                $all_fees_set = mysqli_fetch_assoc($fee_set);
                                $line = 0;

                                foreach ($all_fees_set as $name => $value) {
                                    $line++;

                                    if ($line < 23) {
                                        $label .= $name . ",";
                                    } else {
                                        $label .= $name . "\n";
                                    }
                                }
                                fputs($fileOpen, $label);

                                $fee_payments_set = find_stocks_payments($_SESSION['stock']);
                                while ($fee_payments = mysqli_fetch_assoc($fee_payments_set)) {
                                    $data = $fee_payments ["id"] . "," . $fee_payments['student_admin'] . "," . $fee_payments["registration"] . "," . $fee_payments["surname"] . "," .
                                        $fee_payments ["fullnames"] . "," . $fee_payments["gender"] . "," .
                                        $fee_payments["class"] . "," . $fee_payments['school'] . "," . $fee_payments["gname"] . "," . $fee_payments ["phone"] . "," .
                                        $fee_payments["email"] . "," . $fee_payments["stock"] . "," . $fee_payments["size"] . "," . $fee_payments["quantity"] . "," .
                                        $fee_payments["amount"] . "," . $fee_payments["total_amount"] . "," . $fee_payments["paid"] . "," . $fee_payments["total"] . "," .
                                        $fee_payments["balance"] . "," . $fee_payments["status"] . "," . $fee_payments['method'] . "," . $fee_payments['date'] . "," . $fee_payments['term'] . "\n";
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
                        }elseif(isset($_POST['term_export'])){
                            $fee_set = find_all_payments();
                            $payments_rows = mysqli_num_rows($fee_set);
                            if ($payments_rows >= 1) {
                                $file = "exports/" . strtotime(now) . ".csv";
                                $fileOpen = fopen($file, "w");

                                $all_fees_set = mysqli_fetch_assoc($fee_set);
                                $line = 0;

                                foreach ($all_fees_set as $name => $value) {
                                    $line++;

                                    if ($line < 23) {
                                        $label .= $name . ",";
                                    } else {
                                        $label .= $name . "\n";
                                    }
                                }
                                fputs($fileOpen, $label);

                                $fee_payments_set = find_stocks_payments_by_term($_SESSION['stock_term']);
                                while ($fee_payments = mysqli_fetch_assoc($fee_payments_set)) {
                                    $data = $fee_payments ["id"] . "," . $fee_payments['student_admin'] . "," . $fee_payments["registration"] . "," . $fee_payments["surname"] . "," .
                                        $fee_payments ["fullnames"] . "," . $fee_payments["gender"] . "," .
                                        $fee_payments["class"] . "," . $fee_payments['school'] . "," . $fee_payments["gname"] . "," . $fee_payments ["phone"] . "," .
                                        $fee_payments["email"] . "," . $fee_payments["stock"] . "," . $fee_payments["size"] . "," . $fee_payments["quantity"] . "," .
                                        $fee_payments["amount"] . "," . $fee_payments["total_amount"] . "," . $fee_payments["paid"] . "," . $fee_payments["total"] . "," .
                                        $fee_payments["balance"] . "," . $fee_payments["status"] . "," . $fee_payments['method'] . "," . $fee_payments['date'] . "," . $fee_payments['term'] . "\n";
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

                        }elseif(isset($_POST['stock_term_export'])){

                            $fee_set = find_all_payments();
                            $payments_rows = mysqli_num_rows($fee_set);
                            if ($payments_rows >= 1) {
                                $file = "exports/" . strtotime(now) . ".csv";
                                $fileOpen = fopen($file, "w");

                                $all_fees_set = mysqli_fetch_assoc($fee_set);
                                $line = 0;

                                foreach ($all_fees_set as $name => $value) {
                                    $line++;

                                    if ($line < 23) {
                                        $label .= $name . ",";
                                    } else {
                                        $label .= $name . "\n";
                                    }
                                }
                                fputs($fileOpen, $label);

                                $fee_payments_set = find_stocks_payments_by_stock_and_term($_SESSION['stock'], $_SESSION['stock_term']);
                                while ($fee_payments = mysqli_fetch_assoc($fee_payments_set)) {
                                    $data = $fee_payments ["id"] . "," . $fee_payments['student_admin'] . "," . $fee_payments["registration"] . "," . $fee_payments["surname"] . "," .
                                        $fee_payments ["fullnames"] . "," . $fee_payments["gender"] . "," .
                                        $fee_payments["class"] . "," . $fee_payments['school'] . "," . $fee_payments["gname"] . "," . $fee_payments ["phone"] . "," .
                                        $fee_payments["email"] . "," . $fee_payments["stock"] . "," . $fee_payments["size"] . "," . $fee_payments["quantity"] . "," .
                                        $fee_payments["amount"] . "," . $fee_payments["total_amount"] . "," . $fee_payments["paid"] . "," . $fee_payments["total"] . "," .
                                        $fee_payments["balance"] . "," . $fee_payments["status"] . "," . $fee_payments['method'] . "," . $fee_payments['date'] . "," . $fee_payments['term'] . "\n";
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

                    <div class="widget-box">
                        <?php if(isset($_POST['enter'])){?>
                            <?php
                            $stock = mysqli_sec($_POST['stock']);
                            $_SESSION['stock'] = $stock;

                            $term = mysqli_sec($_POST['term']);
                            $_SESSION['stock_term'] = $term;
                            ?>

                            <?php if(!empty($stock) && empty($term)){?>

                                <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-th"></i>
                                    </span>

                                    <span class="icon_right">
                                        <form action="payments.php" method="post" class="form-horizontal">
                                            <button name="stock_export" type="submit" class="btn btn-mini btn-info">
                                                <i class="icon-external-link"></i> EXPORT
                                            </button>
                                        </form>
                                    </span>

                                    <span class="icon_right">
                                        <a href="" class="btn btn-mini btn-default"><i class="icon-refresh"></i> REFRESH</a>
                                    </span>
                                    <span class="icon_right">
                                        <a href="students/stock-print.php" class="btn btn-mini btn-primary" target="_blank">
                                            <i class="icon-print"></i> PRINT
                                        </a>
                                    </span>

                                    <h5>Stocks Payments</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <table class="table table-bordered table-responsive">
                                        <thead>
                                        <tr>
                                            <th>REGISTRATION #</th>
                                            <th>SURNAME</th>
                                            <th>FULL NAMES</th>
                                            <th>GENDER</th>
                                            <th>CLASS</th>
                                            <th>STOCK</th>
                                            <th>QUANTITY</th>
                                            <th>SIZE</th>
                                            <th>TOTAL AMOUNT</th>
                                            <th>PAID AMOUNT</th>
                                            <th>BALANCE</th>
                                            <th>DATE</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total_paid = 0; ?>
                                        <?php $students_set = find_stocks_payments($stock); ?>
                                        <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                            <tr>
                                                <td><?php echo htmlentities($students['registration']); ?></td>
                                                <td><?php echo htmlentities($students['surname']); ?></td>
                                                <td><?php echo htmlentities($students['fullnames']); ?></td>
                                                <td><?php echo htmlentities($students['gender']); ?></td>
                                                <td><?php echo htmlentities($students['class']) ?></td>
                                                <td><?php echo htmlentities($students['stock']) ?></td>
                                                <td><?php echo htmlentities($students['quantity']) ?></td>
                                                <td><?php echo htmlentities($students['size']) ?></td>
                                                <td><?php echo htmlentities($students['total_amount']) ?></td>
                                                <td><?php echo htmlentities($students['paid']) ?></td>
                                                <?php $total_paid += $students['paid']; ?>
                                                <td><?php echo htmlentities($students['balance']) ?></td>
                                                <td><?php echo htmlentities($students['date']) ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php mysqli_free_result($students_set); ?>
                                        </tbody>
                                    </table>
                                </div><!--widget-content nopadding-->
                                <div class="widget-footer">
                                    <table  class="table table-bordered table-responsive">
                                        <tbody>
                                        <th>TOTAL PAYMENTS: </th>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                        </tbody>
                                    </table>
                                </div><!--widget-footer-->

                            <?php }elseif(empty($stock) && !empty($term)){?>
                                <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-th"></i>
                                    </span>

                                    <span class="icon_right">
                                        <form action="payments.php" method="post" class="form-horizontal">
                                            <button name="term_export" type="submit" class="btn btn-mini btn-info">
                                                <i class="icon-external-link"></i> EXPORT
                                            </button>
                                        </form>
                                    </span>

                                    <span class="icon_right">
                                        <a href="" class="btn btn-mini btn-default">
                                            REFRESH <i class="icon-refresh"></i>
                                        </a>
                                    </span>

                                    <span class="icon_right">
                                        <a href="students/term-print.php" class="btn btn-mini btn-info" target="_blank">
                                            <i class="icon-print"></i> PRINT
                                        </a>
                                    </span>
                                    <h5>Stock Term Payments</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <table class="table table-bordered table-responsive">
                                        <thead>
                                        <tr>
                                            <th>REGISTRATION #</th>
                                            <th>SURNAME</th>
                                            <th>FULL NAMES</th>
                                            <th>GENDER</th>
                                            <th>CLASS</th>
                                            <th>STOCK</th>
                                            <th>QUANTITY</th>
                                            <th>SIZE</th>
                                            <th>TOTAL AMOUNT</th>
                                            <th>PAID AMOUNT</th>
                                            <th>BALANCE</th>
                                            <th>DATE</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total_paid = 0; ?>
                                        <?php $students_set = find_stocks_payments_by_term($term); ?>
                                        <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                            <tr>
                                                <td><?php echo htmlentities($students['registration']); ?></td>
                                                <td><?php echo htmlentities($students['surname']); ?></td>
                                                <td><?php echo htmlentities($students['fullnames']); ?></td>
                                                <td><?php echo htmlentities($students['gender']); ?></td>
                                                <td><?php echo htmlentities($students['class']) ?></td>
                                                <td><?php echo htmlentities($students['stock']) ?></td>
                                                <td><?php echo htmlentities($students['quantity']) ?></td>
                                                <td><?php echo htmlentities($students['size']) ?></td>
                                                <td><?php echo htmlentities($students['total_amount']) ?></td>
                                                <td><?php echo htmlentities($students['paid']) ?></td>
                                                <?php $total_paid += $students['paid']; ?>
                                                <td><?php echo htmlentities($students['balance']) ?></td>
                                                <td><?php echo htmlentities($students['date']) ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php mysqli_free_result($students_set); ?>
                                        </tbody>
                                    </table>
                                </div><!--widget-content nopadding-->
                                <div class="widget-footer">
                                    <table  class="table table-bordered table-responsive">
                                        <tbody>
                                        <th>TOTAL PAYMENTS: </th>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                        </tbody>
                                    </table>
                                </div><!--widget-footer-->

                            <?php }elseif(!empty($stock) && !empty($term)){ ?>
                                <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-th"></i>
                                    </span>

                                    <span class="icon_right">
                                        <form action="payments.php" method="post" class="form-horizontal">
                                            <button name="stock_term_export" type="submit" class="btn btn-mini btn-info">
                                                <i class="icon-external-link"></i> EXPORT
                                            </button>
                                        </form>
                                    </span>

                                    <span class="icon_right">
                                        <a href="" class="btn btn-mini btn-default">
                                            REFRESH <i class="icon-refresh"></i>
                                        </a>
                                    </span>

                                    <span class="icon_right">
                                        <a href="students/stock-term-print.php" class="btn btn-mini btn-info" target="_blank">
                                            <i class="icon-print"></i> PRINT
                                        </a>
                                    </span>
                                    <h5>Stocks and Term Payments</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <table class="table table-bordered table-responsive">
                                        <thead>
                                        <tr>
                                            <th>REGISTRATION #</th>
                                            <th>SURNAME</th>
                                            <th>FULL NAMES</th>
                                            <th>GENDER</th>
                                            <th>CLASS</th>
                                            <th>STOCK</th>
                                            <th>QUANTITY</th>
                                            <th>SIZE</th>
                                            <th>TOTAL AMOUNT</th>
                                            <th>PAID AMOUNT</th>
                                            <th>BALANCE</th>
                                            <th>DATE</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total_paid = 0; ?>
                                        <?php $students_set = find_stocks_payments_by_stock_and_term($stock, $term); ?>
                                        <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                            <tr>
                                                <td><?php echo htmlentities($students['registration']); ?></td>
                                                <td><?php echo htmlentities($students['surname']); ?></td>
                                                <td><?php echo htmlentities($students['fullnames']); ?></td>
                                                <td><?php echo htmlentities($students['gender']); ?></td>
                                                <td><?php echo htmlentities($students['class']) ?></td>
                                                <td><?php echo htmlentities($students['stock']) ?></td>
                                                <td><?php echo htmlentities($students['quantity']) ?></td>
                                                <td><?php echo htmlentities($students['size']) ?></td>
                                                <td><?php echo htmlentities($students['total_amount']) ?></td>
                                                <td><?php echo htmlentities($students['paid']) ?></td>
                                                <?php $total_paid += $students['paid']; ?>
                                                <td><?php echo htmlentities($students['balance']) ?></td>
                                                <td><?php echo htmlentities($students['date']) ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php mysqli_free_result($students_set); ?>
                                        </tbody>
                                    </table>
                                </div><!--widget-content nopadding-->
                                <div class="widget-footer">
                                    <table  class="table table-bordered table-responsive">
                                        <tbody>
                                        <th>TOTAL PAYMENTS: </th>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                        </tbody>
                                    </table>
                                </div><!--widget-footer-->
                            <?php } ?>
                        <?php }else{?>
                            <div class="widget-title">
                                <span class="icon"><i class="icon-th"></i></span>
                                <span class="icon_right">
                                    <a href="" class="btn btn-mini btn-default"><i class="icon-refresh"></i> REFRESH</a>
                                </span>
                                <h5>Payments</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATION #</th>
                                        <th>SURNAME</th>
                                        <th>FULL NAMES</th>
                                        <th>GENDER</th>
                                        <th>CLASS</th>
                                        <th>STOCK</th>
                                        <th>QUANTITY</th>
                                        <th>SIZE</th>
                                        <th>TOTAL AMOUNT</th>
                                        <th>PAID AMOUNT</th>
                                        <th>BALANCE</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total_paid = 0; ?>
                                    <?php $students_set = find_stocks_payments_by_term($_SESSION['login_term']); ?>
                                    <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                        <tr>
                                            <td><?php echo htmlentities($students['registration']); ?></td>
                                            <td><?php echo htmlentities($students['surname']); ?></td>
                                            <td><?php echo htmlentities($students['fullnames']); ?></td>
                                            <td><?php echo htmlentities($students['gender']); ?></td>
                                            <td><?php echo htmlentities($students['class']) ?></td>
                                            <td><?php echo htmlentities($students['stock']) ?></td>
                                            <td><?php echo htmlentities($students['quantity']) ?></td>
                                            <td><?php echo htmlentities($students['size']) ?></td>
                                            <td><?php echo htmlentities($students['total_amount']) ?></td>
                                            <td><?php echo htmlentities($students['paid']) ?></td>
                                            <?php $total_paid += $students['paid']; ?>
                                            <td><?php echo htmlentities($students['balance']) ?></td>
                                            <td><?php echo htmlentities($students['date']) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php mysqli_free_result($students_set); ?>
                                    </tbody>
                                </table>
                            </div><!--widget-content nopadding-->
                            <div class="widget-footer">
                                <table  class="table table-bordered table-responsive">
                                    <tbody>
                                    <th>Total Paid: </th>
                                    <td><?php echo htmlentities($total_paid); ?></td>
                                    </tbody>
                                </table>
                            </div><!--widget-footer-->
                        <?php } ?>
                    </div><!--widget-box-->
                </div><!--span12-->
            </div><!--row-fluid-->
        </div><!--container-fluid-->
    </div><!--container-->
<?php include '../../../includes/system/table_footer.php'; ?>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.uniform.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.tables.js"></script>
</body>
</html>
