<?php
include './connect.php';

$sql = "INSERT INTO `member_achieve_record`(
    `member_id`,`achieve_id`, `creates_at`) 
    VALUES (?,?,NOW())";


$stmt = $pdo->prepare($sql);


$stmt->execute([
    3,
    '11'
]);



echo $stmt->rowCount();
