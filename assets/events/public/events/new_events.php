<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/events_function.php'; ?>
<?php 
//1. confirm that the form has been submitted
if(isset($_POST["submit"])){
    //submission was successfull check the form vallidation
    $required_fields = array("upcoming", "venue", "day", "date", "time", "attendance", "comments");
    validate_presences($required_fields);

    if(!empty($errors)){
      $_SESSION["errors"] = $errors;
      redirect_to("../events.php");

    }else{
      $upcoming = mysqli_sec($_POST["upcoming"]);
      $venue = mysqli_sec($_POST["venue"]);
      $day = mysqli_sec($_POST["day"]);
      $date = mysqli_sec($_POST["date"]);
      $time = mysqli_sec($_POST["time"]);
      $attendance = mysqli_sec($_POST["attendance"]);
      $comments = mysqli_sec($_POST["comments"]);

      //perform query 
      $query = "INSERT INTO events(";
      $query .= "upcoming, venue, ";
      $query .= "day, event_date, ";
      $query .= "event_time, attendance, ";
      $query .= "comments ";
      $query .= ")VALUES(";
      $query .= "'{$upcoming}', '{$venue}', ";
      $query .= "'{$day}', '{$date}', ";
      $query .= "'{$time}', '{$attendance}', ";
      $query .= "'{$comments}'";
      $query .= ")";
      $results = mysqli_query($connection, $query);
      if($results){
        $_SESSION["message"] = "Youve successfully added an event";
        redirect_to("../events.php");


      }else{
        $_SESSION["error_message"] = "There was a problem in adding anewevent";
        redirect_to("../events.php");
      }
    }


  }else{
    redirect_to("../events.php");
  }
    
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
