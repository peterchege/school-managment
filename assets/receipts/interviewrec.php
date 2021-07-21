<?php require_once('../../includes/initialization.php'); ?>
<?php require_once'includes/rec_function.php'; ?>
<?php $current_username = find_username_by_username($_GET['username']); ?>
<?php
if(!$current_username){
    redirect_to('../fees/public/payments.php');
}
?>
<?php
    $surname = mysqli_sec($current_username['surname']);
    $fullnames = mysqli_sec($current_username['fullnames']);
    $class = mysqli_sec($current_username['class']);
    $amount = mysqli_sec($current_username["paid"]);
    $date = mysqli_sec($current_username["date"]);
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
$pdf -> Cell(25, 5, ''.$current_username['username'], 0);
$pdf -> Cell(35, 5, '', 0);

$pdf -> Ln(8);
$pdf -> Cell(22, 5, 'DATE RECEIVED:', 0);
$pdf -> Cell(25, 5, ''.$current_username['date'], 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(32, 5, 'REGISTRATION NUMBER:', 0);
$pdf -> Cell(30, 5, ''.$current_username['username'], 0, 1);

$pdf -> Ln(8);
$pdf -> Cell(22, 5, 'FULL NAMES:', 0);
$pdf -> Cell(30, 5, ''.$current_username['fullnames'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(22, 5, 'CLASS:', 0);
$pdf -> Cell(30, 5, ''.$current_username['class'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Ln(5);
$pdf -> Cell(22, 5, 'PAYMENTS FOR:', 0);
$pdf -> Cell(30, 5, INTERVIEW, 0, 0);
$pdf -> Ln(5);
$pdf -> Cell(22, 5, 'PAID AMOUNT:', 0);
$pdf -> Cell(30, 5, ''.$current_username['paid'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(22, 5, 'METHOD:', 0);
$pdf -> Cell(30, 5, CASH, 0, 1);
$pdf -> Ln(5);

$pdf -> Ln(5);
$pdf -> SetFont("Arial", 'I', 6);
$pdf -> Cell(22, 5, 'ISSUED BY:', 0);
$pdf -> Cell(30, 5, ''.$_SESSION['names'], 0, 0);
$pdf -> Cell(35, 5, '', 0);
$pdf -> Cell(15, 5, 'SIGNED:', 0);
$pdf -> Cell(30, 5, '____________________', 0, 0);

$pdf -> Output();

