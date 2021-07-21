<?php require_once'../../../includes/initialization.php'; ?>
<?php require_once '../includes/student_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php //check whether the form is submitted
error_reporting(0);
if(isset($_POST["Import"])){
    if($_FILES['file']['name']){
        $filename = explode(".", $_FILES['file']['name']);
        if($filename[1] == 'csv') {
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            while ($data = fgetcsv($handle)) {
                $registration = mysqli_sec($data[0]);
                $surname = mysqli_sec($data[1]);
                $full_names = mysqli_sec($data[2]);
                $date_of_birth = mysqli_sec($data[3]);
                $gender = mysqli_sec($data[4]);
                $joined = mysqli_sec($data[5]);
                $class = mysqli_sec($data[6]);
                $school = mysqli_sec($data[7]);
                $skills = mysqli_sec($data[8]);
                $status = mysqli_sec($data[9]);
                $nationality = mysqli_sec($data[10]);
                $residence = mysqli_sec($data[11]);
                $county = mysqli_sec($data[12]);
                $sql = "INSERT INTO students(";
                $sql .= "registration, sirname, ";
                $sql .= "full_names, pic, ";
                $sql .= "dob, gender, ";
                $sql .= "date_of_adm, class, school, ";
                $sql .= "Skills, status, ";
                $sql .= "nationality, residence, ";
                $sql .= "county, background";
                $sql .= ") VALUES(";
                $sql .= "'{$registration}', '{$surname}', ";
                $sql .= "'{$full_names}', '', ";
                $sql .= "'{$date_of_birth}', '{$gender}', ";
                $sql .= "'{$joined}', '{$class}', '{$school}', ";
                $sql .= "'{$skills}', '{$status}', ";
                $sql .= "'{$nationality}', '{$residence}', ";
                $sql .= "'{$county}', ''";
                $sql .= ")";
                $results = mysqli_query($connection, $sql);
            }
            fclose($handle);
            if($results){
                $_SESSION["message"] = "Youve successfully imported your data";
            }else{
                $_SESSION["error_message"] = "There was a problem in trying to import your data";
            }
        }else{
            $_SESSION["error_message"] = "Please select a csv file.";
        }
    }else{
        $_SESSION["error_message"] = "Please select a file.";
    }
}else{}
?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i>Home
            </a>
            <a href="students.php" class="current">students </a>
        </div>
        <h1>Students.</h1>
    </div><!--content-header-->

    <div class="container-fluid"><hr/>
        <div class="row-fluid">
            <div class="span12">
                <?php $layout_context = $_SESSION['usertype']; ?>
                <?php if($layout_context == 'Admin'){ ?>
                    <?php echo message(); ?>
                <?php } ?>
                <?php
                if (isset($_POST["export"]))
                {
                    $all_students_set = find_all_students();
                    $all_students_rows = mysqli_num_rows($all_students_set);
                    if ($all_students_rows>= 1)
                    {
                        $file = "exports/". strtotime(now) . ".csv";
                        $fileOpen = fopen($file, "w");

                        $all_students_set = mysqli_fetch_assoc($all_students_set);
                        $line = 0;
                        foreach ($all_students_set as $name => $value)
                        {
                            $line++;
                            if ($line < 16) {
                                $label .= $name . ",";
                            }else{
                                $label .= $name . "\n";
                            }
                        }
                        fputs($fileOpen, $label);
                        $sql = "SELECT * FROM students";
                        $pupils_set = mysqli_query($connection, $sql);
                        while($pupils = mysqli_fetch_assoc($pupils_set))
                        {
                            $data=$pupils["admin"] .",". $pupils["registration"] . "," . $pupils["sirname"] . "," .
                                $pupils["full_names"] .",". $pupils["pic"] .",". $pupils["dob"] .",". $pupils["gender"] .",".
                                $pupils["date_of_adm"] .",". $pupils["class"] .",". $pupils["Skills"] ."," . $pupils["status"] ."," .
                                $pupils["nationality"] ."," . $pupils["residence"] ."," . $pupils["county"] ."," . $pupils["county"] . "\n";
                            fputs($fileOpen, $data);
                        }
                        echo "<div class=\"alert alert-success\">";
                        echo "<button class=\"close\" id=\"#gritter-notify\" data-dismiss=\"alert\">×</button>";
                        echo "<strong><a href='$file'>Download.</a></strong>";
                        echo "</div>";
                        echo "</div>";
                    }else{
                        $_SESSION["error_message"] = "You do not have any data to export";
                    }
                }else{
                ///no button has been clicked
                }
                ?>
                <?php if($layout_context == 'Admin'){ ?>
                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <form action="students.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label"><strong>IMPORT DATA :</strong></label>
                                    <div class="controls">
                                        <input type="file" name="file">
                                        <button type="submit" name="Import" class="btn btn-mini btn-success">
                                            <icon><i class="icon-download-alt"></i></icon> Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!--widget box-->
                <?php } ?>

                <form action="students/move_students.php" method="post" class="form-horizontal">
                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon">
                                <i class="icon-th"></i>
                            </span>
                            <?php if($layout_context == 'Admin'){ ?>
                                <span class="icon_right">
                                    <form action="students.php" method="POST" class="form-horizontal">
                                        <button type="submit" name="export" class="btn btn-mini btn-info">
                                            <i class="icon-upload-alt"></i> Export
                                        </button>
                                    </form>
                                </span>
                            <?php } ?>

                            <span class="icon_right">
                                <a href="" class="btn btn-mini btn-default">
                                    <i class="icon-refresh"></i>
                                </a>
                            </span>
                            <h5>Students table</h5>
                        </div>
                        <!--all students table-->
                        <div class="widget-content nopadding">
                            <?php echo message(); ?>
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>REGISTRATION #</th>
                                    <th>SURNAME</th>
                                    <th>FULL NAMES</th>
                                    <th>CLASS</th>
                                    <th>GENDER</th>
                                    <th>PROFILE</th>
                                    <?php if($layout_context == 'Admin' || $layout_context == 'Clerk'){?>
                                        <th>INVOICE</th>
                                        <th>LUNCH</th>
                                        <th>TRANSPORT</th>
                                        <th>STOCKS</th>
                                        <th>ACTIONS</th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $students_set = find_all_students(); ?>
                                <?php while($students = mysqli_fetch_assoc($students_set)){ ?>
                                    <tr>
                                        <td><?php echo htmlentities($students["registration"]); ?></td>
                                        <td><?php echo htmlentities($students["sirname"]); ?></td>
                                        <td><?php echo htmlentities($students["full_names"]); ?></td>
                                        <td><?php echo htmlentities($students["class"]); ?></td>
                                        <td><?php echo htmlentities($students["gender"]); ?></td>
                                        <td>
                                            <a href="profile.php?student=<?php echo urlencode($students["admin"]); ?>">
                                                <span class="icon">
                                                    profile <i class="icon-user"></i>
                                                </span>
                                            </a>
                                        </td>
                                        <?php if($layout_context == 'Admin' || $layout_context == 'Clerk'){?>
                                            <td>
                                                <div class="fr">
                                                    <a href="payments/invoice.php?student=<?php echo urlencode($students['admin']); ?>" class="btn btn-mini btn-success">
                                                        PAYMENTS
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fr">
                                                    <a href="lunch/lunch-invoice.php?student=<?php echo urlencode($students['admin']); ?>" class="btn btn-mini btn-link">
                                                        FEE
                                                    </a>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="fr">
                                                    <a href="transport/transport-invoice.php?student=<?php echo urlencode($students['admin']); ?>" class="btn btn-mini btn-link">
                                                         TRANSPORT FEE
                                                    </a>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="fr">
                                                    <a href="stocks/stocks.php?student=<?php echo urlencode($students['admin']); ?>" class="btn btn-mini btn-info">
                                                         ISSUED
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fr">
                                                    <a href="admit_students/delete.php?student=<?php echo urlencode($students['admin']); ?>" class="btn btn-mini btn-danger">
                                                        DELETE
                                                    </a>
                                                </div>
                                            </td>

                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table><!--table table-bordered data-table-->
                        </div><!--widget-content nopadding-->
                    </div><!--widget-box-->
                </form>
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->

<?php include '../../../includes/system/table_footer.php'; ?>
<!--end-Footer-part-->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/jquery.ui.custom.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery.uniform.js"></script>
<script src="../../js/select2.min.js"></script>
<script src="../../js/jquery.dataTables.min.js"></script>
<script src="../../js/matrix.js"></script>
<script src="../../js/matrix.tables.js"></script>
</body>
</html>
