<?php
include "./connect_team3_db.php";

$output = [

    'success' => false,
    'data' => $_POST,  //除錯用~~
    'error' => [],  //可以丟錯誤訊息
    'code' => 0,
];


$sql = "UPDATE coupon SET
    `coupon_title` = ?, 
    `coupon_content` = ?, 
    `coupon_discount` = ?,
    `coupon_deadline` = ? WHERE `coupon_sid` = ?";

$ispass = true;


$stmt = $pdo->prepare($sql);
if ($ispass) {
    $stmt->execute([
        $_POST['coupon_title'],
        $_POST['coupon_content'],
        $_POST['discount'],
        $_POST['day'],
        $_POST['coupon_sid'],
    ]);
    $output['success'] = !!$stmt->rowCount();
}

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
