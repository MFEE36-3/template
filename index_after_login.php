<?php
if (!isset($_SESSION)) {
    session_start();
}
include './connect_team3_db.php';
require './coupon_deadline_api.php';


$perpage = 1;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header("Location: ?page=1");
    exit;
}


$total = $pdo->query("SELECT COUNT(*) FROM coupon")->fetch(PDO::FETCH_NUM)[0];

$total_pages = ceil($total / $perpage);

if ($page > $total_pages) {
    header("Location: ?page={$total_pages}");
    exit;
}


if ($total) {

    $sql = sprintf("SELECT * FROM coupon ORDER BY `coupon_sid` ASC LIMIT %s,%s", ($page - 1) * $perpage, $perpage);
    $row = $pdo->query($sql)->fetch();
}


$here_sid = $row['coupon_sid'];

$sql2 = "SELECT COUNT(*) as total,member_id,nickname,photo FROM coupon JOIN (SELECT * FROM user_coupon JOIN member_info ON user_coupon.member_id = member_info.sid) AS tbl3 ON tbl3.coupon_sid = coupon.coupon_sid WHERE coupon.coupon_sid = $here_sid GROUP BY member_id,nickname,photo";
// 小心Group by條件

$combine_user = $pdo->query($sql2)->fetchall();
$total_person = $pdo->query("SELECT COUNT(*) FROM coupon JOIN (SELECT * FROM user_coupon JOIN member_info ON user_coupon.member_id = member_info.sid) AS tbl3 ON tbl3.coupon_sid = coupon.coupon_sid WHERE coupon.coupon_sid = $here_sid GROUP BY member_id")->fetch(PDO::FETCH_NUM)[0];


if (!empty($_GET['money'])) {

    $money = $_GET['money'];

    $sql3 = "SELECT * FROM coupon WHERE coupon_discount >= $money ORDER BY `coupon_sid` ASC";
    $fit_money = $pdo->query($sql3)->fetchAll();
    $fit_num = $pdo->query("SELECT COUNT(*) FROM coupon WHERE coupon_discount >= $money ORDER BY `coupon_sid` ASC")->fetch(PDO::FETCH_NUM)[0];
}

$sql4 = "SELECT * FROM coupon ORDER BY `coupon_sid` ASC";
$find_page = $pdo->query($sql4)->fetchAll();


?>
<?php include "./backend_header.php" ?>
<style>
    .move_word {
        font-family: 'Source Code Pro', monospace;
        font-size: 50px;
        animation: wave_up linear infinite 2s;
    }

    @keyframes wave_up {
        0% {
            rotate: 0;
        }

        25% {
            rotate: 10deg;
        }

        50% {
            rotate: 0;
        }

        75% {
            rotate: -10deg;
        }

        100% {
            rotate: 0;
        }
    }

    .move_name {
        animation: fly_name linear 2s;
    }

    @keyframes fly_name {
        0% {
            opacity: 0;
            transform: translateX(500px);
        }

        50% {
            opacity: 1;
            transform: translateX(-50px);
        }

        75% {
            transform: translateX(20px);
        }

        100% {
            transform: translateX(0);
        }
    }

    .show_pic {
        animation: show_up linear 2s;
    }

    @keyframes show_up {
        0% {
            opacity: 0;
            transform: scale(1.7);
        }

        100% {
            opacity: 1;
            transform: scale(1.0);
        }
    }
</style>

<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100 d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex flex-column align-items-center justify-content-around empty_dai w-100" style="flex:auto;margin-top:100px">
            <div class="d-flex justify-content-center align-items-center overflow-hidden show_pic" style="height:350px;width:350px;border-radius:50%;border:15px solid gold">
                <img src="./images/<?= $_SESSION['admin_member']['photo'] ?>" alt="<?= $_SESSION['admin_member']['name'] ?>" class="w-100" style="">
            </div>
            <div class="d-flex align-items-center justify-content-center mt-3">
                <span class="move_word text-danger">W</span>
                <span class="move_word text-success">E</span>
                <span class="move_word text-warning">L</span>
                <span class="move_word text-danger">C</span>
                <span class="move_word text-info">O</span>
                <span class="move_word text-success">M</span>
                <span class="move_word text-info">E</span>
                <span class="move_word ms-3 text-success">B</span>
                <span class="move_word text-danger">A</span>
                <span class="move_word text-warning">C</span>
                <span class="move_word text-info">K</span>
                <span class="move_word text-warning">!</span>
                <span class="ms-5 move_name" style="font-family: 'Noto Sans JP', sans-serif;font-size:40px"><?= $_SESSION['admin_member']['name'] ?></span>
            </div>

        </div>
    </div>

</div>

<?php include "./backend_footer.php" ?>

<script>

</script>

<?php include "./backend_js_and_endtag.php" ?>