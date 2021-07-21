
<?php require_once '../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php find_selected_fields(); ?>
<?php if(!$current_student_admin){redirect_to('../students.php');} ?>
<?php if(isset($_GET['student'])){$current_parent = find_current_parent($_GET['student']);} ?>
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
        <h1>Student Stocks.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php echo message(); ?>
                <div class="widget-box">
                    <?php if(isset($_POST['add'])){ ?>
                        <div class="widget-content nopadding">
                            <form action="create-stock.php?student=<?php echo urlencode($current_student_admin['admin']) ?>" method="post" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">STOCKS:</label>
                                    <div class="controls">
                                        <select name="stock" class="span11">
                                            <option></option>
                                            <?php $stocks_set = find_all_stocks();  ?>
                                            <?php while($stocks = mysqli_fetch_assoc($stocks_set)){ ?>
                                                <option><?php echo htmlentities($stocks['stock']); ?> </option>
                                            <?php } ?>
                                            <?php mysqli_free_result($stocks_set); ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">SIZE: </label>
                                    <div class="controls">
                                        <select name="size" class="span5">
                                            <option></option>
                                            <?php $size_set = find_all_avail_stocks();  ?>
                                            <?php while($size = mysqli_fetch_assoc($size_set)){ ?>
                                                <option><?php echo htmlentities($size['size']); ?> </option>
                                            <?php } ?>
                                            <?php mysqli_free_result($size_set); ?>
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
                                    <button type="submit" name="enter" class="btn btn-primary">
                                        ENTER <i class="icon-money"></i>
                                    </button>

                                    <button type="submit" class="btn btn-default">
                                        <i class="icon-refresh"></i> REFRESH
                                    </button>
                                </div>

                            </form>
                        </div>
                    <?php }?>
                </div>
                <?php $term = $_SESSION['login_term']; ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"> <i class="icon-briefcase"></i> </span>
                        <span class="icon_right">
                            <a href="stock.php" class="btn btn-mini btn-info" target="_blank">
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
                                        <td>TERM: <?php echo htmlentities($_SESSION['login_term']); ?></td>
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
                                        <th class="head0 right">STOCK</th>
                                        <th class="head1 right">QUANTITY</th>
                                        <th class="head0 right">AMOUNT A PIECE</th>
                                        <th class="head0 right">TOTAL AMOUNT</th>
                                        <th class="head1 right">PAID AMOUNT</th>
                                        <th class="head0 right">BALANCE</th>
                                        <th class="head1 right">STATUS</th>
                                        <th class="head0 right">DATE</th>
                                        <th class="head1 right">TERM</th>
                                        <th class="head0 right">MAKE ORDERS</th>
                                        <th class="head0 right">RECEIPTS</th>
                                        <th class="head1 right">DELETE</th>

                                    </tr>
                                    </thead>
                                    <?php $stocks_issued_set = find_all_stocks_for_student($current_student_admin['admin']); ?>
                                    <?php while($stocks_issued= mysqli_fetch_assoc($stocks_issued_set)){ ?>
                                        <tbody>
                                        <td><?php echo htmlentities($stocks_issued['stock']); ?></td>
                                        <td><?php echo htmlentities($stocks_issued['quantity']); ?></td>
                                        <td><?php echo htmlentities($stocks_issued['amount']); ?></td>
                                        <td><?php echo htmlentities($stocks_issued['total_amount']); ?></td>
                                        <td><?php echo htmlentities($stocks_issued['paid']); ?></td>
                                        <td><?php echo htmlentities($stocks_issued['balance']); ?></td>
                                        <td><?php echo htmlentities($stocks_issued['status']); ?></td>
                                        <td><?php echo htmlentities($stocks_issued['date']); ?></td>
                                        <td><?php echo htmlentities($stocks_issued['term']); ?></td>
                                        <td>
                                            <a href="orders.php?stock=<?php echo htmlentities($stocks_issued['id']) ?>" class="btn btn-mini btn-success">
                                                <i class="icon-money"></i> ORDER
                                            </a>
                                        </td>

                                        <td>
                                            <a href="receipt.php?stock=<?php echo urlencode($stocks_issued['id']); ?>" class="btn btn-link" target="_blank">
                                                <i class="icon-credit-card"></i> ISSUE
                                            </a>
                                        </td>

                                        <td>
                                            <a href="delete-stock.php?stock=<?php echo urlencode($stocks_issued['id']); ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure..?');">
                                                DELETE <i class="icon-trash"></i>
                                            </a>
                                        </td>

                                        </tbody>
                                    <?php } ?>
                                </table><!--table table-bordered table-invoice-full-->

                                <div class="pull-right">
                                    <br>
                                    <div class="fr">
                                        <a class="btn btn-primary btn-large" href="../students.php">
                                            STUDENTS <i class="icon-arrow-left"></i>
                                        </a>

                                        <a class="btn btn-info btn-large" href="../profile.php?student=<?php echo urlencode($current_student_admin['admin']); ?>">
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


