<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once'../../includes/student_function.php'; ?>
<?php require_once'../../includes/invoice_function.php'; ?>
<?php $stock = $_GET['stock'];
$name = $_GET['name'];

$query=mysqli_query($connection,"select * from stocks_payments where student_admin='$stock'");


?>


<?php confirm_other_folder_logged_in(); ?>

<?php require_once'../../../../includes/fpdf/fpdf.php'; ?>

<?php
$pdf = new FPDF();
$pdf -> AddPage();
$pdf -> SetFont("Arial", "", 10);
$pdf -> Image('../img/sacred.png', 10, 10, 40, 40, 'png');
$pdf -> Cell(18, 10, '', 0);
$pdf -> SetFont("Arial", '', 9);
$pdf -> Ln(1);
$pdf -> SetFont("Arial", '', 8);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, "ADMISSION: ", 0, 0);
$pdf -> Cell(40, 4, $stock, 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, 'ISSUED: ', 0, 0);
$pdf -> Cell(40, 4, date('Y-m-d'), 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, "STUDENT: ", 0, 0);
$pdf -> Cell(40, 4, $name, 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, "CLASS: ", 0, 0);
$pdf -> Cell(40, 4, '$class', 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(12, 4, "PHONE: ", 0, 0);
$pdf -> Cell(46, 4, '0702974143', 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(12, 4, "EMAIL: ", 0, 0);
//$pdf -> Cell(46, 4, $current_parent['email'], 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(12, 4, "TERM : ", 0, 0);
$pdf -> Cell(46, 4, '', 0, 1);
$pdf -> Cell(100, 3, '', 0);
$pdf -> Ln(20);
$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Cell(50, 3, '', 0);
$pdf -> Cell(50, 5, "SACRED HEART CATHOLIC SCHOOL", 0, 1, 'L');
$pdf -> Ln(8);
$pdf -> SetFont("Arial", 'B', 8);
$pdf -> Cell(30, 5, "STOCK", 1, 0);
$pdf -> Cell(25, 5, "QUANTITY ", 1, 0);
$pdf -> Cell(25, 5, "S. AMOUNT ", 1, 0);
$pdf -> Cell(20, 5, "T. AMOUNT ", 1, 0);
$pdf -> Cell(20, 5, "P. AMOUNT", 1, 0);
$pdf -> Cell(20, 5, "BALANCE ", 1, 0);
$pdf -> Cell(30, 5, "STATUS ", 1, 0);
$pdf -> Cell(25, 5, "DATE", 1, 1);
$pdf -> SetFont("Arial", '', 8);
$payments_set = 'TERM';
$total_term_amount = 0;
$total_term_paid = 0;


while($row = mysqli_fetch_array($query))
{
	$admission = $row["registration"];
	$fullnames = $row["fullnames"];
	$class = $row["class"];
$pdf -> Cell(30, 5, $row["stock"], 1, 0);
$pdf -> Cell(25, 5, $row["quantity"], 1, 0);
$pdf -> Cell(25, 5, $row["total_amount"], 1, 0);
$pdf -> Cell(20, 5, $row["total_amount"], 1, 0);
$pdf -> Cell(20, 5, $row["paid"], 1, 0);
$pdf -> Cell(20, 5, $row["balance"], 1, 0);
$pdf -> Cell(30, 5, $row["status"], 1, 0);
$pdf -> Cell(25, 5, $row["date"], 1, 1);
   // $pdf -> Cell(50, 5, 'MPESA', 1, 0);
   // $pdf -> Cell(15, 5, $total_amount, 1, 0);
   // $pdf -> Cell(50, 5, $paid, 1, 0);
   // $pdf -> Cell(40, 5, $balance, 1, 0);
   // $pdf -> Cell(40, 5, $date, 1, 1);
   
   
  
}

$pdf -> Cell(65, 5, '', 0);
$pdf -> Cell(90, 5, 'TOTAL PAYMENTS MADE IN TERM : ', 1, 0);
$pdf -> Cell(25, 5, 'Amount: ', 1, 0);
$pdf -> Cell(15, 5, '', 1, 1);

$pdf -> Cell(65, 5, '', 0);
$pdf -> Cell(90, 5, 'TERM', 1, 0);
$pdf -> Cell(25, 5, 'Paid: ', 1, 0);
$pdf -> Cell(15, 5, $total_term_paid, 1, 1);

$pdf -> Cell(65, 5, '', 0);
$pdf -> Cell(90, 5, "", 0, 0);
$pdf -> Cell(25, 5, 'Balance', 1, 0);
$total_term_balance = $total_term_amount - $total_term_paid;
$pdf -> Cell(15, 5, $total_term_balance, 1, 1);


$total_amount = 0;
$total_paid = 0;

    $total_amount += $row["total_amount"];
    $total_paid += $row["total_amount"];

$pdf -> Ln(8);
//$pdf -> Cell(65, 5, '', 0);
//$pdf -> Cell(90, 5, 'TOTAL PAYMENTS MADE: ', 1, 0);
//$pdf -> Cell(25, 5, 'Total Amount: ', 1, 0);
//$pdf -> Cell(15, 5, $total_amount, 1, 1);

//$pdf -> Cell(65, 5, '', 0);
//$pdf -> Cell(90, 5, 'YEAR: '.date('Y'), 1, 0);
//$pdf -> Cell(25, 5, 'Total Paid: ', 1, 0);
//$pdf -> Cell(15, 5, $total_paid, 1, 1);

$pdf -> Cell(65, 5, '', 0);
$pdf -> Cell(65, 5, "", 0, 0);
$pdf -> Cell(25, 5, 'YEAR: '.date('Y'), 1, 0);
$pdf -> Cell(25, 5, 'TOTAL BALANCE', 1, 0);
$total_balance = $total_amount - $total_paid;
$pdf -> Cell(15, 5, $total_balance, 1, 1);

$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Ln(5);
$pdf -> Cell(50, 5, '', 0);
$pdf -> Cell(87, 5, "", 0, 0);
$pdf -> Cell(28, 5, 'Amount Due: ', 0, 0);
$pdf -> Cell(15, 5, $total_balance, 0, 1);

$pdf -> SetFont("Arial", 'I', 8);
$pdf -> Ln(5);
$pdf -> Cell(20, 5, 'ISSUED BY: ', 0);
$pdf -> Cell(40, 5, $_SESSION['names'], 0, 0);
$pdf -> Cell(10, 5, '', 0, 0);
$pdf -> Cell(20, 5, 'Sign: ', 0, 0);
$pdf -> Cell(12, 5, '__________________________', 0, 1);




$pdf -> Output();


