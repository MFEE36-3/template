<?php
require './connect_team3_db.php';

// $output = [
//     'success' => true
// ];

if (isset($_GET['sid'])) {
    $sid = intval($_GET['sid']);
    $sql = "SELECT * FROM `member_info`WHERE sid LIKE '%$sid%'";
    $stmt = $pdo->query($sql)->fetchAll();
}
