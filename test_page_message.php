<pre>
<?php
require './connectwei-db.php';

$sql = "SELECT * FROM article";

$rows = $pdo->query($sql)->fetchAll();
// print_r($stmt);
// exit;

?></pre>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100 overflow-scroll"> <!--這個的class可以自己改掉，給你們看範圍的而已-->

        <div class="row">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <!-- <th scope="col"><i class="fa-solid fa-trash-can"></i></th> -->
                        <th scope="col">文章編號</th>
                        <th scope="col">發文時間</th>
                        <th scope="col">分類</th>
                        <th scope="col">會員id</th>
                        <th scope="col">標題</th>
                        <th scope="col">文章內容</th>
                        <th scope="col">照片</th>
                        <th scope="col">影片</th>
                        <!-- <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <!-- <td><a href="javascript: delete_it()">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a></td> -->
                            <td><?= $r['article.sid'] ?></td>
                            <td><?= $r['publishedTime'] ?></td>
                            <td><?= $r['category'] ?></td>
                            <td><?= $r['user.id'] ?></td>
                            <td><?= $r['header'] ?></td>
                            <td><?= $r['contant'] ?></td>
                            <td><?= $r['photo'] ?></td>
                            <td><?= $r['video'] ?></td>
                            <td><?= "放讚數" ?></td>
                            <!-- <td><a href="edit.php?sid=">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include "./backend_footer.php" ?>
<?php include "./backend_js_and_endtag.php" ?>