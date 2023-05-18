<?php

require './connect_team3_db.php';

$output = [
    'success' => false,
    'code' => 0, // 除錯用
    'errors' => '',
    'postData' => $_POST, // 除錯用
    'file' => $_FILES,
];

if (!empty($_FILES['file']['name'])) {
    $filename = sha1($_FILES['file']['name'] . uniqid()) . 'jpg';

    if (move_uploaded_file($_FILES['file']['tmp_name'], "./images/{$filename}")) {
        $output['filename'] = $filename;
    } else {
        $output['error'] = 'cannot move files';
    }
    // echo json_encode($output);
    if (isset($_POST['email'])) {
        $sql = "INSERT INTO `member_info`(
            `account`, `password`, `name`, 
            `nickname`, `mobile`, `birthday`, 
            `photo`,`creat_at`) VALUES(
                ?,?,?,
                ?,?,?,
                ?,NOW()
            )";


        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['email'],
            $_POST['password'],
            $_POST['name'],
            $_POST['nickname'],
            $_POST['mobile'],
            $_POST['birthday'],
            $filename
        ]);

        $output['success'] = !!$stmt->rowCount();
    }
} else {
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
            $_POST['birthday'],
        ]);

        $output['success'] = !!$stmt->rowCount();
    }
}


header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
