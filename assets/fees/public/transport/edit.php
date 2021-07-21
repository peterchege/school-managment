<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php $current_structure = find_transport_fee_structure_by_id($_GET["transport"]); ?>
<?php if(!$current_structure){redirect_to('../transport.php');} ?>
<?php
if(isset($_POST["submit"])){

    $required_fields = array("route", "amount");
    validate_presences($required_fields);

    if(empty($errors)){

        $id = $current_structure['id'];
        $type = mysqli_sec($_POST['type']);
        $option = mysqli_sec($_POST['option']);
        $route = mysqli_sec($_POST['route']);
        $amount =  mysqli_sec($_POST['amount']);
        $payments = mysqli_sec($_POST['payments']);
        $term =  mysqli_sec($_POST['term']);
        $year = mysqli_sec($_POST['year']);

        //3. perform insertion query
        $query = "UPDATE transport_structure SET ";
        $query .= "type ='{$type}', options = '{$option}', route = '{$route}', ";
        $query .= "amount = '{$amount}', payments = '{$payments}', term = '{$term}', year = '{$year}' ";
        $query .= "WHERE id= {$id} ";
        $query .= "LIMIT 1";
        $results = mysqli_query($connection, $query);

        //confirm if the query took place
        if($results && mysqli_affected_rows($connection) == 1){
            $_SESSION["message"] = "You have successfully updated the transport structure";
            redirect_to("../transport.php");
        }else{
            //failure
            $_SESSION["error_message"] = "There was a problem in updating the lunch structure";
        }
    }

}else{//there was a problem in trying to submit the form
}
?>

<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav();; ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>

            <a href="../lunch.php" class="current">Transport Structure</a>
        </div>
        <h1>Transport payments structure.</h1>
    </div><!--content-header-->

    <div class="container-fluid"><hr>
        <div class="span12">
            <div class="row-fluid">
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <form action="edit.php?transport=<?php echo urlencode($current_structure['id']); ?>" method="post" class="form-horizontal">

                            <div class="control-group">
                                <label class="control-label">FEE TYPE:</label>
                                <div class="controls">
                                    <input type="text" name="type" placeholder="Enter fee type" value="TRANSPORT FEE" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">OPTIONS:</label>
                                <div class="controls">
                                    <input type="text" name="option" placeholder="Enter payments options" value="OPTIONAL"  class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">ROUTE:</label>
                                <div class="controls">
                                    <input type="text" name="route" placeholder="Enter route" value="<?php echo htmlentities($current_structure['route']); ?>"  class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">AMOUNT:</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo htmlentities($current_structure['amount']); ?>" name="amount" placeholder="Enter lunch fee amount" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">PAYMENTS:</label>
                                <div class="controls">
                                    <select name="payments" class="span3">
                                        <option <?php if($current_structure['payments'] == 'TO'){ echo 'selected'; } ?>>TO</option>
                                        <option <?php if($current_structure['payments'] == 'FROM'){ echo 'selected'; } ?>>FROM</option>
                                        <option <?php if($current_structure['payments'] == 'TO AND FROM'){ echo 'selected'; } ?>>TO AND FROM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">TERM:</label>
                                <div class="controls">
                                    <select name="term" class="span5">
                                        <option <?php if($current_structure['term'] == 'ONE'){ echo 'selected'; } ?>>ONE</option>
                                        <option <?php if($current_structure['term'] == 'TWO'){ echo 'selected'; } ?>>TWO</option>
                                        <option <?php if($current_structure['term'] == 'THREE'){ echo 'selected'; } ?>>THREE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">YEAR:</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo htmlentities($current_structure['year']); ?>" name="year" placeholder="Enter lunch fee amount" class="span11">
                                </div>
                            </div>


                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-info">
                                    <i class="icon-ok-sign"></i> UPDATE
                                </button>

                                <a href="../transport.php" class="btn btn-danger">
                                    CANCEL <i class="icon-exclamation-sign"></i>
                                </a>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div><!--span12-->
    </div><!--container-fluid-->
</div><!--content-->
<?php include '../../../../includes/system/footer.php'; ?>
