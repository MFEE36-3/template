<?php

require '../m_path/connect.php';
// require '../m_path/admin-required.php';

$output = [
    'success' => false,
    'code' => 0, // 除錯用
    'errors' => '',
    'postData' => $_POST, // 除錯用
];

if (isset($_POST['email'])) {
    $sql = "INSERT INTO `member_info`(
        `account`, `password`, `name`, 
        `nickname`, `mobile`, `birthday`, 
        `creat_at`) VALUES(
            ?,?,?,
            ?,?,?,
            NOW()
        )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['email'],
        $_POST['password'],
        $_POST['name'],
        $_POST['nickname'],
        $_POST['mobile'],
        $_POST['birthday']
    ]);

    $output['success'] = !!$stmt->rowCount();
}
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
