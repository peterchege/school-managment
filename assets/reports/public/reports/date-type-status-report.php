<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/report_functions.php'; ?>
<?php require_once'../../../../includes/fpdf/fpdf.php'; ?>
<?php
$pdf = new FPDF();
$pdf -> AddPage();
$pdf -> SetFont("Arial", "", 10);
$pdf -> Image('../../../img/sacred.png', 10, 10, 40, 40, 'png');
$pdf -> Cell(18, 10, '', 0);
$pdf -> SetFont("Arial", '', 9);
$pdf -> Ln(1);
$pdf -> SetFont("Arial", '', 8);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(25, 4, "SACRED SCHOOL", 0, 0);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(25, 4, '', 0, 0);
$pdf -> Cell(40, 4, '', 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(25, 4, "BABA DOGO", 0, 0);
$pdf -> Cell(40, 5, '', 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(15, 4, "P.O BOX: ", 0, 0);
$pdf -> Cell(25, 4, '65125-00618', 0, 0);
$pdf -> Cell(40, 4, '', 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(25, 4, "PHONE NUMBER: ", 0, 0);
$pdf -> Cell(40, 5, '0702974143', 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(10, 5, "DATE: ", 0, 0);
$pdf -> Cell(40, 5, $_SESSION['daily_date'], 0, 1);
$pdf -> Cell(100, 3, '', 0);
$pdf -> Ln(20);
$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Cell(70, 5, '', 0);
$pdf -> Cell(50, 5, "FEE TYPE REPORTS", 0, 1, 'L');
$pdf -> Ln(8);
$pdf -> SetFont("Arial", '', 9);
$total_paid = 0;
$pdf -> SetFont("Arial", 'B', 9);
$pdf -> Cell(28, 5, 'REG', 1, 0);
$pdf -> Cell(40, 5, 'FULLNAMES', 1, 0);
$pdf -> Cell(15, 5, 'CLASS', 1, 0);
$pdf -> Cell(30, 5, 'FEE TYPE', 1, 0);
$pdf -> Cell(22, 5, 'AMOUNT', 1, 0);
$pdf -> Cell(17, 5, 'PAID', 1, 0);
$pdf -> Cell(22, 5, 'BALANCE', 1);
$pdf -> Cell(22, 5, 'DATE', 1, 1);
$pdf -> SetFont("Arial", '', 8);
$payment_set = find_daily_payments_by_type_and_status($_SESSION['daily_date'], $_SESSION['daily_type'], $_SESSION['daily_status']);
while($payments = mysqli_fetch_assoc($payment_set)){
    $pdf -> Cell(28, 5, $payments['registration'], 1, 0);
    $pdf -> Cell(40, 5, $payments['fullnames'], 1, 0);
    $pdf -> Cell(15, 5, $payments['class'], 1, 0);
    $pdf -> Cell(30, 5, $payments['type'], 1, 0);
    $pdf -> Cell(22, 5, $payments['amount'], 1, 0);
    $pdf -> Cell(17, 5, $payments['paid'], 1, 0);
    $total_paid += $payments['paid'];
    $pdf -> Cell(22, 5, $payments['balance'], 1, 0);
    $pdf -> Cell(22, 5, $payments['date'], 1, 1);
}
$pdf -> SetFont("Arial", 'I', 8);
$pdf -> Ln(5);
$pdf -> Cell(28, 5, '', 0);
$pdf -> Cell(20, 5, 'ISSUED BY: ', 0);
$pdf -> Cell(40, 5, $_SESSION['names'], 0, 0);
$pdf -> Cell(10, 5, '', 0, 0);
$pdf -> Cell(20, 5, 'Sign: ', 0, 0);
$pdf -> Cell(12, 5, '__________________________', 0, 1);

$pdf -> Output();

