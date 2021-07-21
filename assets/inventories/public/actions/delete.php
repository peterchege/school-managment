<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/inventories_function.php'; ?>
<?php $current_stock = find_stock_by_id($_GET['stock']) ?>
<?php if(!$current_stock){redirect_to("../tockss.php");} ?>

<?php

$stock_avail_set = find_stocks_pieces_available_for_stocks($current_stock['id']);
if(mysqli_num_rows($stock_avail_set) > 0){
    $_SESSION['error_message'] = "Cannot delete this stock. Clear first all records from this stock.!";
    redirect_to("../stocks.php?stock=".urlencode($current_stock["id"]));
}

?>

<?php

$id = $current_stock["id"];
$query = "DELETE FROM stocks WHERE id= {$id} LIMIT 1";
$results = mysqli_query($connection, $query);

if($results && mysqli_affected_rows($connection) == 1){
    $_SESSION['message'] = "The stock has been successfully removed";
    redirect_to("../stocks.php");
}else{
    //there was a failure
    $_SESSION['error_message'] = "There was a problem in removing the current stock";
    redirect_to("../stocks.php?stock={$id}");
}

?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








