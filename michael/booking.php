<?php

    require 'connect-db.php';

    $perPage = 3; #每頁幾筆
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; # 用戶要看第幾頁

    // if ($page < 1) {
    // header('Location: ?page=1');
    // exit;
    // }

    $sql = "SELECT * FROM BOOKING LIMIT 0,$perPage";
    $rows = $pdo->query($sql)->fetchAll();

?>

<?php include "../backend_header.php" ?>
<?php include "../backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid bg-info w-100" style="height: 100px;"> <!--這個的class可以自己改掉，給你們看範圍的而已-->



    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">訂位編號</th>
                    <th scope="col">會員編號</th>
                    <th scope="col">餐廳編號</th>
                    <th scope="col">訂位日期</th>
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

                        <td><?= $r['booking_id'] ?></td>
                        <td><?= $r['Id'] ?></td>
                        <td><?= $r['shop_id'] ?></td>
                        <td><?= $r['booking_date'] ?></td>
                        <td><?= $r['booking_time'] ?></td>
                        <td><?= $r['booking_number'] ?></td>
                        <td><?= $r['table'] ?></td>
                        <td><?= $r['create_at'] ?></td>
                        <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>
    </div>
</div>


<?php include "../backend_footer.php" ?>
<?php include "../backend_js_and_endtag.php" ?>