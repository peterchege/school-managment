<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/staff_function.php'; ?>

<?php 
//1.check whether the form has been submited
if(isset($_POST['submit'])){
	if($_FILES['file']['name']){
		$filename = explode(".", $_FILES['file']['name']);
		if($filename[1] == 'csv')
		{
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			while ($data = fgetcsv($handle))
			{
				$surname= mysqli_sec($data[0]);
			    $fullnames= mysqli_sec($data[1]);
			    $id_number= mysqli_sec($data[2]);
			    $gender= mysqli_sec($data[3]);
			    $joined= mysqli_sec($data[4]);
			    $status= mysqli_sec($data[5]);
			    $age= mysqli_sec($data[6]);
			    $marital= mysqli_sec($data[7]);
			    $position= mysqli_sec($data[8]);
			    $subject= mysqli_sec($data[9]);
			    $classes= mysqli_sec($data[10]);
			    $college= mysqli_sec($data[11]);
			    $hobies= mysqli_sec($data[12]);
			    $mobile= mysqli_sec($data[13]);
			    $phone= mysqli_sec($data[14]);
			    $email= mysqli_sec($data[15]);
			    $address= mysqli_sec($data[16]);
			    $nationality= mysqli_sec($data[17]);
			    $county= mysqli_sec($data[18]);
			    $residence= mysqli_sec($data[19]);
			    $next_of_kin= mysqli_sec($data[20]);
		        
		        $sql = "INSERT INTO teaching_staff(";
			    $sql .= "Idnumber, sirname, ";
			    $sql .= "full_names, pic, ";
			    $sql .= "gender, age, ";
			    $sql .= "marital, joined, ";
			    $sql .= "phone, altphone, ";
			    $sql .= "email, address, ";
			    $sql .= "position, subject, ";
			    $sql .= "classes, hobies, ";
			    $sql .= "education, nationality, ";
			    $sql .= "county, residence, ";
			    $sql .= "status, next_kin ";
			    $sql .= ")VALUES(";
			    $sql .= "'{$id_number}', '{$surname}', ";
			    $sql .= "'{$fullnames}', '{$photoNameNew}', ";
			    $sql .= "'{$gender}', '{$age}', ";
			    $sql .= "'{$marital}', '{$joined}', ";
			    $sql .= "'{$mobile}', '{$phone}', ";
			    $sql .= "'{$email}', '{$address}', ";
			    $sql .= "'{$position}', '{$subject}', ";
			    $sql .= "'{$classes}', '{$hobies}', ";
			    $sql .= "'{$college}', '{$nationality}', ";
			    $sql .= "'{$county}', '{$residence}', ";
			    $sql .= "'{$status}', '{$next_of_kin}' ";
			    $sql .= ")";
			    $results = mysqli_query($connection, $sql);
			}
			fclose($handle);
		    if($results)
		    {
		       $_SESSION["message"] = "Youve successfully imported your data";
				redirect_to("../teachers.php");
		    }else{
		     	$_SESSION["error_message"] = "There was a problem in trying to import your data";
		     	redirect_to("../teachers.php");
		    }

		}else
		{
		 	$_SESSION["error_message"] = "Please select a csv file.";
		 	redirect_to("../teachers.php");
		 }
	}else{
		$_SESSION["error_message"] = "Please select a file.";
		redirect_to("../teachers.php");
	}
	
}else{
	//the form has not been submitted 
	//this is probably a get request
	redirect_to("../teachers.php");
}


?>