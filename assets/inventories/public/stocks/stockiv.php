<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/inventories_function.php'; ?>
<?php require_once'../../../../includes/fpdf/fpdf.php'; ?>
<?php //$current_stock_id = find_stock_by_id($_GET['stock']); ?>
<?php //if(!$current_stock_id){ redirect_to('../stocks.php');} ?>
<?php include 'stockiv.php' ?>
<?php
$pdf = new FPDF();
$pdf -> AddPage();
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
$pdf -> SetFont("Arial", 'B', 8);
$pdf -> Cell(40, 5, "STOCK ", 1, 0);
$pdf -> Cell(20, 5, "SIZE ", 1, 0);
$pdf -> Cell(30, 5, "PRICES IN ", 1, 0);
$pdf -> Cell(20, 5, "BUYING ", 1, 0);
$pdf -> Cell(30, 5, "TOTAL BUYING ", 1, 0);
$pdf -> Cell(40, 5, "DATE", 1, 1);
$pdf -> SetFont("Arial", '', 8);



$query=mysqli_query($connection,"select * from stocks_avial");
while ($data = mysqli_fetch_array($query)) {
	$stid = $data['stock'];
	$size = $data['size'];
	$price = $data['price_in'];
	$cost = $data['cost'];
	$tcost = $data['total_cost'];
	$date = $data['date_in'];
	$pdf -> Ln();
	$pdf -> SetFont("Arial", '', 8)
	$pdf -> Cell(40, 5, $stid, 1, 0);
	$pdf -> Cell(20, 5, $size, 1, 0);
	$pdf -> Cell(30, 5, $price, 1, 0);
	$pdf -> Cell(20, 5, $cost, 1, 0);
	$pdf -> Cell(30, 5, $tcost, 1, 0);
	$pdf -> Cell(40, 5, $date, 1, 1);

}

$pdf -> Ln(8);


$pdf -> Cell(50, 5, 'QUANTITY IN: ', 1, 0);
$pdf -> Cell(50, 5, 'QUANTITY OUT: ', 1, 0);
$pdf -> Cell(40, 5, 'AVAIL', 1, 0);
$pdf -> Cell(40, 5, 'COST', 1, 1);







$pdf -> Ln(8);
//$pdf -> Cell(65, 5, '', 0);
//$pdf -> Cell(90, 5, 'TOTAL PAYMENTS MADE: ', 1, 0);
//$pdf -> Cell(25, 5, 'Total Amount: ', 1, 0);
//$pdf -> Cell(15, 5, $total_amount, 1, 1);

//$pdf -> Cell(65, 5, '', 0);
//$pdf -> Cell(90, 5, 'YEAR: '.date('Y'), 1, 0);
//$pdf -> Cell(25, 5, 'Total Paid: ', 1, 0);
//$pdf -> Cell(15, 5, $total_paid, 1, 1);




$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Ln(5);
$pdf -> Cell(50, 5, '', 0);
$pdf -> Cell(87, 5, "", 0, 0);
$pdf -> Cell(28, 5, 'Amount : ', 0, 0);



$pdf -> SetFont("Arial", 'I', 8);
$pdf -> Ln(5);
$pdf -> Cell(20, 5, 'APPROVED BY: ', 0);


$pdf -> Cell(10, 5, '', 0, 0);
$pdf -> Cell(20, 5, 'Sign: ', 0, 0);
$pdf -> Cell(12, 5, '__________________________', 0, 1);




$pdf -> Output();


?>