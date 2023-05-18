<pre>

<style>
   
    .table td {
        max-width: 200px; /* 設定欄寬上限 */
        white-space: nowrap; /* 避免文字換行 */
        overflow: hidden; /* 隱藏多餘的文字 */
        text-overflow: ellipsis; /* 使用省略號表示被隱藏的文字 */
        height: 65px;
    }
    .demo{
        opacity: 0.3;
    }

    .demo:hover{
        opacity: 1;
    }
  
</style>
</style>
<?php
require './connect_team3_db.php';

$sql = "SELECT * FROM article";

$rows = $pdo->query($sql)->fetchAll();
// print_r($stmt);
// exit;

$perPage = 10; # 每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; # 用戶要看第幾頁

if ($page < 1) {
    header('Location: ?page=1');
    exit;
}
$t_sql = "SELECT COUNT(*) FROM `article` as a join shop_type as b on a.category =b.sid left join member_info as c on a.user_id=c.sid left join (select COUNT(user_id) as nlike,article_id from `like` GROUP by article_id) as d on a.article_sid=d.article_id;";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; # 總筆數
$totalPages = ceil($totalRows / $perPage); # 總頁數


if ($totalRows) {
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }
    $sql = sprintf("SELECT a.*,b.type,c.nickname,nlike FROM `article` as a join shop_type as b on a.category =b.sid left join member_info as c on a.user_id=c.sid left join (select COUNT(user_id) as nlike,article_id from `like` GROUP by article_id) as d on a.article_sid=d.article_id LIMIT %s, %s", ($page - 1) * $perPage, $perPage);



    $rows = $pdo->query($sql)->fetchAll();
}







?></pre>

<?php



?>




<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100" text-wrap> <!--這個的class可以自己改掉，給你們看範圍的而已-->

        <div class="container">

            <div class="row">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item  <?= 1 == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=1">
                                <i class="fa-solid fa-angles-left" style="font-size:18px"></i>
                            </a>
                        </li>
                        <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">
                                <i class="fa-solid fa-angle-left" style="font-size:18px"></i>
                            </a>
                        </li>
                        <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $totalPages) :
                        ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                        <?php endif;
                        endfor; ?>
                        <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">
                                <i class="fa-solid fa-angle-right" style="font-size:18px"></i>
                            </a>
                        </li>
                        <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $totalPages ?>">
                                <i class="fa-solid fa-angles-right" style="font-size:18px"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- 搜尋：<input type="search" class="light-table-filter" data-table="order-table" placeholder="請輸入關鍵字"> -->

            <table class="table table-bordered table-striped order-table" id="table">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                        <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
                        <th scope="col">文章編號</th>
                        <th scope="col" data-sortable="true">建立時間</th>
                        <th scope="col">類別</th>
                        <th scope="col">會員暱稱</th>
                        <th scope="col">標題</th>
                        <th scope="col">文章內容</th>
                        <th scope="col">讚數</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><a href="javascript: delete_it(<?= $r['article_sid'] ?>)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a></td>
                            <td><a href="edit.php?article_sid=<?= $r['article_sid'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td><?= $r['article_sid'] ?></td>
                            <td><?= $r['publishedTime'] ?></td>
                            <td><?= $r['type'] ?></td>
                            <td><?= $r['nickname'] ?></td>
                            <td><?= $r['header'] ?></td>
                            <td><?= $r['content'] ?></td>
                            <td><?= $r['nlike'] ?></td>

                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include "./backend_footer.php" ?>




<script>
    (function(document) {
        'use strict';

        // 建立 LightTableFilter
        var LightTableFilter = (function(Arr) {

            var _input;

            // 資料輸入事件處理函數
            function _onInputEvent(e) {
                _input = e.target;
                var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                Arr.forEach.call(tables, function(table) {
                    Arr.forEach.call(table.tBodies, function(tbody) {
                        Arr.forEach.call(tbody.rows, _filter);
                    });
                });
            }

            // 資料篩選函數，顯示包含關鍵字的列，其餘隱藏
            function _filter(row) {
                var text = row.textContent.toLowerCase(),
                    val = _input.value.toLowerCase();
                row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
            }

            return {
                // 初始化函數
                init: function() {
                    var inputs = document.getElementsByClassName('light-table-filter');
                    Arr.forEach.call(inputs, function(input) {
                        input.oninput = _onInputEvent;
                    });
                }
            };
        })(Array.prototype);

        // 網頁載入完成後，啟動 LightTableFilter
        document.addEventListener('readystatechange', function() {
            if (document.readyState === 'complete') {
                LightTableFilter.init();
            }
        });

    })(document);
</script>



<script>
    function delete_it(article_sid) {
        if (confirm(`是否要刪除編號為 ${article_sid} 的資料?`)) {
            location.href = 'delete.php?sid=' + article_sid;
        }

    }

    $(function() {
        $('#table').bootstrapTable()
    })
</script>
<?php include "./backend_js_and_endtag.php" ?>