<?php
header("Content-Type: application/json");

include_once '../config/database.php';
include_once '../models/item.php';

$database = new Database();
$db = $database->getConnection();

$item = new Item($db);

$active = isset($_GET['active']) ? $_GET['active'] : NULL;

if ($active === '1') {
    $stmt = $item->readActive();
} elseif ($active === '0') {
    $stmt = $item->readInActive();
} else {
    $stmt = $item->read();
}

$items = $stmt->fetch_all(MYSQLI_ASSOC);

echo json_encode($items);
?>
