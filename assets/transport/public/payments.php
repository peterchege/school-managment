<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once('../includes/transport_function.php') ?>
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
        <h1>Transport Payments.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php $layout_context = $_SESSION['usertype']; ?>
                <?php if($layout_context == 'Admin'){?>
                    <?php echo message(); ?>
                <?php } ?>
                <!--select box-->
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <div class="controls controls-row">
                            <form action="" method="post" class="form-horizontal">
                                <select name="class" class="span3 m-wrap">
                                    <option></option>
                                    <?php $classes_set = find_all_classes(); ?>
                                    <?php while($class=mysqli_fetch_assoc($classes_set)){?>
                                        <option><?php echo htmlentities($class['class']); ?></option>
                                    <?php } ?>
                                    <?php mysqli_free_result($classes_set); ?>

                                </select>

                                <select name="term" class="span3 m-wrap">
                                    <option></option>
                                    <option>ONE</option>
                                    <option>TWO</option>
                                    <option>THREE</option>
                                </select>

                                <select name="status" class="span3 m-wrap">
                                    <option></option>
                                    <option>FULL PAID</option>
                                    <option>WITH BALANCE</option>
                                </select>


                                <button type="submit" name="select" class="btn btn-success span2 m-wrap">
                                    <i class="icon-ok-sign"></i> SELECT
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!--exports-->
                <div class="widget-box">
                    <?php
                    error_reporting(0);
                    if(isset($_POST['class_export'])) {
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

                            $fee_payments_set = find_all_trans_by_class($_SESSION['trans_class'], $_SESSION['login_term']);
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
                    }elseif(isset($_POST['term_export'])){

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

                            $fee_payments_set = find_all_students_trans_payments($_SESSION['trans_term']);
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
                                if ($line < 22) {
                                    $label .= $name . ",";
                                }else{
                                    $label .= $name . "\n";
                                }
                            }
                            fputs($fileOpen, $label);

                            $fee_payments_set = find_all_trans_by_status($_SESSION['trans_status'], $_SESSION['login_term']);
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
                    }elseif(isset($_POST['class_term_export'])){
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

                            $fee_payments_set = find_all_trans_by_class($_SESSION['trans_class'], $_SESSION['trans_term']);
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

                    }elseif(isset($_POST['class_status_export'])){

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

                            $fee_payments_set = find_all_trans_by_status($_SESSION['trans_status'], $_SESSION['trans_term']);
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

                    }elseif(isset($_POST['class_status'])){
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

                            $fee_payments_set = find_all_trans_by_class($_SESSION['trans_class'], $_SESSION['trans_term']);
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

                <?php if(isset($_POST['select'])){?>
                    <?php
                    $class = mysqli_sec($_POST['class']);
                    $_SESSION['trans_class'] = $class;

                    $term = mysqli_sec($_POST['term']);
                    $_SESSION['trans_term'] = $term;

                    $status = mysqli_sec($_POST['status']);
                    $_SESSION['trans_status'] = $status;
                    ?>
                    <?php if(!empty($class) && empty($term) && empty($status)){?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-th"></i>
                                </span>

                                <span class="icon_right">
                                    <a href="students/class-report.php" class="btn btn-mini btn-primary" target="_blank">
                                        <i class="icon-print"></i> PRINT
                                    </a>
                                </span>

                                <span class="icon_right">
                                    <form action="payments.php" method="post" class="form-horizontal">
                                        <button type="submit" name="class_export" class="btn btn-mini btn-info">
                                            EXPORT <i class="icon-external-link"></i>
                                        </button>
                                    </form>
                                </span>

                                <span class="icon_right">
                                    <a href="" class="btn btn-mini btn-default">
                                        <i class="icon-refresh"></i> REFRESH
                                    </a>
                                </span>
                                <h5>Transport Class Payments</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATI0ON #</th>
                                        <th>FULL NAMES</th>
                                        <th>GENDER</th>
                                        <th>CLASS</th>
                                        <th>FEE TYPE</th>
                                        <th>PAID AMOUNT</th>
                                        <th>BALANCE</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total_paid = 0; ?>
                                    <?php $students_set = find_all_trans_by_class($class, $_SESSION['login_term']); ?>
                                    <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                        <tr>
                                            <td><?php echo htmlentities($students['registration']); ?></td>
                                            <td><?php echo htmlentities($students['fullnames']); ?></td>
                                            <td><?php echo htmlentities($students['gender']); ?></td>
                                            <td><?php echo htmlentities($students['class']) ?></td>
                                            <td><?php echo htmlentities($students['type']) ?></td>
                                            <td><?php
                                                $total_paid += $students['paid'];
                                                echo htmlentities($students['paid']) ?>
                                            </td>

                                            <td><?php echo htmlentities($students['balance']) ?></td>
                                            <td><?php echo htmlentities($students['date']) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php mysqli_free_result($students_set); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="widget-footer">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>TOTAL PAID</th>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--widget-box-->
                    <?php }elseif(empty($class) && !empty($term) && empty($status)){?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-th"></i>
                                </span>

                                <span class="icon_right">
                                    <a href="students/term-reports.php" class="btn btn-mini btn-primary" target="_blank">
                                        <i class="icon-print"></i> PRINT
                                    </a>
                                </span>

                                <span class="icon_right">
                                    <form action="payments.php" method="post" class="form-horizontal">
                                        <button type="submit" name="term_export" class="btn btn-mini btn-info">
                                            EXPORT <i class="icon-external-link"></i>
                                        </button>
                                    </form>
                                </span>

                                <span class="icon_right">
                                    <a href="" class="btn btn-mini btn-default">
                                        <i class="icon-refresh"></i> PREFRESH
                                    </a>
                                </span>
                                <h5>REPORTS BY TERM.</h5>
                            </div>

                            <div class="widget-content nopadding">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATI0ON #</th>
                                        <th>FULL NAMES</th>
                                        <th>GENDER</th>
                                        <th>CLASS</th>
                                        <th>FEE TYPE</th>
                                        <th>PAID AMOUNT</th>
                                        <th>BALANCE</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total_paid = 0; ?>
                                    <?php $students_set = find_all_students_trans_payments($term); ?>
                                    <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                        <tr>
                                            <td><?php echo htmlentities($students['registration']); ?></td>
                                            <td><?php echo htmlentities($students['fullnames']); ?></td>
                                            <td><?php echo htmlentities($students['gender']); ?></td>
                                            <td><?php echo htmlentities($students['class']) ?></td>
                                            <td><?php echo htmlentities($students['type']) ?></td>
                                            <td><?php
                                                $total_paid += $students['paid'];
                                                echo htmlentities($students['paid']) ?>
                                            </td>

                                            <td><?php echo htmlentities($students['balance']) ?></td>
                                            <td><?php echo htmlentities($students['date']) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php mysqli_free_result($students_set); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="widget-footer">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>TOTAL PAID</th>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div><!--widget-box-->

                    <?php }elseif(empty($class) && empty($term) && !empty($status)){?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-th"></i>
                                </span>

                                <span class="icon_right">
                                    <a href="students/status-report.php" class="btn btn-mini btn-primary" target="_blank">
                                        <i class="icon-print"></i> PRINT
                                    </a>
                                </span>

                                <span class="icon_right">
                                    <form action="payments.php" method="post" class="form-horizontal">
                                        <button type="submit" name="status_export" class="btn btn-mini btn-info">
                                            <i class="icon-external-link"></i> EXPORT
                                        </button>
                                    </form>
                                </span>

                                <span class="icon_right">
                                    <a href="" class="btn btn-mini btn-default">
                                        REFRESH <i class="icon-refresh"></i>
                                    </a>
                                </span>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATI0ON #</th>
                                        <th>FULL NAMES</th>
                                        <th>GENDER</th>
                                        <th>CLASS</th>
                                        <th>FEE TYPE</th>
                                        <th>PAID AMOUNT</th>
                                        <th>BALANCE</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total_paid = 0; ?>
                                    <?php $students_set = find_all_trans_by_status($status, $_SESSION['login_term']); ?>
                                    <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                        <tr>
                                            <td><?php echo htmlentities($students['registration']); ?></td>
                                            <td><?php echo htmlentities($students['fullnames']); ?></td>
                                            <td><?php echo htmlentities($students['gender']); ?></td>
                                            <td><?php echo htmlentities($students['class']) ?></td>
                                            <td><?php echo htmlentities($students['type']) ?></td>
                                            <td><?php $total_paid += $students['paid'];
                                                echo htmlentities($students['paid']) ?>
                                            </td>

                                            <td><?php echo htmlentities($students['balance']) ?></td>
                                            <td><?php echo htmlentities($students['date']) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php mysqli_free_result($students_set); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="widget-footer">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>TOTAL PAID</th>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--widget-box-->

                    <?php }elseif(!empty($class) && !empty($term) && empty($status)){?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-th"></i>
                                </span>

                                <span class="icon_right">
                                    <a href="students/class-term-report.php" class="btn btn-mini btn-primary" target="_blank">
                                        <i class="icon-print"></i> PRINT
                                    </a>
                                </span>

                                <span class="icon_right">
                                    <form action="payments.php" method="post" class="form-horizontal">
                                        <button type="submit" name="class_term_export" class="btn btn-mini btn-info">
                                            EXPORT <i class="icon-external-link"></i>
                                        </button>
                                    </form>
                                </span>

                                <span class="icon_right">
                                    <a href="" class="btn btn-mini btn-default">
                                        <i class="icon-refresh"></i> REFRESH
                                    </a>
                                </span>
                                <h5>Transport Class Payments</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATI0ON #</th>
                                        <th>FULL NAMES</th>
                                        <th>GENDER</th>
                                        <th>CLASS</th>
                                        <th>FEE TYPE</th>
                                        <th>PAID AMOUNT</th>
                                        <th>BALANCE</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total_paid = 0; ?>
                                    <?php $students_set = find_all_trans_by_class($class, $term); ?>
                                    <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                        <tr>
                                            <td><?php echo htmlentities($students['registration']); ?></td>
                                            <td><?php echo htmlentities($students['fullnames']); ?></td>
                                            <td><?php echo htmlentities($students['gender']); ?></td>
                                            <td><?php echo htmlentities($students['class']) ?></td>
                                            <td><?php echo htmlentities($students['type']) ?></td>
                                            <td><?php
                                                $total_paid += $students['paid'];
                                                echo htmlentities($students['paid']) ?>
                                            </td>

                                            <td><?php echo htmlentities($students['balance']) ?></td>
                                            <td><?php echo htmlentities($students['date']) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php mysqli_free_result($students_set); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="widget-footer">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>TOTAL PAID</th>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--widget-box-->
                    <?php }elseif(!empty($class) && empty($term) && !empty($status)){?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-th"></i>
                                </span>

                                <span class="icon_right">
                                    <a href="students/class-status.php" class="btn btn-mini btn-primary" target="_blank">
                                        <i class="icon-print"></i> PRINT
                                    </a>
                                </span>

                                <span class="icon_right">
                                    <form action="payments.php" method="post" class="form-horizontal">
                                        <button type="submit" name="class_status" class="btn btn-mini btn-info">
                                            <i class="icon-external-link"></i> EXPORT
                                        </button>
                                    </form>
                                </span>

                                <span class="icon_right">
                                    <a href="" class="btn btn-mini btn-default">
                                        REFRESH <i class="icon-refresh"></i>
                                    </a>
                                </span>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATI0ON #</th>
                                        <th>FULL NAMES</th>
                                        <th>GENDER</th>
                                        <th>CLASS</th>
                                        <th>FEE TYPE</th>
                                        <th>PAID AMOUNT</th>
                                        <th>BALANCE</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total_paid = 0; ?>
                                    <?php $students_set = find_payments_by_class_status($class, $status); ?>
                                    <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                        <tr>
                                            <td><?php echo htmlentities($students['registration']); ?></td>
                                            <td><?php echo htmlentities($students['fullnames']); ?></td>
                                            <td><?php echo htmlentities($students['gender']); ?></td>
                                            <td><?php echo htmlentities($students['class']) ?></td>
                                            <td><?php echo htmlentities($students['type']) ?></td>
                                            <td><?php
                                                $total_paid += $students['paid'];
                                                echo htmlentities($students['paid']) ?>
                                            </td>

                                            <td><?php echo htmlentities($students['balance']) ?></td>
                                            <td><?php echo htmlentities($students['date']) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php mysqli_free_result($students_set); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--widget-box-->

                    <?php }elseif(empty($class) && !empty($term) && !empty($status)){?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-th"></i>
                                </span>

                                <span class="icon_right">
                                    <a href="students/class-status-report.php" class="btn btn-mini btn-primary" target="_blank">
                                        <i class="icon-print"></i> PRINT
                                    </a>
                                </span>

                                <span class="icon_right">
                                    <form action="payments.php" method="post" class="form-horizontal">
                                        <button type="submit" name="class_status_export" class="btn btn-mini btn-info">
                                            <i class="icon-external-link"></i> EXPORT
                                        </button>
                                    </form>
                                </span>

                                <span class="icon_right">
                                    <a href="" class="btn btn-mini btn-default">
                                        REFRESH <i class="icon-refresh"></i>
                                    </a>
                                </span>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATI0ON #</th>
                                        <th>FULL NAMES</th>
                                        <th>GENDER</th>
                                        <th>CLASS</th>
                                        <th>FEE TYPE</th>
                                        <th>PAID AMOUNT</th>
                                        <th>BALANCE</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total_paid = 0; ?>
                                    <?php $students_set = find_all_trans_by_status($status, $term); ?>
                                    <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                        <tr>
                                            <td><?php echo htmlentities($students['registration']); ?></td>
                                            <td><?php echo htmlentities($students['fullnames']); ?></td>
                                            <td><?php echo htmlentities($students['gender']); ?></td>
                                            <td><?php echo htmlentities($students['class']) ?></td>
                                            <td><?php echo htmlentities($students['type']) ?></td>
                                            <td><?php
                                                $total_paid += $students['paid'];
                                                echo htmlentities($students['paid']) ?>
                                            </td>

                                            <td><?php echo htmlentities($students['balance']) ?></td>
                                            <td><?php echo htmlentities($students['date']) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php mysqli_free_result($students_set); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--widget-box-->
                    <?php }elseif(!empty($class) && !empty($term) && !empty($status)){?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-th"></i>
                                </span>
                                <span class="icon_right">
                                    <a href="" class="btn btn-mini btn-primary">
                                        <i class="icon-print"></i> PRINT
                                    </a>
                                </span>

                                <span class="icon_right">
                                    <a href="" class="btn btn-mini btn-primary">
                                        <i class="icon-print"></i> PRINT
                                    </a>
                                </span>
                            </div>
                        </div><!--widget-box-->
                    <?php } ?>
                <?php }else{ ?>
                    <div class="widget-box">
                        <div class="widget-title">
                           <span class="icon">
                               <i class="icon-th"></i>
                           </span>

                            <span class="icon_right">
                                <a href="" class="btn btn-mini btn-default">
                                    <i class="icon-refresh"></i> REFRESH
                                </a>
                            </span>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th>REGISTRATI0ON #</th>
                                    <th>FULL NAMES</th>
                                    <th>GENDER</th>
                                    <th>CLASS</th>
                                    <th>FEE TYPE</th>
                                    <th>PAID AMOUNT</th>
                                    <th>BALANCE</th>
                                    <th>DATE</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $total_paid = 0; ?>
                                <?php $students_set = find_all_students_trans_payments($_SESSION['login_term']); ?>
                                <?php while($students = mysqli_fetch_assoc($students_set)){?>
                                    <tr>
                                        <td><?php echo htmlentities($students['registration']); ?></td>
                                        <td><?php echo htmlentities($students['fullnames']); ?></td>
                                        <td><?php echo htmlentities($students['gender']); ?></td>
                                        <td><?php echo htmlentities($students['class']) ?></td>
                                        <td><?php echo htmlentities($students['type']) ?></td>
                                        <td><?php
                                            $total_paid += $students['paid'];
                                            echo htmlentities($students['paid']) ?>
                                        </td>

                                        <td><?php echo htmlentities($students['balance']) ?></td>
                                        <td><?php echo htmlentities($students['date']) ?></td>
                                    </tr>
                                <?php } ?>
                                <?php mysqli_free_result($students_set); ?>
                                </tbody>

                            </table>
                        </div>
                    </div><!--widget-box-->
                <?php } ?>

            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
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
