<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/users_function.php'; ?>
<?php 
//1. confirm that the form has been submitted
  if(isset($_POST["submit"])){
    //2. vvalidate the form
    $required_fields = array("fullnames", "username", "password");
    validate_presences($required_fields);

    if(empty($errors)){
      //3. get objectes and store them to variables
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
            move_uploaded_file($photoTmpName, $photoDestination);

          }
        }

      }else{
        $_SESSION["error_message"] = "The file you are trying to upload is not allowed";
        redirect_to("../users.php");
      }


      //perform insertion query 
      $query = "INSERT INTO users(";
      $query .= "fullnames, username, "; 
      $query .= "pic, usertype, ";
      $query .= "mobile, phone, ";
      $query .= "email, password ";
      $query .= ") VALUES (";
      $query .= "'{$fullnames}', '{$username}', ";
      $query .= "'{$photoNameNew}', '{$role}', ";
      $query .= "'{$mobile}', '{$phone}', ";
      $query .= "'{$email}', '{$password}' ";
      $query .= ")";
      $results = mysqli_query($connection, $query);

      if($results){
        //successfull
        $_SESSION["message"] = "You have successfully added a new user";
        redirect_to("../users.php");
      }else{
        //failed
        $_SESSION["message"] = "There was aproblem in adding the user";
        redirect_to("../users.php");
      }

    }else{
       redirect_to("../users.php");
    }

  }else{
     redirect_to("../users.php");
  }
?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>
