<?php require_once('../../../../includes/initialization.php');  ?>
<?php require_once '../../includes/lunch_function.php'; ?>
<?php
    $current_lunch_id = find_lunch_by_id($_GET['lunch']);
    if(!$current_lunch_id){
        redirect_to('../lunch.php');
    }
?>
<?php
//1. confirm that the form has been submitted
if(isset($_POST["edit_lunch"])){
    //3. get objectes and store them to variables
    $id = $current_lunch_id['id'];
    $food= mysqli_sec($_POST["food"]);
    $day= mysqli_sec($_POST["day"]);

    //perform insertion query
    $query = "UPDATE lunch SET ";
    $query .= "food = '{$food}', day= '{$day}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $results = mysqli_query($connection, $query);

    if($results && mysqli_affected_rows($connection)==1){
        //successfull
        $_SESSION["message"] = "You have successfully updated lunch schedule";
        redirect_to("../lunch.php");
    }else{
        //failed
        $_SESSION["error_message"] = "There was aproblem in updating a lunch schedule";
        redirect_to("../lunch.php");
    }

}else{
    redirect_to("../lunch.php");
}
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
