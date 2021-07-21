<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_payments= find_trans_payments_by_id($_GET['payments']) ?>
<?php if (!$current_payments) {redirect_to("../students.php");} ?>
<?php
$id = mysqli_sec($current_payments['id']);
$student_admin = mysqli_sec($current_payments['student_admin']);
$registration= mysqli_sec($current_payments['registration']);
$surname = mysqli_sec($current_payments['surname']);
$fullnames = mysqli_sec($current_payments['fullnames']);
$gender = mysqli_sec($current_payments['gender']);
$class = mysqli_sec($current_payments['class']);
$school = mysqli_sec($current_payments['school']);
$parent = mysqli_sec($current_payments['gname']);
$phone = mysqli_sec($current_payments['phone']);
$email = mysqli_sec($current_payments['email']);
$type = mysqli_sec($current_payments['type']);
$route = mysqli_sec($current_payments['route']);
$payments = mysqli_sec($current_payments['payments']);
$paid = mysqli_sec($_POST['paid_amount']);
$term = mysqli_sec($current_payments['term']);
$method = mysqli_sec($_POST['method']);
$initial_pay = mysqli_sec($_POST['initial_paid']);
$date = mysqli_sec($_POST['date']);
$total_payments = $paid + $initial_pay;
?>

<?php
$current_transport_fee_structure = find_transport_fee_structure_type($current_payments['route'], $current_payments['payments'], $term);
$options = $current_transport_fee_structure['options'];
$amount = $current_transport_fee_structure['amount'];
$balance = $amount - $total_payments;
if($balance == 0){ $status = 'FULL PAID'; }else{ $status = 'WITH BALANCE'; }
?>


<?php if(isset($_POST['pay'])){
    $required_fields = array('paid_amount');
    validate_presences($required_fields);

    if(empty($errors)){
        $query = "INSERT INTO trans_payments(";
        $query .= "student_admin, registration, ";
        $query .= "fullnames, gender, ";
        $query .= "class, school, ";
        $query .= "gname, phone, ";
        $query .= "email, type, ";
        $query .= "options, route, ";
        $query .= "payments, amount, ";
        $query .= "paid, balance, total, ";
        $query .= "status, method, ";
        $query .= "date, term";
        $query .= ")VALUES(";
        $query .= "'{$student_admin}', '{$registration}', ";
        $query .= "'{$fullnames}', '{$gender}', ";
        $query .= " '{$class}', '{$school}', ";
        $query .= " '{$parent}', '{$phone}', ";
        $query .= " '{$email}', '{$type}', ";
        $query .= " '{$options}', '{$route}', ";
        $query .= "'{$payments}', '', ";
        $query .= "'{$paid}', '{$balance}', '{$total_payments}', ";
        $query .= "'{$status}', '{$method}', ";
        $query .= "'{$date}', '{$term}'";
        $query .= ")";
        $results = mysqli_query($connection, $query);
        if($results){
            $_SESSION["message"] = "You have successfully added a new payments";
            redirect_to('transport-invoice.php?student='.urlencode($current_payments['student_admin']));
        }else{
            //failure
            $_SESSION['error_message'] = 'There was a problem in making payments';
            redirect_to('make-transport-payments.php?student='.urlencode($current_payments['student_admin']));
        }
    }
}else{
    redirect_to('make-transport-payments.php?student='.urlencode($current_payments['student_admin']));
}

if(isset($connection)){ mysqli_close($connection); }
?>
