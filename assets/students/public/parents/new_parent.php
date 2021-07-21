<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php find_selected_fields(); ?>

<?php // process the form 
//1. check whether the form has been submitted

if(isset($_POST["submit"])){
 //2. validation 
  //check whether there was any errors
    //get objects from the form 
     //this is the path to store the uploaded image 
    
    //3. get objects info from the form 
    $admin= $current_student_admin["admin"];    
    $fullnames= mysqli_sec($_POST["full_names"]);
    $id_number= mysqli_sec($_POST["id_number"]);
    $relationship= mysqli_sec($_POST["relationship"]);
    $gender= mysqli_sec($_POST["gender"]);
    $occupation= mysqli_sec($_POST["occupation"]);
    $phone_number= mysqli_sec($_POST["phone_number"]);
    $office_phone= mysqli_sec($_POST["office_phone"]);
    $email= mysqli_sec($_POST["email"]);
    $address= mysqli_sec($_POST["address"]);
    $marital_status= mysqli_sec($_POST["marital_status"]);
    $nationality= mysqli_sec($_POST["nationality"]);
    $county= mysqli_sec($_POST["county"]);
    $residence= mysqli_sec($_POST["residence"]);
    

    //4. perform the update query 
    $query = "INSERT INTO all_parents (";
    $query .= "admin_number, id_number, ";
    $query .= "full_names, relationship, ";
    $query .= "gender, occupation, ";
    $query .= "phone, altphone, ";
    $query .= "email, address, ";
    $query .= "marital, nationality, ";
    $query .= "county, residence";
    $query .= ") VALUES (";
    $query .= "{$admin}, '{$id_number}', ";
    $query .= "'{$fullnames}', '{$relationship}', ";
    $query .= "'{$gender}', '{$occupation}', ";
    $query .= "'{$phone_number}', '{$office_phone}', ";
    $query .= "'{$email}', '{$address}', ";
    $query .= "'{$marital}', '{$nationality}', ";
    $query .= "'{$county}', '{$residence}'";
    $query .= ")";
    $results = mysqli_query($connection, $query);

    //5. check whether the query took place
    if($results){
      //it was successfull 
      $_SESSION["message"]= "New parent/gurdian has been successfully added";
      redirect_to("../profile.php?student=". urlencode($current_student_admin["admin"]));

    }else{
      //update has failed
      $_SESSION["message"]= "There was an error in adding a new parent or gurdian";

    }
}else{
  //form has not been submitted
  //probably a get request 
}


?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo navigation_nav(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="../students.php" class="current">
                students
            </a>
        </div>
        <h1>Students.</h1>
    </div><!--content-header-->

    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php echo message(); ?>
                <?php echo form_errors($errors); ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-align-justify"></i>
                        </span>
                        <h5>New parent or Gurdian</h5>
                    </div><!--widget-title-->
                    <div class="widget-content nopadding">
                        <form action="new_parent.php?student=<?php echo urlencode($current_student_admin["admin"]); ?>" method="POST" class="form-horizontal">
                            <!--photo--><!--full_names-->
                            <div class="control-group">
                                <label class="control-label">FULL NAMES :</label>
                                <div class="controls">
                                    <input type="text" name="full_names" placeholder="Enter the parents full names" class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <!--id_number-->
                            <div class="control-group">
                                <label class="control-label">ID NUMBER :</label>
                                <div class="controls">
                                    <input type="text" name="id_number" placeholder="Enter id number of the parent" class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <!--relationship-->
                            <div class="control-group">
                                <label class="control-label">RELATIONSHIP :</label>
                                <div class="controls">
                                    <input type="text" name="relationship" placeholder="Enter the relationship with the student" class="span11"/>
                                </div>
                            </div><!--control-group-->
                
                            <!--gender-->
                            <div class="control-group">
                                <label class="control-label">GENDER :</label>
                                <div class="controls">
                                    <select name="gender">
                                        <option>MALE</option>
                                        <option>FEMALE</option>
                                    </select>
                                </div>
                            </div><!--control-group-->

                            <!--occupation-->
                            <div class="control-group">
                                <label class="control-label">OCCUPATION :</label>
                                <div class="controls">
                                    <input type="text" name="occupation" placeholder="Enter the parents occupation" class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <!--phone-->
                            <div class="control-group">
                                <label class="control-label">PHONE NUMBER :</label>
                                <div class="controls">
                                    <input type="text" name="phone_number" placeholder="Enter phone number" class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <!--altphone-->
                            <div class="control-group">
                                <label class="control-label">OFFICE PHONE NUMBER :</label>
                                <div class="controls">
                                    <input type="text" name="office_phone" placeholder="Enter the office number" class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <!--email-->
                            <div class="control-group">
                                <label class="control-label">EMAIL ADDRESS :</label>
                                <div class="controls">
                                    <input type="text" name="email" placeholder="Enter email address" class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <!--altphone-->
                            <div class="control-group">
                                <label class="control-label">LOCAL ADDRESS :</label>
                                <div class="controls">
                                    <input type="text" name="address" placeholder="Enter the local address" class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <!--altphone-->
                            <div class="control-group">
                                <label class="control-label">MARITAL STATUS :</label>
                                <div class="controls">
                                    <select name="marital_status">
                                        <option>MARRIED</option>
                                        <option>SINGLE</option>
                                    </select>
                                </div>
                            </div><!--control-group-->

  
                            <!--Nationality-->
                            <div class="control-group">
                                <label class="control-label">NATIONALITY :</label>
                                <div class="controls">
                                    <input type="text" name="nationality" placeholder="Enter the nationality" class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <div class="control-group">
                                <label class="control-label">COUNTY :</label>
                                <div class="controls">
                                    <input type="text" name="county" placeholder="Enter the county they belong" class="span11"/>
                                </div>
                            </div><!--control-group-->

                            <!--Residential area-->
                            <div class="control-group">
                                <label class="control-label">RESIDENTIAL AREA :</label>
                                <div class="controls">
                                    <input type="text" name="residence" placeholder="Enter the place where they live" class="span11" />
                                </div>
                            </div><!--control-group-->


                            <div class="form-actions">
                                <button name="submit" type="submit" class="btn btn-success">
                                    <i class="icon-download-alt"></i> Save
                                </button>

                                <a href="../profile.php?student=<?php echo urlencode($current_student_admin["admin"])?>" type="submit" class="btn btn-danger">
                                    <i class="icon-exclamation-sign"></i>  Cancel
                                </a>
                            </div>
                        </form>
                    </div><!--widget-content nopadding-->
                </div><!--widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div><!--container-fluid-->
</div><!--content-->
<?php include'../../../../includes/system/footer.php'; ?>
