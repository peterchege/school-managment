<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/inventories_function.php'; ?>
<?php $current_avail_id = find_stocks_pieces_available_by_id($_GET['avail']); ?>
<?php if(!$current_avail_id){ redirect_to('../stocks.php');} ?>

<?php

$id = $current_avail_id["id"];
$query = "DELETE FROM stocks_avial WHERE id= {$id} LIMIT 1";
$results = mysqli_query($connection, $query);

if($results && mysqli_affected_rows($connection) == 1){
    $_SESSION['message'] = "The stock has been successfully removed";
    redirect_to("view-stock.php?stock=".urlencode($current_avail_id['stock_id']));
}else{
    //there was a failure
    $_SESSION['error_message'] = "There was a problem in removing the current stock";
    redirect_to("view-stock.php?stock=".urlencode($current_avail_id['stock_id']));
}

?>
<?php if(isset($connection)){ mysqli_close($connection); } ?>








