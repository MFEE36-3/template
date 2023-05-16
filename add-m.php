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

$tables = [
    [
        'id' => 2,
        'name' => '2人桌',
    ],
    [
        'id' => 4,
        'name' => '4人桌',
    ],
    [
        'id' => 6,
        'name' => '6人桌',
    ],
    [
        'id' => 10,
        'name' => '10人桌',
    ],
];

$tomorrow =  date("Y-m-d", strtotime('+1 day'));;

?>

<div class="w-100 p-3 mb-auto">
    <div class="container w-100" style="flex:auto">
        <div class="col-6">
            <div class="card">
                <div class="card-body" style="border: 1px solid grey; border-radius: 20px; padding:50px">
                    <h5 class="card-title">新增訂單</h5>

                    <form name="form1" onsubmit="checkForm(event)">
                        <div class="mb-3">
                            <label for="id" class="form-label">會員編號</label>
                            <input type="text" class="form-control" id="id" name="id">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="shop_id" class="form-label">餐廳編號</label>
                            <input type="text" class="form-control" id="shop_id" name="shop_id" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">訂位日期</label>
                            <input type="date" class="form-control" id="booking_date" name="booking_date" data-required="1" min="<?= $tomorrow ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="time" class="form-label">訂位時間</label>
                            <input type="text" class="form-control" id="booking_time" name="booking_time" data-required="1" placeholder="請輸入四位數整點時段 ex.1800"> -->
                            <label for="booking_time" class="form-label">訂位時間</label>
                            <?php foreach ($times as $k => $i) : ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="booking_time" id="booking_time<?= $k ?>" value="<?= $i['name'] ?>">
                                    <label class="form-check-label" for="booking_time<?= $k ?>">
                                        <?= $i['name'] ?>
                                    </label>
                                </div>
                            <?php endforeach ?>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="num" class="form-label">人數</label>
                            <input type="text" class="form-control" id="booking_number" name="booking_number" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="table" class="form-label">桌型</label>
                            <select class="form-select" name="table" id="table">
                                <!-- <option value="">--請選擇--</option> -->
                                <?php foreach ($tables as $i) : ?>
                                    <option id="<?= $i['id'] ?>" value="<?= $i['id'] ?>"><?= $i['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="form-text"></div>
                        </div>

                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>

                        <button type="submit" class="btn btn-primary">新增</button>
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

        console.log(booking_number.value);
        console.log(table.value);

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
            isPass = false;
            // table.style.border = '1px solid red';
            table.nextElementSibling.innerHTML = '請選擇正確桌型';
        }


        if (isPass) {
            const fd = new FormData(document.form1); // 沒有外觀的表單
            // const usp = new URLSearchParams(fd); // 可以轉換為 urlencoded 格式
            // console.log(usp.toString());

            fetch('add-api-m.php', {
                    method: 'POST',
                    body: fd, // Content-Type 省略, multipart/form-data
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {

                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '新增成功'
                        infoBar.style.display = 'block';
                        setTimeout(() => {
                            infoBar.style.display = 'none';
                            // window.location = 'booking.php';
                        }, 2000);
                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '新增失敗' //bug
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
                    infoBar.innerHTML = '新增發生錯誤'
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