<?php
require './connect_dai_db.php';
exit;  //防呆

$coupon = [
    ["初來乍到", "歡迎新加入的小萌新!", 20, 30],
    ["購物大師", "在商城消費五筆訂單，你好棒棒", 20, 14],
    ["遊戲大師", "玩遊戲也可以拿購物金，484棒呆了", 10, 7],
    ["幸運的你", "好耶!來個大的!", 30, 7],
    ["我全都要", "有夠難選擇怎麼辦？我幫你出!", 50, 3],
];

$rowcount = count($coupon);


$sql = "INSERT INTO `coupon`(
        `coupon_title`,
        `coupon_content`, 
        `coupon_discount`,
        `coupon_deadline`
    ) VALUES (
        ?,
        ?,
        ?,
        ?
    )";

$stmt = $pdo->prepare($sql);

for ($i = 0; $i < $rowcount; $i++) {

    $stmt->execute(
        $coupon[$i]
    );
}

echo json_encode([
    $stmt->rowCount(), // 影響的資料筆數
    $pdo->lastInsertId(), // 最新的新增資料的主鍵
]);
