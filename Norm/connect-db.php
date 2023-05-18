<?php

// 連結資料庫：PDO(PHP Data Objects)
// 先設定連線變數
$db_host = 'localhost';
$db_name = 'team_3';
$db_user = 'root';
$db_pass = 'root';

// 設定data source name (dsn)

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";

// 對pdo的連線做設定，以陣列方式設定key跟value
$pdo_option = [
    // 因為是陣列，所以key跟value要用胖箭頭對應
    // 因為pdo是類型class(講義前面講的)，所以下面的雙冒號代表類別的屬性
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,    // EXCEPTION會跳錯
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // FETCH查詢資料時使用關聯式陣列(顯示主key跟value，就不是看不懂的索引值)
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_option);

if (!isset($_SESSION)) {
    session_start();
}
