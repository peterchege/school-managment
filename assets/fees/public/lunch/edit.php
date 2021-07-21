<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php
$current_structure = find_lunch_fee_structure_by_id($_GET["lunch"]);
if(!$current_structure){
    //student id doesnot exist
    redirect_to('../lunch.php');
}
?>

<?php
//1. confirm that the form has been submitted
if(isset($_POST["submit"])){
    //submission was successfull
    //2. validate the form
    $required_fields = array("type", "amount");
    validate_presences($required_fields);

    if(empty($errors)){

        $id = mysqli_sec($current_structure['id']);
        $type = mysqli_sec($_POST['type']);
        $option = mysqli_sec($_POST['option']);
        $method = mysqli_sec($_POST['method']);
        $amount =  mysqli_sec($_POST['amount']);
        $term =  mysqli_sec($_POST['term']);

        //3. perform insertion query
        $query = "UPDATE lunch_payments_structure SET ";
        $query .= "type ='{$type}', options = '{$option}', method = '{$method}', ";
        $query .= "amount = '{$amount}', term = '{$term}' ";
        $query .= "WHERE id= {$id} ";
        $query .= "LIMIT 1";
        $results = mysqli_query($connection, $query);

        //confirm if the query took place
        if($results && mysqli_affected_rows($connection) == 1){
            $_SESSION["message"] = "You have successfully updated the lunch structure";
            redirect_to("../lunch.php");
        }else{
            //failure
            $_SESSION["error_message"] = "There was a problem in updating the lunch structure";
        }
    }

}else{

    //there was a problem in trying to submit the form

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

            <a href="../lunch.php" class="current">Lunch Structure</a>
        </div>
        <h1>Lunch payments structure.</h1>
    </div><!--content-header-->

    <div class="container-fluid"><hr>
        <div class="span12">
            <div class="row-fluid">
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <form action="edit.php?lunch=<?php echo urlencode($current_structure['id']); ?>" method="post" class="form-horizontal">

                            <div class="control-group">
                                <label class="control-label">FEE TYPE:</label>
                                <div class="controls">
                                    <input type="text" name="type" placeholder="Enter fee type" value="LUNCH FEE" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">OPTIONS:</label>
                                <div class="controls">
                                    <input type="text" name="option" placeholder="Enter payments options" value="OPTIONAL"  class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">METHOD:</label>
                                <div class="controls">
                                    <select name="method" class="span5">
                                        <option></option>
                                        <option <?php if($current_structure['method'] == 'DAILY'){ echo 'selected'; } ?>>DAILY</option>
                                        <option <?php if($current_structure['method'] == 'WEEKLY'){ echo 'selected'; } ?>>WEEKLY</option>
                                        <option <?php if($current_structure['method'] == 'MONTHLY'){ echo 'selected'; } ?>>MONTHLY</option>
                                        <option <?php if($current_structure['method'] == 'TERMLY'){ echo 'selected'; } ?>>TERMLY</option>
										 <option <?php if($current_structure['method'] == 'PRE SCHOOL'){ echo 'selected'; } ?>>PRE SCHOOL</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">AMOUNT:</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo htmlentities($current_structure['amount']); ?>" name="amount" placeholder="Enter lunch fee amount" class="span11">
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

                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-info">
                                    <i class="icon-ok-sign"></i> UPDATE
                                </button>

                                <a href="../lunch.php" class="btn btn-danger">
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
