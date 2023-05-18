<?php
header("Content-Type: application/json");

include_once '../connect_team3_db.php';
include_once '../models/item.php';

$item = new Item($pdo);

$item_id = $_POST['item_id'];
$item_name = $_POST['itemName'];
// $cate_id = $_POST['cate'];
$price = $_POST['price'];
// $stock = $_POST['stock'];
$description = $_POST['description'];

try {
    $item->updateItem($item_id, $item_name, $price, $description);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
