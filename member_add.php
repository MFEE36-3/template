<?php
require './connect_team3_db.php';
$pageName = 'add';
$title = '新增';
?>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="container my-5">
    <div class="row me-3" style="display: flex; justify-content:center">
        <div class="col-lg-6">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body" style="background-color: #ececdf; border-radius: 10px;">
                    <h5 class="card-title" style="color:#0066CC; font-size:30px;">新增會員資料</h5>
                    <form name="form1" onsubmit="checkForm(event)" novalidate enctype="multipart/form-data">

                        <div class="mb-4">
                            <label for="email" class="form-label">帳號 (email)</label>
                            <input placeholder="請輸入您的電子信箱" type="email" class="form-control" id="email" name="email" required>
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">密碼</label>
                            <input placeholder="請輸入至少4個字" type="password" class="form-control" id="password" name="password" pattern=".{4,}" required>
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="form-label">姓名</label>
                            <input placeholder="請輸入至少2個字" type="text" class="form-control" id="name" name="name" required>
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="nickname" class="form-label">暱稱</label>
                            <input placeholder="請輸入至少2個字" type="text" class="form-control" id="nickname" name="nickname" required>
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="mobile" class="form-label">手機</label>
                            <input placeholder="0 9 * * * * * * * *" type="text" class="form-control" id="mobile" name="mobile">
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="birthday" class="form-label">生日</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="2000-01-01">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-4">
                            <label for="file" class="form-label">上傳照片</label>
                            <input type="file" class="form-control" id="file" name="file" accept="image/jpg">
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>

                        <button type="submit" class="btn btn-primary my-3">送出資料</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    const email_re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zAZ]{2,}))$/;

    const checkForm = function(event) {
        event.preventDefault();
        // 欄位外觀回復原來的樣子
        document.form1.querySelectorAll('input').forEach(function(el) {
            el.style.border = '1px solid #CCCCCC';
            el.nextElementSibling.innerHTML = '';
        });


        // TODO: 欄位檢查
        let isPass = true;


        let field = document.form1.email;
        if (!email_re.test(field.value)) {
            isPass = false;
            field.style.border = '2px solid red';
            field.nextElementSibling.innerHTML = '信箱格式錯誤';
        }

        field = document.form1.password;
        if (field.value.length < 4) {
            isPass = false;
            field.style.border = '2px solid red';
            field.nextElementSibling.innerHTML = '密碼格式錯誤';

        }

        field = document.form1.name;
        if (field.value.length < 2) {
            isPass = false;
            field.style.border = '2px solid red';
            field.nextElementSibling.innerHTML = '姓名格式錯誤';
            setTimeout(() => {
                infoBar.style.display = 'none';
            }, 1500);
        }

        field = document.form1.nickname;
        if (field.value.length < 2) {
            isPass = false;
            field.style.border = '2px solid red';
            field.nextElementSibling.innerHTML = '暱稱格式錯誤';
            setTimeout(() => {
                infoBar.style.display = 'none';
            }, 1500);
        }

        field = document.form1.mobile;
        if (!mobile_re.test(field.value)) {
            isPass = false;
            field.style.border = '2px solid red';
            field.nextElementSibling.innerHTML = '手機格式錯誤';
            setTimeout(() => {
                infoBar.style.display = 'none';
            }, 1500);
        }

        if (isPass) {
            const fd = new FormData(document.form1);

            // fetch('member_upload_api.php', {
            //         method: POST,
            //         body: fd,
            //     }), then(r => r.json())
            //     .then(obj => {
            //         console.log(obj)
            //     })

            fetch('member_add_api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json()).then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '新增成功'
                        infoBar.style.display = 'block';

                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '新增失敗'
                        infoBar.style.display = 'block';
                    }
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                        location.href = 'member_info.php';
                    }, 1500);
                })
                .catch(ex => {
                    console.log(ex);
                    infoBar.classList.remove('alert-success')
                    infoBar.classList.add('alert-danger')
                    infoBar.innerHTML = '新增發生錯誤'
                    infoBar.style.display = 'block';
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 1500);
                })

        } else {
            // 沒通過檢查
        }


    }
</script>
<?php include "./backend_js_and_endtag.php" ?>
<?php include './backend_footer.php' ?>