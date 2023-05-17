<?php
require './connect_team3_db.php';
// exit;  //防呆

$sql = "SELECT * FROM `user_coupon` JOIN `coupon` ON `user_coupon`.coupon_sid = `coupon`.coupon_sid";
$stmt = $pdo->query($sql);
$r = $stmt->fetchAll();
//print_r($r);

//$r_count = count($r);
//echo $r_count;


foreach ($r as $item) {

    //var_dump($item);

    $get_time = $item['coupon_get_time'];
    $dead = intval($item['coupon_deadline']);
    $sid = $item['get_coupon_sid'];
    //echo $sid;
    // 將 datetime 資料轉換成 DateTime 物件
    $add_day = new DateTime($get_time);

    // 加上天數
    $add_day->add(new DateInterval("P{$dead}D"));

    //var_dump($add_day);
    $date = $add_day->format('Y-m-d H:i:s');
    // mktime( $hour , $minute , $second , $month , $day , $year , $is_dst);

    //exit;
    $sql1 = "UPDATE `user_coupon` JOIN `coupon` ON `user_coupon`.coupon_sid = `coupon`.coupon_sid SET `coupon_dead_time` = :date WHERE `get_coupon_sid` = $sid";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->bindParam(':date', $date);
    $stmt1->execute();
}

//header("Location: dai_coupon_page.php");
//記得user_coupon頁面也要放這支


// echo json_encode([
//     $stmt->rowCount(), // 影響的資料筆數
//     $pdo->lastInsertId(), // 最新的新增資料的主鍵
// ]);
