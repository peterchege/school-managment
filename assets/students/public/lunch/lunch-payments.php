<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_student = find_student_by_adm($_GET['student']); ?>
<?php if(!$current_student){redirect_to('../students.php');} ?>
<?php $current_parent = find_current_parent($_GET['student']); ?>

<?php
$student_admin = mysqli_sec($current_student['admin']);
$registration= mysqli_sec($current_student['registration']);
$surname = mysqli_sec($current_student['sirname']);
$fullnames = mysqli_sec($current_student['full_names']);
$gender = mysqli_sec($current_student['gender']);
$class = mysqli_sec($current_student['class']);
$school = mysqli_sec($current_student['school']);
$parent = mysqli_sec($current_parent['full_names']);
$phone = mysqli_sec($current_parent['phone']);
$email = mysqli_sec($current_parent['email']);
$type = mysqli_sec($_POST['type']);
$payments = mysqli_sec($_POST['payments']);
$_SESSION['payments_method'] = $payments;
$paid = mysqli_sec($_POST['paid']);
$method = mysqli_sec($_POST['method']);
$date = date('Y-m-d');
$term = mysqli_sec($_POST['term']);
$total = $paid;
?>

<?php
$current_lunch_fee_structure = find_lunch_fee_structure_type($payments, $term);
$options = $current_lunch_fee_structure['options'];
$amount = $current_lunch_fee_structure['amount'];
$balance = $amount - $paid;
if($balance == '0'){$status = 'FULL PAID';}else{$status = 'WITH BALANCE';}
?>

<?php
if(isset($_POST['create'])){
    $required_fields = array('payments', 'paid');
    validate_presences($required_fields);
    if(!empty($errors)){
        $errors = $_SESSION['errors'];
        redirect_to('../students.php');
    }else{
        //perform insertion query
        $query = "INSERT INTO fee_payments(";
        $query .= "student_admin, registration, ";
        $query .= "surname, fullnames, ";
        $query .= "gender, class, ";
        $query .= "school, gname, ";
        $query .= "phone, email, ";
        $query .= "type, options, ";
        $query .= "amount, ";
        $query .= "paid, balance, total, ";
        $query .= "status, method, ";
        $query .= "date, term";
        $query .= ")VALUES(";
        $query .= "'{$student_admin}', '{$registration}', ";
        $query .= "'{$surname}', '{$fullnames}', ";
        $query .= "'{$gender}', '{$class}', ";
        $query .= "'{$school}', '{$parent}', ";
        $query .= "'{$phone}', '{$email}', ";
        $query .= "'{$type}', '{$options}', ";
        $query .= "'{$amount}', ";
        $query .= "'{$paid}', '{$balance}', '{$total}', ";
        $query .= "'{$status}', '{$method}', ";
        $query .= "'{$date}', '{$term}'";
        $query .= ")";
        $results = mysqli_query($connection, $query);

        if($results){
            $_SESSION["message"] = "You have successfully made lunch payments";
            redirect_to("lunch-invoice.php?student=".urlencode($current_student['admin']));
        }else{
            //failure
            $_SESSION["error_message"] = "There was a problem in adding a new fee payments";
            redirect_to("lunch-invoice.php?student=".urlencode($current_student['admin']));
        }


    }
}else{
    //form was not successfully submitted
    redirect_to("invoice.php?student=".urlencode($current_student['admin']));
}

if(isset($connection)){ mysqli_close($connection); }
