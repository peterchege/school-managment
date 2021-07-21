<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/class_function.php'; ?>
<?php $current_class = find_class_by_id($_GET["class"]); ?>
<?php if (!$current_class) {
  redirect_to("../classes.php");
} ?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="../classes.php" class="current">Classes</a>
        </div>
        <h1>Students.</h1>
    </div><!--content-header-->

    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <?php $layout_context = $_SESSION['usertype']; ?>
            <?php if($layout_context == 'Admin' || 'Accountant'){ ?>
                <?php echo message(); ?>
            <?php } ?>

            <div class="widget-box">
                <?php error_reporting(0);
                if(isset($_POST['export']))
                {
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

                        $fee_payments_set = find_all_payments_for_class($current_class['class']);
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

                }


                ?>
            </div>

            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-user"></i></span>
                    <h5>Student profile</h5>
                    <span class="icon">
                        <a href="../classes.php" class="btn btn-mini btn-info">
                            <i class="icon-arrow-left"></i>
                        </a>
                    </span>

                     <span class="icon">
                        <a href="" class="btn btn-mini btn-default">
                            <i class="icon-refresh"></i> REFRESH
                        </a>
                    </span>

                    <div id="search">
                        <form action="" method="post">
                            <input type="text" name="record" placeholder="Search here..."/>
                            <button name="search" type="submit" class="tip-bottom">
                                <i class="icon-search icon-white"></i>
                            </button>
                        </form>
                    </div>

                    <span class="icon">
                        <a href="print.php?class=<?php echo urlencode($current_class['id']); ?>" class="btn btn-mini btn-warning" target="_blank">
                            <i class="icon-print"></i> PRINT
                        </a>
                    </span>

                    <span class="icon">
                        <form action="students.php?class=<?php echo urlencode($current_class['id']); ?>" method="post" class="form-horizontal">
                            <button name="export" type="submit" class="btn btn-mini btn-info">
                                <i class="icon-external-link"></i> EXPORT
                            </button>
                        </form>
                    </span>



                </div><!--title-->
                
                <?php
                	$counter = 1;
                ?>

                <div class="widget-content nopadding">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                        	<th>No.</th>
                            <th>REGISTRATION #</th>
                            <th>SURNAME</th>
                            <th>FULL NAMES</th>
                            <th>GENDER</th>
                            <th><i class="icon-user"></i> Profile</th>
                            <?php if($layout_context == 'Admin' || 'Accountant'){?>
                                <th>INVOICE</th>
                                <th>TOTAL AMOUNT</th>
                                <th>TOTAL PAID AMOUNT </th>
                                <th>BALANCE</th>
                                <th>LUNCH</th>
                                <th>TRANSPORT</th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <?php if(isset($_POST['search'])){ ?>
                            <?php $search = mysqli_sec($_POST['record']); ?>
                            <?php $class_set = find_all_students_search($current_class['class'], $search); ?>
                            <?php while($class = mysqli_fetch_assoc($class_set)){ ?>
                                <tbody>
                                <tr>
                                	<td><?php echo $counter; ?></td>
                                    <td><?php echo htmlentities($class['registration']); ?></td>
                                    <td><?php echo htmlentities($class['sirname']); ?></td>
                                    <td><?php echo htmlentities($class['full_names']); ?></td>
                                    <td><?php echo htmlentities($class['gender']); ?></td>
                                    <td>
                                        <a href="../../../students/public/profile.php?student=<?php echo urlencode($class['admin']); ?>" class="btn btn-mini btn-default">
                                            <i class="icon-user"></i>
                                        </a>
                                    </td>

                                    <?php if($layout_context == 'Admin' || 'Accountant'){?>
                                        <td>
                                            <div class="fr">
                                                <a href="../../../students/public/payments/invoice.php?student=<?php echo urlencode($class['admin']); ?>" class="btn btn-mini btn-success">
                                                    PAYMENTS <i class="icon-briefcase"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <?php
                                        $total_amount = 0;
                                        $total_paid = 0;
                                        ?>
                                        <?php $student_payments_set = find_payments_for_students($class['registration']); ?>
                                        <?php while($students_payments = mysqli_fetch_assoc($student_payments_set)){ ?>
                                            <?php  $total_amount += $students_payments['amount']; ?>
                                            <?php  $total_paid += $students_payments['paid']; ?>
                                        <?php } ?>
                                        <td><?php echo htmlentities($total_amount); ?></td>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                        <?php  $total_balance = $total_amount - $total_paid; ?>
                                        <td><?php echo htmlentities($total_balance); ?></td>
                                        <td>
                                            <a href="../../../students/public/lunch/lunch-invoice.php?student=<?php echo urlencode($class['admin']); ?>" class="btn btn-mini btn-link">
                                                PAYs <i class="icon-gift"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="../../../students/public/transport/transport-invoice.php?student=<?php echo urlencode($class['admin']); ?>" class="btn btn-mini btn-link">
                                                <i class="icon-truck"></i> PAYs
                                            </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <?php $counter++; ?>
                                </tbody>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php $class_set = find_all_students_with_class($current_class['class'], $current_class['stream']); ?>
                            <?php while($class = mysqli_fetch_assoc($class_set)){ ?>
                                <tbody>
                                <tr>
                                	<td><?php echo $counter; ?></td>
                                    <td><?php echo htmlentities($class['registration']); ?></td>
                                    <td><?php echo htmlentities($class['sirname']); ?></td>
                                    <td><?php echo htmlentities($class['full_names']); ?></td>
                                    <td><?php echo htmlentities($class['gender']); ?></td>
                                    <td>
                                        <a href="../../../students/public/profile.php?student=<?php echo urlencode($class['admin']); ?>" class="btn btn-mini btn-default">
                                            <i class="icon-user"></i>
                                        </a>
                                    </td>

                                    <?php if($layout_context == 'Admin' || 'Accountant'){?>
                                        <td>
                                            <div class="fr">
                                                <a href="../../../students/public/payments/invoice.php?student=<?php echo urlencode($class['admin']); ?>" class="btn btn-mini btn-success">
                                                    PAYMENTS <i class="icon-briefcase"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <?php
                                        $total_amount = 0;
                                        $total_paid = 0;
                                        $total_total_paid = 0;
                                        $total_total_balance = 0;
                                        ?>
                                        <?php $student_payments_set = find_payments_for_students($class['registration']); ?>
                                        <?php while($students_payments = mysqli_fetch_assoc($student_payments_set)){ ?>
                                            <?php  $total_amount += $students_payments['amount']; ?>
                                            <?php  $total_paid += $students_payments['paid']; ?>
                                            <?php $total_total_paid += $total_paid; ?>

                                        <?php } ?>
                                        <td><?php echo htmlentities($total_amount); ?></td>
                                        <td><?php echo htmlentities($total_paid); ?></td>
                                        <?php  $total_balance = $total_amount - $total_paid; ?>
                                        <td><?php echo htmlentities($total_balance); ?></td>
                                        <td>
                                            <a href="../../../students/public/lunch/lunch-invoice.php?student=<?php echo urlencode($class['admin']); ?>" class="btn btn-mini btn-link">
                                                PAYs <i class="icon-gift"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="../../../students/public/transport/transport-invoice.php?student=<?php echo urlencode($class['admin']); ?>" class="btn btn-mini btn-link">
                                                <i class="icon-truck"></i> PAYs
                                            </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <?php $counter++; ?>
                                </tbody>
                            <?php } ?>
                        <?php } ?>
                    </table>
                    <!--<table>
                    	<tr>
                    		<?php
                    			$paymenttotal += $total_paid;
                    		?>
                            <td><strong>Total Paid:</strong> <?php echo($paymenttotal) ?> </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><strong>Total Balance:</strong></td>
                        </tr>
                    </table>-->
                </div><!--widget-content-->
            </div><!--widget-box-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--container-->
<?php include '../../../../includes/system/alt_footer.php'; ?>


