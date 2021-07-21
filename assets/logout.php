<?php require_once '../includes/session.php'; ?>
<?php include'../includes/functions.php'; ?>
<?php 

$_SESSION["user_id"] = null;
$_SESSION["username"] = null;
redirect_to("../index.php");
?>
