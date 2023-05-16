<?php
header("Content-Type: application/json");

include_once '../connect_team3_db.php';
include_once '../models/item.php';

$item = new Item($pdo);

$active = isset($_GET['active']) ? $_GET['active'] : NULL;

if ($active === '1') {
    $stmt = $item->readActive();
} elseif ($active === '0') {
    $stmt = $item->readInActive();
} else {
    $stmt = $item->read();
}

$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($items);
