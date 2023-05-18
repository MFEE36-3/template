<?php
$pageName = "add";
$title = "新增";
require './connect_team3_db.php';
$sql = "SELECT article_sid FROM article order by article_sid  desc limit 1";
$stmt = $pdo->query($sql)->fetch();

?>
<?php include './backend_header.php' ?>
<?php include './backend_navbar_and_sidebar.php' ?>
<style>
    form.mb-3.form-text {
        color: red;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增文章</h5>
                    <form name="form1" onsubmit="checkForm(event)">
                        <div class="mb-3">
                            <label for="article_sid" class="form-label">* 文章編號</label>
                            <input type="number" class="form-control" id="article_sid" name="article_sid" data-required="1" min="1" value="<?= $stmt['article_sid'] + 1 ?>" readonly>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">會員編號</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="header" class="form-label">標題</label>
                            <input type="text" class="form-control" id="header" name="header" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">內容</label>
                            <input type="text" class="form-control" id="content" name="content" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <select name="category">
                            <option value="">請選擇文章類別</option>
                            <option value="1">台式</option>
                            <option value="2">美式</option>
                            <option value="3">義式</option>
                            <option value="4">日式</option>
                            <option value="5">韓式</option>
                            <option value="6">港式</option>
                            <option value="7">中式</option>
                            <option value="8">飲料</option>
                            <option value="9">甜點</option>
                            <option value="10">炸物</option>
                        </select>

                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>
                        <button type="submit" class="btn btn-primary ">新增</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include './backend_js_and_endtag.php' ?>
<script>
    const headerField = document.querySelector('#header');
    const fields = document.querySelectorAll('form input');
    const infoBar = document.querySelector("#infoBar")

    function checkForm(event) {
        event.preventDefault();
        for (let f of fields) {
            f.style.border = "1px solid #ccc";
            f.nextElementSibling.innerHTML = ''
        }
        let isPass = true; // 預設值是通過的

        for (let f of fields) {
            if (!f.value) {
                isPass = false;
                f.style.border = "1px solid red";
                f.nextElementSibling.innerHTM = '請填入資料'
            }
        }
        if (headerField.value.length < 2) {
            isPass = false;
            headerField.style.border = '1px solid red';
            headerField.nextElementSibling.innerHTML = '請輸入至少兩個字'
        }


        if (isPass) {
            const fd = new FormData(document.form1); // 沒有外觀的表單
            // const usp = new URLSearchParams(fd); // 可以轉換為 urlencoded 格式
            // console.log(usp.toString());


            fetch('article-add-api.php', {
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
                            location.href = './list_page.php';
                        }, 2000);
                    } else {
                        infoBar.classList.remove('alert-success')
                        infoBar.classList.add('alert-danger')
                        infoBar.innerHTML = "新增失敗"
                        infoBar.style.display = 'none'
                    }
                })


                .catch(ex => {
                    console.log(ex);
                    infoBar.classList.remove('alert-success')
                    infoBar.classList.add('alert-danger')
                    infoBar.innerHTML = "新增發生錯誤"
                    infoBar.style.display = 'block';
                    setTimeout(() => {
                        infoBar.style.display = 'none';
                    }, 2000);
                })

        } else {
            // 沒通過檢查
        }


    };
</script>
<?php include './backend_footer.php' ?>