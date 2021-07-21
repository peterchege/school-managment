<?php
/**
 * find payments by id
 * help to retrieve student admin and check current payments
 * @param $payments_id
 * @return array|null
 */
//check query errors
function confirm_query($string){
    if(!$string){
        die("Problem in the query");
    }
}

function find_student_by_adm($student_adm){
    global $connection;

    $safe_student_adm= mysqli_real_escape_string($connection, $student_adm);

    $query= "SELECT * FROM students ";
    $query .= "WHERE admin = {$safe_student_adm}";
    $student_set = mysqli_query($connection, $query);
    confirm_query($student_set);
    if($student= mysqli_fetch_assoc($student_set)){
        return $student;
    }else{
        return null;
    }
}

function find_current_parent($student_adm){
    global $connection;

    $safe_student_adm= mysqli_real_escape_string($connection, $student_adm);

    $query= "SELECT * FROM all_parents ";
    $query .= "WHERE admin_number = {$safe_student_adm} LIMIT 1";
    $parent_set = mysqli_query($connection, $query);
    confirm_query($parent_set);
    if($parent = mysqli_fetch_assoc($parent_set)){
        return $parent;
    }else{
        return null;
    }
}

function find_all_payments(){
    global $connection;

    $query = "SELECT * FROM fee_payments";
    $payments_set = mysqli_query($connection, $query);
    confirm_query($payments_set);
    return $payments_set;
}


function find_all_payments_for_students($student_admin, $term){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE student_admin= {$safe_student_admin} AND term = '{$safe_term}'";
    $payments_set = mysqli_query($connection, $query);
    confirm_query($payments_set);
    return $payments_set;

}

function find_all_students_invoice($student_admin, $term){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE student_admin= {$safe_student_admin} AND term = '{$safe_term}' AND paid != 0";
    $payments_set = mysqli_query($connection, $query);
    confirm_query($payments_set);
    return $payments_set;

}

function find_payments_student_made($student_admin){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE student_admin= {$safe_student_admin} ";
    $payments_set = mysqli_query($connection, $query);
    confirm_query($payments_set);
    return $payments_set;

}

function find_payments_by_id($payments_id){
    global $connection;

    $secure_payments_id = mysqli_real_escape_string($connection, $payments_id);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE id= {$secure_payments_id}";
    $payments_set = mysqli_query($connection, $query);
    confirm_query($payments_set);
    if($payments = mysqli_fetch_assoc($payments_set)){
        return $payments;
    }else{
        return null;
    }
}

function find_username_by_username($current_username){
    global $connection;

    $secure_payments_id = mysqli_real_escape_string($connection, $current_username);

    $query = "SELECT * FROM interviewed_students ";
    $query .= "WHERE username = {$current_username}";
    $payments_set = mysqli_query($connection, $query);
    confirm_query($payments_set);
    if($payments = mysqli_fetch_assoc($payments_set)){
        return $payments;
    }else{
        return null;
    }
}


/**
 * this function is to select all from payments database that have same admin number
 */



