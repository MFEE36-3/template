<?php
 require './connect_team3_db.php';

$areasTPE = ['中正區', '大同區', '中山區', '松山區', '大安區', '萬華區', '信義區', '士林區', '北投區', '內湖區', '南港區', '文山區'];
$areasNTC = ['萬里區', '金山區', '板橋區', '汐止區', '深坑區', '石碇區', '瑞芳區', '平溪區', '雙溪區', '貢寮區', '新店區', '坪林區', '烏來區', '永和區', '中和區', '土城區', '三峽區', '樹林區', '鶯歌區', '三重區', '新莊區', '泰山區', '林口區', '蘆洲區', '五股區', '八里區', '淡水區', '三芝區', '石門區'];
$areasKEE = ['仁愛區', '信義區', '中正區', '中山區', '安樂區', '暖暖區', '七堵區'];

// phpinfo();

$sql = "INSERT INTO 
`area`
(`city_id`, `area`) 
VALUES 
(?,?)";

// $r = "SELECT * FROM shops";

// $stmt1 = $pdo->query($r)->fetchAll();
// print_r($stmt1);

$stmt = $pdo->prepare($sql);

// $stmt = $pdo->query($sql)->fetch();


for ($i = 0; $i < count($areasTPE); $i++) {
    $stmt->execute([
        1,
        $areasTPE[1],
    ]);
}

// for ($i = 0; $i < count($areasNTC); $i++) {
//     $stmt->execute([
//         2,
//         $areasNTC[$i],
//     ]);
// }

// for ($i = 0; $i < count($areasKEE); $i++) {
//     $stmt->execute([
//         3,
//         $areasKEE[$i],
//     ]);
// }

// echo $areasTPE[0];

