<pre>
<?php
require './daidai_apis/connect_dai_db.php';
// exit;  //防呆

$sql = "SELECT `coupon_get_time`, `coupon_deadline` FROM `user_coupon` JOIN `coupon` ON `user_coupon`.coupon_sid = `coupon`.coupon_sid";
$stmt = $pdo->query($sql);
$r = $stmt->fetchAll();

print_r($r);


$get_time = $r['coupon_get_time'];
$dead = $r['coupon_deadline'];

$add_day = strtotime($get_time) + $dead;

// mktime( $hour , $minute , $second , $month , $day , $year , $is_dst);

exit;





$sql1 = "UPDATE `user_coupon` JOIN `coupon` ON `user_coupon`.coupon_sid = `coupon`.coupon_sid SET(`coupon_dead_time` = $get_time+`coupon_deadline`
    ) WHERE `coupon_dead_time` = NULL";

$stmt1 = $pdo->query($sql1);






echo json_encode([
    $stmt->rowCount(), // 影響的資料筆數
    $pdo->lastInsertId(), // 最新的新增資料的主鍵
]);
?>
</pre>