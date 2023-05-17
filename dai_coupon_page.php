<?php
include './connect_team3_db.php';
require './coupon_deadline_api.php';

if (!isset($_SESSION)) {
    session_start();
}

$perpage = 1;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header("Location: ?page=1");
    exit;
}


$total = $pdo->query("SELECT COUNT(*) FROM coupon")->fetch(PDO::FETCH_NUM)[0];
// if (isset($_POST['money'])) {
//     $sql = sprintf("SELECT * FROM coupon WHERE `coupon_discount` > %s ORDER BY `coupon_sid` ASC LIMIT %s,%s", $_POST['money'], ($page - 1) * $perpage, $perpage);
//     $sql2 = sprintf("SELECT COUNT(*) FROM coupon WHERE `coupon_discount` > %s ORDER BY `coupon_sid` ASC LIMIT %s,%s", $_POST['money'], ($page - 1) * $perpage, $perpage);
//     $row = $pdo->query($sql)->fetch();
//     $total = $pdo->query("sql2")->fetch(PDO::FETCH_NUM)[0];
// } else {
//     $sql = sprintf("SELECT * FROM coupon ORDER BY `coupon_sid` ASC LIMIT %s,%s", ($page - 1) * $perpage, $perpage);
//     $row = $pdo->query($sql)->fetch();
//     $total = $pdo->query("SELECT COUNT(*) FROM coupon")->fetch(PDO::FETCH_NUM)[0];
// }
//$total = isset($_SESSION['page']) ? intval($_SESSION['page']) : $pdo->query("SELECT COUNT(*) FROM coupon")->fetch(PDO::FETCH_NUM)[0];

$total_pages = ceil($total / $perpage);

if ($page > $total_pages) {
    header("Location: ?page={$total_pages}");
    exit;
}


// if ($total && isset($_SESSION['page'])) {

//     if (isset($_SESSION['money'])) {
//         $sql = sprintf("SELECT * FROM coupon WHERE `coupon_discount` > %s ORDER BY `coupon_sid` ASC LIMIT %s,%s", $_SESSION['money'], ($page - 1) * $perpage, $perpage);
//         $row = $pdo->query($sql)->fetch();
//     }
//     $sql = sprintf("SELECT * FROM coupon ORDER BY `coupon_sid` ASC LIMIT %s,%s", ($page - 1) * $perpage, $perpage);
//     $row = $pdo->query($sql)->fetch();
// }
if ($total) {

    $sql = sprintf("SELECT * FROM coupon ORDER BY `coupon_sid` ASC LIMIT %s,%s", ($page - 1) * $perpage, $perpage);
    $row = $pdo->query($sql)->fetch();
}

?>
<?php include "./backend_header.php" ?>
<style>
    .dai_coupon {
        width: 300px;
        height: 200px;
        border-radius: 20px;
        box-shadow: 0px 0px 0px 5px white inset;
        border: 5px solid slategray;
    }

    .dai_h2 {
        font-family: 'Noto Sans JP', sans-serif;
        letter-spacing: 5px;
        color: white;
        text-shadow: 0 0 5px goldenrod, 2px 2px 5px goldenrod, -2px -2px 5px goldenrod, 2px -2px 5px goldenrod, -2px 2px 5px goldenrod;
    }

    .dai_h3 {
        color: gray;
        font-size: 20px;
        padding: 0;
        margin: 0;
        text-align: justify;
    }

    .content_box {
        width: 80%;
        margin-top: 10px;
        background-color: rgba(255, 255, 255, 0.5);
        padding: 10px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }


    .empty_dai .pagination .page-item:hover .page-link {
        background-color: #FFFF93;
        color: orangered;
        border: 2px solid orangered;
        transform: scale(1.1);
    }

    .empty_dai .pagination .page-item .page-link {
        transition: 0.3s ease-in-out;
    }

    .empty_dai .pagination .page-item:hover .disabled {
        background-color: #999;
        color: black;
        border: 1px solid gray;
        transform: none;
    }


    .empty_dai2 .pagination .page-item:hover .page-link {
        background-color: lightskyblue;
        color: white;
        border: 2px solid gray;
    }

    .empty_dai2 .page-link.active {
        color: white;
    }

    .dai_icon {
        line-height: 100px;
        font-size: 20px;
    }

    #dai_editbtn {
        background-color: lightskyblue;
        border: none;
        transition: 0.3s ease-in-out;
        box-shadow: 2px 2px 5px gray;
    }

    #dai_editbtn:hover {
        transform: scale(1.1);
        border: 5px solid wheat;
    }

    #dai_deletebtn {
        background-color: lightcoral;
        border: none;
        transition: 0.3s ease-in-out;
        box-shadow: 2px 2px 5px gray;
    }

    #dai_deletebtn:hover {
        transform: scale(1.1);
        border: 5px solid wheat;
    }

    /* 跑馬燈 */

    @keyframes run_text {
        0% {
            margin-left: 500px;
        }

        100% {
            margin-left: -250px;
        }
    }

    .run_text1 {
        margin-left: 500px;
        animation: run_text linear infinite 8s;
        height: 24px;
        line-height: 24px;
        width: 250px;
    }

    .inputsearchmoney {
        border: none;
        border-radius: 15px;
        background-color: #FFFF93;
        padding: 5px 15px;
        width: 80px;
    }

    .inputsearchmoney:focus {
        border: 2px solid goldenrod;
    }
</style>

<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100 d-flex flex-column justify-content-center align-items-center"> <!--這個的class可以自己改掉，給你們看範圍的而已-->
        <div class="d-flex align-items-center justify-content-around empty_dai w-100" style="flex:auto;margin-top:100px">
            <div class="d-flex">
                <ul class="pagination me-3">
                    <li class="page-item d-flex align-items-center">
                        <a class="page-link <?= (1 == $page) ? 'disabled' : '' ?>" href="?page=1">
                            <i class="fa-solid fa-angles-left dai_icon"></i>
                        </a>
                    </li>
                </ul>
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link <?= (1 == $page) ? 'disabled' : '' ?>" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-angle-left dai_icon"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <?php $c = sprintf("rgb(%s,%s,%s)", rand(100, 255), rand(100, 255), rand(100, 255)); ?>
            <div>

                <div class="d-flex flex-column justify-content-center align-items-center dai_coupon position-relative" style="background-color:<?= $c ?>;">

                    <h2 class="dai_h2"><?= htmlentities($row['coupon_title']) ?></h2>
                    <a href="edit_coupon.php?coupon_sid=<?= $row['coupon_sid'] ?>" class="position-absolute top-0 end-0 m-3"><i class="fa-solid fa-pen-to-square text-secondary" style="text-shadow:0 0 5px white,0 0 5px white,0 0 5px white,0 0 5px white,0 0 5px white,0 0 5px white,0 0 5px white,0 0 5px white,0 0 5px white"></i></a>
                    <div class="content_box">
                        <p class="dai_h3"><?= htmlentities($row['coupon_content']) ?></p>
                    </div>
                    <p class="fw-bold mt-2 fs-6">折扣金額 <span class="text-danger bg-warning fw-bold">
                            <<?= $row['coupon_discount'] ?>>
                        </span>
                    </p>

                </div>
                <p class="fw-bold mt-4 text-center fs-2">使用期限：<span class="text-danger"><?= $row['coupon_deadline'] ?></span> 天</p>
            </div>
            <div class="d-flex">
                <ul class="pagination me-3">
                    <li class="page-item">
                        <a class="page-link <?= ($total_pages == $page) ? 'disabled' : '' ?>" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-angle-right dai_icon"></i>
                        </a>
                    </li>
                </ul>
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link <?= ($total_pages == $page) ? 'disabled' : '' ?>" href="?page=<?= $total_pages ?>">
                            <i class="fa-solid fa-angles-right dai_icon"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container d-flex justify-content-center mt-3 empty_dai2">
            <nav aria-label="Page navigation example">
                <ul class="pagination">

                    <?php for ($i = $page - 5; $i < $page + 5; $i++) : ?>
                        <?php if ($i >= 1 and $i <= $total_pages) : ?>
                            <li class="page-item"><a class="page-link <?= ($i == $page) ? 'active' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>

                </ul>
            </nav>
        </div>
        <div class="d-flex overflow-hidden align-items-center" style="width:400px;height:32px;background-color:aliceblue">
            <p class="text-info fs-6 run_text1 mb-0 d-flex" style="white-space:nowrap;">目前優惠券種類總共有<span class="fw-bold text-warning mx-2"><?= $total ?></span>種哦!</p>
        </div>
        <div class="mt-3">
            <button class="btn btn-primary fw-bold" id="dai_editbtn" onclick="location.href='edit_coupon.php?coupon_sid=<?= $row['coupon_sid'] ?>'">修改</button>
            <button class="btn btn-primary fw-bold ms-3" id="dai_deletebtn" onclick="location.href ='javascript: delete_coupon(<?= $row['coupon_sid'] ?>)'">刪除</button>
        </div>
        <div class="mt-3 d-flex align-items-center">
            <label for="money" class="fw-bold me-2 mb-0">搜尋優惠券金額</label>
            <input type="number" min="1" id="money" class="inputsearchmoney">
            <label class="fw-bold mb-0 ms-2">以上</label>
        </div>
    </div>

</div>

<?php include "./backend_footer.php" ?>

<script>
    coupon_title = '<?= $row['coupon_title'] ?>';

    function delete_coupon(couponsid) {
        if (confirm(`你確定要刪除 \"${coupon_title}\" 這張優惠券嗎？`)) {
            if (confirm(`要確定誒...想優惠券很累ㄝ`)) {
                location.href = 'delete_coupon.php?coupon_sid=' + couponsid;
            }
        }
    }

    const searchmoney = document.getElementById('money');

    searchmoney.addEventListener('change', () => {
        // console.log(searchmoney.value);

        //如果有值
        if (searchmoney.value) {

            const fd1 = new FormData();

            fd1.append('money', searchmoney.value);

            // console.log(fd1);

            fetch('./coupon_search_money.php', {
                    method: 'POST',
                    body: fd1 //可以省略Content-type  multipart form/data
                }).then(r => r.json())
                .then(obj => () => {
                    console.log(obj.money);
                })

            // fetch('./dai_coupon_page.php', {
            //     method: 'POST',
            //     body: fd1 //可以省略Content-type  multipart form/data
            // }).then(res => res.json()).then(res => console.log(res))

            //location.href = './dai_coupon_page.php';

        }
    })
</script>

<?php include "./backend_js_and_endtag.php" ?>