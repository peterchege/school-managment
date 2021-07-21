
<?php


require('../../../../includes/fpdf/fpdf.php');

//Connect to your database
include("../../../../includes/configs/db_connect/connection.php");

//Select the Products you want to show in your PDF file
$query=mysqli_query($connection,"select * from stocks_avial");
while($row = mysqli_fetch_array($query))
{
	$stid = $row['stock'];
	$size = $row['size'];
	$price = $row['total_cost'];
	$cost = $row['cost'];
	$tcost = $row['total_amount'];
	$date = $row['date_in'];

    //Sum all the Prices (TOTAL)
   // $total = $total+$real_price;
}

//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.


//Create a new PDF file
$pdf=new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf -> SetFont("Arial", "B", 10);
$pdf -> SetFont("Arial", "B", 10);
$pdf -> Image('../../../../assets/img/login.png', 10, 10, 40, 40, 'png');
$pdf -> Cell(18, 10, '', 0);
$pdf -> SetFont("Arial", '', 9);
$pdf -> Ln(1);
$pdf -> SetFont("Arial", '', 8);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, "STOCK TYPE: ", 0, 0);


$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, 'ISSUED: ', 0, 0);
$pdf -> Cell(40, 4, date('Y-m-d'), 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, "QUANTITY: ", 0, 0);


$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, "CLASS: ", 0, 0);


$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(12, 4, "PHONE: ", 0, 0);
$pdf -> Cell(46, 4, '0702974143', 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(12, 4, "AMOUNT: ", 0, 0);


$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(12, 4, "TERM : ", 0, 0);


$pdf -> Cell(100, 3, '', 0);
$pdf -> Ln(20);
$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Cell(50, 3, '', 0);
$pdf -> Cell(50, 5, "SACRED HEART CATHOLIC SCHOOL STOCK INVENTORY", 0, 1, 'L');
$pdf -> Ln(8);

//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);

$pdf -> Cell(40, 5, "STOCK ", 1, 0);
$pdf -> Cell(20, 5, "SIZE ", 1, 0);
$pdf -> Cell(30, 5, "PRICES IN ", 1, 0);
$pdf -> Cell(20, 5, "BUYING ", 1, 0);
$pdf -> Cell(30, 5, "TOTAL BUYING ", 1, 0);
$pdf -> Cell(40, 5, "DATE", 1, 1);



$pdf->SetFont('Arial','',10);

	$pdf -> Cell(40,5,$stid,1,0);
	$pdf -> Cell(20,5,$size,1, 0);
	$pdf -> Cell(30,5,$price,1,0);
	$pdf -> Cell(20,5,$cost,1,0);
	$pdf -> Cell(30,5,$tcost,1,0);
	$pdf -> Cell(40,5,$date,1,1);
$pdf -> Ln();
function Footer()
{
    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Arial','I',8);
    // Print centered page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
$filename="stock-inventory.pdf";
$pdf->Output();
?>