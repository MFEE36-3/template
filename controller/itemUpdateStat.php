<?php
header("Content-Type: application/json");

include_once '../connect_team3_db.php';
include_once '../models/item.php';

$item = new Item($pdo);

$item_id = $_POST['item_id'];
$active = $_POST['active'];


try {
    $item->updateItemStats($item_id, $active);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$data = [
    'data' => $item,
    'update' => true
];

echo json_encode($data);
