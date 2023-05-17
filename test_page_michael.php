<?php

require './michael/connect-db.php';

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; # 用戶要看第幾頁

if ($page < 1) {
    header('Location: ?page=1');
    exit;
}



$sql = "SELECT * FROM BOOKING";

$rows = $pdo->query($sql)->fetchAll();

// print_r($rows);
// exit;

?>



<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid bg-info w-100" style="height: 100px;"> <!--這個的class可以自己改掉，給你們看範圍的而已-->
        123
    </div>
</div>

<?php include "./backend_footer.php" ?>
<?php include "./backend_js_and_endtag.php" ?>