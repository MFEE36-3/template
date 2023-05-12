<?php

require './Norm/connect-db.php';


$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => [],
];

if (!empty($_POST['account'])) {

    $isPass = true;

    $email = trim($_POST['email']);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$email) {
        $isPass = false;
        $output['error']['email'] = '信箱格式有誤';
    };

    $sql = "UPDATE 
    `shops` SET
    `account`= ?,
    `password`= ?,
    `shop`= ?,
    `owner`= ?,
    `category`= ?,
    `photo`= ?,
    `city`= ?,
    `area`= ?,
    `location`= ?,
    `res_category`= ?,
    `phone`= ?,
    `email`= ?,
    `uniform_number`= ?,
    `company_number`= ?,
    `open_time`= ?,
    `food_categories`= ?
     WHERE `sid`= ?";


    $stmt = $pdo->prepare($sql);

    if ($isPass) {
        $stmt->execute([
            $_POST['account'],
            $_POST['password'],
            $_POST['shop'],
            $_POST['owner'],
            $_POST['category'],
            $_POST['photo'],
            $_POST['city'],
            $_POST['area'],
            $_POST['location'],
            $_POST['res_category'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['uniform_number'],
            $_POST['company_number'],
            $_POST['open_time'],
            $_POST['food_categories'],
            $_POST['sid'],
        ]);

        $output['success'] = !!$stmt->rowCount();
    }
};

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
