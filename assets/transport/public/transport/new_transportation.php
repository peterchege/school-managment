<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/transport_function.php'; ?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("vehicle");
    validate_presences($required_fields);

    if(empty($errors)){
      //3. get objectes and store them to variables
      $vehicle= mysqli_sec($_POST["vehicle"]);
      $plate_number= mysqli_sec($_POST["plate_number"]);
      $route= mysqli_sec($_POST["route"]);
      $amount= mysqli_sec($_POST["amount"]);

      //perform insertion query 
      $query = "INSERT INTO transport(";
      $query .= "vehicle, plate, "; 
      $query .= "route, amount ";
      $query .= ") VALUES (";
      $query .= "'{$vehicle}', '{$plate_number}', ";
      $query .= "'{$route}', '{$amount}' ";
      $query .= ")";
      $results = mysqli_query($connection, $query);

      if($results){
        //successfull
        $_SESSION["message"] = "You have successfully added transportation schedule";
        redirect_to("../transport.php");
      }else{
        //failed
        $_SESSION["message"] = "There was aproblem in adding a transportation schedule";
        redirect_to("../transport.php");
      }

    }else{
       redirect_to("../transport.php");
    }

  }else{
     redirect_to("../transport.php");
  }
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
