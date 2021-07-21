<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/transport_function.php'; ?>
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
$pdf -> Cell(40, 5, '+254160857988', 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(10, 5, "DATE: ", 0, 0);
$pdf -> Cell(40, 5, $_SESSION['daily_date'], 0, 1);
$pdf -> Cell(100, 3, '', 0);
$pdf -> Ln(20);
$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Cell(70, 5, '', 0);
$pdf -> Cell(50, 5, "TRANSPORT CLASS REPORTS", 0, 1, 'L');
$pdf -> Ln(8);
$pdf -> SetFont("Arial", '', 9);
$total_paid = 0;
$pdf -> SetFont("Arial", 'B', 9);
$pdf -> Cell(28, 5, 'REG', 1, 0);
$pdf -> Cell(40, 5, 'FULLNAMES', 1, 0);
$pdf -> Cell(15, 5, 'CLASS', 1, 0);
$pdf -> Cell(15, 5, 'TERM', 1, 0);
$pdf -> Cell(16, 5, 'ROUTE', 1, 0);
$pdf -> Cell(12, 5, 'FOR', 1, 0);
$pdf -> Cell(18, 5, 'AMOUNT', 1, 0);
$pdf -> Cell(15, 5, 'PAID', 1, 0);
$pdf -> Cell(15, 5, 'BAL', 1);
$pdf -> Cell(20, 5, 'DATE', 1, 1);
$pdf -> SetFont("Arial", '', 8);
$payment_set = find_all_trans_by_class($_SESSION['trans_class'], $_SESSION['trans_term']);
while($payments = mysqli_fetch_assoc($payment_set)){
    $pdf -> Cell(28, 5, $payments['registration'], 1, 0);
    $pdf -> Cell(40, 5, $payments['fullnames'], 1, 0);
    $pdf -> Cell(15, 5, $payments['class'], 1, 0);
    $pdf -> Cell(15, 5, $payments['term'], 1, 0);
    $pdf -> Cell(16, 5, $payments['route'], 1, 0);
    $pdf -> Cell(12, 5, $payments['payments'], 1, 0);
    $pdf -> Cell(18, 5, $payments['amount'], 1, 0);
    $pdf -> Cell(15, 5, $payments['paid'], 1, 0);
    $total_paid += $payments['paid'];
    $pdf -> Cell(15, 5, $payments['balance'], 1, 0);
    $pdf -> Cell(20, 5, $payments['date'], 1, 1);
}
mysqli_free_result($payment_set);
$pdf -> Ln(5);
$pdf -> Cell(55, 5, '', 0);
$pdf -> Cell(88, 5, '', 0, 0);
$pdf -> Cell(30, 5, 'Total Paid: ', 1, 0);
$pdf -> Cell(22, 5, $total_paid, 1, 1);

$pdf -> SetFont("Arial", 'I', 8);
$pdf -> Ln(5);
$pdf -> Cell(28, 5, '', 0);
$pdf -> Cell(20, 5, 'ISSUED BY: ', 0);
$pdf -> Cell(40, 5, $_SESSION['names'], 0, 0);
$pdf -> Cell(10, 5, '', 0, 0);
$pdf -> Cell(20, 5, 'Sign: ', 0, 0);
$pdf -> Cell(12, 5, '__________________________', 0, 1);

$pdf -> Output();

