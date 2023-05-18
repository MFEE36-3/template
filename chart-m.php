<?php

require './connect_team3_db.php';

$sql = "select booking_time,count(*) as booking_num
from booking
group by booking_time";

$sql2 = "select shops.shop,count(*) as booking_total from booking JOIN shops on booking.shop_id=shops.sid group by shops.shop order by booking_total desc limit 5";


$rows = $pdo->query($sql)->fetchAll();
$rows2 = $pdo->query($sql2)->fetchAll();

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
    <div class="container w-100 align-items-center d-flex" style="flex:auto; justify-content:center;">
        <div class="col-6" style="justify-content: center;">
            <div>
                <canvas id="myChart"></canvas>
            </div>
            <div>
                <canvas id="myChart1"></canvas>
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