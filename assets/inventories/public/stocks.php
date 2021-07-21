<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/inventories_function.php'; ?>
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
            <a href="stocks.php" class="current">stocks </a>
        </div>
        <h1>All stocks.</h1>
    </div><!--content-header-->

    <div class="container-fluid"><hr/>
        <div class="row-fluid">
            <div class="span12">
                <?php $layout_context = $_SESSION['usertype']; ?>
                <?php if($layout_context == 'Admin' || 'Accountant'){?>
                    <?php echo message(); ?>
                    <?php echo form_errors($errors); ?>
                <?php } ?>
                <?php if(isset($_POST['add_stock'])){?>
                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <form action="actions/add_stocks.php" method="post" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">STOCK: </label>
                                    <div class="controls">
                                        <input type="text" name="stock" placeholder="Enter the stock name.." class="span11">
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">YEAR: </label>
                                    <div class="controls">
                                        <input type="text" name="year" placeholder="Enter quantity in.." value="<?php echo date('Y'); ?>" class="span11">
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" name="submit" class="btn btn-info">
                                        <i class="icon-download"></i> ENTER
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span>
                        <?php if($layout_context == 'Admin' || 'Accountant'){?>
                            <span class="icon_right">
                                <form action="stocks.php" method="post" class="form-horizontal">
                                    <button type="submit" name="add_stock" class="btn btn-mini btn-success">
                                        <i class="icon-plus-sign"></i> ADD STOCK
                                    </button>
                                </form>
                            </span>

                            <span class="icon_right">
                                <a href="stocks.php" class="btn btn-mini btn-default">
                                    <i class="icon-refresh"></i> REFRESH
                                </a>
                            </span>
                        <?php } ?>
                        <h5>Available Stocks</h5>
                    </div>

                    <!--all students table-->
                    <div class="widget-content nopadding">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>STOCK</th>
                                <th>QUANTITY BROUGHT IN</th>
                                <th>QUANTITY AVAILABLE</th>
                                <th>QUANTITY OUT</th>
                                <th>COST</th>
                                <th>AMOUNT</th>
                                <th>YEAR</th>
                                <?php if($layout_context == 'Admin' || 'Accountant'){?>
                                    <th>VIEW</th>
                                    <th>ACTIONS</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stocks_set = find_all_stocks(); ?>
                            <?php while($stocks = mysqli_fetch_assoc($stocks_set)){ ?>
                                <tr>
                                    <td><?php echo htmlentities($stocks["stock"]); ?></td>
                                    <td><?php echo htmlentities($stocks["quantity"]) . ' pieces'; ?></td>
                                    <td><?php echo htmlentities($stocks["available"]) . ' pieces'; ?></td>
                                    <td><?php echo htmlentities($stocks["used"]). ' pieces'; ?></td>
                                    <td><?php echo htmlentities($stocks["cost"]); ?></td>
                                    <td><?php echo htmlentities($stocks["amount"]); ?></td>
                                    <td><?php echo htmlentities($stocks["year"]); ?></td>
                                    <?php if($layout_context == 'Admin' || 'Accountant'){?>
                                        <td>
                                            <a href="stocks/view-stock.php?stock=<?php echo urlencode($stocks['id']); ?>" class="btn btn-mini btn-primary">
                                                <i class="icon-shopping-cart"></i> STOCK
                                            </a>
                                        </td>
                                        <td>
                                            <div class="fr">
                                                <a href="actions/delete.php?stock=<?php echo urlencode($stocks["id"]) ?>" onclick= "return confirm('Are you sure..?!');" class="btn btn-mini btn-danger">
                                                   DELETE <i class="icon-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <?php mysqli_free_result($stocks_set); ?>
                            </tbody>
                        </table>
                    </div><!--widget-content tab-content nopadding-->
                </div>
            </div><!--Widget-Box-->
        </div><!--span12-->
    </div><!--row-fluid-->
</div><!--container-fluid-->
<!--Footer-part-->
<?php include'../../../includes/system/footer.php'; ?>
