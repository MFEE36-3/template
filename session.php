<?php
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['test'] = '我的SESSION呢!!!????????';
$_SESSION['test2'] = '那為什麼';
$_SESSION['test3'] = ['換頁面', '沒有session???'];
$_SESSION['admin_member'] = ["sid" => "1", "account" => "ccg75665@gmail.com", "password" => "0000", "name" => "張葦航", "nickname" => "國動", "mobile" => "0988070327", "birthday" => "1990-10-18", "level" => "1", "wallet" => "500", "photo" => "spyanya.jpg", "creat_at" => "2023-05-13%2018:36:24"];

header('Content-Type: application/json');
echo json_encode($_SESSION, JSON_UNESCAPED_UNICODE);