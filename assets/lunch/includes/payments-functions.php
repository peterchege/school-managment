<?php

function find_all_payments(){
    global $connection;

    $query = "SELECT * FROM fee_payments";
    $payments_set = mysqli_query($connection, $query);
    confirm_query($payments_set);

    return $payments_set;
}

function find_payments_for_students($term){
    global $connection;

    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type= 'LUNCH FEE' AND term= '{$safe_term}'";
    $students_set = mysqli_query($connection, $query);
    confirm_query($students_set);
    return $students_set;
}

function find_payments_for_students_by_class($class, $term){
    global $connection;

    $safe_class = mysqli_real_escape_string($connection, $class);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type= 'LUNCH FEE' AND class= '{$safe_class}' AND term = '{$safe_term}'";
    $students_set = mysqli_query($connection, $query);
    confirm_query($students_set);
    return $students_set;
}

function find_students_for_lunch($status, $term){
    global $connection;

    $safe_status = mysqli_real_escape_string($connection, $status);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type= 'LUNCH FEE' AND status= '{$safe_status}' AND term= '{$safe_term}'";
    $students_set = mysqli_query($connection, $query);
    confirm_query($students_set);
    return $students_set;
}

function find_payments_by_class_and_status($class, $status, $term){
    global $connection;

    $safe_class = mysqli_real_escape_string($connection, $class);
    $safe_status = mysqli_real_escape_string($connection, $status);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type= 'LUNCH FEE' AND class = '{$safe_class}' AND status = '{$safe_status}'  AND term= '{$safe_term}'";
    $students_set = mysqli_query($connection, $query);
    confirm_query($students_set);
    return $students_set;
}

function find_payments_by_class_and_term($class, $term){
    global $connection;

    $safe_class = mysqli_real_escape_string($connection, $class);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type= 'LUNCH FEE' AND class = '{$safe_class}' AND term= '{$safe_term}'";
    $students_set = mysqli_query($connection, $query);
    confirm_query($students_set);
    return $students_set;
}
function find_payments_by_status_and_term($status, $term){
    global $connection;

    $safe_status = mysqli_real_escape_string($connection, $status);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type= 'LUNCH FEE' AND status = '{$safe_status}'  AND term= '{$safe_term}'";
    $students_set = mysqli_query($connection, $query);
    confirm_query($students_set);
    return $students_set;

}

function find_students_lunch_payments_for_term($term){
    global $connection;

    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type= 'LUNCH FEE' AND term= '{$safe_term}'";
    $students_set = mysqli_query($connection, $query);
    confirm_query($students_set);
    return $students_set;
}



function find_students_for_lunch_invoice($status, $term){
    global $connection;

    $safe_status = mysqli_real_escape_string($connection, $status);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type= 'LUNCH FEE' AND status= '{$safe_status}' AND term= '{$safe_term}' AND paid != 0";
    $students_set = mysqli_query($connection, $query);
    confirm_query($students_set);
    return $students_set;
}