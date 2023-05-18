<?php
require './connect_team3_db.php';

$perPage = 10; # 每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; # 用戶要看第幾頁
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : '';

// $_GET = [
//     'page' => '1',
//     'sort' => 'DESC'
// ];

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'ASC';
}

if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM member_info";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; # 總筆數
$totalPages = ceil($totalRows / $perPage); # 總頁數
$rows = [];

if ($totalRows) {
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }

    if (isset($_GET['sid']) && $_GET['sid'] !== "") {
        //$sql = sprintf("SELECT * FROM member_info WHERE sid LIKE $sid ORDER BY `sid` $sort LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
        $sql = "SELECT `member_info`.*,`member_level`.name AS lname FROM `member_info` JOIN `member_level` ON `member_info`.`level` = `member_level`.`sid` WHERE member_info.sid LIKE '%$sid%' ORDER BY sid $sort";
    } else {
        $sql = sprintf("SELECT `member_info`.*,`member_level`.name AS lname FROM `member_info` JOIN `member_level` ON `member_info`.`level` = `member_level`.`sid` ORDER BY member_info.sid $sort LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    }

    $rows = $pdo->query($sql)->fetchAll();
}
?>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 h-100 p-3 mb-auto" style="margin-bottom: 15px;">
    <div class="m-3"> <!--這個的class可以自己改掉，給你們看範圍的而已-->
        <div class="row mt-4 d-flex" style="flex:auto;">
            <nav aria-label="Page navigation example" style="display:flex; justify-content:space-between; align-items:center;">
                <ul class="pagination" style="width: 380px">
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1&sort=<?= $sort ?>">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>&sort=<?= $sort ?>">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>
                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&sort=<?= $sort ?><?= isset($sid) && $sid != "" ? "&sid=$sid" : null ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>
                    <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>&sort=<?= $sort ?>">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>&sort=<?= $sort ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                </ul>
                <div class="d-flex" style="align-items:center">
                    <div style="margin-right:35px;" class="mb-3">
                        <input type="search" id="inp" placeholder="     輸入編號查詢" style="height:38px; background-color:#c5e0f6; width:170px" class="p-3 mb-2 rounded" value="<?= isset($sid) && $sid != "" ? "$sid" : "" ?>">
                    </div>
                    <button class="rounded p-2  mb-4" style="height:40px; width:85px; background-color:#D6D6FF; font-size:16px; font-weight:bold" onclick="window.location.href='./member_add.php'" onmouseover="this.style.backgroundColor='#9999FF';this.style.color='white'" onmouseout="this.style.backgroundColor='#D6D6FF';this.style.color='black'">新增會員</button>
                </div>
            </nav>
        </div>
        <div class="row">
            <table class="table table-bordered table-striped order-table" id="myTable">
                <thead style="background-color: #c9b69c;">
                    <tr>
                        <th style="text-align: center;" scope="col">編號<a href="?page=<?= $page ?>&sort=<?= $sort == 'ASC' ? 'DESC' : 'ASC' ?><?= isset($sid) && $sid != "" ? "&sid=$sid" : "" ?>" id="sortIcon"><i class="fa-solid fa-retweet"></i></a></th>
                        <th style="text-align: center;" scope="col">大頭照</th>
                        <th style="text-align: center;" scope="col">帳號(email)</th>
                        <th style="text-align: center;" scope="col">會員姓名</th>
                        <th style="text-align: center;" scope="col">論壇暱稱</th>
                        <th style="text-align: center;" scope="col">手機號碼</th>
                        <th style="text-align: center;" scope="col">生日</th>
                        <th style="text-align: center;" scope="col">會員等級</th>
                        <th style="text-align: center;" scope="col">錢包餘額</th>
                        <th style="text-align: center;" scope="col">編輯資料</th>
                        <th style="text-align: center;" scope="col">刪除會員</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td style="text-align: center;"><?= $r['sid'] ?></td>
                            <td style="text-align: center;"><img src="./images/<?= $r['photo'] ?>" alt=""></td>
                            <td style="text-align: center;"><?= $r['account'] ?></td>
                            <td style="text-align: center;"><?= $r['name'] ?></td>
                            <td style="text-align: center;"><?= $r['nickname'] ?></td>
                            <td style="text-align: center;"><?= $r['mobile'] ?></td>
                            <td style="text-align: center;"><?= $r['birthday'] ?></td>
                            <td style="text-align: center;"><?= $r['lname'] ?></td>
                            <td style="text-align: center;"><?= $r['wallet'] ?></td>
                            <td style="text-align: center;"><a href="member_update.php?sid=<?= $r['sid'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td style="text-align: center;"><a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

    <script>
        let sortIcon = document.getElementById("sortIcon");
        sortIcon.addEventListener("click", function() {
            window.location('member_info.php?page=<?= $page ?>&sort=<?= $sort ?>')
        });

        document.querySelector('li.page-item.active a').removeAttribute('href');

        function delete_it(sid) {
            if (confirm(`確定要刪除${sid}號會員的資料?`)) {
                location.href = 'member_delete_api.php?sid=' + sid;
            }
        };

        let inp = document.querySelector("#inp");
        inp.addEventListener('change', function() {
            let inpVal = inp.value;
            if (inpVal === "") {
                location.href = 'member_info.php';
            } else {
                location.href = 'member_info.php?sid=' + inpVal;
            }
            // fetch('member_info.php?sid=' + inpVal).then(r => r.json()).then(obj => {
            //     console.log(obj);
            // })
            //todo 後端 根據你傳過來的數字去資料庫讀資料
            //todo 回傳資料到前端
            //todo 確定前端有收到資料
            //todo 更新資料到tbody中
        });
    </script>
</div>
<?php include "./backend_footer.php" ?>
<?php include "./backend_js_and_endtag.php" ?>