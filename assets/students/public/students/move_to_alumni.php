<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php require_once '../../includes/invoice_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php find_selected_fields(); ?>
<?php if(!$current_student_admin){ redirect_to('../students.php'); } ?>
<?php
if(isset($_POST['submit'])){

    $parents_set = find_payments_student_made($current_student_admin['admin']);
    if(mysqli_num_rows($parents_set) > 0){
        $_SESSION['error_message'] = "Cannot move this student. Please move first his/her payments records..!";
        redirect_to("../profile.php?student=". urlencode($current_student_admin['admin']));
    }


    $transport_payments_set = find_transport_for_student($current_student_admin['admin']);
    if(mysqli_num_rows( $transport_payments_set) > 0){
        $_SESSION['error_message'] = "Cannot move this student. Please move first his/her transport payments records..!";
        redirect_to("../profile.php?student=". urlencode($current_student_admin['admin']));
    }

    $admin = mysqli_sec($current_student_admin['admin']);
    $registration = mysqli_sec($current_student_admin['registration']);
    $category = mysqli_sec($_POST['category']);
    $surname = mysqli_sec($current_student_admin['sirname']);
    $fullnames = mysqli_sec($current_student_admin['full_names']);
    $pic = mysqli_sec($current_student_admin['pic']);
    $dob = mysqli_sec($current_student_admin['dob']);
    $gender = mysqli_sec($current_student_admin['gender']);
    $date_of_adm = mysqli_sec($current_student_admin['date_of_adm']);
    $class = mysqli_sec($current_student_admin['class']);
    $stream = mysqli_sec($current_student_admin['stream']);
    $skills= mysqli_sec($current_student_admin['Skills']);
    $nationality = mysqli_sec($current_student_admin['nationality']);
    $county = mysqli_sec($current_student_admin['county']);
    $residence = mysqli_sec($current_student_admin['residence']);
    $date = mysqli_sec($_POST['date_left']);
    $year = mysqli_sec($_POST['year_left']);
    $background = mysqli_sec($_POST['reasons']);

    //perform insertion query
    $query = "INSERT INTO alumni(";
    $query .= "admin_number, registration, category, ";
    $query .= "surname, fullnames, pic, ";
    $query .= "dob, gender, date_of_adm, ";
    $query .= "class, stream, skills, ";
    $query .= "nationality, county, residence, ";
    $query .= "date, year, background";
    $query .= ")VALUES(";
    $query .= "{$admin}, '{$registration}', '{$category}', ";
    $query .= "'{$surname}', '{$fullnames}', '{$pic}', ";
    $query .= "'{$dob}', '{$gender}', '{$date_of_adm}', ";
    $query .= "'{$class}', '{$stream}', '{$skills}', ";
    $query .= "'{$nationality}', '{$county}', '{$residence}', ";
    $query .= "'{$date}', '{$year}', '{$background}'";
    $query .= ")";
    $results = mysqli_query($connection, $query);
    if($results){
        $sql = "DELETE FROM students WHERE admin= {$admin} LIMIT 1";
        $answer =  mysqli_query($connection, $sql);
        if( $answer && mysqli_affected_rows($connection) == 1){
            $_SESSION["message"] = "Youve successfully moved current student into alumni";
            redirect_to('../students.php');
        }
    }else{
        $_SESSION["error_message"] = "There was a problem in moving student to alumni";
        redirect_to('../profile.php?student='.urlencode($current_student_admin['admin']));

    }

}else{
    //the button was not submitted
    redirect_to('../profile.php?student='.urlencode($current_student_admin['admin']));
}





?>