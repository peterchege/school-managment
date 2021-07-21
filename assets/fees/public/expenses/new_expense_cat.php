<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php $current_cat = find_expense_by_id($_GET['cat']); ?>
<?php if(!$current_cat){
    redirect_to('../expenses.php');
}
?>
<?php
//1. confirm that the form has been submitted
if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("expense");
    validate_presences($required_fields);

    if(empty($errors)){
        //3. get objectes and store them to variables
        $cat_id = $current_cat['id'];
        $expense= mysqli_sec($_POST["expense"]);
        $amount= mysqli_sec($_POST["amount"]);
        $date= mysqli_sec($_POST['date']);
        $payment_date= mysqli_sec($_POST['payment_date']);
        $paid= mysqli_sec($_POST["paid"]);
        $balance= mysqli_sec($_POST["balance"]);

        //perform insertion query
        $query = "INSERT INTO expense(";
        $query .= "cat_id, expense, date, ";
        $query .= "pay_date, amount, paid, ";
        $query .= "balance";
        $query .= ") VALUES (";
        $query .= "'{$cat_id}', '{$expense}', '{$date}', ";
        $query .= "'{$payment_date}', '{$amount}', '{$paid}', ";
        $query .= "'{$balance}'";
        $query .= ")";
        $results = mysqli_query($connection, $query);

        if($results){
            //successfull
            $_SESSION["message"] = "Expensehas been successfully added";
            redirect_to("expense.php?cat=".urlencode($current_cat['id']));
        }else{
            //failed
            $_SESSION["error_message"] = "There was aproblem in adding an expense";
            redirect_to("expense.php?cat=".urlencode($current_cat['id']));
        }

    }else{
        redirect_to("expense.php?cat=".urlencode($current_cat['id']));
    }

}else{
    $_SESSION["error_message"] = "There was aproblem in adding an expense DURING SUBMISSION";
    redirect_to("expense.php?cat=".urlencode($current_cat['id']));
}
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
