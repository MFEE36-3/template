<pre>
    <?php

    require './Norm/connect-db.php';

    $perPage = 10;
    $page = 1;

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    if ($page < 1) {
        header('Location: test_page-Norm.php');
        exit;
    };

    $sql = sprintf("SELECT * FROM shops ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();

    $t_sql = "SELECT COUNT(1) FROM shops";
    // $t_row = $pdo->query($t_sql)->fetch();
    // echo gettype($t_row) . "<br>";  // array
    // print_r($t_row);
    // print_r($t_row['COUNT(1)']);    // 總列數
    // exit;

    $r1 = $pdo->query($t_sql)->fetch();
    $totalRows = $r1['COUNT(1)'];



    // echo $totalRows;
    // exit;

    $totalPages = ceil($totalRows / $perPage);

    if ($totalRows) {
        if ($page > $totalPages) {
            header("Location: ?page=$totalPages");
            exit();
        }
        $sql = sprintf("SELECT * FROM shops ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

        $rows = $pdo->query($sql)->fetchAll();
    }

    // print_r($rows);
    // exit;

    ?>
</pre>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid bg-white w-100 overflow-scroll" style="height: 800px;"> <!--這個的class可以自己改掉，給你們看範圍的而已-->

        <div class="container">
            <div class="row">

                <nav aria-label="Page navigation example">
                    <ul class="pagination">

                        <!-- 回到最前頁 -->
                        <li class="page-item"><a class="page-link" href="?page=<?= $page == 1 ?>" style="font-size:18px"><i class="fa-solid fa-angles-left"></i></a></li>

                        <!-- 上一頁 -->
                        <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>" style="font-size:18px"><i class="fa-solid fa-angle-left"></i></a></li>

                        <!-- 製作互動式分頁表 -->
                        <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                            if ($i >= 1 and $i <= $totalPages) :
                        ?>

                                <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>

                        <?php endif;
                        endfor; ?>

                        <!-- 下一頁 -->
                        <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>" style="font-size:18px"><i class="fa-solid fa-angle-right"></i></a></li>

                        <!-- 跳到最後頁 -->
                        <li class="page-item"><a class="page-link" href="?page=<?= $totalPages ?>" style="font-size:18px"><i class="fa-solid fa-angles-right"></i></a></li>

                    </ul>
                </nav>

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">

                <table class="table table-bordered table-striped" style="margin-bottom:100px">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">account</th>
                            <th scope="col">password</th>
                            <th scope="col">shop</th>
                            <th scope="col">owner</th>
                            <th scope="col">category</th>
                            <th scope="col">photo</th>
                            <th scope="col">city</th>
                            <th scope="col">area</th>
                            <th scope="col">location</th>
                            <th scope="col">res_category</th>
                            <th scope="col">phone</th>
                            <th scope="col">email</th>
                            <th scope="col">uniform_number</th>
                            <th scope="col">company_number</th>
                            <th scope="col">open_time</th>
                            <th scope="col">food_categories</th>
                            <th scope="col">編輯</th>
                            <th scope="col">刪除</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($rows as $r) : ?>

                            <tr>
                                <td><?= $r['sid'] ?></td>
                                <td><?= $r['account'] ?></td>
                                <td><?= $r['password'] ?></td>
                                <td><?= $r['shop'] ?></td>
                                <td><?= $r['owner'] ?></td>
                                <td><?= $r['category'] ?></td>
                                <td><?= $r['photo'] ?></td>
                                <td><?= $r['city'] ?></td>
                                <td><?= $r['area'] ?></td>
                                <td><?= $r['location'] ?></td>
                                <td><?= $r['res_category'] ?></td>
                                <td><?= $r['phone'] ?></td>
                                <td><?= $r['email'] ?></td>
                                <td><?= $r['uniform_number'] ?></td>
                                <td><?= $r['company_number'] ?></td>
                                <td><?= $r['open_time'] ?></td>
                                <td><?= $r['food_categories'] ?></td>
                                <td><a href="edit1.php?sid=<?= $r['sid'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td><a href="javascript: delete_it(<?= $r['sid'] ?>)"><i class="fa-solid fa-trash-can"></i></a></td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div>


    </div>
</div>

<?php include "./backend_footer.php" ?>
<script>
    function delete_it(sid) {
        if (confirm(`確定是否要刪掉第${sid}的資料?`)) {
            location.href = 'delete1.php?sid=' + sid;
        }
    }
</script>
<?php include "./backend_js_and_endtag.php" ?>