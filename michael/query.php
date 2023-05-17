<?php

require '../connect_team3_db.php';
exit;  //防呆

$sql = "INSERT INTO `booking`(
    `id`, `shop_id`, `booking_date`,
    `booking_time`, `booking_number`, `table`, `create_at`
    ) VALUES (
        ?, ?, ?,
        ?, ?, ?, NOW()
    )";

//$table = [10];

$stmt = $pdo->prepare($sql);
?>
<?php for ($i = 0; $i < 20; $i++) : ?>
    <?php
    $id = random_int(1, 100);
    $shop_id = random_int(53, 100);
    $booking_date = rand(strtotime('2023-05-16'), strtotime('2023-09-30'));
    $time = date('Y-m-d', $booking_date);

    $x = random_int(1, 2);
    $a = random_int(11, 13);
    $b = random_int(18, 20);
    $c = ($x === 1) ? $a : $b;
    $booking_time = "{$c}:00";
    $booking_number = random_int(1, 2);
    $t = 2;
    $table = "{$t}人桌";

    $stmt->execute([
        $id,
        $shop_id,
        $time,
        $booking_time,
        $booking_number,
        $table,
    ]);
    ?>
<?php endfor; ?>