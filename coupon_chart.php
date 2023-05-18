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
    $datas[] = $number;
};
//print_r($datas);

//上面已經拿到優惠券對應張數了

?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100 d-flex flex-column justify-content-center align-items-center">

        <canvas id="myChart" width="400" height="400"></canvas>


    </div>
</div>

<?php include "./backend_footer.php"; ?>

<script>
    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: (ctx) => 'Point Style: ' + ctx.chart.data.datasets[0].pointStyle,
                }
            }
        }
    };


    const actions = [{
            name: 'pointStyle: circle (default)',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = 'circle';
                });
                chart.update();
            }
        },
        {
            name: 'pointStyle: cross',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = 'cross';
                });
                chart.update();
            }
        },
        {
            name: 'pointStyle: crossRot',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = 'crossRot';
                });
                chart.update();
            }
        },
        {
            name: 'pointStyle: dash',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = 'dash';
                });
                chart.update();
            }
        },
        {
            name: 'pointStyle: line',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = 'line';
                });
                chart.update();
            }
        },
        {
            name: 'pointStyle: rect',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = 'rect';
                });
                chart.update();
            }
        },
        {
            name: 'pointStyle: rectRounded',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = 'rectRounded';
                });
                chart.update();
            }
        },
        {
            name: 'pointStyle: rectRot',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = 'rectRot';
                });
                chart.update();
            }
        },
        {
            name: 'pointStyle: star',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = 'star';
                });
                chart.update();
            }
        },
        {
            name: 'pointStyle: triangle',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = 'triangle';
                });
                chart.update();
            }
        },
        {
            name: 'pointStyle: false',
            handler: (chart) => {
                chart.data.datasets.forEach(dataset => {
                    dataset.pointStyle = false;
                });
                chart.update();
            }
        }
    ];
</script>


<?php include "./backend_js_and_endtag.php"; ?>