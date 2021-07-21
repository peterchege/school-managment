<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/inventories_function.php'; ?>
<?php
$stock = mysqli_sec($_POST['stock']);
$quantity = mysqli_sec($_POST['quantity']);
$out = 0;
$year = mysqli_sec($_POST['year']);

if(isset($_POST['submit'])){
    //validate
    $stocks_set = find_all_available_stock($stock);
    if(mysqli_num_rows($stocks_set)>0){
        $_SESSION['error_message'] = 'The stock youve entered exist. please check and try again..';
        redirect_to('../actions.php');
    }else{
        $required_fields = array("stock");
        validate_presences($required_fields);
        if(empty($errors)){
            //perform insert query
            $query = "INSERT INTO stocks(";
            $query .= "stock, quantity, ";
            $query .= "used, year";
            $query .= ")VALUES(";
            $query .= "'{$stock}', '{$quantity}', ";
            $query .= "'{$out}', '{$year}'";
            $query .= ")";
            $results = mysqli_query($connection, $query);

            if($results){
                $_SESSION['message'] = "You've successfully entered a new stock";
                redirect_to('../stocks.php');
            }else{
                $_SESSION['error_message'] = "There was a problem in trying to enter anew stock";
                redirect_to('../stocks.php');
            }

        }else{
            $_SESSION['errors'] =  $errors;
            redirect_to('../stocks.php');
        }
    }

}else{
    redirect_to('../stocks.php');
}
if(isset($connection)){ mysqli_close($connection); }


