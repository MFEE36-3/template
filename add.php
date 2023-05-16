<?php
$pageName = "add";
$title = "新增";
require './connectwei-db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $header = $_POST['header'];
    $content = $_POST['content'];
    $cate = $_POST['cate'];

    // Perform validation and data processing here

    // Assuming validation and data processing are successful
    $sql = "INSERT INTO article (user_id, header, content,category) VALUES (?, ?, ?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $header, $content, $cate]);

    $result = array('success' => true);
    //echo json_encode($result);
}
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
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">* 使用者編號</label>
                            <input type="number" class="form-control" id="name" name="name" data-required="1" min="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="header" class="form-label">標題</label>
                            <input type="text" class="form-control" id="header" name="header" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3 h-100 w-100">
                            <label for="content" class="form-label">內容</label>
                            <input type="text" class="form-control" id="content" name="content" data-required="1">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3 h-100 w-100">
                            <label for="cate" class="form-label">類別</label>
                            <input type="number" class="form-control" id="cate" name="cate" data-required="1" min="1">
                            <div class="form-text"></div>
                        </div>

                        <div class="alert alert-danger" role="alert" id="infoBar" style="display:none"></div>
                        <button type="submit" class="btn btn-primary" id="btn1">新增</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include './backend_js_and_endtag.php' ?>
<script>
    const btn_sumbit = document.getElementById('btn1');
    btn_sumbit.addEventListener('click', () => {
        alert("新增成功!");
    });








    const nameField = document.querySelector('#name');
    const fields = document.querySelectorAll('form input');
    const infoBar = document.querySelector('#infoBar')

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
        if (nameField.value.length < 2) {
            isPass = false;
            nameField.style.border = '1px solid red';
            nameField.nextElementSibling.innerHTML = '請輸入至少兩個字'
        }

        if (isPass) {
            const fd = new FormData(document.form1); // 沒有外觀的表單
            // const usp = new URLSearchParams(fd); // 可以轉換為 urlencoded 格式
            // console.log(usp.toString());

            fetch('add-api.php', {
                    method: 'POST',
                    body: fd, // Content-Type 省略, multipart/form-data
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infoBar.classList.remove('alert-danger')
                        infoBar.classList.add('alert-success')
                        infoBar.innerHTML = '新增成功'
                        infoBar.style.display = 'block'
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


    }
</script>
<?php include './backend_footer.php' ?>