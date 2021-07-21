<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php
//1. check whether the form has been submitted
if(isset($_POST["add_fee"])){
    //the form has been submitted
    //2. perform the form validation
    $required_fields = array("fee");
    validate_presences($required_fields);

    //check whether there was any errors

    if(!empty($errors)){
        //there was errors
        $errors = $_SESSION["errors"];
        redirect_to("../fees.php");
    }else{
        //no errors found
        //3. get fields from the form and store them on variables
        $fee = mysqli_sec($_POST["fee"]);
        $description = mysqli_sec($_POST["description"]);

        //4. perform the insertion query
        $query = "INSERT INTO fees(";
        $query .= "type, description";
        $query .= ") VALUES (";
        $query .= "'{$fee}', '{$description}'";
        $query .= ")";
        $results = mysqli_query($connection, $query);
        //5. confirm if the query took place
        if($results){
            $_SESSION["message"] = "You have successfull entered a new fee type.. ";
            redirect_to("../fees.php");

        }else{
            $_SESSION["error_message"] = "There was a problem in entering data. Please try again!..";
            redirect_to("../fees.php");
        }
    }
}else{
    //something went wrong during submission
    redirect_to("../fees.php");
}

?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>