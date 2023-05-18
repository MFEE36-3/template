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
// $rows = [];


// $sql2 = "SELECT COUNT(1) FROM booking join shops on booking.shop_id=shops.sid where id like '%$sid%'"; 
// $rows2 = $pdo->query($sql2)->fetch(PDO::FETCH_NUM)[0]; 

// $sql3 = "SELECT * FROM booking JOIN member_info on booking.id = member_info.sid";

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

        $sql = "SELECT * FROM booking join shops on booking.shop_id=shops.sid where id=$sid ORDER BY booking_date $sort";
        // $sql = "SELECT member_info.photo AS member_pic,* from member_info JOIN(SELECT * FROM booking join shops on booking.shop_id=shops.sid) AS a ON member_info.sid = a.id where id=$sid ORDER BY booking_date ASC";
        $sql2 = "SELECT COUNT(1) FROM booking join shops on booking.shop_id=shops.sid where id=$sid";
    } else if (isset($_GET['select_shop']) && $_GET['select_shop'] !== "") {
        $shop = $_GET['select_shop'];

        $sql = "SELECT * FROM booking join shops on booking.shop_id=shops.sid where shop like '%$shop%'";
        $sql2 = "SELECT COUNT(1) FROM booking join shops on booking.shop_id=shops.sid where shop like '%$shop%'";
    } else {
        $sql = sprintf("SELECT * FROM BOOKING join shops on booking.shop_id=shops.sid ORDER BY booking_date $sort LIMIT %s,%s", ($page - 1) * $perPage, $perPage);
        $sql2 = "SELECT COUNT(1) FROM booking join shops on booking.shop_id=shops.sid";
    }

    $rows = $pdo->query($sql)->fetchAll();
    $rows2 = $pdo->query($sql2)->fetch(PDO::FETCH_NUM)[0];

    $sql_mem = "SELECT * FROM member_info";
    $row_mem = $pdo->query($sql_mem)->fetchAll();


    if (isset($_GET['select_member']) && $_GET['select_member'] !== "") {

        foreach ($row_mem as $rm) {
            if ($_GET['select_member'] == $rm['sid']) {
                $rm_photo = $rm['photo'];
                $rm_name = $rm['name'];
                $rm_nickname = $rm['nickname'];
                $rm_mobile = $rm['mobile'];
                $rm_birth = $rm['birthday'];
            }
        }
    }
}


?>
<style>
    .point:hover {
        cursor: pointer;
    }

    .show_pic {
        animation: show_up linear 1s;
    }

    @keyframes show_up {
        0% {
            opacity: 0;
            transform: scale(0.5);
        }

        100% {
            opacity: 1;
            transform: scale(1.0);
        }
    }
</style>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container w-100" style="flex:auto">
        <div class="row">
            <nav aria-label="Page navigation example">
                <div class="select_bar">
                    <ul class="pagination me-auto" style="display:<?= !empty($_GET['select_member']) || !empty($_GET['select_shop']) ? 'none' : '' ?>">
                        <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=1" style="font-size:18px;"><i class="fa-solid fa-angles-left"></i></a>
                        </li>
                        <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" style="font-size:18px;"><i class="fa-solid fa-angle-left"></i></a>
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
                            <a class="page-link" href="?page=<?= $page + 1 ?>" style="font-size:18px;"><i class="fa-solid fa-angle-right"></i></a>
                        </li>
                        <li class="page-item <?= $total_page == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $total_page ?>" style="font-size:18px;"><i class="fa-solid fa-angles-right"></i></a>
                        </li>
                    </ul>

                    <input type="text" class="search_bymember" id="search_bymember" placeholder="輸入會員編號" value="<?= isset($_GET['select_member']) ? $_GET['select_member'] : "" ?>">

                    <input type="text" class="search_byshop" id="search_byshop" placeholder="輸入餐廳名稱" value="<?= isset($_GET['select_shop']) ? $_GET['select_shop'] : "" ?>">
                </div>
            </nav>
        </div>



        <div class="info-m w-100 mb-m" style="display:<?= !empty($_GET['select_member']) ? '' : 'none' ?>">
            <div class="picfor-m mb-m show_pic">
                <div class="pic-m" style="margin-right: 50px;">
                    <img src="./images/<?= $rm_photo ?>" style="object-fit:cover; width:100%;">
                </div>
                <div class="p-info-m">
                    <div class="p-infodeatil-m info-name">
                        姓名 / &nbsp;&nbsp;<?= $rm_name ?>
                    </div>
                    <div class="p-infodeatil-m info-nickname">
                        暱稱 / &nbsp;&nbsp;<?= $rm_nickname ?>
                    </div>
                    <div class="p-infodeatil-m info-mobile">
                        手機 / &nbsp;&nbsp;<?= $rm_mobile ?>
                    </div>
                    <div class="p-infodeatil-m info-birthday">
                        生日 / &nbsp;&nbsp;<?= $rm_birth  ?>
                    </div>
                </div>
            </div>
            <!-- <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">姓名</th>
                        <th scope="col">暱稱</th>
                        <th scope="col">手機</th>
                        <th scope="col">生日</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>?= $rm_name ?></td>
                        <td>?= $rm_nickname ?></td>
                        <td>?= $rm_mobile ?></td>
                        <td>?= $rm_birth  ?></td>
                    </tr>
                </tbody>
            </table> -->
        </div>


        <div class="result-m">資料筆數:<?= $rows2 ?></div>

        <div class="row m-row">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;"><i class="fa-solid fa-trash-can"></i></th>
                        <th scope="col">訂位編號</th>
                        <th scope="col">會員編號</th>
                        <th scope="col">餐廳編號</th>
                        <th scope="col">餐廳名稱</th>
                        <th scope="col">訂位日期<a href="?select_member=<?= !empty($sid) ? $sid : '' ?>&sort=<?= $sort == 'ASC' ? 'DESC' : 'ASC' ?>&page=<?= $page ?>" id="sortdate"><i class="fa-solid fa-sort"></i></a></th>
                        <th scope="col">訂位時間</th>
                        <th scope="col">用餐人數</th>
                        <th scope="col">桌型</th>
                        <th scope="col">建立時間</th>
                        <th scope="col" style="text-align: center;"><i class="fa-solid fa-pen-to-square"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <!-- <th scope="col"><a href="javascript: delete_it(?= $r['booking_id'] ?>)"> -->
                            <th scope="col" style="text-align: center;"><a>
                                    <i class="fa-solid fa-trash-can delete-m point" style="color:#F05E1C;" onclick="delete_it(<?= $r['booking_id'] ?>);"></i></a></th>
                            <td><?= $r['booking_id'] ?></td>
                            <td><?= $r['id'] ?></td>
                            <td><?= $r['shop_id'] ?></td>
                            <td><?= $r['shop'] ?></td>
                            <td><?= $r['booking_date'] ?></td>
                            <td><?= $r['booking_time'] ?></td>
                            <td><?= $r['booking_number'] ?></td>
                            <td><?= $r['table'] ?></td>
                            <td><?= $r['create_at'] ?></td>
                            <th style="text-align: center;"><a href="edit-m.php?booking_id=<?= $r['booking_id'] ?>"><i class="fa-solid fa-pen-to-square" style="color:#F05E1C"></i></a></th>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


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

    // const delete_m = document.querySelectorAll('.delete-m');
    // delete_m[0].addEventListener('click', (event) => {

    //     let mm = event.target.id;
    //     console.log(mm);
    //     location.href = 'delete-m.php?booking_id=' + mm;
    // })


    // Swal.fire({
    //     title: 'Are you sure?',
    //     text: "You won't be able to revert this!",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes, delete it!'
    // }).then((result) => {
    //     if (result.isConfirmed) {
    //         Swal.fire(
    //             'Deleted!',
    //             'Your file has been deleted.',
    //             'success'

    //         )
    //         // fetch(`delete-m.php?booking_id=${mm}`, {
    //         //         method: 'POST',
    //         //         // Content-Type 省略, multipart/form-data
    //         //     }).then(r => r.json())
    //         //     .then(obj => {
    //         //         console.log(obj);
    //         //     })
    //         //location.href = `./booking.php?page=${page}`;
    //     }
    // })


    function delete_it(booking_id) {

        Swal.fire({
            title: '確定刪除?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                location.href = 'delete-m.php?booking_id=' + booking_id;
            }

        })
    }
    // if (confirm(`是否要刪除訂單編號: ${booking_id} 的資料?`)) {
    //     location.href = 'delete-m.php?booking_id=' + booking_id;
    // }
</script>
<?php include "./backend_footer.php" ?>