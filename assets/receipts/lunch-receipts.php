<?php require_once('../../includes/initialization.php'); ?>
<?php require_once'includes/rec_function.php'; ?>
<?php $current_payments = find_payments_by_id($_GET['payments']); ?>
<?php
if(!$current_payments){
    redirect_to('../fees/public/payments.php');
}
?>
<?php
    $registration = mysqli_sec($current_payments['registration']);
    $fullnames = mysqli_sec($current_payments['fullnames']);
    $class = mysqli_sec($current_payments['class']);
    $fee_type = mysqli_sec($current_payments['type']);
    $amount = mysqli_sec($current_payments["amount"]);
    $paid = mysqli_sec($current_payments["paid"]);
    $balance = mysqli_sec($current_payments["balance"]);
    $method = mysqli_sec($current_payments['method']);
    $date = mysqli_sec($current_payments['date']);
    $issue = mysqli_sec($_SESSION['names']);
?>

<?php require_once'../../includes/fpdf/fpdf.php'; ?>

<?php
$pdf = new FPDF("P", "mm", "A5");
$pdf -> AddPage();
$pdf -> SetFont("Arial", "", 10);
$pdf -> Image('img/logo.png', 10, 10, 20, 20, 'png');
$pdf -> Cell(50, 10, '', 0);
$pdf -> SetFont("Arial", 'B', 10);
$pdf -> Cell(50, 30, "RECEIPT", 0, 0);
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
$pdf -> Cell(50, 5, '0702974143', 0, 1);
$pdf -> Ln(5);
$pdf -> Cell(22, 5, 'RECEIPT NO:', 0);
$pdf -> Cell(25, 5, ''.$current_payments['id'], 0);
$pdf -> Cell(35, 5, '', 0);

$pdf -> Ln(8);
$pdf -> Cell(22, 5, 'DATE RECEIVED:', 0);
$pdf -> Cell(25, 5, ''.$current_payments['date'], 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(32, 5, 'REGISTRATION NUMBER:', 0);
$pdf -> Cell(30, 5, ''.$current_payments['registration'], 0, 1);

$pdf -> Ln(8);
$pdf -> Cell(22, 5, 'FULL NAMES:', 0);
$pdf -> Cell(30, 5, ''.$current_payments['fullnames'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(22, 5, 'CLASS:', 0);
$pdf -> Cell(30, 5, ''.$current_payments['class'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Ln(5);
$pdf -> Cell(22, 5, 'PAYMENTS FOR:', 0);
$pdf -> Cell(30, 5, ''.$current_payments['type'], 0, 0);
$pdf -> Ln(5);
$pdf -> Cell(22, 5, 'PAID AMOUNT:', 0);
$pdf -> Cell(30, 5, ''.$current_payments['paid'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(22, 5, 'METHOD:', 0);
$pdf -> Cell(30, 5, ''.$current_payments['method'], 0, 1);
$pdf -> Ln(5);

$pdf -> Ln(5);
$pdf -> SetFont("Arial", 'I', 6);
$pdf -> Cell(22, 5, 'ISSUED BY:', 0);
$pdf -> Cell(30, 5, ''.$_SESSION['names'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(15, 5, 'SIGNED:', 0);
$pdf -> Cell(30, 5, '____________________', 0, 0);

$pdf -> Output();

