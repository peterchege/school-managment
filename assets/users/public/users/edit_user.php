<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php require_once '../../includes/users_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>
<?php find_selected_fields(); ?>
<?php if(!$current_user_id){
  redirect_to("../users.php");
  } ?>
<?php $upload_dir = "img/profile/"; ?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("fullnames", "username", "role", "password");
    validate_presences($required_fields);

    if(empty($errors)){
      //3. get objectes and store them to variables
      $id= $current_user_id["id"];
      $fullnames= mysqli_sec($_POST["fullnames"]);
      $username= mysqli_sec($_POST["username"]);
      $role= mysqli_sec($_POST["role"]);
      $mobile= mysqli_sec($_POST["mobile"]);
      $phone= mysqli_sec($_POST["phone"]);
      $email= mysqli_sec($_POST["email"]);
      $password= password_encrypt($_POST["password"]);

      $photoName = $_FILES['myfile']['name'];
      $photoTmpName = $_FILES['myfile']['tmp_name'];
      $photoSize = $_FILES['myfile']['size'];
      $photoError = $_FILES['myfile']['error'];
      $photoType = $_FILES['myfile']['type'];

      if($photoName){

        //get image extention
        $photoExt = explode('.', $photoName);
        $photoActualExt = strtolower(end($photoExt));

        //allowed extensions
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        $photoNameNew = time().'_'.rand(1000,9999).'.'.$photoActualExt;

        //check valid image
          if(in_array($photoActualExt, $allowed)){
            //check whether there is errors in the image
            if ($photoError === 0) {
              //check size of the image 5MB
               if ($photoSize < 5000000) {
                //give the photo a new name
                $photoDestination = "img/profile/".$photoNameNew;
                //delete the old image
                unlink($upload_dir.$current_user_id["pic"]);
                move_uploaded_file($photoTmpName, $photoDestination);

                }else{
                $_SESSION["error_message"] = "The image size is too big for upload";
                redirect_to("profile.php?user=".urlencode($current_user_id["id"]));

              }
              }else{
              $_SESSION["error_message"] = "There was an error in trying to upload your file";
              redirect_to("profile.php?user=".urlencode($current_user_id["id"]));

            }
          }else{
            $_SESSION["error_message"] = "The file you are trying to upload is not allowed";
            redirect_to("profile.php?user=".urlencode($current_user_id["id"]));

          }

      }else{
      //if no selected new image use the old image
        $photoNameNew = $current_user_id["pic"];
      }


      //perform insertion query 
      $query = "UPDATE users SET ";
      $query .= "fullnames= '{$fullnames}', username= '{$username}', "; 
      $query .= "pic= '{$photoNameNew}', usertype= '{$role}', ";
      $query .= "mobile= '{$mobile}', phone=  '{$phone}', ";
      $query .= "email= '{$email}', password= '{$password}' ";
      $query .= "WHERE id= {$id} ";
      $query .= "LIMIT 1";
      $results = mysqli_query($connection, $query);

      if($results && mysqli_affected_rows($connection)==1){
        //successfull
        $_SESSION["message"] = "User update was successfull";
        redirect_to("profile.php?user=".urlencode($current_user_id["id"]));
      }else{
        //failed
        $_SESSION["message"] = "User update failed..";
        redirect_to("profile.php?user=".urlencode($current_user_id["id"]));
      }

    }else{
       redirect_to("profile.php?user=".urlencode($current_user_id["id"]));
    }

  }else{
     redirect_to("profile.php?user=".urlencode($current_user_id["id"]));
  }
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
