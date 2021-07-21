<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/inventories_function.php'; ?>
<?php $current_stock_id = find_stock_by_id($_GET['stock']); ?>
<?php if(!$current_stock_id){ redirect_to('../stocks.php');} ?>
<?php
$stock_id = $current_stock_id['id'];
$stock = mysqli_sec($_POST['stock']);
$size = mysqli_sec($_POST['size']);
$pieces = mysqli_sec($_POST['pieces']);
$available = $pieces;
$pieces_out = 0;
$cost = mysqli_sec($_POST['cost']);
$total_cost = $pieces * $cost;
$amount = mysqli_sec($_POST['amount']);
$total_amount = $pieces * $amount;
$date = mysqli_sec($_POST['date']);

if(isset($_POST['submit'])){

        $required_fields = array("stock", "size");
        validate_presences($required_fields);
        if(empty($errors)){
            //perform insert query
            $query = "INSERT INTO stocks_avial(";
            $query .= "stock_id, stock, size, ";
            $query .= "pieces_in, available, ";
            $query .= "cost, total_cost, amount, total_amount, date_in";
            $query .= ")VALUES(";
            $query .= "{$stock_id}, '{$stock}', '{$size}', ";
            $query .= "'{$pieces}', '{$available}', ";
            $query .= "'{$cost}', '{$total_cost}', '{$amount}', '{$total_amount}', '{$date}'";
            $query .= ")";
            $results = mysqli_query($connection, $query);

            if($results){
                $_SESSION['message'] = "You've successfully entered a new stock";
                redirect_to('view-stock.php?stock='. urlencode($current_stock_id['id']));
            }else{
                $_SESSION['error_message'] = "There was a problem in trying to enter anew stock";
                redirect_to('view-stock.php?stock='. urlencode($current_stock_id['id']));
            }

        }else{
            $_SESSION['errors'] =  $errors;
            redirect_to('view-stock.php?stock='. urlencode($current_stock_id['id']));
        }


}else{
    redirect_to('view-stock.php?stock='. urlencode($current_stock_id['id']));
}
if(isset($connection)){ mysqli_close($connection); }


