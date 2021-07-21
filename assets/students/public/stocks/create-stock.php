<?php require_once '../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_student = find_student_by_adm($_GET['student']);
$current_parent = find_current_parent($_GET['student']);
if(!$current_student){redirect_to('../students.php');} ?>

<?php
$student_admin = mysqli_sec($current_student['admin']);
$registration= mysqli_sec($current_student['registration']);
$surname = mysqli_sec($current_student['sirname']);
$fullnames = mysqli_sec($current_student['full_names']);
$gender = mysqli_sec($current_student['gender']);
$class = mysqli_sec($current_student['class']);
$school = mysqli_sec($current_student['school']);
$gname = mysqli_sec($current_parent['full_names']);
$phone = mysqli_sec($current_parent['phone']);
$email = mysqli_sec($current_parent['email']);
$stock = mysqli_sec($_POST['stock']);
$quantity = 0;
$size = mysqli_sec($_POST['size']);
$paid = 0;
$method = '';
$date = mysqli_sec($_POST['date']);
$term = mysqli_sec($_POST['term']);
?>

<?php
$current_stock_structure = find_stock_structure($stock, $size);
$amount = $current_stock_structure['amount'];
$total_amount = $amount;
$total = $paid;
$balance = $amount - $total;
if($balance == '0'){ $status = 'FULL PAID';}else{$status = 'WITH BALANCE';}
?>

<?php
if(isset($_POST['enter'])){
    //2. get form data and store them in variables
    //3. check for validations
    $required_fields = array('stock', 'size');
    validate_presences($required_fields);
    if(!empty($errors)){
        $errors = $_SESSION['errors'];
        redirect_to('stocks.php?student='.urlencode($current_student['admin']));
    }else{

        $query = "INSERT INTO stocks_payments(";
        $query .= "student_admin, registration, ";
        $query .= "surname, fullnames, ";
        $query .= "gender, class, ";
        $query .= "school, gname, ";
        $query .= "phone, email, ";
        $query .= "stock, size, quantity, amount, ";
        $query .= "total_amount, paid, ";
        $query .= "total, balance, ";
        $query .= "status, method, ";
        $query .= "date, term";
        $query .= ")VALUES(";
        $query .= "'{$student_admin}', '{$registration}', ";
        $query .= "'{$surname}', '{$fullnames}', ";
        $query .= "'{$gender}', '{$class}', ";
        $query .= "'{$school}', '{$gname}', ";
        $query .= "'{$phone}', '{$email}', ";
        $query .= "'{$stock}', '{$size}', '{$quantity}', '{$amount}', ";
        $query .= "'{$total_amount}', '{$paid}', ";
        $query .= " '{$total}', '{$balance}', ";
        $query .= "'{$status}', '{$method}', ";
        $query .= "'{$date}', '{$term}'";
        $query .= ")";
        $results = mysqli_query($connection, $query);

        if($results){
            $_SESSION["message"] = "You have successfully added a new payments";
            redirect_to("stocks.php?student=".urlencode($current_student['admin']));
        }else{
            //failure
            $_SESSION["error_message"] = "There was a problem in adding a new fee payments";
            redirect_to("stocks.php?student=".urlencode($current_student['admin']));
        }


    }
}else{
    //form was not successfully submitted
    redirect_to("stocks.php?student=".urlencode($current_student['admin']));
}

if(isset($connection)){ mysqli_close($connection); }
