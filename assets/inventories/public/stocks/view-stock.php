<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/inventories_function.php'; ?>
<?php confirm_other_folder_logged_in(); ?>
<?php $current_stock_id = find_stock_by_id($_GET['stock']); ?>
<?php if(!$current_stock_id){ redirect_to('../stocks.php');} ?>
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
            <a href="../stocks.php" class="current">stocks </a>
        </div>
        <h1>All <?php echo htmlentities($current_stock_id['stock']); ?>.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr/>
    	<div class="row-fluid">
            <div class="span12">
                <?php $layout_context = $_SESSION['usertype']; ?>
                <?php if($layout_context == 'Admin' || 'Accountant'){?>
                    <?php echo message(); ?>
                    <?php echo form_errors($errors); ?>
                <?php } ?>
                <div class="widget-box">
                    <?php if(isset($_POST['add'])){?>
                        <div class="widget-content nopadding">
                            <form action="new_stock.php?stock=<?php echo urlencode($current_stock_id['id']); ?>" method="post" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">STOCK: </label>
                                    <div class="controls">
                                        <input type="text" name="stock" placeholder="Enter the stock" value="<?php echo htmlentities($current_stock_id['stock']); ?>" class="span11">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">SIZE: </label>
                                    <div class="controls">
                                        <input type="text" name="size" placeholder="Enter the size ofthe stock" class="span11">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">PIECES IN: </label>
                                    <div class="controls">
                                        <input type="text" name="pieces" placeholder="Enter the numberof pieces brought in" class="span11">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">BUYING COST PER PIECE: </label>
                                    <div class="controls">
                                        <input type="text" name="cost" placeholder="Enter cost of stock per piece" class="span11">
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">AMOUNT PER PIECE: </label>
                                    <div class="controls">
                                        <input type="text" name="amount" placeholder="Enter the amount of the stock per piece" class="span11">
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">DATE: </label>
                                    <div class="controls">
                                        <input type="text" data-date="2013-02-01" name="date" data-date-format="yyyy-mm-dd" value="<?php echo htmlentities(date('Y-m-d')); ?>" class="datepicker span11">
                                        <span class="help-block">Enter the date the stock is brought in</span>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="icon-ok-sign"></i> ENTER
                                    </button>
                                </div>

                            </form>
                        </div>
                    <?php } ?>
                </div><!--widget-box-->
            	<div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-th"></i>
                        </span>
						<span class="icon_right">
                            <a href="stocki.php" class="btn btn-mini btn-info" target="_blank">
                                PRINT <i class="icon-print"></i>
                            </a>
                        </span>
                        <span class="icon_right">
                            <form method="post" class="form-horizontal">
                                <button type="submit" name="add" class="btn btn-mini btn-primary">
                                    ADD NEW STOCK <i class="icon-plus-sign"></i>
                                </button>
                            </form>
                        </span>

                         <span class="icon_right">
                            <a href="" class="btn btn-mini btn-default">
                                <i class="icon-refresh"></i> REFRESH
                            </a>
                        </span>

                        <span class="icon_right">
                            <a href="../stocks.php" class="btn btn-mini btn-warning">
                                BACK <i class="icon-arrow-left"></i>
                            </a>
                        </span>

                        <h5><?php echo htmlentities($current_stock_id['stock']); ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-invoice-full">
                            <thead>
                            <tr>
                                <th class="head0 right">STOCK</th>
                                <th class="head1 right">SIZE</th>
                                <th class="head1 right">PIECES IN</th>
                                <th class="head0 right">BUYING</th>
                                <th class="head0 right">TOTAL BUYING</th>
                                <th class="head0 right">AMOUNT</th>
                                <th class="head0 right">TOTAL AMOUNT</th>
                                <th class="head0 right">DATE</th>
                                <!--<th class="head0 right">MORE</th>-->
                                <th class="head0 right">ACTION</th>
                            </tr>
                            </thead>
                            <?php
                            $all_total_piece_in = 0;
                            $all_total_cost = 0;
                            $all_total_amount = 0;

                            ?>
                            <?php $stocks_set = find_stocks_pieces_available_for_stocks($current_stock_id['id']); ?>
                            <?php while($stocks = mysqli_fetch_assoc($stocks_set)){ ?>
                                <tbody>
                                <tr>
                                    <td><?php echo htmlentities($stocks['stock']); ?></td>
                                    <td><?php echo htmlentities($stocks['size']); ?></td>
                                    <td><?php echo htmlentities($stocks['pieces_in'])  . ' pieces'; ?></td>
                                    <?php $all_total_piece_in += $stocks['pieces_in']; ?>

                                    <td><?php echo htmlentities($stocks['cost']); ?> </td>

                                    <td><?php echo htmlentities($stocks['total_cost']); ?> </td>
                                    <?php $all_total_cost += $stocks['total_cost']; ?>

                                    <td><?php echo htmlentities($stocks['amount']); ?></td>

                                    <td><?php echo htmlentities($stocks['total_amount']); ?></td>
                                    <?php $all_total_amount += $stocks['total_amount']; ?>

                                    <td><?php echo htmlentities($stocks['date_in']); ?></td>
                                    <!--<td>
                                        <a href="new_avail_stock.php?avail=<?php echo urlencode($stocks['id']); ?>" class="btn btn-mini btn-primary">
                                            NEW STOCK <i class="icon-plus-sign"></i>
                                        </a>
                                    </td>-->
                                    <td>
                                        <!--
                                        <a href="update-stock.php?avail=<?php echo urlencode($stocks['id']); ?>" class="btn btn-mini btn-info">
                                            <i class="icon-edit"></i> UPDATE
                                        </a>
                                        -->
                                        <a href="delete_avail_stock.php?avail=<?php echo urlencode($stocks['id']); ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure!');">
                                            DELETE <i class="icon-edit"></i>
                                        </a>

                                    </td>
                                </tr>
                                </tbody>
                            <?php } ?>
                            <?php mysqli_free_result($stocks_set); ?>
                        </table><!--table table-bordered table-invoice-full-->
                    </div><!--widget-content nopadding-->
                </div><!--widget-box-->


                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-invoice">
                            <tbody>
                            <tr>
                                <td class="msg-invoice" width="85%"><h4>TOTAL PIECES OF <?php echo htmlentities($current_stock_id['stock']) ?>: </h4><hr>
                                    <form action="view-stock.php?stock=<?php echo urlencode($current_stock_id['id']); ?>" method="post">
                                        <button type="submit" name="update_stocks" class="tip-bottom btn btn-info" title="Paid by">
                                            <i class="icon-money"></i> UPDATE TOTALS
                                        </button>
                                    </form>
                                </td>
                                <?php
                                if(isset($_POST['update_stocks'])){
                                    $id = $current_stock_id['id'];
                                    $stock = $current_stock_id['stock'];
                                    $quantity = $all_total_piece_in;
                                    $available = $quantity;
                                    $cost = $all_total_cost;
                                    $amount = $all_total_amount;
                                    $year = $current_stock_id['year'];

                                    $query = "UPDATE stocks SET ";
                                    $query .= "stock = '{$stock}', quantity = '{$quantity}', available = '{$available}', ";
                                    $query .= "cost = '{$cost}', amount = '{$amount}', ";
                                    $query .= "year = '{$year}' ";
                                    $query .= "WHERE id = {$id} ";
                                    $query .= "LIMIT 1";
                                    $results = mysqli_query($connection, $query);

                                    if($results){
                                        $_SESSION['message'] = 'You have successfully updated the stock';
                                    }

                                }

                                ?>
                                <td class="right">
                                    <strong>QUANTITY IN:</strong> <br>
                                    <strong>AVAIL:</strong> <br>
                                    <strong>QUANTITY OUT:</strong> <br>
                                    <strong>COST:</strong> <br>
                                    <strong>AMOUNT:</strong>
                                </td>

                                <td class="right">
                                    <strong>
                                        <?php echo htmlentities($current_stock_id['quantity']); ?><br>
                                        <?php echo htmlentities($current_stock_id['available']); ?><br>
                                        <?php echo htmlentities($current_stock_id['used']); ?><br>
                                        <?php echo htmlentities($current_stock_id['cost']); ?><br>
                                        <?php echo htmlentities($current_stock_id['amount']); ?>
                                    </strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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