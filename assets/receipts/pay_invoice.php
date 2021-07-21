<?php require_once('../../includes/initialization.php'); ?>
<?php require_once'includes/rec_function.php'; ?>
<?php $current_student_admin = find_student_by_adm($_GET['student']); ?>
<?php
if(!$current_student_admin){
redirect_to('../fees/public/payments.php');
}
?>
<?php $current_parent = find_current_parent($_GET['student']); ?>
<?php require_once'../../includes/fpdf/fpdf.php'; ?>
<?php
$pdf = new FPDF();
$pdf -> AddPage();
$pdf -> SetFont("Arial", "", 10);
$pdf -> Image('img/logo.png', 10, 10, 40, 40, 'png');
$pdf -> Cell(18, 10, '', 0);
$pdf -> SetFont("Arial", '', 9);
$pdf -> Ln(1);
$pdf -> SetFont("Arial", '', 8);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, "ADMISSION: ", 0, 0);
$pdf -> Cell(40, 4, $current_student_admin['registration'], 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, 'ISSUED: ', 0, 0);
$pdf -> Cell(40, 4, date('Y-m-d'), 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, "STUDENT: ", 0, 0);
$pdf -> Cell(40, 4, $current_student_admin['full_names'], 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(18, 4, "CLASS: ", 0, 0);
$pdf -> Cell(40, 4, $current_student_admin['class'], 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(12, 4, "PHONE: ", 0, 0);
$pdf -> Cell(46, 4, '0702974143', 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(12, 4, "EMAIL: ", 0, 0);
$pdf -> Cell(46, 4, $current_parent['email'], 0, 1);
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(12, 4, "TERM : ", 0, 0);
$pdf -> Cell(46, 4, $_SESSION['term_set'], 0, 1);
$pdf -> Cell(100, 3, '', 0);
$pdf -> Ln(20);
$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Cell(50, 3, '', 0);
$pdf -> Cell(50, 5, "SACRED HEART CATHOLIC SCHOOL", 0, 1, 'L');
$pdf -> Ln(8);
$pdf -> SetFont("Arial", 'B', 8);
$pdf -> Cell(50, 5, "FEE TYPE ", 1, 0);
$pdf -> Cell(15, 5, "AMOUNT ", 1, 0);
$pdf -> Cell(50, 5, "PAID ", 1, 0);
$pdf -> Cell(40, 5, "BALANCE ", 1, 0);
$pdf -> Cell(40, 5, "DATE", 1, 1);
$pdf -> SetFont("Arial", '', 8);
$payments_set = find_all_payments_for_students($current_student_admin['admin'], $_SESSION['term_set']);
$total_term_amount = 0;
$total_term_paid = 0;
while($payments = mysqli_fetch_assoc($payments_set)){
    $total_term_amount += (int)$payments["amount"];
    $total_term_paid += (int)$payments["paid"];
}

$payments_invoice_set = find_all_payments_for_students($current_student_admin['admin'], $_SESSION['term_set']);
while($payments_invoice = mysqli_fetch_assoc($payments_invoice_set)){
    $pdf -> Cell(50, 5, $payments_invoice["type"], 1, 0);
    $pdf -> Cell(15, 5, $payments_invoice["amount"], 1, 0);
    $pdf -> Cell(50, 5, $payments_invoice["paid"], 1, 0);
    $pdf -> Cell(40, 5, $payments_invoice["balance"], 1, 0);
    $pdf -> Cell(40, 5, $payments_invoice["date"], 1, 1);
}

$pdf -> Ln(8);

$pdf -> Cell(65, 5, '', 0);
$pdf -> Cell(90, 5, 'TOTAL PAYMENTS MADE IN TERM : ', 1, 0);
$pdf -> Cell(25, 5, 'Amount: ', 1, 0);
$pdf -> Cell(15, 5, $total_term_amount, 1, 1);

$pdf -> Cell(65, 5, '', 0);
$pdf -> Cell(90, 5, 'TERM : '.$_SESSION['term_set'], 1, 0);
$pdf -> Cell(25, 5, 'Paid: ', 1, 0);
$pdf -> Cell(15, 5, $total_term_paid, 1, 1);

$pdf -> Cell(65, 5, '', 0);
$pdf -> Cell(90, 5, "", 0, 0);
$pdf -> Cell(25, 5, 'Balance', 1, 0);
$total_term_balance = $total_term_amount - $total_term_paid;
$pdf -> Cell(15, 5, $total_term_balance, 1, 1);

$total_payments_set = find_payments_student_made($_GET['student']);
$total_amount = 0;
$total_paid = 0;
while($total_payments = mysqli_fetch_assoc($total_payments_set)){
    $total_amount += (int)$total_payments["amount"];
    $total_paid += (int)$total_payments["paid"];
}
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


