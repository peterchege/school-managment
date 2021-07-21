<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/class_function.php'; ?>
<?php $current_class = find_class_by_id($_GET["class"]); ?>
<?php
if (!$current_class) {
    redirect_to("../classes.php");
}
?>

<?php require_once'../../../../includes/fpdf/fpdf.php'; ?>
<?php
$counter = 1;
$pdf = new FPDF();
$pdf -> AddPage();
$pdf -> SetFont("Arial", "", 10);
$pdf -> Image('img/sacred.png', 10, 10, 40, 40, 'png');
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
$pdf -> Cell(25, 5, ''.$current_class['class'], 0, 0);
$pdf -> Cell(100, 3, '', 0);
$pdf -> Ln(20);
$pdf -> SetFont("Arial", 'B', 12);
$pdf -> Cell(50, 3, '', 0);
$pdf -> Cell(50, 5, "CLASS REPORT", 0, 1, 'L');
$pdf -> Ln(8);
$pdf -> SetFont("Arial", '', 9);
$total_paid = 0;
$total_total_paid = 0;
$pdf -> SetFont("Arial", 'B', 9);
$pdf -> Cell(28, 5, '', 0);
$pdf -> Cell(7, 5, 'NO.', 1, 0);
$pdf -> Cell(13, 5, 'REG', 1, 0);
$pdf -> Cell(45, 5, 'FULLNAMES', 1, 0);
$pdf -> Cell(15, 5, 'SEX', 1, 0);
$pdf -> Cell(22, 5, 'AMOUNT', 1, 0);
$pdf -> Cell(22, 5, 'PAID', 1, 0);
$pdf -> Cell(22, 5, 'BALANCE', 1, 1);
$pdf -> SetFont("Arial", '', 8);
$class_set = find_all_students_with_class($current_class['class'], $current_class['stream']);
while($class = mysqli_fetch_assoc($class_set)) {
    $pdf -> Cell(28, 5, '', 0);
    $pdf->Cell(7, 5, $counter, 1, 0);
    $counter++;
    $pdf->Cell(13, 5, $class["registration"], 1, 0);
    $pdf->Cell(45, 5, $class["full_names"], 1, 0);
    $pdf->Cell(15, 5, $class["gender"], 1, 0);
    $registration = $class['registration'];
    $payments_set = find_payments_for_students($registration);
    $total_amount = 0;
    $total_total_amount = 0;
    $total_paid = 0;
    while ($payments = mysqli_fetch_assoc($payments_set)) {
        $total_amount += $payments['amount'];
        $total_total_amount += $total_amount;
        $total_paid += $payments['paid'];
        $total_total_paid += $total_paid;
    }
    $total_balance = $total_amount - $total_paid;

    $pdf->Cell(22, 5, $total_amount, 1, 0);
    $pdf->Cell(22, 5, $total_paid, 1, 0);
    $pdf->Cell(22, 5, $total_balance, 1, 1);
}
    $total_total_balance = 0;
	$total_total_balance += $total_balance;
	
$pdf -> Cell(28, 5, '', 0);
$pdf -> Cell(20, 5, 'TOTAL PAID: ', 0);
$pdf -> Cell(40, 5, $total_total_paid, 0, 0);

//$pdf -> Ln(5);
$pdf -> Cell(28, 5, '', 0);
$pdf -> Cell(20, 5, 'BALANCE: ', 0);
$pdf -> Cell(20, 5, $total_total_balance, 0, 0);


$pdf -> SetFont("Arial", 'I', 8);
$pdf -> Ln(6);
$pdf -> Cell(28, 5, '', 0);
$pdf -> Cell(20, 5, 'ISSUED BY: ', 0);
$pdf -> Cell(40, 5, $_SESSION['names'], 0, 0);
$pdf -> Cell(10, 5, '', 0, 0);
$pdf -> Cell(20, 5, 'Sign: ', 0, 0);
$pdf -> Cell(12, 5, '__________________________', 0, 1);

$pdf -> Output();

