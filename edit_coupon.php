<?php
include "./connect_team3_db.php";

$sid = isset($_GET['coupon_sid']) ? intval($_GET['coupon_sid']) : 0;
$sql = "SELECT * FROM coupon WHERE coupon_sid = {$sid}";

$rows = $pdo->query($sql)->fetch();

if (empty($rows)) {
    header("Location: dai_coupon_page.php");
    exit;
}

$come_from = 'dai_coupon_page.php';

if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}

?>
<?php include "./backend_header.php" ?>
<style>
    .dai_add_coupon {
        width: 300px;
        height: 380px;
        border-radius: 20px;
        box-shadow: 0px 0px 0px 5px white inset;
        border: 5px solid slategray;
    }

    .dai_h2 {
        font-family: 'Noto Sans JP', sans-serif;
        letter-spacing: 5px;
        color: white;
        text-shadow: 0 0 5px goldenrod, 2px 2px 5px goldenrod, -2px -2px 5px goldenrod, 2px -2px 5px goldenrod, -2px 2px 5px goldenrod;
    }

    .dai_h3 {
        color: gray;
        font-size: 20px;
        padding: 0;
        margin: 0;
        text-align: justify;
    }

    .content_box {
        width: 80%;
        margin-top: 10px;
        background-color: rgba(255, 255, 255, 0.5);
        padding: 10px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }


    .empty_dai .pagination .page-item:hover .page-link {
        background-color: #FFFF93;
        color: orangered;
        border: 2px solid orangered;
        transform: scale(1.1);
    }

    .empty_dai .pagination .page-item .page-link {
        transition: 0.3s ease-in-out;
    }

    .empty_dai2 .pagination .page-item:hover .page-link {
        background-color: lightskyblue;
        color: white;
        border: 2px solid gray;
    }

    .empty_dai2 .page-link.active {
        color: white;
    }

    .dai_icon {
        line-height: 100px;
        font-size: 20px;
    }


    #addcoupon input {
        padding: 5px;
        background-color: #ECF5FF;
        border: none;
        border-radius: 15px;
        padding-left: 10px;
        box-sizing: border-box;
        font-weight: 600;
    }


    #addcoupon input:hover {
        box-shadow: 0px 0px 0px 2px #46A3FF inset;
    }

    #addcoupon textarea {
        padding: 15px 15px;
        background-color: #ECF5FF;
        border: none;
        border-radius: 5px;
        box-sizing: border-box;
        color: #46A3FF;
        font-weight: 600;
    }

    #addcoupon textarea:hover {
        box-shadow: 0px 0px 0px 2px #46A3FF inset;
    }

    #addcoupon .btn-primary {
        background-color: green;
        border: none;
        transition: 0.3s ease-in-out;
    }

    #addcoupon .btn-primary:hover {
        transform: scale(1.1);
        border: 5px solid lightgreen;
    }

    #myDialog::backdrop {
        background-color: rgba(0, 0, 0, 0.6);
    }

    #myDialog {
        width: 500px;
        height: 200px;
        background-color: rgba(217, 217, 217, 0.9);
        border-radius: 15px;
        border: none;
        box-shadow:
            5px 5px 15px black;
    }

    @keyframes rocket_fly {

        25% {
            transform: translate(30px, -30px) rotate(-90deg) scale(1.2);
        }

        50% {
            transform: translate(-30px, -30px) rotate(-180deg) scale(1.5);
        }

        75% {
            transform: translate(-30px, 30px) rotate(-270deg) scale(1.8);
        }

        100% {
            transform: translate(30px, 30px) rotate(-360deg) scale(2.0);
        }
    }

    .backrocket {
        transition: 1s ease-in-out;
    }

    .backrocket:hover {
        color: tomato;
        animation: rocket_fly linear forwards 2s;
    }
</style>

<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid w-100 d-flex flex-column justify-content-center align-items-center"> <!--這個的class可以自己改掉，給你們看範圍的而已-->
        <div class="d-flex flex-column align-items-center justify-content-center empty_dai w-100" style="flex:auto;margin-top:-150px">

            <?php $c = sprintf("rgb(%s,%s,%s)", rand(100, 255), rand(100, 255), rand(100, 255)); ?>

            <form id="addcoupon" name="addcoupon" onsubmit="check_form(event)" style="margin-top:200px">
                <div>
                    <div class="d-flex flex-column justify-content-center align-items-center dai_add_coupon" style="background-color:<?= $c ?>;">

                        <input type="text" class="d-none" name="coupon_sid" value="<?= $rows['coupon_sid'] ?>">

                        <label class="dai_h2 fs-4" for="coupon_title">優惠券名稱</label>
                        <input type="text" name="coupon_title" id="coupon_title" maxlength="10" style="padding-left:15px" data-required="1" value="<?= htmlentities($rows['coupon_title']) ?>">
                        <p class="p_fade text-danger bg-warning mt-1 px-2 fw-bold" id="warning_text1"></p>
                        <div class="content_box d-flex flex-column">
                            <label class="dai_h3 mb-2 fw-bold" for="coupon_content">寫點內容</label>
                            <textarea name="coupon_content" id="coupon_content" style="height:100px;width:200px" maxlength="200" data-required="1"><?= htmlentities(trim($rows['coupon_content'])) ?></textarea>
                            <p class="p_fade text-danger bg-warning mt-1 px-2 fw-bold" id="warning_text2"></p>
                        </div>
                        <div d-flex>
                            <label class="fw-bold mt-2 fs-6" for="discount">折扣金額</label>
                            <input type="number" id="discount" name="discount" style="width:50px" min="10" max="50" step="10" value="<?= $rows['coupon_discount'] ?>">
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-4 ">
                        <label for="day" class="fw-bold text-center fs-2 mb-0">使用期限：</label>
                        <input type="number" name="day" id="day" style="height:30px;width:50px" min="1" max="99" value="<?= $rows['coupon_deadline'] ?>">
                        <label class="fw-bold text-center fs-2 mb-0 ms-1">天</label>
                    </div>

                    <div style="height:100px" class="d-flex justify-content-center align-items-center">

                        <button type="submit" class="btn btn-primary">確定編輯</button>
                        <button id="btn1" type="button" class="btn btn-primary ms-2" style="color:white;background-color:gray;border:none">清除重填</button>
                        <a href="<?= $come_from ?>" title="不想編輯了~回上一頁" class="ms-3 fs-2 backrocket"><i class="fa-solid fa-rocket"></i></a>

                    </div>
                    <div class="alert alert-danger text-center" role="alert" id="infoBar" style="display:none"></div>
                </div>
            </form>
            <dialog id="myDialog">
                <div class="d-flex flex-column justify-content-center align-items-center mt-4">
                    <div class="w-100">
                        <p class="text-danger fw-bold fs-4 text-center mt-3">~~優惠券編輯完成囉~~</p>
                    </div>
                    <div class="w-100 d-flex justify-content-center mt-3">
                        <button class="btn btn-warning me-3 fw-bold" id="closeDialog">重新編輯</button>
                        <button class="btn btn-success fw-bold" id="redirection">回去看看</button>
                    </div>
                </div>
            </dialog>
        </div>
    </div>
</div>

<?php include "./backend_footer.php" ?>

<script>
    // onchange就提示你要填東西
    const input_title = document.getElementById("coupon_title")
    const input_content = document.getElementById("coupon_content")

    input_title.addEventListener('change', () => {
        if (input_title.value.length < 4) {
            warning_text1.innerHTML = '想個至少4個字的響亮亮名稱吧!';
            setTimeout(() => {
                warning_text1.innerHTML = '';
            }, 1500)
        }
    })

    input_content.addEventListener('change', () => {
        if (input_content.value.length < 5) {
            warning_text2.innerHTML = '好歹寫個5個字以上的說明吧...';
            setTimeout(() => {
                warning_text2.innerHTML = '';
            }, 1500)
        }
    })




    const coupon_page = <?= isset($_GET['coupon_sid']) ? intval($_GET['coupon_sid']) : 1 ?>



    const btn1 = document.getElementById("btn1");
    const title1 = document.getElementById("coupon_title");
    const content1 = document.getElementById("coupon_content");
    const closeDialogButton = document.getElementById("closeDialog");
    const redirection_to_coupon = document.getElementById("redirection");
    closeDialogButton.addEventListener("click", () => {
        myDialog.close();
    });
    redirection_to_coupon.addEventListener("click", () => {
        myDialog.close();
        window.location = "./dai_coupon_page.php?page=" + coupon_page;
    });

    btn1.addEventListener('click', () => {
        title1.value = "";
        content1.value = "";
    });





    const name_field = document.querySelector('#name');
    const fields = document.querySelectorAll('[data-required="1"]')

    function check_form(event) {
        event.preventDefault();

        // reset 表單樣式
        // for (let f of fields) {
        //     f.style.border = '1px solid #CCC';
        //     f.nextElementSibling.innerHTML = '';
        // }
        // name_field.style.border = '1px solid #CCC';
        // name_field.nextElementSibling.innerHTML = '';

        //TODO: 檢查資料格式

        let ispass = true; //預設值為通過 有不合資料格式再改false

        for (let f of fields) {
            if (!f.value) {
                ispass = false;
                f.style.border = '2px solid red';
                f.nextElementSibling.innerHTML = '請輸入內容';
            }
            setTimeout(() => {
                f.style.border = '1px solid #CCC';
                warning_text1.innerHTML = '';
                warning_text2.innerHTML = '';
            }, 2000);
        }



        // if (name_field.value.length < 2) {
        //     ispass = false;
        //     name_field.style.border = '1px solid red';
        //     name_field.nextElementSibling.innerHTML = '請輸入至少2個字';
        // }


        if (ispass) {

            const fd = new FormData(document.addcoupon); //建一個沒有實體的表單物件(可以拿到表單的全部元素&data)

            //const sup = new URLSearchParams(fd); //把表單data變成querystring (urlencoded)
            //console.log(sup.toString());

            fetch('./editcoupon_api.php', {
                    method: 'POST',
                    body: fd //可以省略Content-type  multipart form/data
                })
                //.then(r => r.text())
                //.then(txt => console.log(txt))
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        // infoBar.style.display = "block";
                        // infoBar.classList.remove('alert-danger');
                        // infoBar.classList.add('alert-success');
                        // infoBar.innerHTML = "新增成功~~~~";
                        myDialog.showModal();
                    } else {
                        infoBar.style.display = "block";
                        infoBar.classList.remove('alert-success');
                        infoBar.classList.add('alert-danger');
                        infoBar.innerHTML = "你沒動內容捏ˊˋ";
                    }
                    setTimeout(() => {
                        infoBar.style.display = "none";
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
                });
        }
    }
</script>
<?php include "./backend_js_and_endtag.php" ?>