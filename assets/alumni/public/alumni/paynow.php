<?php require_once '../../../../includes/initialization.php'; ?>
<?php require_once '../../../students/includes/student_function.php'; ?>
<?php require_once '../../../students/includes/invoice_function.php'; ?>
<?php $current_alumni_student= find_alumni_payments_by_id($_GET['alumni']) ?>



<?php

//check if the form was submitted
$id = mysqli_sec($current_alumni_student['id']);
$student_admin = mysqli_sec($current_alumni_student['admin_number']);
$registration= mysqli_sec($current_alumni_student['registration']);
$surname = mysqli_sec($current_alumni_student['surname']);
$fullnames = mysqli_sec($current_alumni_student['fullnames']);
$gender = mysqli_sec($current_alumni_student['gender']);
$class = mysqli_sec($current_alumni_student['class']);

$amounts = $_GET['amount'];
$reg = $_GET['reg'];

if(isset($_POST['pay'])){
    //validate presences
    //$initial_payments = mysqli_sec($_POST['initial_paid']);
    $paid = mysqli_sec($_POST['paid_amount']);
    //$_SESSION['paid_amount'] = $_POST['paid_amount'];
    //$total_paid = $initial_payments + $paid;
   // $balance = $amount_set - $total_paid;
   // if($balance == 0){ $status = 'FULL PAID'; }else{ $status = 'WITH BALANCE'; }
    //$payments = mysqli_sec($_POST['payments']);
    $method = mysqli_sec($_POST['method']);
    $date = mysqli_sec($_POST['date']);
	//$type = mysqli_sec($_POST['type']);
    //$required_fields = array('paid_amount');
   // validate_presences($required_fields);

   
   $query = "INSERT INTO alumni_payments (student_admin,registration,surname,fullnames,gender,class,paid,method,date,term) VALUES ('".$student_admin."','".$registration."','".$surname."','".$fullnames."','".$gender."','".$class."','".$paid."','".$method."','".$date."','ALUMNI')";
   // if(empty($errors)){
        //$query = "INSERT INTO alumni_payments(";
    ////    $query .= "student_admin, registration, ";
      //  $query .= "surname, fullnames, ";
        //$query .= "gender, class, ";
        //$query .= "school, gname, ";
        //$query .= "phone, email, ";
       // $query .= "type,  ";
        //$query .= "amount, ";
     //   $query .= "paid, ";
       // $query .= " method, ";
     //   $query .= "date";
     //   $query .= ")VALUES(";
     //   $query .= "'{$student_admin}', '{$registration}', ";
//'{$student_admin}', '{$registration}','{$surname}', '{$fullnames}','{$gender}', '{$class}','{$paid}','{$method}','{$date}'
     //   $query .= "'{$surname}', '{$fullnames}', ";
     //   $query .= "'{$gender}', '{$class}', ";
        //$query .= "'{$school}', '{$parent}', ";
        //$query .= "'{$phone}', '{$email}', ";
        //$query .= "'{$type}', ";
        //$query .= "'', ";
       // $query .= "'{$paid}', ";
       // $query .= " '{$method}', ";
       // $query .= "'{$date}'";
       // $query .= ")";
        $results = mysqli_query($connection, $query);
        if($results){
            $_SESSION["message"] = "You have successfully added a new payments";
            
        }else{
            //failure
            $_SESSION['error_message'] = 'There was a problem in making payments';
        }
    }

?>


<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home</a>
            <a href="../alumni.php" class="current">Alumni</a>
        </div>
        <h1>Alumni Balance Payment.</h1>
    </div><!--content-header-->
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php echo message(); ?>
                <?php echo form_errors(errors()); ?>
                <div class="widget-box">
                    <div class="widget-title">
                       <span class="icon">
                        <i class="icon-barcode"></i>
                       </span>

                        <span class="icon_right">
                            <a href="" class="btn btn-mini btn-default">
                                REFRESH <i class="icon-refresh"></i>
                            </a>
                       </span>
                       <h5>MAKE ALL PAYMENTS.</h5>
                    </div>
                    <div class="widget-content nopadding">
					
                        <form action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"> FEE TYPE </label>
                                <div class="controls">
                                    <input type="text" name="type" disabled="" value="BALANCE PAYMENT" placeholder="Enter the fee type." class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"> AMOUNT TO PAY </label>
                                <div class="controls">
                                    <input type="text" name="amount" disabled=""  value="KSH.<?php echo $amounts; ?>.00" placeholder="fee type amount" class="span11">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">PAID AMOUNT:</label>
                                <div class="controls">
                                    <input type="number" id="paid" name="paid_amount" placeholder="PAY KSH.<?php echo $amounts; ?>.00 TO CLEAR YOUR BALANCE" class="span11">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">METHOD:</label>
                                <div class="controls">
                                    <select name="method">
                                        <option>BANK SLIP</option>
                                        <option>CASH</option>
                                        <option>CHEQUE</option>
                                        <option>M-PESA</option>
									

                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">DATE:</label>
                                <div class="controls">
                                    <input name="date" type="text" data-date="2017-04-14" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d'); ?>" class="datepicker span11">
                                    <span class="help-block">Date with Formate of  (yy-mm-dd)</span>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="pay" class="btn btn-primary">
                                    <i class="icon-money"></i> PAY
                                </button>
<script>
function goBack() {
    window.history.back();
}
</script>
                                <a onclick="goBack()" class="btn btn-danger">
                                    CANCEL <i class="icon-exclamation-sign"></i>
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<?php include '../../../../includes/system/table_footer.php'; ?>
<script src="../students/js/jquery.min.js"></script>
<script src="../students/js/jquery.ui.custom.js"></script>
<script src="../students/js/bootstrap.min.js"></script>
<script src="../students/js/bootstrap-colorpicker.js"></script>
<script src="../students/js/bootstrap-datepicker.js"></script>
<script src="js/jquery.toggle.buttons.js"></script>
<script src="../students/js/masked.js"></script>
<script src="../students/js/jquery.uniform.js"></script>
<script src="../students/js/select2.min.js"></script>
<script src="../students/js/matrix.js"></script>
<script src="../students/js/matrix.form_common.js"></script>
<script src="../students/js/wysihtml5-0.3.0.js"></script>
<script src="../students/js/jquery.peity.min.js"></script>
<script src="../students/js/bootstrap-wysihtml5.js"></script>
<script>
    $('.textarea_editor').wysihtml5();
</script>
</body>
</html>
