<?php
require './connect_team3_db.php';
// require './list_page.php';
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

// echo $sid;
// exit;

$sql = "DELETE FROM article WHERE article_sid={$sid}";

$pdo->query($sql);

$comeFrom = 'list_page.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}

header('Location:' . $comeFrom);
