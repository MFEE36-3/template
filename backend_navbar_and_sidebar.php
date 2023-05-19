<?php

if (!isset($_SESSION)) {
    session_start();
}

?>


<style>
    .navbar {
        box-shadow: none;
    }

    .sidebar .nav:not(.sub-menu)>.nav-item:hover>.nav-link {
        background-color: #313131;
        font-weight: bold;
    }

    .sidebar .nav.sub-menu {
        background-color: #313131;
    }

    .sidebar .nav:not(.sub-menu)>.nav-item>.nav-link[aria-expanded="true"] {
        background-color: #313131;
    }

    .scale_logo {
        transform: scale(1.2);
    }

    .sidebar .nav .nav-item.active>.nav-link {
        background-color: #313131;
    }

    .sidebar .nav:not(.sub-menu)>.nav-item.active {
        background-color: #313131;
    }

    .btn-logout div {
        animation: btn_go linear infinite 2s;
    }

    .btn-logout {
        transition: 1s ease-in-out;
    }

    .btn-logout:hover {
        box-shadow: 0 0 0 5px gold;
        transform: scale(1.1) rotate(10deg);
    }


    @keyframes btn_go {
        0% {
            color: white;
        }

        50% {
            color: #313131;
        }

        100% {
            color: white;
        }
    }
</style>

<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background-color:#d9d9d9;">
        <a class="navbar-brand brand-logo scale_logo" href="./index_after_login.php"><img src="images/logo.svg" class="" alt="logo" /> <span style="color:rgb(219, 114, 16);font-family: 'Noto Sans JP', sans-serif;">食 </span><span style="text-shadow:0 0 5px gold,1px 1px 5px gold,-1px -1px 5px gold,-1px 1px 5px gold,1px -1px 5px gold;font-family: 'Source Code Pro', monospace;" class="me-1">GO</span><span class="text-danger" style="font-family: 'Source Code Pro', monospace;">EAT!</span></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo.svg" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background-color:#D9D9D9;">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            <!-- <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search" />
                </div>
            </li> -->
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">
                        Notifications
                    </p>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="ti-info-alt mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">
                                Application Error
                            </h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                                Just now
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-warning">
                                <i class="ti-settings mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Settings</h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                                Private message
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-info">
                                <i class="ti-user mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">
                                New user registration
                            </h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                                2 days ago
                            </p>
                        </div>
                    </a>
                </div>
            </li>
            <div class="d-flex align-items-center">
                <div class="d-flex justify-content-center align-items-center overflow-hidden me-1" style="height:45px;width:45px;border-radius:50%;border:5px solid #313131">
                    <img src="./images/<?= $_SESSION['admin_member']['photo'] ?>" alt="<?= $_SESSION['admin_member']['name'] ?>" class="w-100" style="" title="Hi! <?= $_SESSION['admin_member']['nickname'] ?>">
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center me-3">
                    <span style="font-family: 'Noto Sans JP', sans-serif;font-size:20px;"><?= $_SESSION['admin_member']['nickname'] ?></span><span class="mx-2">登入中</span>
                </div>
                <button class="btn btn-primary px-3 py-2 border-0 btn-logout fw-bold" style="background-color:#313131;color:#313131;font-size:16px" id="logout_btn">
                    <div class="d-flex align-items-center justify-content-center"><i class="fa-solid fa-ghost me-2"></i>登出</div>
                </button>
            </div>
            <li class="nav-item nav-settings d-none d-lg-flex">
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>

<!-- partial -->
<div class="container-fluid page-body-wrapper" style="position:absolute; top:0">
    <!-- 改這邊 -->
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar" style="position:fixed; top:60px;background-color:#d9d9d9;">
        <!-- 改這邊 -->
        <ul class="nav" style="position:absolute; top:0;width:80%">
            <!-- 改這邊 -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">會員</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="./member_info.php?">
                                會員資訊
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./member_add.php?">
                                新增會員
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                    <i class="icon-columns menu-icon"></i>
                    <span class="menu-title">餐廳管理</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="form-elements">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="./rest_add1.php">新增商家</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./test_page-Norm.php">商家管理</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">訂單管理</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="./booking.php">查詢訂單</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./add-m.php">新增訂單</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./chart-m.php">報表</a>
                        </li>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                    <i class="icon-bar-graph menu-icon"></i>
                    <span class="menu-title">討論區管理</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="./article-add.php">新增文章</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./list_page.php">文章列表</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                    <!-- <i class="icon-contract menu-icon"></i> -->
                    <i class="fa-solid fa-ticket icon-contract menu-icon"></i>
                    <span class="menu-title">優惠券管理</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="icons">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="./dai_coupon_page.php">優惠券列表</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./dai_add_coupon_page.php">新增優惠券</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./coupon_chart.php">熱門優惠券</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                    <i class="fa-brands fa-shopify icon-contract menu-icon"></i>
                    <span class="menu-title">商城管理</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="icons">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="./kaishop.php">商品管理</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <div class="main-panel" style="position:absolute;background-color:rgb(250,250,248)">
        <!-- 改這邊 -->

        <script>
            let logoutBtn = document.getElementById('logout_btn');
            logoutBtn.addEventListener('click', () => {
                <?php unset($_SESSION['admin']) ?>;
                location.href = "./login.php";
            })
        </script>