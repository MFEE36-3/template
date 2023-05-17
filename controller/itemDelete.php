<?php
header("Content-Type: application/json");

include_once '../connect_team3_db.php';
include_once '../models/item.php';

$item = new Item($pdo);

$item_ids = $_POST['item_id'];

try {
    $item->deleteItems($item_ids);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$data = [
    'data' => $item_ids,
    'delete' => true
];

echo json_encode($data);
