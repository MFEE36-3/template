<?php

require './connect_team3_db.php';

$output = [
    'success' => false,
    'postData' => $_POST,
    // 'filename' => '',
    // 'files' => $_FILES,
    'code' => 0,
    'error' => [],
];

$selectedCategories = $_POST['food_categories'];
// $categorystr1 = "";
$categorystr1 = implode(" ", $selectedCategories);
echo $categorystr1;
// foreach ($selectedCategories as $category) {
//     // Process each selected category
//     // For example, you can store them in a database or perform any other operations
//     $categorystr1 . $category . ",";
//     // echo $category . "<br>";


//     echo $categorystr1;
// }
// echo $categorystr1;
// exit;
if (!empty($_POST['account']) and !empty($_POST['email'])) {

    $isPass = true;

    $str = "";
    $r1 = $_POST['food_categories'];
    foreach ($r1 as $r2) {
        $str . $r2 . " ";
    };

    $email = trim($_POST['email']);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$email) {
        $isPass = false;
        $output['error']['email'] = '信箱格式有誤';
    };

    $city = $_POST['city'];
    $area = $_POST['area'];

    $sql2 = "SELECT * FROM area WHERE city_id = $city AND area_id = $area";

    $verify = $pdo->query($sql2)->fetch();



    $sql = "INSERT INTO 
    `shops`(
    `account`, `password`, `shop`, `owner`, `category`, 
    `photo`, `city`, `area`, `location`, `res_category`, 
    `phone`, `email`, `uniform_number`, `company_number`, 
    `open_time`, `close_time`, `food_categories`) 
    VALUES 
    (
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, 
    ?, ?, ?
    )";

    // $sql2 = "INSERT INTO 
    // `shops`
    // (`account`, `password`, `shop`, `owner`, `category`, 
    // `photo`, `city`, `area`, `location`, `res_category`, 
    // `phone`, `email`, `uniform_number`, `company_number`, 
    // `open_time`, `close_time`, 
    // `res_photo`, `food_categories`) 
    // VALUES 
    // (?, ?, ?, ?, ?, 
    // ?, ?, ?, ?, ?, 
    // ?, ?, ?, ?, 
    // ?, ?, 
    // ?, ?, )";

    $stmt = $pdo->prepare($sql);

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    if (!empty($_FILES['photo'])) {
        $filename = sha1($_FILES['photo']['name'] . uniqid()) . '.jpg';


        if (move_uploaded_file($_FILES['photo']['tmp_name'], "./Norm/imgs/{$filename}")) {
            // $output['filename'] = $filename;
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
                $_POST['open_time'],
                $_POST['close_time'],
                // $_POST['food_categories'],
                $categorystr1,
                // $str,
            ]);

            $output['success'] = !!$stmt->rowCount();
            // $output['foodcate'] = $_POST['food_categories'];
        };
    };
};


header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);