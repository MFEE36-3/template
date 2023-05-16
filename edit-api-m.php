<?php

require './connect_team3_db.php';

$output = [
    'success' => false,
    'postData' => $_POST, # 除錯用的
    'code' => 0,
    'error' => [],
];



if (!empty($_POST['id']) and !empty($_POST['shop_id'])) {

    # TODO: 檢查欄位資料

    $sql = "UPDATE `booking` SET 
    `id`=?,
    `shop_id`=?,
    `booking_date`=?,
    `booking_time`=?,
    `booking_number`=?,
    `table`=?
    WHERE `booking_id`=? ";

    $stmt = $pdo->prepare($sql);
    $number = $_POST['table'] . "人桌";


    $stmt->execute([
        $_POST['id'],
        $_POST['shop_id'],
        $_POST['booking_date'],
        $_POST['booking_time'],
        $_POST['booking_number'],
        $number,
        $_POST['booking_id'],
    ]);

    $output['success'] = !!$stmt->rowCount();
}
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
