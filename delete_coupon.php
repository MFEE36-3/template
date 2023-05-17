<?php
include './connect_team3_db.php';

$sid = isset($_GET['coupon_sid']) ? intval($_GET['coupon_sid']) : 0;

$sql = "DELETE FROM coupon WHERE coupon_sid = {$sid}";

$pdo->query($sql);

$come_from = 'dai_coupon_page.php';

if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}


header("Location: " . $come_from);
