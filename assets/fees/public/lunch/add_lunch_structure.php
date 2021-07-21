<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php
//1. check whether the form has been submitted
if(isset($_POST["submit"])){
    //the form has been submitted
    //2. perform the form validation
    $required_fields = array("amount");
    validate_presences($required_fields);
    //check whether there was any errors
    if(!empty($errors)){
        //there was errors
        $errors = $_SESSION["errors"];
        redirect_to("../lunch.php");
    }else{
        $type = mysqli_sec($_POST['type']);
        $option = mysqli_sec($_POST['option']);
        $method = mysqli_sec($_POST['method']);
        $amount =  mysqli_sec($_POST['amount']);
        $term =  mysqli_sec($_POST['term']);



        //4. perform the insertion query
        $query = "INSERT INTO lunch_payments_structure(";
        $query .= "type, options, method, amount, term";
        $query .= ") VALUES (";
        $query .= "'{$type}', '{$option}', '{$method}', '{$amount}', '{$term}'";
        $query .= ")";
        $results = mysqli_query($connection, $query);
        //5. confirm if the query took place
        if($results){
            $_SESSION["message"] = "You have successfull entered a new lunch structure.. ";
            redirect_to("../lunch.php");

        }else{
            $_SESSION["error_message"] = "There was a problem in entering data. Please try again!..";
            redirect_to("../lunch.php");
        }
    }
}else{
    //something went wrong during submission
    redirect_to("../lunch.php");
}

?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>