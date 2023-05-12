<?php
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
</style>

<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100 d-flex flex-column justify-content-center align-items-center "> <!--這個的class可以自己改掉，給你們看範圍的而已-->
        <div class="d-flex align-items-center justify-content-around empty_dai w-100" style="height:500px;">
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
                <div class="d-flex flex-column justify-content-center align-items-center dai_coupon" style="background-color:<?= $c ?>;">

                    <h2 class="dai_h2"><?= $row['coupon_title'] ?></h2>
                    <div class="content_box">
                        <p class="dai_h3"><?= $row['coupon_content'] ?></p>
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
    </div>
</div>

<?php include "./backend_footer.php" ?>
<?php include "./backend_js_and_endtag.php" ?>