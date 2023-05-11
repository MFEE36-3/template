<?php

$db_host = 'localhost';
$db_name = 'daidai_project';
$db_user = 'root';
$db_pass = 'root';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";


//下面是ㄍ關聯式陣列
$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    //改成預設關聯式陣列 另外還有PDO::FETCH_NUM 索引式陣列 PDO::FETCH_BOTH 我全都要
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

// 如果網頁沒有seesion才啟用session
if (!isset($_SESSION)) {
    session_start();
}
