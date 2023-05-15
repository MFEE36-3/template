<?php

require './connect_team3_db.php';

$output = [
    'success' => false,
    'postData' => $_POST, # 除錯用的
    'code' => 0,
    'error' => '',
];



if (!empty($_POST['id'])) {

    # TODO: 檢查欄位資料

    $sql = "INSERT INTO `booking`(
        `id`, `shop_id`, `booking_date`,
        `booking_time`, `booking_number`, `table`, `create_at`
        ) VALUES (
            ?, ?, ?,
            ?, ?, ?, NOW()
        )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['id'],
        $_POST['shop_id'],
        $_POST['booking_date'],
        $_POST['booking_time'],
        $_POST['booking_number'],
        $_POST['table'],
    ]);

    $output['success'] = !!$stmt->rowCount();
}
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
