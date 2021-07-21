<?php require_once('../../../../includes/initialization.php');?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once '../../include/admin_function.php'; ?>

<?php
//1. check whether the form has been submitted
if(isset($_POST["submit"])){
    //submission was successfull go to step two
    //2. check form validation
    $required_fields= array("surname", "fullnames", "dob", "gender", "class", "gurdian", "phone");
    validate_presences($required_fields);

    //check whether there is any validation errorrs
    if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        redirect_to('../registration.php');
    }else{
        //there is no any errors go to step 3
        //3. get objects from the form and store them on variables
        $surname= mysqli_sec($_POST["surname"]);
        $fullnames= mysqli_sec($_POST["fullnames"]);
        $dob= mysqli_sec($_POST["dob"]);
        $gender= mysqli_sec($_POST["gender"]);
        $class= mysqli_sec($_POST["class"]);
        $gurdian= mysqli_sec($_POST["gurdian"]);
        $phone= mysqli_sec($_POST["phone"]);
        $email= mysqli_sec($_POST["email"]);
        //you can now go to the next step
        //4. perform insertion query
        $query = "INSERT INTO registration(";
        $query .= "surname, fullnames, ";
        $query .= "dob, gender, ";
        $query .= "class, gurdian, ";
        $query .= "phone, email";
        $query .= ") VALUES(";
        $query .= "'{$surname}', '{$fullnames}', ";
        $query .= "'{$dob}', '{$gender}', ";
        $query .= "'{$class}', '{$gurdian}', ";
        $query .= "'{$phone}', '{$email}'";
        $query .= " )";
        $results = mysqli_query($connection, $query);

        //5. check if the query took place.
        if($results){
            $_SESSION["message"] = "You have successfully registered a new student";
            redirect_to("../registration.php");
        }else{
            //the query failed
            $_SESSION["message"]= "There was a problem in registering the student";
            redirect_to("../registration.php");
        }

    }
}else{
    //the form was not submitted
    //probably a get request
    redirect_to("../registration.php");
}


?>