<?php

require './connect_team3_db.php';
$output = [
    'success' => false,
    'postData' => $_POST, # 除錯用的
    'code' => 0,
    'error' => [],
];



if (!empty($_POST['article_sid'])) {
    // $isPass = true;
    // $email = trim($_POST['email']);
    // $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    // if (empty($email)) {
    //     $isPass = false;
    //     $output['error']['email'] = 'email 格式錯誤';
    // }



    // $birthday = empty($_POST['birthday']) ? null : $_POST['birthday'];

    $sql = "INSERT INTO `article`(
        `user_id`,`header`,`content`,`category`
        ) VALUES ( ?, ?, ?, ? )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['user_id'],
        $_POST['header'],
        $_POST['content'],
        $_POST['category']

    ]);

    $output['success'] = !!$stmt->rowCount();
};

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
