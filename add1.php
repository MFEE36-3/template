<?php include './Norm/connect-db.php'

// $food_categories = [

// ];

?>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<style>
    form .mb-3 .form-text {
        color: red;
    }

    .flex1 {
        display: flex;
        flex-direction: row;
    }

    .flex2 {
        display: flex;
        flex-direction: column;
    }
</style>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid bg-info w-100 overflow-scroll" style="height: 800px;"> <!--這個的class可以自己改掉，給你們看範圍的而已-->


        <div class="container">
            <div class="row">
                <div class="col-11">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">新增資料</h5>

                            <form name="form1" onsubmit="checkForm(event)" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="account" class="form-label">帳號</label>
                                    <input type="text" class="form-control" id="account" name="account" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">密碼</label>
                                    <input type="password" class="form-control" id="password" name="password" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="shop" class="form-label">店名</label>
                                    <input type="text" class="form-control" id="shop" name="shop" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="owner" class="form-label">負責人</label>
                                    <input type="text" class="form-control" id="owner" name="owner" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">種類</label>
                                    <!-- <input type="text" class="form-control" id="category" name="category" data-required="1"> -->
                                    <select name="category" id="category">
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
                                    <input type="file" class="form-control" id="photo" name="photo">
                                    <div class="form-text"></div>
                                    <img src="" alt="" id="myimg">
                                </div>

                                <!-- <div class="mb-3">
                                    <label for="city" class="form-label">城市：</label> -->
                                <!-- <input type="text" class="form-control" id="city" name="city" data-required="1"> -->

                                <!-- <select name="city" id="city" data-required="1">
                                        <option value="台北市">台北市</option>
                                        <option value="新北市">新北市</option>
                                        <option value="桃園市">桃園市</option>
                                    </select>
                                    <div class="form-text"></div>

                                </div>

                                <div class="mb-3">
                                    <label for="area" class="form-label">區域</label>
                                    <input type="text" class="form-control" id="area" name="area" data-required="1">
                                    <div class="form-text"></div>

                                </div> -->
                                <div class="flex1">
                                    <select id="city" name="city" class="me-3">
                                        <option value="">請選擇</option>
                                    </select>


                                    <select id="area" name="area" style="display:none;">
                                        <option value="">請選擇</option>
                                    </select>
                                </div>

                                <!-- <select name="" id="selectCity" onchange="changearea(this.selectedArea)"> -->
                                <!-- <option value="">-請選擇-</option>
                                        <option value="TPE">台北市</option>
                                        <option value="NTC">新北市</option>
                                        <option value="KEL">基隆市</option> -->
                                <!-- </select> -->

                                <!-- <select name="" id="selectarea">
                                        <option value=""></option>
                                    </select> -->

                                <div class="mb-3">
                                    <label for="location" class="form-label">詳細地址</label>
                                    <input type="text" class="form-control" id="location" name="location" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="res_category" class="form-label">餐廳種類</label>
                                    <!-- <input type="text" class="form-control" id="res_category" name="res_category" data-required="1"> -->
                                    <select name="res_category" id="res_category">
                                        <option value="可訂可揪">可訂位也可揪團</option>
                                        <option value="可訂不可揪">可揪團，但不可訂位</option>
                                        <option value="可揪不可訂">可訂位，但不可揪團</option>
                                    </select>
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">電話</label>
                                    <input type="text" class="form-control" id="phone" name="phone" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">email</label>
                                    <input type="text" class="form-control" id="email" name="email" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="uniform_number" class="form-label">公司統一編號</label>
                                    <input type="text" class="form-control" id="uniform_number" name="uniform_number" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="company_number" class="form-label">公司營業編號</label>
                                    <input type="text" class="form-control" id="company_number" name="company_number" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="open_time" class="form-label">營業時間</label>

                                    <select name="open_time" id="opentime" data-required="1">

                                    </select>
                                    <span>-</span>
                                    <select name="close_time" id="closetime" data-required="1">

                                    </select>

                                    <!-- <input type="text" class="form-control" id="open_time" name="open_time" data-required="1"> -->
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3 flex2 ms-1">
                                    <label for="" class="form-label">菜色種類</label>
                                    <!-- <input type="checkbox" name="food_categories" id="food_categories"> -->
                                    <div class="form-check ms-4">
                                        <input class="form-check-input" type="checkbox" name="food_categories[]" value="appetizer" id="appetizer">
                                        <label class="form-check-label ms-0" for="appetizer">前菜</label>
                                    </div>

                                    <div class="form-check ms-4">
                                        <input class="form-check-input" type="checkbox" name="food_categories[]" value="main_dish" id="main_dish">
                                        <label class="form-check-label ms-0" for="main_dish">主菜</label>
                                    </div>

                                    <div class="form-check ms-4">
                                        <input class="form-check-input" type="checkbox" name="food_categories[]" value="side_dish" id="side_dish">
                                        <label class="form-check-label ms-0" for="side_dish">配菜</label>
                                    </div>

                                    <div class="form-check ms-4">
                                        <input class="form-check-input" type="checkbox" name="food_categories[]" value="2" id="drink">
                                        <label class="form-check-label ms-0" for="drink">飲料</label>
                                    </div>

                                    <div class="form-check ms-4">
                                        <input class="form-check-input" type="checkbox" name="food_categories" value="dessert" id="dessert">
                                        <label class="form-check-label ms-0" for="dessert">甜點</label>
                                    </div>
                                </div>

                                <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>
                                <button type="submit" class="btn btn-primary">新增</button>
                        </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<?php include "./backend_footer.php" ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="./city.js"></script>
<script>
    $(document).ready(function() {

        //第一層選單
        $.ajax({
            url: './city1.json',
            type: "get",
            dataType: "json",
            success: function(data) {
                console.log(data);
                $.each(data, function(key, value) {
                    console.log(key, value)
                    $('#city').append('<option value="' + key + '">' + data[key].CityName + '</option>')
                })
            },
            error: function(data) {
                alert("fail");
            }
        });

        //第二層選單
        $("#city").change(function() {
            cityvalue = $("#city").val(); //取值
            $("#area").empty(); //清空上次的值
            $("#area").css("display", "inline"); //顯現
            $.ajax({
                url: './city1.json',
                type: "get",
                dataType: "json",
                success: function(data) {

                    eachval = data[cityvalue].AreaList; //鄉鎮

                    $.each(eachval, function(key, value) {
                        $('#area').append('<option value="' + key + '">' + eachval[key].AreaName + '</option>')
                    });
                },
                error: function() {
                    alert("fail");
                }

            });
        });

        //選完後跳出選擇值
        $("#area").change(function() {
            cityvalue = $("#city").val(); //縣市
            areavalue = $("#area").val(); //鄉鎮
            $.ajax({
                url: './city1.json',
                type: "get",
                dataType: "json",
                // success: function(data) {
                //     alert(data[cityvalue].CityName + "-" + data[cityvalue].AreaList[areavalue].AreaName);
                // },
                // error: function() {
                //     alert("fail");
                // }

            });
        })

    });

    // 縣市選擇器
    console.log(city);
    let selectCity = document.querySelector("#selectCity");
    let selectArea = document.querySelector("#selectarea");

    let cities = ['台北市', '新北市', '基隆市'];

    let areasTPE = [];
    for (i = 0; i <= 11; i++) {
        areasTPE.push(city[0].AreaList[i].AreaName);
    }
    console.log(areasTPE)


    let areasNTC = [];
    for (i = 0; i <= 28; i++) {
        areasNTC.push(city[2].AreaList[i].AreaName);
    }
    console.log(areasNTC)

    let areasKEE = [];
    for (i = 0; i <= 6; i++) {
        areasKEE.push(city[1].AreaList[i].AreaName);
    }
    console.log(areasKEE)

    // let str3;
    // for (let i = 0; i < areasTPE.length; i++) {
    //     str3 += `<option value="${i}">${areasTPE[i]}</option>`;
    // }
    // selectArea.innerHTML = str3;
    // let sectors = new Array();

    // function changearea(index) {
    //     let str4 = "";
    //     for (let i = 0; i < sectors[index].length; i++) {
    //         str4 += `<option value="${i}">${areasTPE[index][i]}</option>`;
    //     }
    // }

    // selectArea.innerHTML = str4;

    // changearea(document.getElementById("#selectarea").selectedArea);

    // selectCity.addEventListener('change', () => {
    //     if (selectCity.children.valuee = 'TPE') {
    //         for (i = 0; i <= 11; i++) {
    //             str3 += `<option value="${i}">${areasTPE[i]}</option>`
    //         }
    //     }

    //     if (selectCity.children.value = 'NTC') {
    //         for (i = 0; i <= 28; i++) {
    //             str3 += `<option value="${i}">${areasNTC[i]}</option>`
    //         }
    //     }
    // })


    // for (i = 0; i <= 11; i++) {
    //     str3 += `<option value="${i}">${areasTPE[i]}</option>`
    // }

    // if (selectCity.children.value = 'NTC') {
    //     for (i = 0; i <= 28; i++) {
    //         str3 += `<option value="${i}">${areasNTC[i]}</option>`
    //     }
    // }



    // if (selectCity.children[1]) {
    //     for (i = 0; i <= 11; i++) {
    //         str3 += `<option value="${i}">${areasTPE[i]}</option>`
    //     }
    // }



    // selectArea.innerHTML = str3;

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

    const accountField = document.querySelector('#account')
    const fields = document.querySelectorAll('form *[data-required="1"]');
    const infoBar = document.querySelector('#infoBar');
    const phone = document.querySelector("#phone");
    const uni = document.querySelector('#uniform_number');
    const com = document.querySelector('#company_number');

    const photo = document.querySelector("#photo");

    function checkForm(event) {

        event.preventDefault();

        const fd = new FormData(document.form1);

        let isPass = true;

        for (let f of fields) {
            f.style.border = '1px solid #CCC';
            f.nextElementSibling.innerHTML = '';
            accountField.style.border = '1px solid #CCC';
            accountField.nextElementSibling.innerHTML = '';
        }

        let phoneCheck = /^[0][9]\d{8}$/;

        if (phoneCheck.test(phone.value)) {
            console.log("通過");
            isPass = true;
        } else {
            isPass = false;
            phone.style.border = '1px solid red';
            phone.nextElementSibling.innerHTML = '電話格式錯誤';
        }

        let uniCheck = /^\d{8}$/;
        if (uniCheck.test(uni.value)) {
            console.log("通過");
            isPass = true;
        } else {
            isPass = false;
            uni.style.border = '1px solid red';
            uni.nextElementSibling.innerHTML = '統一編號格式錯誤';
        }

        let comCheck = /^\d{8}$/;
        if (comCheck.test(com.value)) {
            console.log("通過");
            isPass = true;
        } else {
            isPass = false;
            com.style.border = '1px solid red';
            com.nextElementSibling.innerHTML = '營業編號格式錯誤';
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

        photo.addEventListener('change', function(event) {

            fetch('upload-api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json())
                .then(obj => {
                    if (obj.filename) {
                        document.querySelector("#myimg").src
                    }
                })

        })

        if (isPass) {
            fetch('add1-api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infoBar.classList.remove('alert-danger');
                        infoBar.classList.add('alert-success');
                        infoBar.innerHTML = '新增成功';
                        infoBar.style.display = 'block';
                    } else {
                        infoBar.classList.remove('alert-success');
                        infoBar.classList.add('alert-danger');
                        infoBar.innerHTML = '新增失敗';
                        infoBar.style.display = 'block';
                    }

                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 3000);

                }).catch(ex => {
                    // console.log(ex)
                })
        }



    }
</script>

<?php include "./backend_js_and_endtag.php" ?>