<?php require_once('../includes/initialization.php'); ?>
<?php include '../includes/dashboard_functions.php'; ?>
<?php confirm_logged_in(); ?>
<?php
$ip = $_SERVER['SERVER_NAME'];
$port = $_SERVER['REMOTE_PORT'];
$time_set = $_SERVER['REQUEST_TIME'];
$time = date("Y", $time_set);
$file = fopen("ips.txt", "at");
fwrite($file, "Name: ".$_SESSIONs['names']."\n");
fwrite($file, "Time: ".$time."\n");
fwrite($file, "Server Name: ".$ip. "\n");
fwrite($file, "Port: ".$port."\n");

?>
<?php echo dashboard_header(); ?>
<?php check_login_time(); ?>
<?php echo nav(); ?>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="home.php" title="Welcome Home" class="tip-bottom">
    <i class="icon-home"></i>Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="home.php"> 
        <i class="icon-dashboard"></i>My Dashboard </a> 
        </li>

        <li class="bg_lg span3"> 
        <a href="admissions/public/interviews.php"> <i class="icon-signal"></i>Admit</a> 
        </li>

        <li class="bg_ly"> 
        <a href="students/public/students.php"> <i class="icon-group"></i>Students </a> 
        </li>

        <li class="bg_lo">
        <a href="staff/public/teachers.php"> <i class="icon-user"></i> Teachers</a>
        </li>

        <li class="bg_ls"> 
        <a href="classes/public/classes.php"> <i class="icon-th-list"></i> Classes</a> 
        </li>
      </ul>
  </div><!--quick action homepage-->
<!--End-Action boxes-->    

<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-leaf"></i></span>
          <h5>Fee Payments Analytics</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span9">
              <table class="table table-bordered table-responsive">
                <tr valign="top">
                  <th>School Classes</th>
                  <th>Number of Students</th>
                  <th><strong>Fee Payable</strong></th>
                  <th><strong>Fees Paid</strong></th>
                  <th>Fee Balances</th>
                </tr>
                <tr valign="top">
                  <td>Play-Group</td>
                  <?php $class= 'play group';
                  $school = 'PLAY GROUP'?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_pre_students = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_pre_students);
                    ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_pre_payable_fee =  $all_pre_students * $total_pre_student_amount;
                    echo $total_pre_payable_fee; ?>
                  </td>

                  <!--total_paid-->
                  <td>
                    <?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $pre_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $pre_total_paid += (int)$pre_fee_paid['paid']; }
                    echo $pre_total_paid;
                    ?>
                  </td>


                  <td>
                    <?php
                    $pre_total_balance = $total_pre_payable_fee - $pre_total_paid;
                    echo $pre_total_balance;
                    ?>
                  </td>
                </tr>

<tr valign="top">
                  <td>Baby-class</td>
                  <?php $class= 'baby class';
                  $school = 'PRE SCHOOL'?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_pre_students = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_pre_students);
                    ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_pre_payable_fee =  $all_pre_students * $total_pre_student_amount;
                    echo $total_pre_payable_fee; ?>
                  </td>

                  <!--total_paid-->
                  <td>
                    <?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $pre_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $pre_total_paid += (int)$pre_fee_paid['paid']; }
                    echo $pre_total_paid;
                    ?>
                  </td>


                  <td>
                    <?php
                    $pre_total_balance = $total_pre_payable_fee - $pre_total_paid;
                    echo $pre_total_balance;
                    ?>
                  </td>
                </tr>
                
                <tr valign="top">
                  <td>Pre-Unit</td>
                  <?php $class= 'pre unit';
                  $school = 'PRE SCHOOL'?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_pre_students = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_pre_students);
                    ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_pre_payable_fee =  $all_pre_students * $total_pre_student_amount;
                    echo $total_pre_payable_fee; ?>
                  </td>

                  <!--total_paid-->
                  <td>
                    <?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $pre_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $pre_total_paid += (int)$pre_fee_paid['paid']; }
                    echo $pre_total_paid;
                    ?>
                  </td>


                  <td>
                    <?php
                    $pre_total_balance = $total_pre_payable_fee - $pre_total_paid;
                    echo $pre_total_balance;
                    ?>
                  </td>
                </tr>
                
                <tr valign="top">
                  <td>Nursery</td>
                  <?php $class= 'NURSERY';
                  $school = 'PRE SCHOOL'?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_nursery_students = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_nursery_students);
                    ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_nus_payable_fee = $all_nursery_students * $total_pre_student_amount;
                    echo $total_nus_payable_fee; ?>
                  </td>

                  <!--total_paid-->
                  <td>
                    <?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $pre_nus_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $pre_nus_paid += $pre_fee_paid['paid']; }
                    echo $pre_nus_paid;
                    ?>
                  </td>

                  <td><?php
                    $pre_nus_balance = $total_nus_payable_fee - $pre_nus_paid;
                    echo $pre_nus_balance;
                    ?>
                  </td>
                </tr>
                <tr valign="top">
                  <td>Class 1</td>
                  <?php
                  $class= 'Class 1';
                  $school = 'LOWER';?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_class_one = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_class_one);
                    ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_class_one_payable_fee = $all_class_one * $total_pre_student_amount;
                    echo $total_class_one_payable_fee; ?>
                  </td>

                  <td><?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $class_one_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $class_one_total_paid += $pre_fee_paid['paid']; }
                    echo $class_one_total_paid;
                    ?>
                  </td>

                  <td>
                    <?php $class_one_total_balance = $total_class_one_payable_fee - $class_one_total_paid;
                    echo $class_one_total_balance; ?>
                  </td>
                </tr>
                <tr valign="top">
                  <td>Class 2</td>
                  <?php $class= 'Class 2';
                  $school = 'LOWER'?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_class_two = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_class_two); ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_class_two_payable_fee = $all_class_two * $total_pre_student_amount;
                    echo $total_class_two_payable_fee; ?>
                  </td>

                  <td>
                    <?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $class_two_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $class_two_total_paid += $pre_fee_paid['paid']; }
                    echo $class_two_total_paid;
                    ?>
                  </td>

                  <td>
                    <?php
                    $class_two_total_balance = $total_class_two_payable_fee - $class_two_total_paid;
                    echo $class_two_total_balance;
                    ?>
                  </td>
                </tr>
                <tr valign="top">
                  <td>Class 3</td>
                  <?php $class= 'Class 3';
                  $school = 'LOWER'?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_class_three = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_class_three);
                    ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_class_three_payable_fee = $all_class_three * $total_pre_student_amount;
                    echo $total_class_three_payable_fee; ?>
                  </td>

                  <td>
                    <?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $class_three_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $class_three_total_paid += $pre_fee_paid['paid']; }
                    echo $class_three_total_paid;
                    ?>
                  </td>

                  <td>
                    <?php
                    $class_three_total_balance = $total_class_three_payable_fee - $class_three_total_paid;
                    echo $class_three_total_balance;
                    ?>
                  </td>
                </tr>
                <tr valign="top">
                  <td>Class 4</td>
                  <?php $class= 'Class 4';
                  $school = 'UPPER'?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_class_four = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_class_four);
                    ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_class_four_payable_fee = $all_class_four * $total_pre_student_amount;
                    echo $total_class_four_payable_fee; ?>
                  </td>

                  <td>
                    <?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $class_four_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $class_four_total_paid += $pre_fee_paid['paid']; }
                    echo $class_four_total_paid;
                    ?>
                  </td>

                  <td>
                    <?php $class_four_total_balance = $total_class_four_payable_fee - $class_four_total_paid;
                    echo $class_four_total_balance; ?>
                  </td>
                </tr>
                <tr valign="top">
                  <td>Class 5</td>
                  <?php $class= 'Class 5';
                  $school = 'UPPER'?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_class_five = mysqli_num_rows($pre_students_set);
                    echo htmlentities(mysqli_num_rows($pre_students_set)); ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_class_five_payable_fee = $all_class_five * $total_pre_student_amount;
                    echo $total_class_five_payable_fee; ?>
                  </td>

                  <td>
                    <?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $class_five_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $class_five_total_paid += $pre_fee_paid['paid']; }
                    echo $class_five_total_paid;
                    ?>
                  </td>

                  <td>
                    <?php
                    $class_five_total_balance = $total_class_five_payable_fee - $class_five_total_paid;
                    echo $class_five_total_balance;
                    ?>
                  </td>
                </tr>

                <tr valign="top">
                  <td>Class 6</td>
                  <?php
                  $class= 'Class 6';
                  $school = 'UPPER'; ?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_class_six = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_class_six); ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_class_six_payable_fee = $all_class_six * $total_pre_student_amount;
                    echo $total_class_six_payable_fee; ?>
                  </td>

                  <td><?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $class_six_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $class_six_total_paid += $pre_fee_paid['paid']; }
                    echo $class_six_total_paid;
                    ?>
                  </td>

                  <td>
                    <?php
                    $class_six_total_balance = $total_class_six_payable_fee - $class_six_total_paid;
                    echo $class_six_total_balance;
                    ?>
                  </td>
                </tr>

                <tr valign="top">
                  <td>Class 7</td>
                  <?php
                  $class= 'Class 7';
                  $school = 'UPPER';
                  ?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_class_seven = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_class_seven);
                    ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_class_seven_payable_fee = $all_class_seven * $total_pre_student_amount;
                    echo $total_class_seven_payable_fee; ?>
                  </td>

                  <td>
                    <?php $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $class_seven_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $class_seven_total_paid += $pre_fee_paid['paid']; }
                    echo $class_seven_total_paid;
                    ?>
                  </td>

                  <td>
                    <?php
                    $class_seven_total_balance = $total_class_six_payable_fee - $class_seven_total_paid;
                    echo $class_six_total_balance;
                    ?>
                  </td>
                </tr>

                <tr valign="top">
                  <td>Class 8</td>
                  <?php
                  $class= 'Class 8';
                  $school = 'CLASS 8';
                  ?>
                  <td>
                    <?php $pre_students_set = find_all_students_for_class($class); ?>
                    <?php
                    $all_class_eight = mysqli_num_rows($pre_students_set);
                    echo htmlentities($all_class_eight); ?>
                  </td>

                  <td>
                    <?php $total_pre_student_amount = 0;
                    $pre_amount_set = find_structure_of_students_by_class($school, $_SESSION['login_term']);
                    while($pre_amount = mysqli_fetch_assoc($pre_amount_set)){ $total_pre_student_amount += $pre_amount['amount']; }
                    $total_class_eight_payable_fee = $all_class_eight * $total_pre_student_amount;
                    echo $total_class_eight_payable_fee; ?>
                  </td>

                  <td>
                    <?php
                    $pre_fee_paid_set = find_payments_of_students_by_class($class, $_SESSION['login_term']);
                    $class_eight_total_paid = 0;
                    while($pre_fee_paid = mysqli_fetch_assoc($pre_fee_paid_set)){ $class_eight_total_paid += $pre_fee_paid['paid']; }
                    echo $class_eight_total_paid;
                    ?>
                  </td>

                  <td>
                    <?php
                    $class_eight_total_balance= $total_class_eight_payable_fee - $class_eight_total_paid;
                    echo $class_eight_total_balance;
                    ?>
                  </td>
                </tr>

                <tr valign="top">
                  <td><h1>TOTAL</h1></td>
                  <td>
                    <?php $total_students_avail= $all_pre_students + $all_nursery_students + $all_class_one + $all_class_two + $all_class_three + $all_class_four + $all_class_five + $all_class_six + $all_class_seven + $all_class_eight; ?>
                    <?php echo htmlentities($total_students_avail); ?>
                  </td>

                  <td>
                    <?php $total_payable_fee = $total_pre_payable_fee + $total_nus_payable_fee + $total_class_one_payable_fee + $total_class_two_payable_fee + $total_class_three_payable_fee + $total_class_four_payable_fee + $total_class_five_payable_fee + $total_class_six_payable_fee + $total_class_seven_payable_fee + $total_class_eight_payable_fee;
                    echo $total_payable_fee; ?>
                  </td>

                  <td>
                    <?php $total_paid_fee = $pre_total_paid + $pre_nus_paid + $class_one_total_paid + $class_two_total_paid + $class_three_total_paid + $class_four_total_paid + $class_five_total_paid + $class_six_total_paid + $class_seven_total_paid + $class_eight_total_paid;
                    echo $total_paid_fee; ?>
                  </td>

                  <td>
                    <?php

                    $total_all_balance = $total_payable_fee - $total_paid_fee;
                    //$total_all_balance =  $pre_total_balance + $pre_nus_balance + $class_one_total_balance + $class_two_total_balance + $class_three_total_balance + $class_four_total_balance + $class_five_total_balance + $class_six_total_balance + $class_seven_total_balance + $class_eight_total_balance;
                    echo $total_all_balance;
                    ?>

                  </td>
                </tr>
              </table>

            </div>
            <div class="span3">
              <ul class="site-stats">
                <li class="bg_lh">
                <?php $students_set = find_all_students(); ?>
                <i class="icon-group"></i><strong><?php echo htmlentities($total_students_avail); ?></strong>
                <small>Total Students</small>
                </li>

                <li class="bg_lh">
                  <?php $new_students_set = find_all_new_students(); ?>
                <i class="icon-plus"></i> <strong><?php echo mysqli_num_rows($new_students_set); ?></strong>
                <small>New Students </small>
                </li>

                <li class="bg_lh">
                  <i class="icon-money"></i>
                  <strong><?php echo htmlentities($total_payable_fee);?></strong>
                  <small>Fee Amount</small>
                </li>

                <li class="bg_lh">
                  <i class="icon-tag"></i>
                  <strong><?php echo htmlentities($total_paid_fee); ?></strong>
                  <small>Total Paid Fee</small>
                </li>

                <li class="bg_lh">
                  <i class="icon-tint"></i>
                  <strong><?php echo htmlentities($total_all_balance); ?></strong>
                  <small>Balances</small>
                </li>

                <li class="bg_lh">
                <i class="icon-table"></i>
                  <?php $all_classes_set = find_all_classes(); ?>
                <strong><?php echo mysqli_num_rows($all_classes_set); ?></strong>
                <small>Classes</small>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 

    <hr/>
  <div class="row-fluid">
  <div class="span12">
         <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
            <h5>Latest School Events &amp; Activities</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
            <li>
                <div class="article-post"> 
                  <table class="table table-bordered table-responsive">
                    <thead>
                      <th>UPCOMING EVENT</th>
                      <th>VENUE</th>
                      <th>DAY</th>
                      <th>DATE</th>
                      <th>TIME</th>
                    </thead>
                    <?php $events_set = find_all_events(); ?>
                    <?php while ($events= mysqli_fetch_assoc($events_set)) { ?>
                    <tbody>
                      <td><?php echo htmlentities($events["upcoming"]); ?></td>
                      <td><?php echo htmlentities($events["venue"]); ?></td> 
                      <td><?php echo htmlentities($events["day"]); ?></td> 
                      <td><?php echo htmlentities($events["event_date"]); ?></td> 
                      <td><?php echo htmlentities($events["event_time"]); ?></td>   
                    </tbody>
                    <?php } ?>
                    <?php mysqli_free_result($events_set); ?> 
                  </table>
                </div>
              </li>
              <li>
                <a href="events/public/events.php" class="btn btn-warning btn-mini">View All</a>
              </li>
            </ul>
          
          </div>
        </div>
        <hr>
        <!--notification starter -->
        <?php if (isset($_POST["add"])) { ?>
        <div class="widget-box">
          <div class="widget-content nopadding">
            <form action="notifications/public/add_notification.php" method="POST" class="form-horizontal">
              <!--class-->
              <div class="control-group">
                    <label class="control-label">TITLE :</label>
                  <div class="controls">
                      <input type="text" name="title" class="span11" placeholder="Enter the notification title.." />
                    </div>
                </div><!--control-group-->


                <!--stream-->
                <div class="control-group">
                  <label class="control-label">NOTICE :</label>
                  <div class="controls">
                  <input type="text" name="notice" class="span11" placeholder="Enter the notice.." />
                  </div>
                </div><!--control-group-->

                <!--photo-->
                <div class="control-group">
                  <label class="control-label">DATE :</label>
                  <div class="controls">
                     <input type="text" name="date" class="span11" placeholder="Enter the date of notification..." />
                  </div>
                </div><!--control-group-->

                <!--photo-->
                <div class="control-group">
                  <label class="control-label">MONTH :</label>
                  <div class="controls">
                     <input type="text" name="month" class="span11" placeholder="Enter the class teacher..." />
                  </div>
                </div><!--control-group-->

                <!--photo-->
                <div class="control-group">
                  <label class="control-label">TERM :</label>
                  <div class="controls">
                     <input type="text" name="term" class="span11" placeholder="Enter term..." />
                  </div>
                </div><!--control-group-->



                <div class="form-actions">
                    <button name="submit" type="submit" class="btn btn-success">
                    <i class="icon-download-alt"></i> Save
                    </button>
                </div>

            </form>
          </div><!--widget-content nopadding-->
        </div><!--widget-box-->
        <?php } ?>
        <div class="widget-box">
        <?php $layout_context = $_SESSION['usertype']; ?>
        <?php if($layout_context == 'Admin'){ ?>
        <?php echo message(); ?>
          <div class="widget-title"> 
          <span class="icon"><i class="icon-ok"></i></span>
          <span class="icon_right">
          <form action="" method="POST" class="form-horizontal">
            <a href="" class="btn btn-mini btn-default"><i class="icon-refresh"></i></a>
            <button type="submit" name="add" class="btn btn-mini btn-success">
              <i class="icon-plus"></i>
            </button>
          </form>
          </span>
            <h5>Notifications</h5>
          </div>
        <?php }else{ ?>
          <div class="widget-title">
            <span class="icon"><i class="icon-ok"></i></span>
            <h5>Notifications</h5>
          </div><!--user widget title-->
          <?php } ?>
          <div class="widget-content">
            <div class="todo">
            <?php $notification_set = find_all_notification(); ?>
              <ul>
              <?php while ($notification = mysqli_fetch_assoc($notification_set)) { ?>
                <li class="clearfix">
                  <strong><?php echo htmlentities($notification["title"]) ?>.</strong><br>
                  <div class="txt"><?php echo htmlentities($notification["notice"]); ?>
                  <span class="date badge badge-success"><?php echo htmlentities($notification["month"]);  ?></span>
                  <span class="date badge badge-important"><?php echo htmlentities($notification["not_date"]);  ?></span>
                  <span class="by label"><?php echo htmlentities($notification["term"]);  ?></span>  
                  </div>
                  <?php if($layout_context == 'Admin'){ ?>
                    <div class="pull-right">
                      <a href="notifications/public/edit.php?notice=<?php echo urlencode($notification["id"]);?>" class="tip">
                        <i class="icon-pencil"></i></a>
                      <a href="notifications/public/delete.php?notice=<?php echo urlencode($notification["id"]); ?>" onclick="return confirm('Are you sure?..');" class="tip">
                        <i class="icon-remove"></i></a>
                    </div>
                  <?php } ?>
                </li>
              <?php } ?>
              </ul>
            </div><!--to do-->
          </div><!--widget-content-->
        </div><!--widget-box-->
      </div><!--Span12-->
    </div>
  </div><!--Container fluid-->
</div><!--Content-->
<!--end-main-container-part-->
<?php include '../includes/system/footer.php'; ?>

