<?php
include './connect_team3_db.php';
include "./backend_header.php";
include "./backend_navbar_and_sidebar.php";


$sql = "SELECT * FROM coupon";
$row = $pdo->query($sql)->fetchAll();

$coupon_num = COUNT($row);



$datas = [];

foreach ($row as $ele) {

    $sid = $ele['coupon_sid'];

    $sql_2 = "SELECT * FROM user_coupon WHERE coupon_sid = $sid";
    $r_2 = $pdo->query($sql_2)->fetchAll();
    $number = COUNT($r_2);
    if (COUNT($r_2) == 0) {

        $datas[] = $number + 1;
    } else {
        $datas[] = $number;
    }
    $titles[] = $ele['coupon_title'];
};

//print_r($datas);


//上面已經拿到優惠券對應張數了

?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100 d-flex flex-column justify-content-center align-items-center">

        <div>
            <canvas id="myChart" style="width:200%"></canvas>
        </div>


    </div>
</div>

<?php include "./backend_footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const cht = document.getElementById('myChart').getContext('2d');

    let datas = [];
    <?php foreach ($datas as $d) : ?>
        datas.push(<?= $d ?>);
    <?php endforeach; ?>
    //console.log(datas);

    let titles = [];
    <?php foreach ($titles as $t) : ?>
        titles.push('<?= $t ?>');
    <?php endforeach; ?>
    console.log(titles);

    let color = [];

    let $what_color = '';
    <?php foreach ($titles as $t) : ?>
        <?php $c = sprintf("rgb(%s,%s,%s)", rand(100, 255), rand(100, 255), rand(100, 255)); ?>
        $what_color = '<?= $c ?>';
        color.push($what_color);
    <?php endforeach; ?>
    console.log(color);


    data = {
        labels: titles,
        datasets: [{
            label: '送出張數', //這些資料都是在講什麼，也就是data 300 500 100是什麼
            data: datas, //每一塊的資料分別是什麼，台北：300、台中：50..
            backgroundColor: color,
            hoverOffset: 4
        }]
    };

    let chart = new Chart(cht, {
        type: 'pie', //圖表類型
        data, //設定圖表資料
        options: {} //圖表的一些其他設定，像是hover時外匡加粗
    })
</script>


<?php include "./backend_js_and_endtag.php"; ?>