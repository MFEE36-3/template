<?php
header("Content-Type: application/json");

include_once '../connect_team3_db.php';
include_once '../models/item.php';

$item = new Item($pdo);

$item_id = isset($_GET['item_id']) ? $_GET['item_id'] : "";

$stmt = $item->getItemById($item_id);

$item = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($item);
