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
    <title>Document</title>
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
        }

        100% {
            transform: translateX(0px);
        }
    }

    .move1 {
        animation: move1 linear 1s;
    }

    @keyframes move2 {

        0% {
            transform: translateX(50px);
        }

        100% {
            transform: translateX(0px);
        }
    }

    .move2 {
        animation: move2 linear 1s;
    }

    @keyframes move3 {

        0% {
            transform: translateX(-100px);
        }

        100% {
            transform: translateX(0px);
        }
    }

    .move3 {
        animation: move3 linear 1s;
    }

    #form1 {
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 15px;
    }

    input {
        width: 200px;
        height: 30px;
        box-sizing: border-box;
        border-radius: 5px;
        border: none;
        padding: 5px 15px;
    }

    input:focus {
        width: 200px;
        height: 30px;
        box-sizing: border-box;
        border: none;
        outline: none;
        border: 2px solid lightcoral;
    }

    .btn-primary {
        background-color: navy;
        transition: 0.5s ease-in-out;
    }

    .btn-primary:hover {
        transform: scale(1.1);
    }
</style>

<body>
    <div class="d-flex flex-column" id="div1">
        <div class="text-center d-flex align-items-center justify-content-center">
            <img src="images/logo.svg" class="move1" alt="logo" style="width:200px;height:200px;filter: drop-shadow(16px 16px 50px red) invert(100%) hue-rotate(180deg);" />
            <span style="color:rgb(219, 114, 16);font-family: 'Noto Sans JP', sans-serif;" class="move2">食 </span>
            <span style="text-shadow:0 0 5px gold,1px 1px 5px gold,-1px -1px 5px gold,-1px 1px 5px gold,1px -1px 5px gold;font-family: 'Source Code Pro', monospace;color:#27367f" class="me-1">GO</span>
            <span class="text-danger move3" style="font-family: 'Source Code Pro', monospace;">EAT!</span>
        </div>
        <button class="btn btn-primary" id="login" style="width:100px">登入</button>
        <div id="show_input" style="display:none">
            <form action="" id="form1" class="d-flex flex-column p-5">
                <label for="email" class="fw-bold ms-2 mb-1" style="font-family: 'Noto Sans JP', sans-serif;">帳號</label>
                <input type="text" id="email" name="email">
                <label for="password" class="fw-bold ms-2 mb-1 mt-2" style="font-family: 'Noto Sans JP', sans-serif;">密碼</label>
                <input type="password" id="password" name="password">
            </form>
        </div>
    </div>






    <script>
        const btn1 = document.getElementById('login');
        btn1.addEventListener('click', () => {
            btn1.style.display = "none";
            show_input.style.display = "block";
        })
    </script>


    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>