<?php
require './connect_team3_db.php';
// exit;  //防呆

if (!isset($_SESSION)) {
    session_start();
} else {
    session_unset($_SESSION['PHPSESSID']);
}

$sql = "SELECT * FROM `coupon` WHERE `coupon_discount` >=  {$_POST['money']}";
//$sql = "SELECT * FROM `coupon` WHERE `coupon_discount` >  10";
$stmt = $pdo->query($sql);
$r = $stmt->fetchAll();



//print_r($r);

$page = count($r);

$output = [
    'money' => $page
];



$_SESSION['page'] = $page;
$_SESSION['money'] = $_POST['money'];
$_SESSION['dai'] = 66;

//print_r($_SESSION);


//header("Location: dai_coupon_page.php");

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
