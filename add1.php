<?php include './Norm/connect-db.php' ?>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<style>
    form .mb-3 .form-text {
        color: red;
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

                            <form name="form1" onsubmit="checkForm(event)">
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
                                    <input type="text" class="form-control" id="category" name="category" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="photo" class="form-label">照片</label>
                                    <input type="text" class="form-control" id="photo" name="photo" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="city" class="form-label">城市</label>
                                    <input type="text" class="form-control" id="city" name="city" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="area" class="form-label">區域</label>
                                    <input type="text" class="form-control" id="area" name="area" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">詳細地址</label>
                                    <input type="text" class="form-control" id="location" name="location" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="res_category" class="form-label">餐廳種類</label>
                                    <input type="text" class="form-control" id="res_category" name="res_category" data-required="1">
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
                                    <input type="text" class="form-control" id="open_time" name="open_time" data-required="1">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="food_categories" class="form-label">菜色分類</label>
                                    <input type="text" class="form-control" id="food_categories" name="food_categories" data-required="1">
                                    <div class="form-text"></div>
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

<script>
    const accountField = document.querySelector('#account')
    const fields = document.querySelectorAll('form *[data-required="1"]');
    const infoBar = document.querySelector('#infoBar');

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