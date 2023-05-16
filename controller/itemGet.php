<?php
header("Content-Type: application/json");

include_once '../connect_team3_db.php';
include_once '../models/item.php';

$item = new Item($pdo);

$page_number = isset($_GET['page']) ? $_GET['page'] : 1;

$items_per_page = isset($_GET['totalshow']) ? $_GET['totalshow'] : 3;

$active = isset($_GET['active']) ? $_GET['active'] : 1;

$stmt = $item->get_items_for_page($active, $page_number, $items_per_page);

$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_pages = $item->get_total_pages($active, $items_per_page);

$data = [
    'data' => $items,
    'totalPages' => $total_pages,
    'page' => $page_number
];

echo json_encode($data);
