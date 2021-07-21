<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/inventories_function.php'; ?>
<?php $current_avail_id = find_stocks_pieces_available_by_id($_GET['avail']); ?>
<?php if(!$current_avail_id){ redirect_to('../stocks.php');} ?>
<?php confirm_other_folder_logged_in(); ?>
<?php
if(isset($_POST['submit'])){
    $stock_id = $current_avail_id['stock_id'];
    $stock = mysqli_sec($_POST['stock']);
    $size = mysqli_sec($_POST['size']);
    $pieces = mysqli_sec($_POST['pieces']);
    $available = $pieces;
    $pieces_out = 0;
    $cost = mysqli_sec($_POST['cost']);
    $total_cost = $pieces * $cost;
    $amount = mysqli_sec($_POST['amount']);
    $total_amount = $pieces * $amount;
    $date = mysqli_sec($_POST['date']);

    $required_fields = array("stock", "size");
    validate_presences($required_fields);
    if(empty($errors)){
        //perform insert query
        $query = "INSERT INTO stocks_avial(";
        $query .= "stock_id, stock, size, ";
        $query .= "pieces_in, available, pieces_out, ";
        $query .= "cost, total_cost, amount, total_amount, date_in";
        $query .= ")VALUES(";
        $query .= "{$stock_id}, '{$stock}', '{$size}', ";
        $query .= "'{$pieces}', '{$available}', '{$pieces_out}', ";
        $query .= "'{$cost}', '{$total_cost}', '{$amount}', '{$total_amount}', '{$date}'";
        $query .= ")";
        $results = mysqli_query($connection, $query);

        if($results){
            $_SESSION['message'] = "You've successfully entered a new stock";
            redirect_to('view-stock.php?stock='. urlencode($current_avail_id['stock_id']));
        }else{
            $_SESSION['error_message'] = "There was a problem in trying to enter a new stock";
        }

    }
}
?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="../stocks.php" class="current">stocks </a>
        </div>
        <h1>Update current <?php echo htmlentities($current_avail_id['stock']); ?>.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr/>
        <div class="row-fluid">
            <div class="span12">
                <?php $layout_context = $_SESSION['usertype']; ?>
                <?php if($layout_context == 'Admin'){?>
                    <?php echo message(); ?>
                    <?php echo form_errors($errors); ?>
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-th"></i>
                        </span>
                        <h5><?php echo htmlentities($current_avail_id['stock']); ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="new_avail_stock.php?avail=<?php echo urlencode($current_avail_id['id']); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">STOCK: </label>
                                <div class="controls">
                                    <input type="text" name="stock" value="<?php echo htmlentities($current_avail_id['stock']); ?>" placeholder="Enter the stock name" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">SIZE: </label>
                                <div class="controls">
                                    <input type="text" name="size" value="<?php echo htmlentities($current_avail_id['size']); ?>" placeholder="Enter the stocks size" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">PIECES IN: </label>
                                <div class="controls">
                                    <input type="text" name="pieces" placeholder="Enter the stocks size" class="span11">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">BUYING COST PER PIECE: </label>
                                <div class="controls">
                                    <input type="text" name="cost" placeholder="Enter the of the stock per piece" class="span11">
                                </div>
                            </div>



                            <div class="control-group">
                                <label class="control-label">AMOUNT PER PIECE: </label>
                                <div class="controls">
                                    <input type="text" name="amount" placeholder="Enter thestocks amount per piece" class="span11">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">DATE: </label>
                                <div class="controls">
                                    <input type="text" data-date="2013-02-01" data-date-format="yyyy-mm-dd" name="date" value="<?php echo htmlentities(date('Y-m-d')); ?>" class="datepicker span11">
                                    <span class="help-block">Date the stock was brought in</span>
                                </div>
                            </div>


                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    ENTER <i class="icon-ok-sign"></i>
                                </button>

                                <a href="view-stock.php?stock=<?php echo urlencode($current_avail_id['stock_id']); ?>" class="btn btn-danger">
                                    <i class="icon-exclamation-sign"></i> CANCEL
                                </a>
                            </div>


                        </form>
                    </div><!--widget-content nopadding-->
                </div><!--widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<?php include'../../../../includes/system/table_footer.php'; ?>
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


