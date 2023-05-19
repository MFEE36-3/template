<?php
require '../connect_team3_db.php';
exit;  //防呆


$sql = "INSERT INTO `user_coupon`(
        `member_id`,
        `coupon_sid`, 
        `coupon_status_sid`,
        `coupon_get_time`
    ) VALUES (
        ?,
        ?,
        ?,
        NOW()
    )";


$stmt = $pdo->prepare($sql);

for ($i = 0; $i < 3; $i++) {

    $member = rand(20, 200);
    $coupon = 1;
    $coupon_status = rand(1, 3);

    $stmt->execute([
        $member,
        $coupon,
        $coupon_status
    ]);

    $stmt = $pdo->prepare($sql);
}

echo json_encode([
    $stmt->rowCount(), // 影響的資料筆數
    $pdo->lastInsertId(), // 最新的新增資料的主鍵
]);
