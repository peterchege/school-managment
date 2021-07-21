<?php $csurname = $_GET['s']; ?>
<?php
require('../../../../includes/fpdf/fpdf.php');
//Connect to your database
include("../../../../includes/configs/db_connect/connection.php");
$query=mysqli_query($connection,"select * from interviewed_students where surname='$csurname'");
while($row = mysqli_fetch_array($query))
{
	$surname = $row['surname'];
	$fullnames = $row['fullnames'];
	$age = $row['age'];
	$gender = $row['gender'];
	$paid = $row['paid'];
	$balance = $row['balance'];
	


    //Sum all the Prices (TOTAL)
   // $total = $total+$real_price;
}

$pdf = new FPDF();
$pdf -> AddPage();
$pdf -> SetFont("Arial", "", 10);
$pdf -> Image('../../../../assets/img/login.png', 10, 10, 40, 40, 'png');
$pdf -> Cell(18, 10, '', 0);
$pdf -> SetFont("Arial", '', 9);
$pdf -> Ln(1);
$pdf -> SetFont("Arial", 'B', 8);
$pdf -> Cell(120, 4, '', 0);
$pdf -> Cell(20, 4, "SURNAME: ", 0, 0);
$pdf -> SetFont("Arial", "", 10);
$pdf -> Cell(40, 4, $surname, 0, 1);
$pdf -> Cell(120, 4, '', 0);
$pdf -> SetFont("Arial", 'B', 8);
$pdf -> Cell(20, 4, 'ISSUED: ', 0, 0);
$pdf -> SetFont("Arial", "", 10);
$pdf -> Cell(40, 4, date('Y-m-d'), 0, 1);
$pdf -> Cell(120, 4, '', 0);
$pdf -> SetFont("Arial", 'B', 8);
$pdf -> Cell(25, 4, "OTHER NAMES: ", 0, 0);
$pdf -> SetFont("Arial", "", 10);
$pdf -> Cell(40, 4, $fullnames, 0, 1);
$pdf -> Cell(130, 4, '', 0);

$pdf -> Cell(100, 3, '', 0);
$pdf -> Ln(20);
$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Cell(50, 5, '', 0);
$pdf -> Cell(50, 5, "                  INTERVIEW FEE RECEIPT", 0, 1);
$pdf -> Ln(8);
$pdf -> SetFont("Arial", 'B', 8);
$pdf -> Cell(50, 5, "FEE TYPE ", 1, 0);
$pdf -> Cell(15, 5, "AMOUNT ", 1, 0);
$pdf -> Cell(50, 5, "PAID ", 1, 0);

$pdf -> Cell(40, 5, "DATE", 1, 1);
$pdf -> SetFont("Arial", '', 8);

$pdf -> SetFont("Arial", '', 8);
$pdf -> Cell(50, 5, "INTERVIEW FEE ", 1, 0);
$pdf -> Cell(15, 5, $paid, 1, 0);
$pdf -> Cell(50, 5, $paid, 1, 0);

$pdf -> Cell(40, 5, date('Y-m-d'), 1, 1);
$pdf -> SetFont("Arial", '', 8);


$pdf -> Ln(8);






$pdf -> SetFont("Arial", 'I', 8);
$pdf -> Ln(5);
$pdf -> Cell(20, 5, 'ISSUED BY: ', 0);
$pdf -> Cell(40, 5, 'SCHOOL MANAGEMENT', 0, 0);
$pdf -> Cell(10, 5, '', 0, 0);
$pdf -> Cell(20, 5, 'Sign: ', 0, 0);
$pdf -> Cell(12, 5, '__________________________', 0, 1);




$pdf -> Output();

?>