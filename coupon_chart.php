<?php
include './connect_team3_db.php';
include "./backend_header.php";
include "./backend_navbar_and_sidebar.php";


$sql = "SELECT * FROM coupon";
$row = $pdo->query($sql)->fetchAll();

$coupon_num = COUNT($row);


foreach ($row as $ele) {

    $sid = $ele['coupon_sid'];

    $sql_2 = "SELECT * FROM user_coupon WHERE coupon_sid = $sid";
    $r_2 = $pdo->query($sql_2)->fetchAll();
    $number = COUNT($r_2);
    // if (COUNT($r_2) == 0) {

    //     $datas[] = $number + 1;
    // } else {
    //     $datas[] = $number;
    // }
    // $titles[] = $ele['coupon_title'];

    //下面改寫
    if (COUNT($r_2) == 0) {
        //$nobodylove[] = $number;
        $nobodylove_titles[] = $ele['coupon_title'];
    } else {
        $datas[] = $number;
        $titles[] = $ele['coupon_title'];
    }
};

//print_r($datas);

//上面已經拿到優惠券對應張數了


//下面拿總發放張數

$sql_3 = "SELECT * FROM user_coupon";
$r_3 = $pdo->query($sql_3)->fetchAll();
$give_number = COUNT($r_3);

?>

<style>
    #winner>div>span {
        font-family: 'Source Code Pro', monospace;
    }

    @keyframes winner {
        0% {
            transform: scale(1.2);
        }

        50% {
            transform: scale(1.0);
        }

        100% {
            transform: scale(1.2);
        }
    }

    div.winwin:first-of-type {
        animation: winner linear infinite 2s;
    }

    @keyframes pull_down {
        0% {
            color: #313131;
        }

        50% {
            color: tomato;
        }

        100% {
            opacity: 1.0;
            color: #313131;
        }
    }

    .shownobody {
        animation: pull_down linear infinite 5s;
    }
</style>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100 d-flex flex-column justify-content-center align-items-center">

        <div class="d-flex align-items-center mt-3">
            <div class="mt-5">
                <canvas id="myChart" class="mb-5" style="width:400px;"></canvas>
            </div>
            <div id="winner" style="width:250px">
                <p class="pb-4">
                    <span class="fw-bold fs-4 text-secondary mb-3 ms-5">總發放張數</span>
                    <span class="fw-bold fs-4 text-danger ms-2" style="font-family: 'Source Code Pro', monospace;"><?= $give_number ?></span>
                </p>
                <p style="width:250px;height:40px" class="fw-bold fs-3">
                    <span class="me-2 ms-2"><i class="fa-solid fa-crown text-warning"></i></span>熱門優惠券排行
                </p>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div>
                <p class="fs-3 text-secondary fw-bold mb-3">沒人要專區</p>
            </div>
            <div style="width:650px;border:2px solid #313131" class="p-2 rounded bg-secondary-subtle shownobody overflow-hidden">
                <?php foreach ($nobodylove_titles as $trash) : ?>

                    <span class="d-inline-block text-center fw-bold" style="width:100px"><?= $trash ?></span>

                <?php endforeach; ?>
            </div>
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
            hoverOffset: 50
        }]
    };

    let chart = new Chart(cht, {
        type: 'pie', //圖表類型
        data, //設定圖表資料
        options: {} //圖表的一些其他設定，像是hover時外匡加粗
    })

    //下面排序名次
    let temparr = [];

    for (let i in datas) {
        temparr.push(`${datas[i]},${titles[i]}`)
    }

    temparr.sort(function(a, b) {
        const aFirstValue = parseInt(a.split(',')[0]);
        const bFirstValue = parseInt(b.split(',')[0]);

        return bFirstValue - aFirstValue;
    });

    //console.log(temparr);

    //準備取前三

    const templ = temparr.length;

    let temparr2 = [];

    for (let i = 0; i < templ; i++) {
        let ajo = temparr[i].split(',');
        temparr2.push(ajo);
        //console.log(ajo);
    }

    const winner_div = document.getElementById('winner');

    for (let i = 0; i < 3; i++) {
        winner_div.innerHTML += `<div class="fw-bold fs-5 mt-3 winwin" style="margin-left:40px;"><span class="me-3 text-danger" style="font-size:40px">${i+1}</span><span>${temparr2[i][1]}</span><span class="ms-3 text-warning" style="font-size:24px">${temparr2[i][0]}</span><span class="ms-1">張</span></div>`;
    }
</script>


<?php include "./backend_js_and_endtag.php"; ?>