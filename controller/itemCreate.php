<?php
header("Content-Type: application/json");

include_once '../connect_team3_db.php';
include_once '../models/item.php';

$item = new Item($pdo);

$item_name = $_POST['itemName'];
$cate_id = $_POST['cate'];
$img_src = "./kaiimgs/drink.jpeg";
//$img_src = $_FILES["imgSrc"];
$price = $_POST['price'];
// $stock = $_POST['stock'];
$description = $_POST['description'];

try {
    $item->insertItem($item_name, $cate_id, $img_src, $price, $description);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
