<pre>
    <?php

    require './connect_team3_db.php';


    $perPage = 7;
    $page = 1;

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    if ($page < 1) {
        header('Location: test_page-Norm.php');
        exit;
    };



    $sql = sprintf("SELECT * FROM shops ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();

    // $res = $rows[6]['food_categories'];
    // print_r($rows);
    // echo gettype($res);
    // exit;

    $t_sql = "SELECT COUNT(1) FROM combination";
    // $t_row = $pdo->query($t_sql)->fetch();
    // echo gettype($t_row) . "<br>";  // array
    // print_r($t_row);
    // print_r($t_row['COUNT(1)']);    // 總列數
    // exit;

    $r1 = $pdo->query($t_sql)->fetch();

    // print_r($r1);
    // exit;

    $totalRows = $r1['COUNT(1)'];



    // echo $totalRows;
    // exit;

    $totalPages = ceil($totalRows / $perPage);

    // echo $totalPages;
    // exit;

    if ($totalRows) {
        if ($page > $totalPages) {
            header("Location: ?page=$totalPages");
            exit();
        } else {
            $sql1 = sprintf("SELECT * FROM shops JOIN (SELECT area_sid,areaname,cityname,area.city_id,area.area_id FROM area JOIN city WHERE area.city_id = city.city_id) AS D ON shops.city= D.city_id AND shops.area = D.area_id GROUP BY shops.sid,account,`password`,shop,`owner`,category,photo,city,area,`location`,res_category,`phone`,email,uniform_number,company_number,open_time,food_categories,D.area_sid,D.cityname ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

            $order = !empty($_GET['order']) ? $_GET['order'] : "";

            // search
            $shop = isset($_GET['shop']) ? $_GET['shop'] : "";

            $search_city = isset($_GET['search_city']) ? $_GET['search_city'] : "";

            $select_res = isset($_GET['select_res']) ? $_GET['select_res'] : "";

            // select_res
            if (!empty($_GET['select_res'])) {
                $sql1 = "SELECT * FROM shops JOIN (SELECT area_sid,areaname,cityname,area.city_id,area.area_id FROM area JOIN city WHERE area.city_id = city.city_id) AS D ON shops.city= D.city_id AND shops.area = D.area_id WHERE shops.category LIKE '%$select_res%' ORDER BY sid DESC LIMIT 0 , 10";
            }

            // search_shop
            if (!empty($_GET['shop'])) {
                // $shop = $_GET['shop'];
                $sql1 = "SELECT * FROM shops JOIN (SELECT area_sid,areaname,cityname,area.city_id,area.area_id FROM area JOIN city WHERE area.city_id = city.city_id) AS D ON shops.city= D.city_id AND shops.area = D.area_id WHERE shops.shop LIKE '%$shop%' ORDER BY sid DESC LIMIT 0 , 10";
            };

            // order
            if (!empty($_GET['order'])) {
                $sql1 = sprintf("SELECT * FROM shops JOIN (SELECT area_sid,areaname,cityname,area.city_id,area.area_id FROM area JOIN city WHERE area.city_id = city.city_id) AS D ON shops.city= D.city_id AND shops.area = D.area_id GROUP BY shops.sid ORDER BY sid $order LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
            }

            // search_city
            if (!empty($_GET['search_city'])) {
                $sql1 = "SELECT * FROM shops JOIN (SELECT area_sid,areaname,cityname,area.city_id,area.area_id FROM area JOIN city WHERE area.city_id = city.city_id) AS D ON shops.city= D.city_id AND shops.area = D.area_id WHERE D.cityname LIKE '%$search_city%' ORDER BY sid DESC LIMIT 0 , 10";
            }

            // $sql1 = sprintf("SELECT * FROM shops JOIN (SELECT area_sid,areaname,cityname,area.city_id,area.area_id FROM area JOIN city WHERE area.city_id = city.city_id) AS D ON shops.city= D.city_id AND shops.area = D.area_id GROUP BY shops.sid ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

            $rows = $pdo->query($sql1)->fetchAll();

            // print_r($rows);
            // exit;

            // $sql3 = "SELECT area_sid,areaname,cityname,area.city_id,area.area_id FROM area JOIN city WHERE area.city_id = city.city_id";

            // $sql4 = sprintf("SELECT * FROM shops JOIN (SELECT area.areaname,city.cityname,city.city_id FROM area JOIN city ON area.city_id=city.city_id) AS D ON shops.city= D.city_id GROUP BY shops.sid ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
        }
    }
    // $sql = sprintf("SELECT * FROM shops ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    ?>





<?php


// print_r($rows);
// exit;    

?>
</pre>

<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container-fluid bg-white w-100 overflow-x-scroll" style="flex:auto;">
        <!--這個的class可以自己改掉，給你們看範圍的而已-->

        <div class="container">

            <div class="row">
                <div class="col-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">

                            <!-- 回到最前頁 -->
                            <li class="page-item"><a class="page-link" href="?page=<?= $page == 1 ?>" style="font-size:18px"><i class="fa-solid fa-angles-left"></i></a></li>

                            <!-- 上一頁 -->
                            <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>" style="font-size:18px"><i class="fa-solid fa-angle-left"></i></a></li>

                            <!-- 製作互動式分頁表 -->
                            <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                                if ($i >= 1 and $i <= $totalPages) :
                            ?>

                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>

                            <?php endif;
                            endfor; ?>

                            <!-- 下一頁 -->
                            <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>" style="font-size:18px"><i class="fa-solid fa-angle-right"></i></a></li>

                            <!-- 跳到最後頁 -->
                            <li class="page-item"><a class="page-link" href="?page=<?= $totalPages ?>" style="font-size:18px"><i class="fa-solid fa-angles-right"></i></a></li>

                        </ul>
                    </nav>
                </div>

                <div class="col-4">


                </div>

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">

                <!-- <div><input type="text" name="" id="searchBar"> -->

                <!-- <button id="searchClick">搜尋</button> -->
            </div>

            <!-- 搜尋：<input type="search" class="light-table-filter" data-table="order-table" placeholder="請輸入關鍵字"> -->

            資料排序：
            <select name="order" id="order" class="">

                <option value="0">-請選擇-</option>
                <option value="1">由新到舊</option>
                <option value="2">由舊到新</option>

            </select>

            <input type="text" name="search_shop" id="search_shop" placeholder="請輸入查詢店家" class="ms-3">

            <span class="ms-3">請選擇縣市：</span><select name="select_city" id="select_city">
                <option value="">請選擇縣市</option>
                <option value="1">台北市</option>
                <option value="2">新北市</option>
                <option value="3">基隆市</option>
            </select>

            <span class="ms-3">請選擇餐廳種類：</span><select name="select_res" id="select_res">
                <option value="">餐廳種類</option>
                <option value="1">中式</option>
                <option value="2">西式</option>
                <option value="3">日式</option>
                <option value="4">韓式</option>
                <option value="5">印式</option>
                <option value="6">其他</option>
            </select>

            <table class="table order-table table-bordered table-striped mb-2">

                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">account</th>
                        <th scope="col">password</th>
                        <th scope="col">shop</th>
                        <th scope="col">owner</th>
                        <th scope="col">category</th>
                        <th scope="col">photo</th>
                        <th scope="col">city</th>
                        <th scope="col">area</th>
                        <th scope="col">location</th>
                        <th scope="col">res_category</th>
                        <th scope="col">phone</th>
                        <th scope="col">email</th>
                        <th scope="col">uniform_number</th>
                        <th scope="col">company_number</th>
                        <th scope="col">open_time</th>
                        <th scope="col">close_time</th>
                        <th scope="col">food_categories</th>
                        <!-- <button><a href="">編輯</a></button> -->
                        <!-- <button><a href="">刪除</a></button> -->
                        <th scope="col">編輯</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($rows as $r) : ?>
                        <?php $cate = ["可訂可揪", "可訂不可揪", "可揪不可訂"] ?>

                        <tr>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['account'] ?></td>
                            <td><?= $r['password'] ?></td>
                            <td><?= $r['shop'] ?></td>
                            <td><?= $r['owner'] ?></td>
                            <td><?= $r['category'] ?></td>
                            <td><img src="./Norm/imgs/<?= $r['photo'] ?>" alt="" style="border-radius: 0%;"></td>
                            <td><?= $r['cityname'] ?></td>
                            <td><?= $r['areaname'] ?></td>
                            <td><?= $r['location'] ?></td>
                            <?php if ($r['res_category'] == 0) : ?>
                                <td><?= $cate[0] ?></td>
                            <?php elseif ($r['res_category'] == 1) : ?>
                                <td><?= $cate[1] ?></td>
                            <?php elseif ($r['res_category'] == 2) : ?>
                                <td><?= $cate[2] ?></td>
                            <?php endif; ?>
                            <td><?= $r['phone'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['uniform_number'] ?></td>
                            <td><?= $r['company_number'] ?></td>
                            <td><?= $r['open_time'] ?></td>
                            <td><?= $r['close_time'] ?></td>
                            <td><?= $r['food_categories'] ?></td>
                            <td><button type="button" class="btn btn-primary"><a href="rest_edit1.php?sid=<?= $r['sid'] ?>" class="link-light">編輯</a></button></td>
                            <td><button type="button" class="btn btn-danger"><a href="javascript: delete_it(<?= $r['sid'] ?>)" class="link-light">刪除</a></button>
                            </td>
                            <!-- <td><a href="edit1.php?sid=<?= $r['sid'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td> -->
                            <!-- <td><a href="javascript: delete_it(<?= $r['sid'] ?>)"><i class="fa-solid fa-trash-can"></i></a></td> -->
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>
</div>
</div>


<?php include "./backend_footer.php" ?>
<script>
    (function(document) {
        // 'use strict';

        // 建立 LightTableFilter
        var LightTableFilter = (function(Arr) {

            var _input;

            // 資料輸入事件處理函數
            function _onInputEvent(e) {
                _input = e.target;
                var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                Arr.forEach.call(tables, function(table) {
                    Arr.forEach.call(table.tBodies, function(tbody) {
                        Arr.forEach.call(tbody.rows, _filter);
                    });
                });
            }

            // 資料篩選函數，顯示包含關鍵字的列，其餘隱藏
            function _filter(row) {
                var text = row.textContent.toLowerCase(),
                    val = _input.value.toLowerCase();
                row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
            }

            return {
                // 初始化函數
                init: function() {
                    var inputs = document.getElementsByClassName('light-table-filter');
                    Arr.forEach.call(inputs, function(input) {
                        input.oninput = _onInputEvent;
                    });
                }
            };
        })(Array.prototype);

        // 網頁載入完成後，啟動 LightTableFilter
        document.addEventListener('readystatechange', function() {
            if (document.readyState === 'complete') {
                LightTableFilter.init();
            }
        });

    })(document);


    // let search = document.querySelector("#searchBar");
    // let searchClick = document.querySelector("#searchClick");

    // searchClick.addEventListener("click", () => {
    //     let searchValue = search.value;
    //     console.log(searchValue);
    // })

    function delete_it(sid) {
        if (confirm(`確定是否要刪掉第${sid}的資料?`)) {
            location.href = 'rest_delete1.php?sid=' + sid;
        }
    }

    // 製作資料排序：
    const order = document.getElementById('order');
    order.addEventListener('change', () => {
        if (order.value == "1") {

            location.href = "./test_page-Norm.php?order=DESC"

        } else if (order.value == "2") {
            location.href = "./test_page-Norm.php?order=ASC"
        }
        // else {
        //     location.href = "./test_page-Norm.php?order=false"
        // }
    })

    // 搜尋商店
    let search_shop = document.querySelector('#search_shop');
    search_shop.addEventListener('change', () => {
        let shop_val = search_shop.value;
        location.href = "./test_page-Norm.php?shop=" + shop_val;

    });

    // 以縣市排列
    let search_city = document.querySelector('#select_city');

    search_city.addEventListener('change', () => {
        if (search_city.value == "1") {
            location.href = "./test_page-Norm.php?search_city=台北市";
        }
        if (search_city.value == "2") {
            location.href = "./test_page-Norm.php?search_city=新北市";
        }
        if (search_city.value == "3") {
            location.href = "./test_page-Norm.php?search_city=基隆市";
        }
    })

    // 選擇餐廳種類
    let select_res = document.querySelector('#select_res');
    select_res.addEventListener('change', () => {
        if (select_res.value == "1") {
            location.href = "./test_page-Norm.php?select_res=中式";
        };
        if (select_res.value == "2") {
            location.href = "./test_page-Norm.php?select_res=西式";
        }
        if (select_res.value == "3") {
            location.href = "./test_page-Norm.php?select_res=日式";
        }
        if (select_res.value == "4") {
            location.href = "./test_page-Norm.php?select_res=韓式";
        }
        if (select_res.value == "5") {
            location.href = "./test_page-Norm.php?select_res=印式";
        }
        if (select_res.value == "6") {
            location.href = "./test_page-Norm.php?select_res=其他";
        }
    })
</script>
<?php include "./backend_js_and_endtag.php" ?>