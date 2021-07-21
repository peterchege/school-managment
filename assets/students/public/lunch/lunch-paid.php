<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_payments= find_payments_by_id($_GET['payments']) ?>
<?php if (!$current_payments) {redirect_to("../students.php");} ?>



<?php if(isset($_POST['pay'])){
    $required_fields = array('paid_amount');
    validate_presences($required_fields);

    if(empty($errors)){
        $query = "INSERT INTO fee_payments(";
        $query .= "student_admin, registration, ";
        $query .= "surname, fullnames, ";
        $query .= "gender, class, ";
        $query .= "school, gname, ";
        $query .= "phone, email, ";
        $query .= "type, options, ";
        $query .= "amount, ";
        $query .= "paid, balance, ";
        $query .= "status, method, ";
        $query .= "date, term";
        $query .= ")VALUES(";
        $query .= "'{$student_admin}', '{$registration}', ";
        $query .= "'{$surname}', '{$fullnames}', ";
        $query .= "'{$gender}', '{$class}', ";
        $query .= "'{$school}', '{$parent}', ";
        $query .= "'{$phone}', '{$email}', ";
        $query .= "'{$type}', '{$options}', ";
        $query .= "'', ";
        $query .= "'{$paid}', '{$balance}', ";
        $query .= "'{$status}', '{$method}', ";
        $query .= "'{$date}', '{$term}'";
        $query .= ")";
        $results = mysqli_query($connection, $query);
        if($results){
            $_SESSION["message"] = "You have successfully added a new payments";
            redirect_to('lunch-invoice.php?student='.urlencode($current_payments['student_admin']));
        }else{
            //failure
            $_SESSION['error_message'] = 'There was a problem in making payments';
            redirect_to('make-lunch-payments.php?student='.urlencode($current_payments['student_admin']));
        }
    }
}else{
    redirect_to('make-lunch-payments.php?student='.urlencode($current_payments['student_admin']));
}

if(isset($connection)){ mysqli_close($connection); }
?>
