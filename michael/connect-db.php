<?php

$db_host = 'localhost';
$db_name = 'restaurant';
$db_user = 'root';
$db_pass = 'root';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
} catch(PDOException $ex){
    echo $ex->getMessage();
}


if(! isset($_SESSION)){
    session_start();
}