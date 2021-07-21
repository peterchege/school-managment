<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once'../../includes/student_function.php'; ?>
<?php require_once'../../includes/invoice_function.php'; ?>
<?php $current_stock = find_all_stocks_by_id($_GET['stock']) ?>
<?php if (!$current_stock) {redirect_to("../students.php");} ?>

<?php
$registration = mysqli_sec($current_stock['registration']);
$fullnames = mysqli_sec($current_stock['fullnames']);
$class = mysqli_sec($current_stock['class']);
$stock = mysqli_sec($current_stock['stock']);
$amount = mysqli_sec($current_stock["amount"]);
$total_amount = mysqli_sec($current_stock["total_amount"]);
$paid = mysqli_sec($current_stock["paid"]);
$balance = mysqli_sec($current_stock["balance"]);
$method = mysqli_sec($current_stock['method']);
$date = mysqli_sec($current_stock['date']);
$issue = mysqli_sec($_SESSION['names']);
?>

<?php require_once'../../../../includes/fpdf/fpdf.php'; ?>

<?php
$pdf = new FPDF("P", "mm", "A5");
$pdf -> AddPage();
$pdf -> SetFont("Arial", "", 10);
$pdf -> Image('../img/sacred.png', 10, 10, 20, 20, 'png');
$pdf -> Cell(50, 10, '', 0);
$pdf -> SetFont("Arial", 'B', 10);
$pdf -> Cell(50, 30, "STOCK RECEIPT", 0, 0);
$pdf -> SetFont("Arial", '', 7);
$pdf -> Cell(50, 5, 'SACRED SCHOOL', 0, 1);
$pdf -> Cell(50, 5, '', 0);
$pdf -> Cell(50, 5, "", 0, 0);
$pdf -> Cell(50, 5, 'BABA DOGO', 0, 1);
$pdf -> Cell(50, 5, '', 0);
$pdf -> Cell(50, 5, "", 0, 0);
$pdf -> Cell(50, 5, 'P.O BOX: 65125-00618', 0, 1);
$pdf -> Cell(50, 5, '', 0);
$pdf -> Cell(50, 5, "", 0, 0);
$pdf -> Cell(50, 5, '+254160857988', 0, 1);
$pdf -> Ln(5);
$pdf -> Cell(22, 5, 'RECEIPT NO:', 0);
$pdf -> Cell(25, 5, ''.$current_stock['id'], 0);
$pdf -> Cell(35, 5, '', 0);

$pdf -> Ln(8);
$pdf -> Cell(22, 5, 'DATE RECEIVED:', 0);
$pdf -> Cell(25, 5, ''.$current_stock['date'], 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(32, 5, 'REGISTRATION NUMBER:', 0);
$pdf -> Cell(30, 5, ''.$current_stock['registration'], 0, 1);

$pdf -> Ln(8);
$pdf -> Cell(22, 5, 'FULL NAMES:', 0);
$pdf -> Cell(30, 5, ''.$current_stock['fullnames'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(22, 5, 'CLASS:', 0);
$pdf -> Cell(30, 5, ''.$current_stock['class'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Ln(5);
$pdf -> Cell(22, 5, 'PAYMENTS FOR:', 0);
$pdf -> Cell(30, 5, ''.$stock, 0, 0);
$pdf -> Ln(5);
$pdf -> Cell(22, 5, 'PAID AMOUNT:', 0);
$pdf -> Cell(30, 5, ''.$paid, 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(22, 5, 'METHOD:', 0);
$pdf -> Cell(30, 5, ''.$method, 0, 1);
$pdf -> Ln(5);

$pdf -> Ln(5);
$pdf -> SetFont("Arial", 'I', 6);
$pdf -> Cell(22, 5, 'ISSUED BY:', 0);
$pdf -> Cell(30, 5, ''.$_SESSION['names'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(15, 5, 'SIGNED:', 0);
$pdf -> Cell(30, 5, '____________________', 0, 0);

$pdf -> Output();

