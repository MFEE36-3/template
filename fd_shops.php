<?php 
require './connect_team3_db.php';

$cities = ["臺北市", "新北市", "桃園市"];

$word = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",];

$account = ['Jack', 'Norm', 'Cindy', 'Bob', 'Zack', 'Lance', 'Aaron', 'Melvin', 'Josh'];

$adj = ["超好吃", "陳記", "王記", "John's", "美味", "very good", "阿金的", "古早味"];

$n = ["漢堡", "美式餐廳", "牛肉麵", "滷味", "脆皮炸雞", "甜點店", "便當店", "快餐店", "義大利麵", "披薩", "珍珠奶茶"];

$lasts = ["何", "傅", "劉", "吳", "呂", "周", "唐", "孫", "宋", "張", "彭", "徐", "於", "曹", "曾", "朱", "李", "林", "梁", "楊", "沈", "王", "程", "羅", "胡", "董", "蕭", "袁", "許", "謝", "趙", "郭", "鄧", "鄭", "陳", "韓", "馬", "馮", "高", "黃"];

$firsts = ["冠廷", "冠宇", "宗翰", "家豪", "彥廷", "承翰", "柏翰", "宇軒", "家瑋", "冠霖", "雅婷", "雅筑", "怡君", "佳穎", "怡萱", "宜庭", "郁婷", "怡婷", "詩涵", "鈺婷"];

$category = ['韓式', '日式', '台式', '義式', '美式', '印式'];

$food_category = ['前菜', '主菜', '飲料', '甜點', '外帶', '素食',];

// phpinfo();
// exit;

$sql = "INSERT INTO 
`shops`(`account`, `password`, `shop`, `owner`, `category`, 
`photo`, `city`, `area`, `location`, `res_category`, 
`phone`, `email`, `uniform_number`, `company_number`, 
`open_time`, `food_categories`) 
VALUES (?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, 
    ?, ?
)";

$stmt = $pdo->prepare($sql);

for ($i = 1; $i <= 100; $i++) {
    shuffle($adj);
    shuffle($n);
    shuffle($account);
    shuffle($word);
    shuffle($lasts);
    shuffle($firsts);
    shuffle($category);
    shuffle($food_category);
    
    $account1 = $account[0] . rand(1000, 9999);
    $password1 = password_hash("123456", PASSWORD_BCRYPT);
    $shop1 = $adj[0] . $n[0];
    $owner1 = $lasts[0] . $firsts[0];
    $category1 = $category[0];
    $photo1 = '';
    $city1 = rand(1, 3);
    $area1 = rand(1, 13);
    $location1 = 'ctlorem10';
    $res_category1 = rand(0, 1);
    $phone1 = '0918' . rand(100000, 999999);
    $email1 = $word[0] . $word[1] . $word[2] . $word[3] . $word[4] . $word[5] . '@mail.com';
    $uniform1 = rand(10000000, 99999999);
    $company_number1 = rand(10000000, 99999999);
    $open_time1 = rand(0, 11) . ':00-' . rand(12, 24) . ':00';
    $food_category1 = $food_category[0] . '、' . $food_category[1] . '、' . $food_category[2];
    
    $stmt->execute(
        [
            $account1,
            $password1,
            $shop1,
            $owner1,
            $category1,
            $photo1,
            $city1,
            $area1,
            $location1,
            $res_category1,
            $phone1,
            $email1,
            $uniform1,
            $company_number1,
            $open_time1,
            $food_category1,
            
            ]
            
        );
    }

?>