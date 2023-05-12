<?php

    require './michael/connect-db.php';

    $perPage = 3; #每頁幾筆
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
    $total_page = ceil($total_rows/$perPage); 
    $rows=[];
    // echo $total_page;
    // exit;

    if($total_rows){
        if($page > $total_page){
            header("Location: ?page=$total_page");
            exit;
        }
        // if ($page > $totalPages) {
        //     header("Location: ?page=$totalPages");
        //     exit;
        // }
        $sql = sprintf("SELECT * FROM BOOKING join shops on booking.shop_id=shops.sid LIMIT %s,%s",($page-1)*$perPage,$perPage);
        $rows = $pdo->query($sql)->fetchAll();     
  
    }
  
?>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container w-100" style="height: 100px;"> 
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1"><i class="fa-solid fa-angles-left"></i></a>
                     </li>
                     <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page-1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                     </li>
                    <?php for($i=$page-5;$i<=$page+5;$i++) : 
                        if($i >= 1 and $i <= $total_page) :
                        ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endif;
                    endfor ;?>
                    <li class="page-item <?= $total_page == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page+1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                    </li>
                    <li class="page-item <?= $total_page == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $total_page ?>"><i class="fa-solid fa-angles-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>


        <div class="row">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                            <th scope="col">訂位編號</th>
                            <th scope="col">會員編號</th>
                            <th scope="col">餐廳編號</th>
                            <th scope="col">餐廳名稱</th>
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
                                <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                                <td><?= $r['booking_id'] ?></td>
                                <td><?= $r['Id'] ?></td>
                                <td><?= $r['shop_id'] ?></td>
                                <td><?= $r['shop'] ?></td>
                                <td><?= $r['booking_date'] ?></td>
                                <td><?= $r['booking_time'] ?></td>
                                <td><?= $r['booking_number'] ?></td>
                                <td><?= $r['table'] ?></td> 
                                <td><?= $r['create_at'] ?></td>
                                <td><i class="fa-solid fa-pen-to-square"></i></td>
                                
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

</script>
<?php include "./backend_footer.php" ?>
