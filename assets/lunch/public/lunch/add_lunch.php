<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/lunch_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php
//1. confirm that the form has been submitted
if(isset($_POST["submit"])){
        //3. get objectes and store them to variables
        $food= mysqli_sec($_POST["food"]);
        $day= mysqli_sec($_POST["day"]);

        //perform insertion query
        $query = "INSERT INTO lunch(";
        $query .= "food, day";
        $query .= ") VALUES (";
        $query .= "'{$food}', '{$day}'";
        $query .= ")";
        $results = mysqli_query($connection, $query);

        if($results){
            //successfull
            $_SESSION["message"] = "You have successfully lunch schedule";
            redirect_to("../lunch.php");
        }else{
            //failed
            $_SESSION["message"] = "There was aproblem in adding a lunch schedule";
            redirect_to("../lunch.php");
        }

}else{
    redirect_to("../lunch.php");
}
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
