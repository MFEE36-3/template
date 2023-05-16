<?php

require './Norm/connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST,
    'filename' => '',
    'files' => $_FILES,
    'code' => 0,
    'error' => [],
];

if (!empty($_POST['account']) and !empty($_POST['email'])) {

    $isPass = true;

    $email = trim($_POST['email']);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$email) {
        $isPass = false;
        $output['error']['email'] = '信箱格式有誤';
    };

    $sql = "INSERT INTO 
    `shops`(
    `account`, `password`, `shop`, `owner`, `category`, 
    `photo`, `city`, `area`, `location`, `res_category`, 
    `phone`, `email`, `uniform_number`, `company_number`, 
    `open_time`, `food_categories`) 
    VALUES 
    (
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, 
    ?, ?
    )";

    $stmt = $pdo->prepare($sql);

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (!empty($_FILES['photo'])) {
        $filename = sha1($_FILES['photo']['name'] . uniqid()) . '.jpg';

        if (move_uploaded_file($_FILES['photo']['tmp_name'], "./Norm/imgs/{$filename}")) {
            $output['filename'] = $filename;
        } else {
            $output['error'] = 'cannot move files';
        };

        if ($isPass) {
            $stmt->execute([
                $_POST['account'],
                $password,
                $_POST['shop'],
                $_POST['owner'],
                $_POST['category'],
                $filename,
                $_POST['city'],
                $_POST['area'],
                $_POST['location'],
                $_POST['res_category'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['uniform_number'],
                $_POST['company_number'],
                $_POST['open_time'] . "-" . $_POST['close_time'],
                $_POST['food_categories'],
            ]);

            $output['success'] = !!$stmt->rowCount();
        };
    };
};


header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);