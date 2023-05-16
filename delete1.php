<?php

require './Norm/connect-db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "DELETE FROM shops WHERE sid={$sid}";

$pdo->query($sql);

$comeFrom = 'test_page-Norm.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
};

header('Location: ' . $comeFrom);
