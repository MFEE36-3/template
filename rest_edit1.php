<pre>
    <?php

    require './connect_team3_db.php';
    $sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

    $sql = "SELECT * FROM shops WHERE sid={$sid}";

    $r = $pdo->query($sql)->fetch();

    if (empty($r)) {
        header('Location: test_page-Norm.php');
        exit();
    };

    $food_category1 = $r['food_categories'];
    $food_category = explode(" ", $food_category1);
    // print_r(explode(" ", $r['food_categories'])); //根據空格切
    // print_r($food_category);
    // echo gettype($food_category);
    // exit;




    // $r1 '<?=$r1['cityname']

    $areasTPE = ['中正區', '大同區', '中山區', '松山區', '大安區', '萬華區', '信義區', '士林區', '北投區', '內湖區', '南港區', '文山區'];
    $areasNTC = ['萬里區', '金山區', '板橋區', '汐止區', '深坑區', '石碇區', '瑞芳區', '平溪區', '雙溪區', '貢寮區', '新店區', '坪林區', '烏來區', '永和區', '中和區', '土城區', '三峽區', '樹林區', '鶯歌區', '三重區', '新莊區', '泰山區', '林口區', '蘆洲區', '五股區', '八里區', '淡水區', '三芝區', '石門區'];
    $areasKEE = ['仁愛區', '信義區', '中正區', '中山區', '安樂區', '暖暖區', '七堵區'];

    $food_cate = [
        "appetizer", "main_dish", "side_dish", "drink", "dessert",
    ];

    $res_cate = [
        "中式", "西式", "日式", "韓式", "印式", "其他",
    ];

    // print_r($r);
    // exit;

    $time = [
        [
            'id' => 1,
            'time' => "1:00",
        ],
        [
            'id' => 2,
            'time' => "2:00",
        ],
        [
            'id' => 3,
            'time' => "3:00",
        ],
        [
            'id' => 4,
            'time' => "4:00",
        ],
        [
            'id' => 5,
            'time' => "5:00",
        ],
        [
            'id' => 6,
            'time' => "6:00",
        ],
        [
            'id' => 7,
            'time' => "7:00",
        ],
        [
            'id' => 8,
            'time' => "8:00",
        ],
        [
            'id' => 9,
            'time' => "9:00",
        ],
        [
            'id' => 10,
            'time' => "10:00",
        ],
        [
            'id' => 11,
            'time' => "11:00",
        ],
        [
            'id' => 12,
            'time' => "12:00",
        ],
        [
            'id' => 13,
            'time' => "13:00",
        ],
        [
            'id' => 14,
            'time' => "14:00",
        ],
        [
            'id' => 15,
            'time' => "15:00",
        ],
        [
            'id' => 16,
            'time' => "16:00",
        ],
        [
            'id' => 17,
            'time' => "17:00",
        ],
        [
            'id' => 18,
            'time' => "18:00",
        ],
        [
            'id' => 19,
            'time' => "19:00",
        ],
        [
            'id' => 20,
            'time' => "20:00",
        ],
        [
            'id' => 21,
            'time' => "21:00",
        ],
        [
            'id' => 22,
            'time' => "22:00",
        ],
        [
            'id' => 23,
            'time' => "23:00",
        ],
        [
            'id' => 24,
            'time' => "24:00",
        ],
    ];

    $foods = [
        [
            "id" => 1,
            "food" => "前菜",
        ],
        [
            "id" => 2,
            "food" => "主菜",
        ],
        [
            "id" => 3,
            "food" => "配菜",
        ],
        [
            "id" => 4,
            "food" => "飲料",
        ],
        [
            "id" => 5,
            "food" => "甜點",
        ],
    ];

    ?>
</pre>
<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<style>
form .mb-3 .form-text {
    color: red;
}

.norm_file_picture {
    height: 150px;
    width: 150px;
}

div {
    font-weight: bold;
    font-size: 20px;

}

span {
    font-weight: bold;
}

.Norm_add_button {
    display: flex;
    justify-content: center;
}

.Norm_add_title {
    display: flex;
    justify-content: center;
    font-size: 100px;
}
</style>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100" style="flex:auto;">
        <!--這個的class可以自己改掉，給你們看範圍的而已-->


        <div class="container">
            <div class="row">
                <div class="col-11">
                    <div class="card bg-warning">

                        <div class="card-body">
                            <h5 class="card-title Norm_add_title">編輯資料</h5>

                            <form name="form1" onsubmit="checkForm(event)">

                                <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                                <div class="mb-3">
                                    <label for="account" class="form-label">帳號</label>
                                    <input type="text" class="form-control" id="account" name="account"
                                        data-required="1" value="<?= htmlentities($r['account']) ?>">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">密碼</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        data-required="1" value="<?= htmlentities($r['password']) ?>">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="shop" class="form-label">店名</label>
                                    <input type="text" class="form-control" id="shop" name="shop" data-required="1"
                                        value="<?= htmlentities($r['shop']) ?>">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="owner" class="form-label">負責人</label>
                                    <input type="text" class="form-control" id="owner" name="owner" data-required="1"
                                        value="<?= htmlentities($r['owner']) ?>">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">種類</label>
                                    <!-- <input type="text" class="form-control" id="category" name="category" data-required="1"> -->
                                    <select name="category" id="category" data-required="1">

                                        <?php foreach ($res_cate as $row) : ?>
                                        <?php if ($row == $r['category']) : ?>

                                        <option value="<?= $row ?>"><?= $r['category'] ?></option>

                                        <? else : ?>



                                        <?php endif;
                                        endforeach; ?>

                                        <option value="中式">中式</option>
                                        <option value="西式">西式</option>
                                        <option value="日式">日式</option>
                                        <option value="韓式">韓式</option>
                                        <option value="印式">印式</option>
                                        <option value="其它">其它...</option>
                                    </select>
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="photo" class="form-label">照片</label>
                                    <input type="file" class="form-control" id="photo" name="photo" data-required="1">
                                    <div class="form-text">
                                        <img src="./Norm/imgs/<?= $r['photo'] ?>" alt="" class=" norm_file_picture">
                                    </div>
                                    <img src="" alt="" id="myimg">
                                </div>

                                <div class="flex1">
                                    <label for="category" class="form-label">地址:</label>
                                    <br>
                                    <select id="city" name="city" class="me-3" data-required="1">
                                        <option value="">-請選擇-</option>
                                        <option value="1">台北市</option>
                                        <option value="2">新北市</option>
                                        <option value="3">基隆市</option>
                                    </select>


                                    <select id="area" name="area">

                                    </select>
                                </div>

                                <br>

                                <div class="mb-3">
                                    <label for="location" class="form-label">詳細地址</label>
                                    <input type="text" class="form-control" id="location" name="location"
                                        data-required="1" value="<?= htmlentities($r['location']) ?>">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="res_category" class="form-label">餐廳種類</label>
                                    <!-- <input type="text" class="form-control" id="res_category" name="res_category" data-required="1"> -->
                                    <select name="res_category" id="res_category">
                                        <option value="0">可訂位也可揪團</option>
                                        <option value="1">可揪團，但不可訂位</option>
                                        <option value="2">可訂位，但不可揪團</option>
                                    </select>
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">電話</label>
                                    <input type="text" class="form-control" id="phone" name="phone" data-required="1"
                                        value="<?= htmlentities($r['phone']) ?>">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">email</label>
                                    <input type="text" class="form-control" id="email" name="email" data-required="1"
                                        value="<?= htmlentities($r['email']) ?>">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="uniform_number" class="form-label">公司統一編號</label>
                                    <input type="text" class="form-control" id="uniform_number" name="uniform_number"
                                        data-required="1" value="<?= htmlentities($r['uniform_number']) ?>">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="company_number" class="form-label">公司營業編號</label>
                                    <input type="text" class="form-control" id="company_number" name="company_number"
                                        data-required="1" value="<?= htmlentities($r['company_number']) ?>">
                                    <div class="form-text"></div>
                                </div>


                                <div class="mb-3">

                                    <label for="open_time" class="form-label">營業時間</label>


                                    <!-- <select name="open_time" id="opentime" data-required="1">


                                    </select>
                                    <span>-</span>
                                    <select name="close_time" id="closetime" data-required="1">
                                    </select> -->

                                    <select name="open_time" id="open_time">

                                        <?php foreach ($time as $t) : ?>

                                        <?php if ($r['open_time'] == $t['time']) : ?>
                                        <option value="<?= $t['id'] ?>:00" id="<?= $t['id'] ?>" selected>
                                            <?= $r['open_time'] ?></option>
                                        <?php else : ?>
                                        <option value="<?= $t['id'] ?>:00" id="<?= $t['id'] ?>"><?= $t['time'] ?>
                                        </option>
                                        <?php endif;
                                        endforeach; ?>

                                    </select>

                                    <select name="close_time" id="close_time">

                                        <?php foreach ($time as $t) : ?>

                                        <?php if ($r['close_time'] == $t['time']) : ?>
                                        <option value="<?= $t['id'] ?>:00" id="<?= $t['id'] ?>" selected>
                                            <?= $r['close_time'] ?></option>
                                        <?php else : ?>

                                        <option value="<?= $t['id'] ?>:00" id="<?= $t['id'] ?>"><?= $t['time'] ?>
                                        </option>
                                        <?php endif;
                                        endforeach; ?>

                                    </select>

                                    <!-- <input type="text" class="form-control" id="open_time" name="open_time" data-required="1"> -->
                                    <div class="form-text"></div>
                                </div>



                                <?php foreach ($foods as $f) : ?>

                                <?php
                                    foreach ($food_category as $fc) {
                                        if ($f['food'] == $fc) {
                                            $temp = 'checked';
                                            break;
                                        } else {
                                            $temp = '';
                                        }
                                    }
                                    ?>

                                <div class="form-check ms-4">

                                    <input class="form-check-input" type="checkbox" name="food_categories[]"
                                        value="<?= $f['food'] ?>" id="<?= $f['food'] ?>" <?= $temp ?>>
                                    <label class="form-check-label ms-0"
                                        for="<?= $f['food'] ?>"><?= $f['food'] ?></label>

                                </div>
                                <?php endforeach; ?>

                                <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>
                                <div class="Norm_add_button">
                                    <button type="submit" class="btn btn-primary">編輯</button>
                                    <button type="reset" class="btn btn-primary ms-3">重填</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<?php include "./backend_footer.php" ?>

<script>
// 縣市選擇器
let areasTPE = [
    "中正區",
    "大同區",
    "中山區",
    "松山區",
    "大安區",
    "萬華區",
    "信義區",
    "士林區",
    "北投區",
    "內湖區",
    "南港區",
    "文山區",
];
let areasNTC = [
    "萬里區",
    "金山區",
    "板橋區",
    "汐止區",
    "深坑區",
    "石碇區",
    "瑞芳區",
    "平溪區",
    "雙溪區",
    "貢寮區",
    "新店區",
    "坪林區",
    "烏來區",
    "永和區",
    "中和區",
    "土城區",
    "三峽區",
    "樹林區",
    "鶯歌區",
    "三重區",
    "新莊區",
    "泰山區",
    "林口區",
    "蘆洲區",
    "五股區",
    "八里區",
    "淡水區",
    "三芝區",
    "石門區",
];
let areasKEE = [
    "仁愛區",
    "信義區",
    "中正區",
    "中山區",
    "安樂區",
    "暖暖區",
    "七堵區",
];

let city = document.querySelector("#city");
let area = document.querySelector("#area");

//   let str;

//   console.log(areasTPE.length);

city.addEventListener("change", () => {
    console.log(city.value);
    if (city.value == "1") {
        let str = "";
        area.innerHTML = "";
        for (i = 0; i < areasTPE.length; i++) {
            str += `<option value="${i}">${areasTPE[i]}</option>`;
        }

        area.innerHTML = str;
    }

    if (city.value == "2") {
        let str = "";
        area.innerHTML = "";
        for (i = 0; i < areasNTC.length; i++) {
            str += `<option value="${i}">${areasNTC[i]}</option>`;
        }
        area.innerHTML = str;
    }

    if (city.value == "3") {
        let str = "";
        area.innerHTML = "";
        for (i = 0; i < areasKEE.length; i++) {
            str += `<option value="${i}">${areasKEE[i]}</option>`;
        }
        area.innerHTML = str;
    }
});

// opentime選單
let opentime = document.querySelector("#opentime");
let str1;
for (i = 0; i <= 24; i++) {
    str1 += `
            <option value="${i}:00">${i}:00</option>
            `;
};
opentime.innerHTML = str1;

let closetime = document.querySelector('#closetime');
let str2;
for (i = 0; i <= 24; i++) {
    str2 += `
            <option value="${i}:00">${i}:00</option>
            `;
};
closetime.innerHTML = str2;






// if (accountField.value.length < 6) {
//     isPass = false;
//     accountField.style.border = '1px solid red';
//     accountField.nextElementSibling.innerHTML = '帳號至少要六個字';
// }

function checkForm(event) {

    event.preventDefault();

    const accountField = document.querySelector('#account')
    const fields = document.querySelectorAll('form *[data-required="1"]');
    const infoBar = document.querySelector('#infoBar');
    const phone = document.querySelector("#phone");
    const uni = document.querySelector('#uniform_number');
    const com = document.querySelector('#company_number');

    const fd = new FormData(document.form1);

    let isPass = true;

    for (let f of fields) {
        f.style.border = '1px solid #CCC';
        f.nextElementSibling.innerHTML = '';
        accountField.style.border = '1px solid #CCC';
        accountField.nextElementSibling.innerHTML = '';
    }



    if (accountField.value.length < 6) {
        isPass = false;
        accountField.style.border = '1px solid red';
        accountField.nextElementSibling.innerHTML = '帳號至少要六個字';
    }

    for (let f of fields) {
        if (!f.value) {
            isPass = false;
            f.style.border = '1px solid red';
            f.nextElementSibling.innerHTML = '請輸入必填資料';
        }
    }

    let phoneCheck = /^[0][9]\d{8}$/;

    if (phoneCheck.test(phone.value)) {
        console.log("通過");
        // isPass = true;
    } else {
        isPass = false;
        phone.style.border = '1px solid red';
        phone.nextElementSibling.innerHTML = '電話格式錯誤';
    }

    let uniCheck = /^\d{8}$/;
    if (uniCheck.test(uni.value)) {
        console.log("通過");
        // isPass = true;
    } else {
        isPass = false;
        uni.style.border = '1px solid red';
        uni.nextElementSibling.innerHTML = '統一編號格式錯誤';
    }

    let comCheck = /^\d{8}$/;
    if (comCheck.test(com.value)) {
        console.log("通過");
        // isPass = true;
    } else {
        isPass = false;
        com.style.border = '1px solid red';
        com.nextElementSibling.innerHTML = '營業編號格式錯誤';
    }

    if (isPass) {
        fetch('rest_edit1-api.php', {
                method: 'POST',
                body: fd,
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success) {
                    infoBar.classList.remove('alert-danger');
                    infoBar.classList.add('alert-success');
                    infoBar.innerHTML = '編輯成功';
                    infoBar.style.display = 'block';
                    setTimeout(() => {
                        location.href = "./test_page-Norm.php";
                    }, 3000)
                } else {
                    infoBar.classList.remove('alert-success');
                    infoBar.classList.add('alert-danger');
                    infoBar.innerHTML = '沒有編輯';
                    infoBar.style.display = 'block';
                }

                setTimeout(() => {
                    infoBar.style.display = 'none';
                }, 3000);

            }).catch(ex => {
                // console.log(ex)
                infoBar.classList.remove('alert-danger');
                infoBar.classList.add('alert-success');
                infoBar.innerHTML = '新增成功';
                infoBar.style.display = 'block';
                setTimeout(() => {
                    location.href = "./test_page-Norm.php";
                }, 3000)
            })
    }





}
</script>

<?php include "./backend_js_and_endtag.php" ?>