<?php
require './connect.php';
$pageName = 'update';
$title = '編輯';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$sql = "SELECT * FROM member_info WHERE sid={$sid}";
$sql_mem_info = "SELECT * FROM member_level";
$stmt_mem_info = $pdo->query($sql_mem_info)->fetchAll();


$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: test_page_member_info.php');
    exit;
}
?>

<?php include './backend_header.php' ?>
<?php include './backend_navbar_and_sidebar.php' ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">

                <div class="card-body mt-3">
                    <h5 class="card-title" style="color:#0066CC; font-size:30px;">編輯會員資料</h5>
                    <form name="form1" onsubmit="checkForm(event)" novalidate>


                        <div class="mb-4">
                            <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">帳號 (email)</label>
                            <input value="<?= htmlentities($r['account']) ?>" type="email" class="form-control" id="email" name="email" required>
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">密碼</label>
                            <input value="<?= htmlentities($r['password']) ?>" type="password" class="form-control" id="password" name="password" pattern=".{4,}" required>
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="form-label">姓名</label>
                            <input value="<?= htmlentities($r['name']) ?>" type="text" class="form-control" id="name" name="name" required>
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="nickname" class="form-label">暱稱</label>
                            <input value="<?= htmlentities($r['nickname']) ?>" type="text" class="form-control" id="nickname" name="nickname" required>
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="mobile" class="form-label">手機</label>
                            <input value="<?= htmlentities($r['mobile']) ?>" type="text" class="form-control" id="mobile" name="mobile">
                            <div class="form-text ms-1" style="color:red; font-size:12px"></div>
                        </div>

                        <div class="mb-4">
                            <label for="birthday" class="form-label">生日</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?= htmlentities($r['birthday']) ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-4">
                            <label for="level" class="form-label">會員等級</label>
                            <select class="form-select" name="level">
                                <?php foreach ($stmt_mem_info as $item) : ?>
                                    <option value="<?= $item['sid'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-4">
                            <label for="wallet" class="form-label">錢包餘額</label>
                            <input type="number" min="0" class="form-control" id="wallet" name="wallet" value="<?= htmlentities($r['wallet']) ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>

                        <button type="submit" class="btn btn-primary my-3">確認修改</button>
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
        }

        field = document.form1.nickname;
        if (field.value.length < 2) {
            isPass = false;
            field.style.border = '2px solid red';
            field.nextElementSibling.innerHTML = '暱稱格式錯誤';
        }

        field = document.form1.mobile;
        if (!mobile_re.test(field.value)) {
            isPass = false;
            field.style.border = '2px solid red';
            field.nextElementSibling.innerHTML = '手機格式錯誤';
        }



        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('test_page_update_api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json()).then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '編輯成功'
                        infoBar.style.display = 'block';

                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = '資料沒有編輯'
                        infoBar.style.display = 'block';
                    }
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                        location.href = 'test_page_member_info.php';
                    }, 1500);
                })
                .catch(ex => {
                    console.log(ex);
                    infoBar.classList.remove('alert-success')
                    infoBar.classList.add('alert-danger')
                    infoBar.innerHTML = '編輯發生錯誤'
                    infoBar.style.display = 'block';
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 1500);
                });

        } else {
            // 沒通過檢查
        }


    }
</script>

<?php include './backend_footer.php' ?>