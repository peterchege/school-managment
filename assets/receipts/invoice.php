<?php require_once('../../includes/initialization.php') ?>
<?php require_once'includes/rec_function.php'; ?>
<?php $current_payments = find_payments_by_id($_GET['payments']); ?>
<?php
    if(!$current_payments){
        redirect_to('../fees/public/payments.php');
    }
?>
<?php require_once'../../includes/fpdf/fpdf.php'; ?>
<?php

/**
 * this is the pdf presentation of the invoice
 *
 */
if(isset($_POST['print'])){

    $pdf = new FPDF();
    $pdf -> AddPage();
    $pdf -> SetFont("Arial", "", 10);
    $pdf -> Image('img/logo.png', 10, 10, 40, 40, 'png');
    $pdf -> Cell(18, 10, '', 0);
    $pdf -> SetFont("Arial", '', 9);
    $pdf -> Ln(1);
    $pdf -> SetFont("Arial", '', 8);
    $pdf -> Cell(130, 4, '', 0);
    $pdf -> Cell(25, 4, "INVOICE #: ", 0, 0);
    $pdf -> Cell(40, 4, $current_payments['id'], 0, 1);
    $pdf -> Cell(130, 4, '', 0);
    $pdf -> Cell(25, 4, 'ISSUE DATE: ', 0, 0);
    $pdf -> Cell(40, 4, $current_payments['date'], 0, 1);
    $pdf -> Cell(130, 4, '', 0);
    $pdf -> Cell(25, 4, "STUDENT INFO: ", 0, 0);
    $pdf -> Cell(40, 5, $current_payments['fullnames'], 0, 1);
    $pdf -> Cell(130, 4, '', 0);
    $pdf -> Cell(25, 4, "CONTACTS: ", 0, 0);
    $pdf -> Cell(40, 4, $current_payments['phone'], 0, 1);
    $pdf -> Cell(130, 4, '', 0);
    $pdf -> Cell(25, 4, "EMAIL: ", 0, 0);
    $pdf -> Cell(40, 5, $current_payments['email'], 0, 1);
    $pdf -> Cell(100, 3, '', 0);
    $pdf -> Ln(20);
    $pdf -> SetFont("Arial", 'B', 12);
    $pdf -> Cell(50, 5, "SACRED SCHOOL", 0, 1, 'L');
    $pdf -> Ln(8);
    $pdf -> SetFont("Arial", 'B', 8);
    $pdf -> Cell(50, 5, "FEE TYPE ", 1, 0);
    $pdf -> Cell(50, 5, "AMOUNT ", 1, 0);
    $pdf -> Cell(50, 5, "PAID ", 1, 0);
    $pdf -> Cell(40, 5, "BALANCE ", 1, 1);
    $pdf -> SetFont("Arial", '', 8);
    $registration = $current_payments['registration'];
    $invoice_set = find_all_students_payments($registration);
    $total_amount = 0;
    $total_paid = 0;
    $total_balance = 0;
    while($invoice = mysqli_fetch_assoc($invoice_set)){
        $pdf -> Cell(50, 5, $invoice["type"], 1, 0);
        $pdf -> Cell(50, 5, $invoice["amount"], 1, 0);
        $pdf -> Cell(50, 5, $invoice["paid"], 1, 0);
        $pdf -> Cell(40, 5, $invoice["balance"], 1, 1);
        $total_amount += $invoice["amount"];
        $total_balance += $invoice["balance"];
        $total_paid += $invoice["paid"];
    }
    $pdf -> Ln(8);
    $pdf -> Cell(50, 5, '', 0);
    $pdf -> Cell(100, 5, 'Payments Method: ', 1, 0);
    $pdf -> Cell(25, 5, 'Total Amount: ', 1, 0);
    $pdf -> Cell(15, 5, $total_amount, 1, 1);

    $pdf -> Cell(50, 5, '', 0);
    $pdf -> Cell(100, 5, $current_payments['method'], 1, 0);
    $pdf -> Cell(25, 5, 'Total Paid: ', 1, 0);
    $pdf -> Cell(15, 5, $total_paid, 1, 1);

    $pdf -> Cell(50, 5, '', 0);
    $pdf -> Cell(100, 5, "", 0, 0);
    $pdf -> Cell(25, 5, 'Total Balance', 1, 0);
    $pdf -> Cell(15, 5, $total_balance, 1, 1);

    $pdf -> SetFont("Arial", 'B', 12);
    $pdf -> Ln(5);
    $pdf -> Cell(50, 5, '', 0);
    $pdf -> Cell(97, 5, "", 0, 0);
    $pdf -> Cell(27, 5, 'Amount Due: ', 0, 0);
    $pdf -> Cell(12, 5, $total_balance, 0, 1);

    $pdf -> Output();


}else{
    //there was a problem in submission
    redirect_to('../fees/public/payments/invoice.php?payments=' . urlencode($_GET['payments']));

}