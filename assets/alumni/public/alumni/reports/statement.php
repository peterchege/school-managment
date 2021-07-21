<?php require_once('../../../../../includes/initialization.php'); ?>
<?php require_once '../../../includes/alumni_function.php'; ?>
<?php find_selected_fields(); ?>
<?php
if (!$current_alumni_id) {
    redirect_to('../alumni.php');
}
?><?php require_once'../../../../../includes/fpdf/fpdf.php'; ?>
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
$pdf -> Cell(130, 4, '', 0);
$pdf -> Cell(10, 4, "DATE: ", 0, 0);
$pdf -> Cell(40, 4, date('Y-m-d'), 0, 1);
$pdf -> Cell(100, 3, '', 0);
$pdf -> Ln(20);
$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Cell(52, 5, '', 0);
$pdf -> Cell(50, 5, "STUDENTS PAYMENTS STATEMENT", 0, 1, 'L');
$pdf -> Ln(8);
$pdf -> SetFont("Arial", '', 9);
$payment_set =  find_total_student_amount($current_alumni_id['admin_number']);
$total_amount = 0;
$total_paid = 0;
$pdf -> SetFont("Arial", 'B', 9.5);
$pdf -> Cell(28, 5, 'REGISTRATION', 1, 0);
$pdf -> Cell(40, 5, 'SURNAME', 1, 0);
$pdf -> Cell(40, 5, 'FULLNAMES', 1, 0);
$pdf -> Cell(30, 5, 'TYPE', 1, 0);
$pdf -> Cell(18, 5, 'PAID', 1, 0);
$pdf -> Cell(18, 5, 'BALANCE', 1);
$pdf -> Cell(20, 5, 'DATE', 1, 1);

$pdf -> SetFont("Arial", '', 7);
while($payments = mysqli_fetch_assoc($payment_set)){
    $pdf -> Cell(28, 5, $payments["registration"], 1, 0);
    $pdf -> Cell(40, 5, $payments["surname"], 1, 0);
    $pdf -> Cell(40, 5, $payments["fullnames"], 1, 0);
    $pdf -> Cell(30, 5, $payments["type"], 1, 0);
    $pdf -> Cell(18, 5, $payments["paid"], 1);
    $pdf -> Cell(18, 5, $payments["balance"], 1);
    $pdf -> Cell(20, 5, $payments["date"], 1, 1);
    $total_amount += $payments["amount"];
    $total_paid += $payments["paid"];
}

$pdf -> Ln(5);
$pdf -> Cell(108, 5, '', 0);
$pdf -> Cell(48, 5, 'TOTAL STUDENT PAYMENTS: ', 1, 0);
$pdf -> Cell(18, 5, 'Total Amount: ', 1, 0);
$pdf -> Cell(20, 5, $total_amount, 1, 1);

$pdf -> Cell(108, 5, '', 0);
$pdf -> Cell(48, 5, '', 0, 0);
$pdf -> Cell(18, 5, 'Total Paid: ', 1, 0);
$pdf -> Cell(20, 5, $total_paid, 1, 1);

$total_balance = $total_amount - $total_paid;
$pdf -> Cell(108, 5, '', 0);
$pdf -> Cell(48, 5, '', 0, 0);
$pdf -> Cell(18, 5, 'Total Balance: ', 1, 0);
$pdf -> Cell(20, 5, $total_balance, 1, 1);


$pdf -> SetFont("Arial", 'I', 8);
$pdf -> Ln(5);
$pdf -> Cell(20, 5, 'ISSUED BY: ', 0);
$pdf -> Cell(40, 5, $_SESSION['names'], 0, 0);
$pdf -> Cell(10, 5, '', 0, 0);
$pdf -> Cell(20, 5, 'Sign: ', 0, 0);
$pdf -> Cell(12, 5, '__________________________', 0, 1);

$pdf -> Output();

