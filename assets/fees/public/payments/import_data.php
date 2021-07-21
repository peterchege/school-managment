<?php require_once'../../../../includes/session.php'; ?>
<?php require_once '../../../../includes/configs/db_connect/connection.php';?>
<?php require_once'../../../../includes/functions.php'; ?>
<?php require_once '../../includes/fee_function.php'; ?>
<?php require_once'../../../../includes/validation_functions.php'; ?>

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
				$registration = mysqli_sec($data[0]);
				$surname = mysqli_sec($data[1]);
				$fullnames = mysqli_sec($data[2]);
				$gender = mysqli_sec($data[3]);
				$class = mysqli_sec($data[4]);
				$stream = mysqli_sec($data[5]);
				$fee_type = mysqli_sec($data[6]);
				$pay_status = mysqli_sec($data[7]);
				$amount = mysqli_sec($data[8]);
				$paid = mysqli_sec($data[9]);
				$balance = mysqli_sec($data[10]);
				$method = mysqli_sec($data[11]);
				$term = mysqli_sec($data[12]);
				$year = mysqli_sec($data[13]);

		        
		        $sql = "INSERT INTO fee_payments(";
		        $sql .= "registration, surname, "; 
		        $sql .= "fullnames, gender, "; 
		        $sql .= "class, stream, ";
		        $sql .= "fee_type, pay_status, "; 
		        $sql .= "amount, paid, ";
		        $sql .= "balance, method, ";
		        $sql .= "term, year";
		        $sql .= ") VALUES(";
		        $sql .= "'{$registration}', '{$surname}', "; 
		        $sql .= "'{$fullnames}', '{$gender}', ";
		        $sql .= "'{$class}', '{$stream}', ";
		        $sql .= "'{$fee_type}', '{$pay_status}', ";
		        $sql .= "'{$amount}', '{$paid}', ";
		        $sql .= "'{$balance}', '{$method}', ";
		        $sql .= "'{$term}', '{$year}'";
		        $sql .= ")";
		        $results = mysqli_query($connection, $sql);
			}
			fclose($handle);
		    if($results)
		    {
		       $_SESSION["message"] = "Youve successfully imported your data";
				redirect_to("../payments.php");
		    }else{
		     	$_SESSION["error_message"] = "There was a problem in trying to import your data";
		     	redirect_to("../payments.php");
		    }

		}else
		{
		 	$_SESSION["error_message"] = "Please select a csv file.";
		 	redirect_to("../payments.php");
		 }
	}else{
		$_SESSION["error_message"] = "Please select a file.";
		redirect_to("../payments.php");
	}
	
}else{
	//the form has not been submitted 
	//this is probably a get request
	redirect_to("../payments.php");
}


?>