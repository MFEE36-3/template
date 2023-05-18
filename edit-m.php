<?php

require './connect_team3_db.php';

$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
$sql = "SELECT * FROM booking WHERE booking_id={$booking_id}";

$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: booking.php');
    exit;
}
?>
<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>
<?php
$times = [
    [
        'id' => 11,
        'name' => '11:00',
    ],
    [
        'id' => 12,
        'name' => '12:00',
    ],
    [
        'id' => 13,
        'name' => '13:00',
    ],
    [
        'id' => 18,
        'name' => '18:00',
    ],
    [
        'id' => 19,
        'name' => '19:00',
    ],
    [
        'id' => 20,
        'name' => '20:00',
    ],
];

// $tables = [
//     [
//         'id' => 2,
//         'name' => '2人桌',
//     ],
//     [
//         'id' => 4,
//         'name' => '4人桌',
//     ],
//     [
//         'id' => 6,
//         'name' => '6人桌',
//     ],
//     [
//         'id' => 10,
//         'name' => '10人桌',
//     ],
// ];

$tomorrow =  date("Y-m-d", strtotime('+1 day'));;

//取得桌型資料
$sql_table = "SELECT * FROM seat_type";
$tables = $pdo->query($sql_table)->fetchAll();

?>

<div class="w-100 p-3 mb-auto">
    <div class="container w-100" style="flex:auto">
        <div class="col-6">
            <div class="card card-m">
                <div class="card-body" style="border-radius: 20px; padding:50px">
                    <h5 class="card-title m-title">編輯訂單</h5>

                    <form name="form1" onsubmit="checkForm(event)">
                        <input type="hidden" name="booking_id" value="<?= $r['booking_id'] ?>">
                        <div class="mb-3">
                            <label for="id" class="form-label">會員編號</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= htmlentities($r['id']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="shop_id" class="form-label">餐廳編號</label>
                            <input type="text" class="form-control" id="shop_id" name="shop_id" data-required="1" value="<?= htmlentities($r['shop_id']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">訂位日期</label>
                            <input type="date" class="form-control" id="booking_date" name="booking_date" data-required="1" min="<?= $tomorrow ?>" value="<?= htmlentities($r['booking_date']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="time" class="form-label">訂位時間</label>
                            <input type="text" class="form-control" id="booking_time" name="booking_time" data-required="1" placeholder="請輸入四位數整點時段 ex.1800"> -->
                            <label for="booking_time" class="form-label">訂位時間</label>
                            <?php foreach ($times as $k => $i) : ?>
                                <div class="form-check" style="margin-left: 30px;">
                                    <?php if ($i['name'] == $r['booking_time']) : ?>
                                        <input class="form-check-input" type="radio" name="booking_time" id="booking_time<?= $k ?>" value="<?= htmlentities($i['name']) ?>" checked>
                                        <label class="form-check-label" for="booking_time<?= $k ?>">
                                            <?= $i['name'] ?>
                                        </label>
                                    <?php else : ?>
                                        <input class="form-check-input" type="radio" name="booking_time" id="booking_time<?= $k ?>" value="<?= $i['name'] ?>">
                                        <label class="form-check-label" for="booking_time<?= $k ?>">
                                            <?= $i['name'] ?>
                                        </label>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach ?>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="num" class="form-label">人數</label>
                            <input type="text" class="form-control" id="booking_number" name="booking_number" data-required="1" value="<?= htmlentities($r['booking_number']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="table" class="form-label">桌型</label>
                            <select class="form-select" name="table" id="table" value="<?= $r['table'] ?>">
                                <?php foreach ($tables as $i) : ?>
                                    <?php if ($i['seat_descript'] == $r['table']) : ?>
                                        <option id="<?= $i['seat_number'] ?>" value="<?= $i['seat_number'] ?>" selected><?= htmlentities($i['seat_descript']) ?></option>
                                    <?php else : ?>
                                        <option id="<?= $i['seat_number'] ?>" value="<?= $i['seat_number'] ?>"><?= $i['seat_descript'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </select>
                            <div class="form-text"></div>
                        </div>

                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>

                        <button type="submit" class="btn btn-primary">編輯</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "./backend_footer.php" ?>

<script>
    const id1 = document.querySelector('#id');
    const infoBar = document.querySelector('#infoBar');
    const booking_number = document.querySelector('#booking_number');
    const table = document.querySelector('#table');
    // const booking_time = document.querySelector('#booking_time');
    const fields = document.querySelectorAll('form *[data-required="1"]');

    function checkForm(event) {
        event.preventDefault();

        // TODO: 檢查欄位資料

        for (let f of fields) {
            f.style.border = '1px solid #ccc';
            f.nextElementSibling.innerHTML = '';
        }

        id1.style.border = '1px solid #CCC';
        id1.nextElementSibling.innerHTML = '';

        table.style.border = '1px solid #CCC';
        table.nextElementSibling.innerHTML = '';
        // booking_time.style.border = '1px solid #CCC';
        // booking_time.nextElementSibling.innerHTML = '';

        let isPass = true;

        // 檢查必填欄位
        for (let f of fields) {
            if (!f.value) {
                isPass = false;
                f.style.border = '1px solid red';
                f.nextElementSibling.innerHTML = '請填入資料';
            }
        }


        //欄位檢查
        if (id1.value == "") {
            isPass = false;
            id1.style.border = '1px solid red';
            id1.nextElementSibling.innerHTML = '請輸入編號';
        }

        if (parseInt(booking_number.value) > table.value) { //5 > 2
            isPass = false;
            // table.style.border = '1px solid red';
            table.nextElementSibling.innerHTML = '人數大於桌數上限';
        }
        if (parseInt(booking_number.value) < table.value - 1) {
            if (parseInt(booking_number.value) >= 7 && (table.value - parseInt(booking_number.value) <= 3)) {
                isPass = true;
            } else {
                isPass = false;
                // table.style.border = '1px solid red';
                table.nextElementSibling.innerHTML = '請選擇正確桌型';
            }
        }


        if (isPass) {
            const fd = new FormData(document.form1); // 沒有外觀的表單
            // const usp = new URLSearchParams(fd); // 可以轉換為 urlencoded 格式
            // console.log(usp.toString());

            fetch('edit-api-m.php', {
                    method: 'POST',
                    body: fd, // Content-Type 省略, multipart/form-data
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '編輯成功'
                        infoBar.style.display = 'block';
                        setTimeout(() => {
                            infoBar.style.display = 'none';
                            // window.location = 'booking.php';
                            history.go(-1); //返回前一頁面
                        }, 2000);
                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '資料沒有更新'
                        infoBar.style.display = 'block';
                        setTimeout(() => {
                            infoBar.style.display = 'none';
                        }, 2000);
                    }

                })
                .catch(ex => {
                    console.log(ex);
                    infoBar.classList.remove('alert-success')
                    infoBar.classList.add('alert-danger')
                    infoBar.innerHTML = '編輯發生錯誤'
                    infoBar.style.display = 'block';
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000);
                })

        } else {
            // 沒通過檢查
        }
    }
</script>

<?php include "./backend_js_and_endtag.php" ?>