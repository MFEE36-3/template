<?php

require './Norm/connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => [],
];

if (!empty($_POST['account']) and !empty($_POST['password'])) {

    $sql = "SELECT * FROM shops WHERE account=?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $_POST['account'],
    ]);

    $row = $stmt->fetch();

    if (empty($row)) {
        $output['code'] = 410;
    } else {

        if (password_verify($_POST['password'], $row['password'])) {
            $_SESSION['admin'] = $row;
            $output['success'] = true;
        } else {
            $output['code'] = 420;
        };
    };
};

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
