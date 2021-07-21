<?php require_once '../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_payments= find_trans_payments_by_id($_GET['payments']) ?>
<?php if(!$current_payments) {redirect_to("../students.php");} ?>
<?php
if(isset($_POST['move'])){
    $id = mysqli_sec($current_payments['id']);
    $student_admin = mysqli_sec($current_payments['student_admin']);
    $registration = mysqli_sec($current_payments['registration']);
    $fullnames = mysqli_sec($current_payments['fullnames']);
    $gender = mysqli_sec($current_payments['gender']);
    $school = mysqli_sec($current_payments['school']);
    $class = mysqli_sec($current_payments['class']);
    $gname = mysqli_sec($current_payments['gname']);
    $phone = mysqli_sec($current_payments['phone']);
    $email = mysqli_sec($current_payments['email']);
    $type = $current_payments['type'];
    $options = $current_payments['options'];
    $route = $current_payments['route'];
    $payments = $current_payments['payments'];
    $amount = $current_payments['amount'];
    $paid = $current_payments['paid'];
    $total = $current_payments['total'];
    $balance = $current_payments['balance'];
    $status = $current_payments['status'];
    $method = $current_payments['method'];
    $date = $current_payments['date'];
    $term = $current_payments['term'];

    //run insertion query
    $query = "INSERT INTO allumni_trans_payments(";
    $query .= "student_admin, registration, fullnames, ";
    $query .= "gender, school, class, ";
    $query .= "gname, phone, email, ";
    $query .= "type, options, route, ";
    $query .= "payments, amount, paid, ";
    $query .= "balance, total, status, ";
    $query .= "method, date, term";
    $query .= ")VALUES(";
    $query .= "{$student_admin}, '{$registration}', '{$fullnames}', ";
    $query .= "'{$gender}', '{$school}', '{$class}', ";
    $query .= "'{$gname}', '{$phone}', '{$email}', ";
    $query .= "'{$type}', '{$options}', '{$route}', ";
    $query .= "'{$payments}', '{$amount}', '{$paid}', ";
    $query .= "'{$balance}', '{$total}', '{$status}', ";
    $query .= "'{$method}', '{$date}', '{$term}'";
    $query .= ")";
    $results = mysqli_query($connection, $query);
    if($results && mysqli_affected_rows($connection) == 1){

        $sql = "DELETE FROM trans_payments WHERE id = {$id} LIMIT 1";
        $del_results = mysqli_query($connection, $sql);
        if($del_results && mysqli_affected_rows($connection) == 1){
            $_SESSION['message'] = "You've successfully moved the current students payments";
            redirect_to('transport-invoice.php?student='. urlencode($current_payments['student_admin']));
        }else{
            $_SESSION['error_message'] = "There was a problem in removing/deleting the current students payments";
            redirect_to('transport-invoice.php?student='. urlencode($current_payments['student_admin']));
        }
    }else{
        $_SESSION['error_message'] = "There was a problem in moving the current student payments";
        redirect_to('transport-invoice.php?student='. urlencode($current_payments['student_admin']));
    }

}else{
    redirect_to('transport-invoice.php?student='. urlencode($current_payments['student_admin']));
}
