<?php

require './connect_team3_db.php';

$sql = "select booking_time,count(*) as booking_num
from booking
group by booking_time";

$sql2 = "select shops.shop,count(*) as booking_total from booking JOIN shops on booking.shop_id=shops.sid group by shops.shop order by booking_total desc limit 5";


$sql3 = "SELECT booking_time, COUNT(*) AS booking_num
FROM booking
GROUP BY booking_time
HAVING COUNT(*) = (
  SELECT MAX(booking_num) AS max_booking_num
  FROM (
    SELECT COUNT(*) AS booking_num
    FROM booking
    GROUP BY booking_time
  ) AS booking_counts
)";

$sql4 = "select shops.shop,count(*) as booking_total from booking JOIN shops on booking.shop_id=shops.sid group by shops.shop order by booking_total desc limit 1";


$rows = $pdo->query($sql)->fetchAll();
$rows2 = $pdo->query($sql2)->fetchAll();
$rows3 = $pdo->query($sql3)->fetch();
$rows4 = $pdo->query($sql4)->fetch();


foreach ($rows as $r) {
    $times[] = $r['booking_time'];
    $numbers[] = $r['booking_num'];
}

foreach ($rows2 as $r2) {
    $shops[] = $r2['shop'];
    $total[] = $r2['booking_total'];
}

?>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>
<style>

</style>


<div class="w-100 p-3 mb-auto" style="display:flex">
    <div class="container w-100 align-items-center d-flex" style="flex:auto;margin-right:40px">
        <div class="col-6" style="justify-content:center;margin-top:80px;">

            <div class="my-chart1 d-flex">
                <canvas id="myChart" style="margin-right:50px;"></canvas>
                <div class="myChart-detail" style="margin-top:20px;">
                    <div class="myChart-detail-div1 mb-3">
                        熱門時段
                    </div>
                    <div class="myChart-detail-div1" style="font-family: 'Noto Sans JP', sans-serif;">
                        <i class="fa-solid fa-crown text-warning me-2"></i>TOP1/ &nbsp;<span style="color:red"><?= $rows3['booking_time'] ?></span>
                    </div>
                    <div class="myChart-detail-div1">
                        訂單數/ <?= $rows3['booking_num'] ?>
                    </div>
                </div>
            </div>

            <div class="my-chart2 d-flex">
                <canvas id="myChart1" style="margin-right:50px"></canvas>
                <div class="myChart1-detail" style="margin-top: 20px;">
                    <div class="myChart-detail-div1 mb-3">
                        餐廳排行
                    </div>
                    <div class="myChart-detail-div1" style="font-family: 'Noto Sans JP', sans-serif;">
                        <i class="fa-solid fa-crown text-warning me-2"></i>TOP1/ &nbsp;<span style="color:red"><?= $rows4['shop'] ?></span>
                    </div>
                    <div class="myChart-detail-div1">
                        訂單數/ <?= $rows4['booking_total'] ?>
                    </div>
                </div>
            </div>




        </div>




    </div>
</div>

<?php include "./backend_footer.php" ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = <?php echo json_encode($times) ?>;

    const data = {
        labels: labels,
        datasets: [{
            label: '訂位時間統計表',
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            data: <?php echo json_encode($numbers) ?>,
        }]
    };

    const labels1 = <?php echo json_encode($shops) ?>;

    const data1 = {
        labels: labels1,
        datasets: [{
            label: 'TOP5 餐廳訂單 統計表',
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            data: <?php echo json_encode($total) ?>,
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
    const config1 = {
        type: 'bar',
        data: data1,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
</script>

<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    const myChart1 = new Chart(
        document.getElementById('myChart1'),
        config1
    );
</script>

<?php include "./backend_js_and_endtag.php" ?>