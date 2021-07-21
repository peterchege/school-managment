<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/lunch_function.php'; ?>
<?php require_once '../../includes/payments-functions.php'; ?>
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
$pdf -> Cell(40, 4, '', 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(12, 4, "CLASS: ", 0);
$pdf -> Cell(40, 4, $_SESSION['lunch_class_payments'], 0, 1);
$pdf -> Cell(100, 3, '', 0);
$pdf -> Ln(20);
$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Cell(50, 3, '', 0);
$pdf -> Cell(50, 5, "LUNCH PAYMENTS REPORTS", 0, 1, 'L');
$pdf -> Ln(8);
$pdf -> SetFont("Arial", '', 9);

$payment_set = find_payments_for_students_by_class($_SESSION['lunch_class_payments'], $_SESSION['login_term']);
$total_paid = 0;
$total_balance = 0;
$pdf -> SetFont("Arial", 'B', 10);
$pdf -> Cell(20, 5, 'REG', 1, 0);
$pdf -> Cell(40, 5, 'SURNAME', 1, 0);
$pdf -> Cell(40, 5, 'FULLNAMES', 1, 0);
$pdf -> Cell(20, 5, 'CLASS', 1, 0);
$pdf -> Cell(12, 5, 'TERM', 1, 0);
$pdf -> Cell(20, 5, 'AMOUNT', 1, 0);
$pdf -> Cell(20, 5, 'PAID', 1, 0);
$pdf -> Cell(20, 5, 'BALANCE', 1, 1);
$pdf -> SetFont("Arial", '', 7);
while($payments = mysqli_fetch_assoc($payment_set)){
    $pdf -> Cell(20, 5, $payments["registration"], 1, 0);
    $pdf -> Cell(40, 5, $payments["surname"], 1, 0);
    $pdf -> Cell(40, 5, $payments["fullnames"], 1, 0);
    $pdf -> Cell(20, 5, $payments["class"], 1, 0);
    $pdf -> Cell(12, 5, $payments["term"], 1, 0);
    $pdf -> Cell(20, 5, $payments["amount"], 1, 0);
    $pdf -> Cell(20, 5, $payments["paid"], 1, 0);
    $pdf -> Cell(20, 5, $payments["balance"], 1, 1);
    $total_paid += $payments["paid"];
    $total_balance += $payments["balance"];
}
$pdf -> Ln(5);
$pdf -> Cell(100, 5, '', 1);
$pdf -> Cell(52, 5, 'TOTAL PAYMENTS', 1, 0);
$pdf -> Cell(20, 5, 'Paid: ', 1, 0);
$pdf -> Cell(20, 5, $total_paid, 1, 1);
$pdf -> Cell(80, 5, '', 0);
$pdf -> Cell(72, 5, '', 0, 0);
$pdf -> Cell(20, 5, 'Balance: ', 1, 0);
$pdf -> Cell(20, 5, $total_balance, 1, 1);



$pdf -> SetFont("Arial", 'I', 8);
$pdf -> Ln(5);
$pdf -> Cell(20, 5, 'ISSUED BY: ', 0);
$pdf -> Cell(40, 5, $_SESSION['names'], 0, 0);
$pdf -> Cell(10, 5, '', 0, 0);
$pdf -> Cell(20, 5, 'Sign: ', 0, 0);
$pdf -> Cell(12, 5, '__________________________', 0, 1);

$pdf -> Output();
