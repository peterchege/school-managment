<?php
//**database query creation
//check query errors
function confirm_query($string){
    if(!$string){
        die("Problem in the query");
    }
}

function find_all_classes(){
    global $connection;

    $query = "SELECT * FROM classes ORDER BY class ASC";
    $classes_set = mysqli_query($connection, $query);
    confirm_query($classes_set);

    return $classes_set;
}

function find_all_lunch(){
    global $connection;

    $query = "SELECT * FROM lunch";
    $lunch_set = mysqli_query($connection, $query);
    confirm_query($lunch_set);

    return $lunch_set;
}

function find_lunch_by_id($lunch_id){
    global $connection;

    $secure_lunch_id = mysqli_real_escape_string($connection, $lunch_id);

    $query = "SELECT * FROM lunch ";
    $query .= "WHERE id= {$secure_lunch_id}";
    $lunch_set = mysqli_query($connection, $query);
    confirm_query($lunch_set);

    if($lunch = mysqli_fetch_assoc($lunch_set)){
        return $lunch;
    }else{
        return null;
    }

}


