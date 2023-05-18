<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php require './connect_team3_db.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Noto+Sans+JP:wght@900&family=Source+Code+Pro:wght@900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./images/favicon.ico" />
    <title>食 GO EAT!</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    #div1 {
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        background-image: url('./images/login_back.jpg');
        margin: auto;
        justify-content: center;
        align-items: center;
    }

    span {
        font-size: 100px;
    }

    @keyframes move1 {

        0% {
            transform: translateX(300px);
            opacity: 0;
        }

        100% {
            transform: translateX(0px);
            opacity: 1;
        }
    }

    .move1 {
        animation: move1 linear 1s;
    }

    @keyframes move2 {

        0% {
            transform: translateX(50px);
            opacity: 0;
        }

        100% {
            transform: translateX(0px);
            opacity: 1;
        }
    }

    .move2 {
        animation: move2 linear 1s;
    }

    @keyframes move3 {

        0% {
            transform: translateX(-100px);
            opacity: 0;
        }

        100% {
            transform: translateX(0px);
            opacity: 1;
        }
    }

    .move3 {
        animation: move3 linear 1s;
    }

    @keyframes move4 {

        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .move4 {
        animation: move4 linear 1s;
    }

    #form1 {
        background-color: rgba(255, 255, 255, 0.4);
        border-radius: 15px;
    }

    input {
        width: 200px;
        height: 30px;
        box-sizing: border-box;
        border-radius: 5px;
        border: none;
        padding: 5px 15px;
        border: 5px solid gold;
        transition: 3s ease-in-out;
        color: white;
        font-weight: bold;
    }

    #form1 input:focus {
        width: 200px;
        height: 30px;
        box-sizing: border-box;
        border: none;
        outline: none;
        background-color: tomato;
    }

    .btn-primary {
        background-color: navy;
        transition: 0.5s ease-in-out;
    }

    .btn-primary:hover {
        transform: scale(1.5);
        border-radius: 50px;
        font-weight: 900;
    }

    #show_input {
        height: 0px;
        overflow: hidden;
        transition: 1s ease-in-out;
    }

    label {
        color: tomato;
        transition: 3s ease-in-out;
    }

    #p1 {
        background-color: lightgoldenrodyellow;
        border-radius: 15px;
        width: 150px;
    }

    #myDialog::backdrop {
        background-color: rgba(0, 0, 0, 0.6);
    }

    #myDialog {
        margin: auto;
        text-align: center;
        width: 300px;
        height: 300px;
        background-color: rgb(1, 180, 104);
        border-radius: 50%;
        border: none;
        /* border: 15px 15px white;
        box-shadow:
            2px 2px 5px black, */
    }

    #badDialog::backdrop {
        background-color: rgba(0, 0, 0, 0.6);
    }

    #badDialog {
        margin: auto;
        width: 300px;
        height: 300px;
        background-color: rgb(255, 81, 5);
        border-radius: 50%;
        border: none;
        /* border: 5px 5px white;
        box-shadow:
            2px 2px 5px black, */
    }

    .p_login {
        font-size: 80px;
    }
</style>

<body>
    <div class="d-flex flex-column" id="div1">
        <div class="text-center d-flex align-items-center justify-content-center">
            <img src="images/logo.svg" class="move1" alt="logo" style="width:200px;height:200px;filter: drop-shadow(16px 16px 50px red) invert(100%) hue-rotate(180deg);" />
            <span style="color:rgb(219, 114, 16);font-family: 'Noto Sans JP', sans-serif;" class="move2">食 </span>
            <span style="text-shadow:0 0 5px gold,1px 1px 5px gold,-1px -1px 5px gold,-1px 1px 5px gold,1px -1px 5px gold;font-family: 'Source Code Pro', monospace;color:#27367f" class="me-1 move4">GO</span>
            <span class="text-danger move3" style="font-family: 'Source Code Pro', monospace;">EAT!</span>
        </div>
        <button class="btn btn-primary" id="login" style="width:100px">登入</button>
        <div id="show_input">
            <form id="form1" class="d-flex flex-column p-5" name="form1" onsubmit="check_password(event)">
                <label for="email" class="fw-bold ms-2 mb-1" style="font-family: 'Noto Sans JP', sans-serif;">帳號</label>
                <input type="text" id="email" name="email">
                <p id="p1" class="text-danger fw-bold text-center mt-2 ms-4"></p>
                <label for="password" class="fw-bold ms-2 mb-1 mt-2" style="font-family: 'Noto Sans JP', sans-serif;">密碼</label>
                <input type="password" id="password" name="password">
                <button class="btn btn-danger mt-3 text-center fw-bold" id="check" style="width:100px">GO!</button>
            </form>
        </div>
        <dialog id="myDialog">
            <div class="d-flex flex-column justify-content-center align-items-center mt-4">
                <div class="" style="width:200px">
                    <p class="text-white fw-bold text-center p_login m-0">登入成功</p>
                </div>
            </div>
        </dialog>
        <dialog id="badDialog">
            <div class="d-flex flex-column justify-content-center align-items-center mt-4">
                <div class="" style="width:200px">
                    <p class="text-white fw-bold text-center p_login m-0">登入失敗</p>
                </div>
            </div>
        </dialog>
    </div>






    <script>
        const btn1 = document.getElementById('login');
        const labels = document.querySelectorAll('label');
        const inputs = document.querySelectorAll('input');
        const email_input = document.getElementById('email');
        const email_check = /^[^@\.]+@([^@\.]+\.)+[^@\.]{2,3}$/;
        const p1 = document.getElementById('p1');

        btn1.addEventListener('click', () => {
            btn1.style.display = "none";
            show_input.style.display = "block";
            show_input.style.height = "300px";
            labels[0].style.color = "black";
            labels[1].style.color = "black";
            inputs[0].style.border = "2px solid transparent";
            inputs[1].style.border = "2px solid transparent";
        })

        let ispass = true;

        email_input.addEventListener('change', () => {
            if (email_check.test(email_input.value) == true) {
                p1.innerHTML = `帳號格式正確`;
            } else {
                p1.innerHTML = `請檢查帳號格式`;
                ispass = false;
            }
            setTimeout(() => {
                p1.innerHTML = "";
            }, 2000);
        })

        function check_password(event) {
            event.preventDefault();

            if (ispass) {
                const fd = new FormData(document.form1);

                fetch('login_api.php', {
                        method: 'POST',
                        body: fd //可以省略Content-type  multipart form/data
                    })
                    .then(r => r.json())
                    .then(obj => {
                        console.log(obj);
                        if (obj.success) {
                            myDialog.showModal();
                            setTimeout(() => {
                                let content = JSON.stringify(obj.ses);
                                location.href = './index_after_login.php';
                            }, 2000);
                        } else {
                            badDialog.showModal();
                            setTimeout(() => {
                                badDialog.close()
                            }, 2000);
                        }

                    })

            };

        }
    </script>


    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>