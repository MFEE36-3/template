<?php

require './connect_team3_db.php';

$perPage = 10; #每頁幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; # 用戶要看第幾頁

if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM BOOKING";
# $t_row = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM);
# echo json_encode($t_row);
# exit;

$total_rows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; #總筆數
$total_page = ceil($total_rows / $perPage);
$rows = [];

// $sql2 = "SELECT COUNT(1) FROM booking join shops on booking.shop_id=shops.sid where id like '%$sid%'"; 
// $rows2 = $pdo->query($sql2)->fetch(PDO::FETCH_NUM)[0]; 

if ($total_rows) {

    if ($page > $total_page) {
        header("Location: ?page=$total_page");
        exit;
    }

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    } else {
        $sort = 'ASC';
    }

    if (isset($_GET['select_member']) && $_GET['select_member'] !== "") {
        $sid = $_GET['select_member'];

        $sql = "SELECT * FROM booking join shops on booking.shop_id=shops.sid where id like '%$sid%' ORDER BY booking_date ASC";
    } else if (isset($_GET['select_shop']) && $_GET['select_shop'] !== "") {
        $shop = $_GET['select_shop'];

        $sql = "SELECT * FROM booking join shops on booking.shop_id=shops.sid where shop like '%$shop%'";
    } else {
        $sql = sprintf("SELECT * FROM BOOKING join shops on booking.shop_id=shops.sid LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
    }

    $rows = $pdo->query($sql)->fetchAll();
}
// sort語法問題
// 取得資料筆數
?>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container w-100" style="flex:auto">
        <div class="row">
            <nav aria-label="Page navigation example">

                <div class="select_bar">

                    <ul class="pagination me-auto" style="display:<?= isset($_GET['select_member']) || isset($_GET['select_shop']) ? 'none' : '' ?>">
                        <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=1"><i class="fa-solid fa-angles-left"></i></a>
                        </li>
                        <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                        </li>
                        <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $total_page) :
                        ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                        <?php endif;
                        endfor; ?>
                        <li class="page-item <?= $total_page == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                        </li>
                        <li class="page-item <?= $total_page == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $total_page ?>"><i class="fa-solid fa-angles-right"></i></a>
                        </li>
                    </ul>

                    <input type="text" class="search_bymember" id="search_bymember" placeholder="輸入會員編號" value="<?= isset($_GET['select_member']) ? $_GET['select_member'] : "" ?>">

                    <input type="text" class="search_byshop" id="search_byshop" placeholder="輸入餐廳名稱" value="<?= isset($_GET['select_shop']) ? $_GET['select_shop'] : "" ?>">

                </div>
            </nav>
        </div>

        <div class="row m-row">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                        <th scope="col">訂位編號</th>
                        <th scope="col">會員編號</th>
                        <th scope="col">餐廳編號</th>
                        <th scope="col">餐廳名稱</th>
                        <th scope="col">訂位日期<a href="?page=<?= $page ?>&sort=<?= $sort == 'ASC' ? 'ASC' : 'DESC' ?>" id="sortdate"><i class="fa-solid fa-sort"></i></a></th>
                        <th scope="col">訂位時間</th>
                        <th scope="col">用餐人數</th>
                        <th scope="col">桌型</th>
                        <th scope="col">建立時間</th>
                        <th scope="col"><i class="fa-solid fa-pen-to-square"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <th scope="col"><a href="javascript: delete_it(<?= $r['booking_id'] ?>)">
                                    <i class="fa-solid fa-trash-can"></i></a></th>
                            <td><?= $r['booking_id'] ?></td>
                            <td><?= $r['id'] ?></td>
                            <td><?= $r['shop_id'] ?></td>
                            <td><?= $r['shop'] ?></td>
                            <td><?= $r['booking_date'] ?></td>
                            <td><?= $r['booking_time'] ?></td>
                            <td><?= $r['booking_number'] ?></td>
                            <td><?= $r['table'] ?></td>
                            <td><?= $r['create_at'] ?></td>
                            <td><a href="edit-m.php?booking_id=<?= $r['booking_id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <span id="msg-box"></span>
    </div>
</div>

<?php include "./backend_js_and_endtag.php" ?>
<script>
    document.querySelector('li.page-item.active a').removeAttribute('href');

    const search_bymember = document.querySelector('#search_bymember');
    const search_byshop = document.querySelector('#search_byshop');
    search_bymember.addEventListener('change', () => {
        let m_value = search_bymember.value;
        console.log(m_value);
        location.href = "booking.php?select_member=" + m_value;
    })

    search_byshop.addEventListener('change', () => {
        let s_value = search_byshop.value;
        console.log(s_value);
        location.href = "booking.php?select_shop=" + s_value;
    })



    function delete_it(booking_id) {
        if (confirm(`是否要刪除訂單編號: ${booking_id} 的資料?`)) {
            location.href = 'delete-m.php?booking_id=' + booking_id;
        }

    }
</script>
<?php include "./backend_footer.php" ?>