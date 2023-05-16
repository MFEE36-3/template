<?php
require '../m_path/connect.php';

if (isset($_GET['sid'])) {
    $sid = intval($_GET['sid']);
    // 從資料庫讀取會員資料
    $stmt = $pdo->prepare("SELECT * FROM member_info WHERE sid LIKE '%$sid%'");
    $stmt->execute([$sid]);
    $r = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$r) {
        // 找不到該會員資料
        header('Location: test_page_member_info.php');
        exit;
    }
}
