<pre>

<style>
.textover {
    max-width: 150px; /* Adjust the value as per your preference */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

</style>
<?php
require './connectwei-db.php';

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
$t_sql = "SELECT COUNT(1) FROM article";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; # 總筆數
$totalPages = ceil($totalRows / $perPage); # 總頁數
$rows = [];

if ($totalRows) {
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }
    $sql = sprintf("SELECT * FROM article  LIMIT %s, %s", ($page - 1) * $perPage, $perPage);


    $rows = $pdo->query($sql)->fetchAll();
}




?></pre>

<?php



?>




<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100 overflow-scroll" text-wrap> <!--這個的class可以自己改掉，給你們看範圍的而已-->

        <div class="container">

            <div class="row">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item  <?= 1 == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=1">
                                <i class="fa-solid fa-angles-left"></i>
                            </a>
                        </li>
                        <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">
                                <i class="fa-solid fa-angle-left"></i>
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
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </li>
                        <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $totalPages ?>">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            搜尋：<input type="search" class="light-table-filter" data-table="order-table" placeholder="請輸入關鍵字">
            <table class="table table-bordered table-striped order-table ">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                        <th scope="col">文章編號</th>
                        <th scope="col">建立時間</th>
                        <th scope="col">分類</th>
                        <th scope="col">會員編號</th>
                        <th scope="col">標題</th>
                        <th scope="col" class="textover">文章內容</th>
                        <th scope="col">照片</th>
                        <th scope="col">影片</th>
                        <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><a href="javascript: delete_it(<?= $r['article_sid'] ?>)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a></td>
                            <td><?= $r['article_sid'] ?></td>
                            <td><?= $r['publishedTime'] ?></td>
                            <td><?= $r['category'] ?></td>
                            <td><?= $r['user_id'] ?></td>
                            <td><?= $r['header'] ?></td>
                            <td><?= $r['content'] ?></td>
                            <td><?= $r['photo'] ?></td>
                            <td><?= $r['video'] ?></td>
                            <td><?= "放讚數" ?></td>
                            <td><a href="edit.php?article_sid=<?= $r['article_sid'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
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






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function delete_it(article_sid) {
        if (confirm(`是否要刪除編號為 ${article_sid} 的資料?`)) {
            location.href = 'delete.php?sid=' + article_sid;
        }

    }
</script>
<?php include "./backend_js_and_endtag.php" ?>