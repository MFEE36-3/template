<?php

$title = "編輯";
require './connect_team3_db.php';


$sid = isset($_GET['article_sid']) ? intval($_GET['article_sid']) : 0;
$sql = "SELECT * FROM article WHERE article_sid={$sid}";

$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location:list_page.php');
}

?>
<?php include './backend_header.php' ?>
<?php include './backend_navbar_and_sidebar.php' ?>
<style>
    form.mb-3.form-text {
        color: red;
    }
</style>

<div class="container mb-auto">
    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col-6 mt-5">
            <div class="card p-3 d-flex flex-column">

                <div class="card-body">
                    <h5 class="card-title">編輯資料</h5>
                    <form name="form1" onsubmit="checkForm(event)">
                        <input type="hidden" name="article_sid" value="<?= $r['article_sid'] ?>">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">* 文章編號</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" data-required="1" value="<?= htmlentities($r['user_id']) ?> " readonly>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="header" class="form-label">標題</label>
                            <input type="text" class="form-control" id="header" name="header" data-required="1" value="<?= htmlentities($r['header']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">內容</label>
                            <textarea class="form-control" id="content" name="content" style="height:200px" data-required="1"><?= htmlentities($r['content']) ?></textarea>
                            <div class="form-text"></div>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="category" class="form-label">類別</label>
                            <input type="text" class="form-control" id="category" name="category" data-required="1" value="<?= htmlentities($r['category']) ?>">
                            <div class="form-text"></div>
                        </div> -->
                        <select name="category" class="d-block">
                            <option value="">請選擇文章類別</option>
                            <option value=" 1">台式</option>
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
                        <button type="submit" class="btn btn-primary mt-5">編輯</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include './backend_js_and_endtag.php' ?>
<script>
    // const nameField = document.querySelector('#name');
    const infoBar = document.querySelector('#infoBar');
    // 取得必填欄位
    const fields = document.querySelectorAll('form *[data-required="1"]');

    function checkForm(event) {
        event.preventDefault();

        // for (let f of fields) {
        //     f.style.border = '1px solid #ccc';
        //     f.nextElementSibling.innerHTML = ''
        // }
        // nameField.style.border = '1px solid #CCC';
        // nameField.nextElementSibling.innerHTML = ''

        // let isPass = true; // 預設值是通過的

        // TODO: 檢查欄位資料

        /*
        // 檢查必填欄位
        for(let f of fields){
            if(! f.value){
                isPass = false;
                f.style.border = '1px solid red';
                f.nextElementSibling.innerHTML = '請填入資料'
            }
        }
        */


        // if (nameField.value.length < 2) {
        //     isPass = false;
        //     nameField.style.border = '1px solid red';
        //     nameField.nextElementSibling.innerHTML = '請輸入至少兩個字'
        // }

        // if (isPass) {
        const fd = new FormData(document.form1); // 沒有外觀的表單
        // const usp = new URLSearchParams(fd); // 可以轉換為 urlencoded 格式
        // console.log(usp.toString());

        fetch('edit-api.php', {
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
                        location.href = './list_page.php';
                    }, 1000);

                } else {
                    infoBar.classList.remove('alert-success')
                    infoBar.classList.add('alert-danger')
                    infoBar.innerHTML = '資料沒有編輯'
                    infoBar.style.display = 'block';
                }
                setTimeout(() => {
                    infoBar.style.display = 'none';
                }, 2000);
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

        // } else {
        //     // 沒通過檢查
        // }


    }
</script>
<?php include './backend_footer.php' ?>