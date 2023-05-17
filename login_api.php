<?php
if (!isset($_SESSION)) {
    session_start();
}

require './connect_team3_db.php';


$output = [

    'success' => false,
    'data' => $_POST,  //除錯用~~
    'code' => 0,
];


if (!empty($_POST['email']) and !empty($_POST['password'])) {
    //如果帳號跟密碼不是空值才進來

    $sql = "SELECT * FROM member_info WHERE account=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['email']
    ]);

    $row = $stmt->fetch();

    //如果資料庫有抓到同帳號的資料才進來
    if (empty($row)) {
        $output['code'] = 410; //自己設的假設帳號錯誤代號
    } else {
        // if (password_verify($_POST['password'], $row['password'])) {
        if ($_POST['password'] == $row['password']) {
            # 密碼也是對的
            $_SESSION['admin'] = $row;
            $output['success'] = true;
            $output['ses'] = $_SESSION['admin'];
        } else {
            $output['code'] = 420; //自己設的假設密碼錯誤代號
        }
    }
}

// $output['success'] = true;
//測試用


header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
