<?php
require './connect.php';

if (isset($_GET['sid'])) {
    $sid = intval($_GET['sid']);

    // 從資料庫讀取會員資料
    $stmt = $pdo->prepare("SELECT * FROM member_info WHERE sid = ?");
    $stmt->execute([$sid]);
    $r = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$r) {
        // 找不到該會員資料
        header('Location: test_page_member_info.php');
        exit;
    }

    // 執行刪除操作
    $stmt = $pdo->prepare("DELETE FROM member_info WHERE sid = ?");
    $stmt->execute([$sid]);

    // 刪除成功，轉到會員列表頁面
    header('Location: test_page_member_info.php');
    exit;
} else {
    // 沒有提供會員編號，轉到會員列表頁面
    header('Location: test_page_member_info.php');
    exit;
}
