<?php
function confirm_query($string){
    if(!$string){
        die("Problem in the query");
    }
}


function find_all_fees(){
    global $connection;

    $query = "SELECT * FROM fees";
    $fees_set = mysqli_query($connection, $query);
    confirm_query($fees_set);
    return $fees_set;
}

function find_all_payments(){
    global $connection;

    $query = "SELECT * FROM fee_payments";
    $payments_set = mysqli_query($connection, $query);
    confirm_query($payments_set);
    return $payments_set;
}

//interview report

function find_interview_payments($date){
	global $connection;
	
	$safe_date = mysqli_real_escape_string($connection, $date);

    $query = "SELECT * FROM interviewed_students WHERE date = '{$safe_date}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}

//reports by dates
function find_daily_payments($date){
    global $connection;

    $safe_date = mysqli_real_escape_string($connection, $date);

    $query = "SELECT * FROM fee_payments WHERE date = '{$safe_date}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;

}

function find_daily_payments_by_status($date, $status){
    global $connection;

    $safe_date = mysqli_real_escape_string($connection, $date);
    $safe_status = mysqli_real_escape_string($connection, $status);

    $query = "SELECT * FROM fee_payments WHERE date = '{$safe_date}' AND status = '{$safe_status}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}

function find_daily_payments_by_class($date, $class){
    global $connection;

    $safe_date = mysqli_real_escape_string($connection, $date);
    $safe_class = mysqli_real_escape_string($connection, $class);

    $query = "SELECT * FROM fee_payments WHERE date = '{$safe_date}' AND class = '{$safe_class}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}


function find_daily_payments_by_type($date, $type){
    global $connection;

    $safe_date = mysqli_real_escape_string($connection, $date);
    $safe_type = mysqli_real_escape_string($connection, $type);

    $query = "SELECT * FROM fee_payments WHERE date = '{$safe_date}' AND type = '{$safe_type}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}



function find_daily_payments_by_type_and_status($date, $type, $status){
    global $connection;

    $safe_date = mysqli_real_escape_string($connection, $date);
    $safe_type = mysqli_real_escape_string($connection, $type);
    $safe_status = mysqli_real_escape_string($connection, $status);

    $query = "SELECT * FROM fee_payments WHERE date = '{$safe_date}' AND type = '{$safe_type}' AND status = '{$safe_status}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}


// class reports
//section abstract
//find all classes
function find_all_classes(){
    global $connection;

    $query = "SELECT * FROM classes";
    $classes_set = mysqli_query($connection, $query);
    confirm_query($classes_set);

    return $classes_set;
}

//section 1 find payments by classes
function find_all_payments_by_class($class){
    global $connection;

    $safe_class = mysqli_real_escape_string($connection, $class);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE class = '{$safe_class}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}

function find_all_payments_by_class_and_status($class, $status){
    global $connection;

    $safe_class = mysqli_real_escape_string($connection, $class);
    $safe_status = mysqli_real_escape_string($connection, $status);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE class = '{$safe_class}' AND status = '{$safe_status}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;

}
//end of section 1.
//section 2 find by class and type

function find_payments_by_class_and_type($type, $class){
    global $connection;

    $safe_type = mysqli_real_escape_string($connection, $type);
    $safe_class = mysqli_real_escape_string($connection, $class);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type = '{$safe_type}' AND class = '{$safe_class}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}
//end of section 2
//section 3 class, type and term
//will share the find_payments_by_class_and_type($type, $class)
//you cannot get class a lone
//you cannot get term alone
function find_payments_by_type_term($class, $term){
    global $connection;

    $safe_class = mysqli_real_escape_string($connection, $class);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE class = '{$safe_class}' AND term = '{$safe_term}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}

function find_all_payments_by_type_class_term($type, $class, $term){
    global $connection;

    $safe_type = mysqli_real_escape_string($connection, $type);
    $safe_class = mysqli_real_escape_string($connection, $class);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type = '{$safe_type}' AND class = '{$safe_class}' AND term = '{$safe_term}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}

//end of section 3
//section 4 will be type, class, term, and status.
function find_payments_by_type_term_status($type, $class, $status, $term){
    global $connection;

    $safe_type = mysqli_real_escape_string($connection, $type);
    $safe_class = mysqli_real_escape_string($connection, $class);
    $safe_status = mysqli_real_escape_string($connection, $status);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type = '{$safe_type}' AND class = '{$safe_class}' AND status = '{$safe_status}' AND term = '{$safe_term}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}
//end of class reports

//type and term reports
//term report
//section 1 term and status reports.
function find_all_termly_payments($term){
    global $connection;

    $safe_term = mysqli_real_escape_string($connection, $term);
    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE term = '{$safe_term}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}

//note there is repition for this function.
function find_payments_by_type($type, $term){
    /*
     * i have thhis function here because
     * if the user selects fee type sloat it
     * should not be empty.
     */
    global $connection;

    $safe_type = mysqli_real_escape_string($connection, $type);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type = '{$safe_type}' AND term = '{$safe_term}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}

function find_all_termly_payments_by_status($term, $status){
    global $connection;

    $safe_term = mysqli_real_escape_string($connection, $term);
    $safe_status = mysqli_real_escape_string($connection, $status);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE term = '{$safe_term}' AND status = '{$safe_status}' ";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}
//end of section 1

//Section 2 Term and type reports
function find_all_payments_by_type_and_term($type, $term){
    global $connection;

    $safe_type = mysqli_real_escape_string($connection, $type);
    $safe_term = mysqli_real_escape_string($connection, $term);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type = '{$safe_type}' AND term = '{$safe_term}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}
//end of section 2
//section 3 Type, term and status.

function find_all_payments_by_type_term_and_status($type, $term, $status){
    global $connection;

    $safe_type = mysqli_real_escape_string($connection, $type);
    $safe_term = mysqli_real_escape_string($connection, $term);
    $safe_status = mysqli_real_escape_string($connection, $status);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type ='{$safe_type}' AND term = '{$safe_term}' AND status = '{$safe_status}' ";
    $payments_set = mysqli_query($connection, $query);
    confirm_query($payments_set);
    return $payments_set;

}

//end of section 3


function find_all_termly_payments_by_type_and_status($type, $status){
    global $connection;

    $safe_type = mysqli_real_escape_string($connection, $type);
    $safe_status = mysqli_real_escape_string($connection, $status);
    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type = '{$safe_type}' AND status = '{$safe_status}'";
    $fee_set = mysqli_query($connection, $query);
    confirm_query($fee_set);
    return $fee_set;
}

function find_payments_by_date_range($feetype, $status, $start_date, $end_date){
    global $connection;

    $safe_feetype = mysqli_real_escape_string($connection, $feetype);
    $safe_status = mysqli_real_escape_string($connection, $status);
    $safe_start_date = mysqli_real_escape_string($connection, $start_date);
    $safe_end_date = mysqli_real_escape_string($connection, $end_date);

    $query = "SELECT * FROM fee_payments ";
    $query .= "WHERE type = '{$safe_feetype}' AND status = '{$safe_status}' AND date ";
    $query .= "BETWEEN '{$safe_start_date}' AND '$safe_end_date'";
    $date_set = mysqli_query($connection, $query);
    confirm_query($date_set);

    return $date_set;

}