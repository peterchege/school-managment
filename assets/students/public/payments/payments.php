<?php require_once '../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_student = find_student_by_adm($_GET['student']);
$current_parent = find_current_parent($_GET['student']);
if(!$current_student){redirect_to('../students.php');} ?>

<?php $student_admin = mysqli_sec($current_student['admin']);
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
$paid = mysqli_sec($_POST['paid']);
//$_SESSION['paid_amount'] = $paid;
//$payments = mysqli_sec($_POST['payments']);
$method = mysqli_sec($_POST['method']);
$date = mysqli_sec($_POST['date']);
$term = mysqli_sec($_POST['term']);
?>

<?php
$current_fee_structure = find_structure_type($type, $current_student['school'], $term);
$type_set = $current_fee_structure['type'];
$payment_option = $current_fee_structure['options'];
$amount_set = $current_fee_structure['amount'];
$total = $paid;
$balance = $amount_set - $total;
if($balance == '0'){ $status = 'FULL PAID';}else{$status = 'WITH BALANCE';}
?>

<?php
//1. check if the form is set
if(isset($_POST['create'])){
    //2. get form data and store them in variables
    //3. check for validations
    $required_fields = array('type', 'paid');
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
        $query .= "'{$type}', '{$payment_option}', ";
        $query .= "'{$amount_set}', ";
        $query .= "'{$paid}', '{$balance}', '{$total}', ";
        $query .= "'{$status}', '{$method}', ";
        $query .= "'{$date}', '{$term}'";
        $query .= ")";
        $results = mysqli_query($connection, $query);

        if($results){
            $_SESSION["message"] = "You have successfully added a new payments";
            redirect_to("invoice.php?student=".urlencode($current_student['admin']));
        }else{
            //failure
            $_SESSION["error_message"] = "There was a problem in adding a new fee payments";
            redirect_to("invoice.php?student=".urlencode($current_student['admin']));
        }


    }
}else{
    //form was not successfully submitted
    redirect_to("invoice.php?student=".urlencode($current_student['admin']));
}

if(isset($connection)){ mysqli_close($connection); }
