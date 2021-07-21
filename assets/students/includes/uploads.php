<?php require_once'../../../includes/session.php'; ?>
<?php require_once '../../../includes/configs/db_connect/connection.php';?>
<?php require_once'../../../includes/functions.php'; ?>
<?php 
	$id = $_SESSION['id'];
	$admin = $_GET["student"];
	if(isset($_POST["submit"])){

		$file= $_FILES['file'];

		$fileName = $_FILES['file']['name'];//name of the file
		$fileTmpName = $_FILES['file']['tmp_name'];//temporary location.
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png', 'pdf');

		if(in_array($fileActualExt, $allowed)){
			if ($fileError === 0) {
				if ($fileSize < 5000000) {
					$fileNameNew = "profile".$admin. "." .$fileActualExt;
					$fileDestination = '../public/img/profile/' . $fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					
					$sql = "UPDATE profile_pic SET status = 0 WHERE student_id= {$admin}";
					$result = mysqli_query($connection, $sql);
					redirect_to("../public/profile.php?student=".$admin);
				}else{
					$_SESSION["message"]= "the file is too large for upload";
					redirect_to("../public/profile.php?student=".$admin);
				}
			}else{
				$_SESSION["message"]="there was an eror uploading you file";
				redirect_to("../public/profile.php?student=".$admin);
			}

		}else{
			$_SESSION["message"]= "you cannot upload files of this type!";
			redirect_to("../public/profile.php?student=".$admin);
		}

	}


?>