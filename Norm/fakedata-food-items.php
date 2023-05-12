<?php

require './connect-db.php';

$food = ["飯糰", "壽司", "烤雞", "吐司", "豬肉火鍋", "牛肉咖哩", "紅醬義大利麵", "油條", "蝦捲", "牛肉湯", "珍珠奶茶", "紅茶拿鐵", "鐵觀音", "排骨便當", "超級夏威夷", "美味蟹堡", "宇宙大燒賣", "波蘿麵包", "野菜手卷", "水煮雞胸肉", "玉米濃湯", "雙層劉肉起司堡", "早餐店大冰奶", "彗星炒飯",];

$sql = "INSERT INTO 
`food-items`(
`shop_id`, `food_img`, `food_title`, 
`food_des`, `food_price`, `food_note`) 
VALUES (
    ?, ?, ?, 
    ?, ?, ?
)";

$stmt = $pdo->prepare($sql);

for ($i = 1; $i <= 100; $i++) {
    shuffle($food);

    $price = rand(5, 30) * 10;

    $shop1 = rand(1, 100);
    $food_img1 = '';
    $food_title1 = $food[0];
    $food_des1 = '待填';
    $food_price1 = $price;
    $food_note1 = '待填';

    $stmt->execute([
        $shop1,
        $food_img1,
        $food_title1,
        $food_des1,
        $food_price1,
        $food_note1,
    ]);
};
