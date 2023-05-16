<?php

require './connect_team3_db.php';
require './parts/admin-required.php';
$output = [
    'success' => false,
    'postData' => $_POST, # 除錯用的
    'code' => 0,
    'error' => [],
];



if (!empty($_POST['name'])) {
    $isPass = true;
    $email = trim($_POST['email']);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (empty($email)) {
        $isPass = false;
        $output['error']['email'] = 'email 格式錯誤';
    }





    $sql = "INSERT INTO `article`(
        `user_id`, `publishedTime`, `header`,
        `content`,
        ) VALUES (
            ?, NOW(),?, 
            ?, ?, 
        )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['user_id'],
        $_POST['publishedTime'],
        $_POST['header'],
        $_POST['content'],
    ]);

    $output['success'] = !!$stmt->rowCount();
}
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
