<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>

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
				$type = mysqli_sec($data[0]);
		        $options = mysqli_sec($data[1]);
		        $school = mysqli_sec($data[2]);
		        $term_one = mysqli_sec($data[3]);
		        $term_two = mysqli_sec($data[4]);
		        $term_three = mysqli_sec($data[5]);
		        $joined = mysqli_sec($data[6]);
		        $installments = mysqli_sec($data[7]);
		        $year = mysqli_sec($data[8]);
		        
		        $sql = "INSERT INTO fee_structure(";
		        $sql .= "type, options, "; 
		        $sql .= "school, term_one, "; 
		        $sql .= "term_two, term_three, ";
		        $sql .= "installments, year"; 
		        $sql .= ") VALUES(";
		        $sql .= "'{$type}', '{$options}', "; 
		        $sql .= "'{$school}', '{$term_one}', ";
		        $sql .= "'{$term_two}', '{$term_three}', ";
		        $sql .= "'{$installments}', '{$year}'"; 
		        $sql .= ")";
		        $results = mysqli_query($connection, $sql);
			}
			fclose($handle);
		    if($results)
		    {
		       $_SESSION["message"] = "Youve successfully imported your data";
				redirect_to("../structure.php");
		    }else{
		     	$_SESSION["error_message"] = "There was a problem in trying to import your data";
		     	redirect_to("../structure.php");
		    }

		}else
		{
		 	$_SESSION["error_message"] = "Please select a csv file.";
		 	redirect_to("../structure.php");
		 }
	}else{
		$_SESSION["error_message"] = "Please select a file.";
		redirect_to("../structure.php");
	}
	
}else{
	//the form has not been submitted 
	//this is probably a get request
	redirect_to("../structure.php");
}


?>