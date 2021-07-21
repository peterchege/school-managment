<?php
function look_query($string){
    if(!$string){
        die("Problem in the query");
    }
}
function find_structure_amount($type){
    global $connection;

    $safe_type = mysqli_real_escape_string($connection, $type);

    $query = "SELECT * FROM fee_structure ";
    $query .= "WHERE type = '{$safe_type}'";
    $structure_set = mysqli_query($connection, $query);
    look_query($structure_set);
    return $structure_set;
}

function find_structure_by_type_school_and_term($school, $term){
    global $connection;

    $safe_school = mysqli_real_escape_string($connection, $school);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_structure ";
    $query .= "WHERE type != 'LUNCH FEE' AND school = '{$safe_school}' AND term = '{$safe_term}'";
    $structure_set = mysqli_query($connection, $query);
    look_query($structure_set);
    return $structure_set;
}


function find_structure_type($type, $school, $term){
    global $connection;

    $safe_type = mysqli_real_escape_string($connection, $type);
    $safe_school = mysqli_real_escape_string($connection, $school);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_structure ";
    $query .= "WHERE type = '{$safe_type}' AND school = '{$safe_school}' AND term = '{$safe_term}'";
    $structure_set = mysqli_query($connection, $query);
    look_query($structure_set);
    if($structure = mysqli_fetch_assoc($structure_set)){
        return $structure;
    }else{
        return null;
    }
}

function find_all_payments(){
    global $connection;

    $query = "SELECT * FROM fee_payments";
    $payments_set = mysqli_query($connection, $query);
    look_query($payments_set);
    return $payments_set;
}
function find_payments_student_made($student_admin){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);
    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE student_admin= {$safe_student_admin}";
    $payments_set = mysqli_query($connection, $query);
    look_query($payments_set);
    return $payments_set;

}

function find_payments_student_made_by_admin($student_admin){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);
    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE student_admin= {$safe_student_admin}";
    $payments_set = mysqli_query($connection, $query);
    look_query($payments_set);
    if($payments = mysqli_fetch_assoc($payments_set)){
        return $payments;
    }else{
        return null;
    }

}

function find_all_payments_for_students($student_admin, $term){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type != 'LUNCH FEE' AND student_admin= {$safe_student_admin} AND term = '{$safe_term}'";
    $payments_set = mysqli_query($connection, $query);
    look_query($payments_set);
    return $payments_set;

}

function find_all_students_payments($student_admin){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE student_admin= {$safe_student_admin}";
    $payments_set = mysqli_query($connection, $query);
    look_query($payments_set);
    return $payments_set;

}


function find_payments_by_id($payments_id){
    global $connection;

    $safe_payments_id = mysqli_real_escape_string($connection, $payments_id);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE id = {$safe_payments_id}";
    $payments_set = mysqli_query($connection, $query);
    look_query($payments_set);
    if($payments= mysqli_fetch_assoc($payments_set)){
        return $payments;
    }else{
        return null;
    }
}

function find_alumni_payments_by_id($alumni_id){
    global $connection;

    $safe_payments_id = mysqli_real_escape_string($connection, $alumni_id);

    $query = "SELECT * FROM alumni ";
    $query .= "WHERE id = {$safe_payments_id}";
    $payments_set = mysqli_query($connection, $query);
    look_query($payments_set);
    if($payments= mysqli_fetch_assoc($payments_set)){
        return $payments;
    }else{
        return null;
    }
}

function find_allalumni_by_id($alumni){
    global $connection;

    $safe_payments_id = mysqli_real_escape_string($connection, $alumni);

    $query = "SELECT * FROM alumni ";
    $query .= "WHERE id = {$safe_payments_id}";
    $payments_set = mysqli_query($connection, $query);
    look_query($payments_set);
    if($payments= mysqli_fetch_assoc($payments_set)){
        return $payments;
    }else{
        return null;
    }
}

function find_lunch_payments_made_by_student($student_admin, $term){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type = 'LUNCH FEE' AND student_admin = {$safe_student_admin} AND term = '{$safe_term}'";
    $lunch_payments_set = mysqli_query($connection, $query);
    look_query($lunch_payments_set);

    return $lunch_payments_set;
}

function find_lunch_fee_structure_type($method, $term){
    global $connection;

    $safe_method = mysqli_real_escape_string($connection, $method);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM lunch_payments_structure ";
    $query .= "WHERE method = '{$safe_method}' AND term = '{$safe_term}'";
    $lunch_structure_set = mysqli_query($connection, $query);
    look_query($lunch_structure_set);
    if($lunch_structure = mysqli_fetch_assoc($lunch_structure_set)){
        return $lunch_structure;
    }else{
        return null;
    }
}

function find_transport_fee_structure(){
    global $connection;

    $query = "SELECT * FROM transport_structure";
    $transport_structure_set = mysqli_query($connection, $query);
    confirm_query($transport_structure_set);

    return $transport_structure_set;
}

function find_transport_payments_made_by_student($student_admin, $term){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type = 'TRANSPORT FEE' AND student_admin = {$safe_student_admin} AND term = '{$safe_term}'";
    $transport_payments_set = mysqli_query($connection, $query);
    look_query($transport_payments_set);

    return $transport_payments_set;
}

function find_transport_payments_for_student($student_admin, $term){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM trans_payments ";
    $query .= "WHERE student_admin = {$safe_student_admin} AND term = '{$safe_term}'";
    $transport_payments_set = mysqli_query($connection, $query);
    look_query($transport_payments_set);

    return $transport_payments_set;
}

function find_transport_for_student($student_admin){
    global $connection;

    $safe_student_admin = mysqli_real_escape_string($connection, $student_admin);

    $query = "SELECT * FROM trans_payments ";
    $query .= "WHERE student_admin = {$safe_student_admin}";
    $transport_payments_set = mysqli_query($connection, $query);
    look_query($transport_payments_set);

    return $transport_payments_set;
}

function find_trans_payments_by_id($trans_id){
    global $connection;

    $safe_trans_id = mysqli_real_escape_string($connection, $trans_id);

    $query = "SELECT * FROM trans_payments ";
    $query .= "WHERE id = {$safe_trans_id}";
    $payments_set = mysqli_query($connection, $query);
    look_query($payments_set);
    if($payments= mysqli_fetch_assoc($payments_set)){
        return $payments;
    }else{
        return null;
    }

}

function find_transport_fee_structure_type($route, $payments, $term){
    global $connection;

    $safe_route = mysqli_real_escape_string($connection, $route);
    $safe_method = mysqli_real_escape_string($connection, $payments);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM transport_structure ";
    $query .= "WHERE route = '{$safe_route}' AND payments = '{$safe_method}' AND term = '{$safe_term}'";
    $transport_structure_set = mysqli_query($connection, $query);
    look_query($transport_structure_set);
    if($transport_structure = mysqli_fetch_assoc($transport_structure_set)){
        return $transport_structure;
    }else{
        return null;
    }
}

//stocks query functions
function find_all_stocks(){
    global $connection;

    $query = "SELECT * FROM stocks ORDER BY id ASC";
    $stocks_set = mysqli_query($connection, $query);
    look_query($stocks_set);

    return $stocks_set;
}

function find_stock_by_type($stock){
    global $connection;

    $secure_stock = mysqli_real_escape_string($connection, $stock);

    $query = "SELECT * FROM stocks ";
    $query .= "WHERE stock = '{$secure_stock}'";
    $stock_set = mysqli_query($connection, $query);
    look_query($stock_set);
    if($stock = mysqli_fetch_assoc($stock_set)){
        return $stock;
    }else{
        return null;
    }

}

function find_all_avail_stocks(){
    global $connection;

    $query = "SELECT * FROM stocks_avial";
    $stocks_set = mysqli_query($connection, $query);
    look_query($stocks_set);

    return $stocks_set;

}

function find_stock_structure($stock, $size){
    global $connection;
    $secure_stock = mysqli_real_escape_string($connection, $stock);
    $secure_size = mysqli_real_escape_string($connection, $size);

    $query = "SELECT * FROM stocks_avial ";
    $query .= "WHERE stock = '{$secure_stock}' AND size = '{$secure_size}'";
    $stock_set = mysqli_query($connection, $query);
    look_query($stock_set);
    if($stock = mysqli_fetch_assoc($stock_set)){
        return $stock;
    }else{
        return null;
    }

}

function find_all_stocks_payments(){
    global $connection;

    $query = "SELECT * FROM stocks_payments ";
    $query .= "ORDER BY term ASC";
    $student_stock_set = mysqli_query($connection, $query);
    look_query($student_stock_set);

    return $student_stock_set;
}

function find_all_stocks_payments_for_stock($stock){
    global $connection;

    $secure_stock = mysqli_real_escape_string($connection, $stock);

    $query = "SELECT * FROM stocks_payments ";
    $query .= "WHERE stock = '{$secure_stock}' ";
    $query .= "ORDER BY term ASC";
    $student_stock_set = mysqli_query($connection, $query);
    look_query($student_stock_set);

    return $student_stock_set;
}



function find_all_stocks_for_student($student_admin){
    global $connection;

    $secure_student_admin = mysqli_real_escape_string($connection, $student_admin);

    $query = "SELECT * FROM stocks_payments ";
    $query .= "WHERE student_admin = {$secure_student_admin} ";
    $query .= "ORDER BY term ASC";
    $student_stock_set = mysqli_query($connection, $query);
    look_query($student_stock_set);

    return $student_stock_set;
}


function find_all_stocks_by_id($stock_id){
    global $connection;

    $secure_stock_id = mysqli_real_escape_string($connection, $stock_id);

    $query = "SELECT * FROM stocks_payments ";
    $query .= "WHERE id = {$secure_stock_id}";
    $stock_set = mysqli_query($connection, $query);
    look_query($stock_set);

    if($stock = mysqli_fetch_assoc($stock_set)){
        return $stock;
    }else{
        return null;
    }

function find_all_stock_by_id($stock_id){
    global $connection;

    $secure_stock_id = mysqli_real_escape_string($connection, $stock_id);

    $query = "SELECT * FROM stocks_payments ";
    $query .= "WHERE id = {$secure_stock_id}";
    $stock_set = mysqli_query($connection, $query);
    look_query($stock_set);

    if($stock = mysqli_fetch_assoc($stock_set)){
        return $stock;
    }else{
        return null;
    }	

}
}
