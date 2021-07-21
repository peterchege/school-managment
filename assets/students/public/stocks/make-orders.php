<?php require_once '../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php $current_stock = find_all_stocks_by_id($_GET['stock']) ?>
<?php if (!$current_stock) {redirect_to("../students.php");} ?>

<?php
$student_admin = mysqli_sec($current_stock['student_admin']);
$surname = mysqli_sec($current_stock['surname']);
$fullnames = mysqli_sec($current_stock['fullnames']);
$gender = mysqli_sec($current_stock['gender']);
$class = mysqli_sec($current_stock['class']);
$school = mysqli_sec($current_stock['school']);
$gname = mysqli_sec($current_stock['gname']);
$phone = mysqli_sec($current_stock['phone']);
$email = mysqli_sec($current_stock['email']);
$stock = mysqli_sec($_POST['stock']);
$quantity = mysqli_sec($_POST['quantity']);
$size = mysqli_sec($current_stock['size']);
$paid = mysqli_sec($_POST['paid']);
$method = mysqli_sec($_POST['method']);
$date = mysqli_sec($_POST['date']);
$term = mysqli_sec($current_stock['term']);
?>

<?php
$current_stock_structure = find_stock_structure($stock, $size);
$amount = $current_stock_structure['amount'];
$total_amount = $quantity * $amount;
$total = $current_stock['total'] + $paid;
$balance = $total_amount - $total;
if($balance == '0'){ $status = 'FULL PAID';}else{$status = 'WITH BALANCE';}
?>

<?php
if(isset($_POST['order'])){
    $required_fields = array('stock', 'quantity', 'paid');
    validate_presences($required_fields);
    if(!empty($errors)){
        $errors = $_SESSION['errors'];
        redirect_to('orders.php?stock='.urlencode($current_stock['id']));
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
            $current_selected_stock = find_stock_by_type($stock);
            $total_quantity = 0;
            $current_quantity_set = find_all_stocks_payments_for_stock($stock);
            while($current_quantity = mysqli_fetch_assoc($current_quantity_set)){
                $total_quantity += $current_quantity['quantity'];
            }
            $available = $current_selected_stock['available'] - $quantity;
            $sql = "UPDATE stocks SET ";
            $sql .= "available = '{$available}', used = '{$total_quantity}' ";
            $sql .= "WHERE stock = '{$stock}'";
            $stock_results = mysqli_query($connection, $sql);
            if($stock_results){
                $_SESSION["message"] = "You have successfully added a new payments";
                redirect_to("stocks.php?student=".urlencode($current_stock['student_admin']));
            }
        }else{
            //failure
            $_SESSION["error_message"] = "There was a problem in adding a new fee payments";
            redirect_to("stocks.php?student=".urlencode($current_stock['student_admin']));
        }

    }
}else{
    //form was not successfully submitted
    redirect_to("stocks.php?student=".urlencode($current_stock['student_admin']));
}

?>

<?php if(isset($connection)){ mysqli_close($connection); } ?>
