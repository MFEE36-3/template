<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>

<div class="w-100 p-3 mb-auto">
    <div class="container w-100 h-100 position-relative">
        <div class="row">
            <div class="col mt-3 d-flex ">
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control searchradius1 fs-4"
                        aria-label="Amount (to the nearest dollar)" placeholder="Search item" id="searchItem">
                    <span class="input-group-text searchradius2 pointer" onclick="search()"><i class="fa-solid fa-magnifying-glass " ></i></span>
                </div>
                <div class="ms-4 d-flex align-items-center mb-3" id="shopcategory">
                    <div class="me-4">
                        <input type="checkbox" name="drink" id="drink" class="me-1">
                        <span>飲料</span>
                    </div>
                    <div class="me-4">
                        <input type="checkbox" name="snack" id="snack" class="me-1">
                        <span>零食</span>
                    </div>
                    <div class="me-4">
                        <input type="checkbox" name="seasoning" id="seasoning" class="me-1"><span>調味料</span>
                    </div>
                    <div class="me-4">
                        <input type="checkbox" name="freshfood" id="freshfood" class="me-1"><span>生鮮食品</span>
                    </div>
                    <div class="me-4">
                        <input type="checkbox" name="fronzefood" id="fronzefood" class="me-1"><span>冷凍食品</span>
                    </div>
                    <div>
                        <input type="checkbox" name="other" id="other" class="me-1"><span>其他</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="mt-4 w-100 bg-light">
                    <div class="d-flex w-100 justify-content-between mt-2">
                        <div class="d-flex">
                            <div class="launch bg-warning-subtle p-3 pointer searching" id="pushItem">已上架商品</div>
                            <div class="nolaunch ms-4 bg-warning-subtle p-3 pointer searching" id="readyPushItem">待上架商品
                            </div>
                            <div class="wish ms-4 bg-warning-subtle p-3 pointer searching" id="wishItem">候選商品管理</div>
                        </div>
                        <div class="bg-warning rounded-3 pt-3 px-2 pointer" id="addNewItem">
                            <i class="fa-solid fa-plus"></i>
                            新增商品
                        </div>
                    </div>
                    <thead class="text-center bg-dark-subtle line position-relative" id="tHead">
                        <tr>
                            <td class="py-3">圖片</td>
                            <td class="py-3">商品名稱</td>
                            <td class="py-3">商品類別</td>
                            <td class="py-3">商品描述</td>
                            <td class="py-3">商品單價</td>
                            <td class="py-3">庫存數量</td>
                            <td class="py-3">上架日期</td>
                            <td class="py-3">編輯</td>
                        </tr>
                    </thead>
                    <tbody class="underline" id="tBody">

                    </tbody>
                </table>
                <nav aria-label="..." class="d-flex justify-content-center mt-3">
                    <ul class="pagination pagination-lg ">
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="http://wuchengrudemacbook-air.local/template/test_page.php#page=2&totalshow=6">2</a></li>
                        <li class="page-item"><a class="page-link" href="http://wuchengrudemacbook-air.local/template/test_page.php#page=3&totalshow=6">3</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="alert d-none bg-warning" id="removeConfirm">
            <div class="ask">點擊確定後將商品移至未上架商品</div>
            <div class="askbtn">
                <button class="btnstyle bg-danger text-light" id="yesRemoveBtn" onclick="yesRemove()">確定</button>
                <button class="btnstyle bg-danger text-light" id="noRemoveBtn" onclick="noRemove()">取消</button>
            </div>
        </div>
        <form action="./php_form.php" method="post" onsubmit="submitForm()" id="addform" class="d-none">
            <div class="position-fixed top-50 start-50 translate-middle formbr" style="background-color: #E1F5FE;">
                <div class="inputadd pt-4">
                    <div class="mx-auto fs-2 mb-3">
                        <div>新增商品</div>
                    </div>
                    <div class="ms-3">
                        <div class="innerinput mb-3">
                            <label for="itemName" style="color:#555555">商品名稱:</label>
                            <input type="text" name="itemName" id="itemName" style="background-color: #1976D2"
                                class="inputborder">
                        </div>
                        <div class="innerinput mb-3">
                            <label for="cate" style="color:#555555">商品類別:</label>
                            <input type="text" name="cate" id="cate" style="background-color: #1976D2"
                                class="inputborder">
                        </div>
                        <div class="innerinput mb-3">
                            <label for="imgSrc" style="color:#555555">商品圖片:</label>
                            <input type="file" name="imgSrc" id="imgSrc">
                        </div>
                        <div class="innerinput mb-3">
                            <label for="price" style="color:#555555">商品價格:</label>
                            <input type="text" name="price" id="price" style="background-color: #1976D2"
                                class="inputborder">
                        </div>
                        <div class="innerinput mb-3">
                            <label for="stock" style="color:#555555">商品庫存:</label>
                            <input type="text" name="stock" id="stock" style="background-color: #1976D2"
                                class="inputborder">
                        </div>
                        <div class="descrip d-flex">
                            <label for="description" style="color:#555555">商品敘述:</label>
                            <textarea name="description" id="description" cols="30" rows="7"
                                style="background-color: #1976D2" class="inputborder ms-2"></textarea>
                        </div>
                        <div class="addbtngroup my-3">
                            <button type="submit" class="addbtnstyle p-2 rounded-3 pointer"
                                style="background-color: #ffb74d">送出</button>
                            <button type="button" class="addbtnstyle p-2 rounded-3 pointer" id="closeAdd"
                                style="background-color: #D2E3F7">取消</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <script>
            //searchbox start
            let searchItem =document.getElementById("searchItem");
            let search = ()=>{
                console.log(searchItem.value);
            }
            //searchbox end
            //test data start
            let testPushData = [
                {
                    "itemId": "1",
                    "cate": "freshfood",
                    "itemName": "香蕉",
                    "imgSrc": ".\/kaiimgs\/freshfood3.jpeg",
                    "price": "50",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "40",
                    "date": "2023-03-23"
                },
                {
                    "itemId": "2",
                    "cate": "freshfood",
                    "itemName": "香蕉",
                    "imgSrc": ".\/kaiimgs\/freshfood3.jpeg",
                    "price": "50",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "40",
                    "date": "2023-03-23"
                },
                {
                    "itemId": "3",
                    "cate": "freshfood",
                    "itemName": "香蕉",
                    "imgSrc": ".\/kaiimgs\/freshfood3.jpeg",
                    "price": "50",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "40",
                    "date": "2023-03-23"
                },
                {
                    "itemId": "4",
                    "cate": "freshfood",
                    "itemName": "香蕉",
                    "imgSrc": ".\/kaiimgs\/freshfood3.jpeg",
                    "price": "50",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "40",
                    "date": "2023-03-23"
                },
                {
                    "itemId": "5",
                    "cate": "freshfood",
                    "itemName": "香蕉",
                    "imgSrc": ".\/kaiimgs\/freshfood3.jpeg",
                    "price": "50",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "40",
                    "date": "2023-03-23"
                },
                {
                    "itemId": "6",
                    "cate": "freshfood",
                    "itemName": "香蕉",
                    "imgSrc": ".\/kaiimgs\/freshfood3.jpeg",
                    "price": "50",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "40",
                    "date": "2023-03-23"
                },
                {
                    "itemId": "7",
                    "cate": "freshfood",
                    "itemName": "香蕉",
                    "imgSrc": ".\/kaiimgs\/freshfood3.jpeg",
                    "price": "50",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "40",
                    "date": "2023-03-23"
                },
                {
                    "itemId": "8",
                    "cate": "freshfood",
                    "itemName": "香蕉",
                    "imgSrc": ".\/kaiimgs\/freshfood3.jpeg",
                    "price": "50",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "40",
                    "date": "2023-03-23"
                }
            ];
            let testReadyData = [
                {
                    "itemId": "1",
                    "cate": "drink",
                    "itemName": "飲料",
                    "imgSrc": ".\/kaiimgs\/drink.jpeg",
                    "price": "80",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "90",
                    "date": "2023-03-03"
                },
                {
                    "itemId": "2",
                    "cate": "drink",
                    "itemName": "飲料",
                    "imgSrc": ".\/kaiimgs\/drink.jpeg",
                    "price": "80",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "90",
                    "date": "2023-03-03"
                },
                {
                    "itemId": "3",
                    "cate": "drink",
                    "itemName": "飲料",
                    "imgSrc": ".\/kaiimgs\/drink.jpeg",
                    "price": "80",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "90",
                    "date": "2023-03-03"
                },
                {
                    "itemId": "4",
                    "cate": "drink",
                    "itemName": "飲料",
                    "imgSrc": ".\/kaiimgs\/drink.jpeg",
                    "price": "80",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "90",
                    "date": "2023-03-03"
                },
                {
                    "itemId": "5",
                    "cate": "drink",
                    "itemName": "飲料",
                    "imgSrc": ".\/kaiimgs\/drink.jpeg",
                    "price": "80",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "90",
                    "date": "2023-03-03"
                },
                {
                    "itemId": "6",
                    "cate": "drink",
                    "itemName": "飲料",
                    "imgSrc": ".\/kaiimgs\/drink.jpeg",
                    "price": "80",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "90",
                    "date": "2023-03-03"
                },
                {
                    "itemId": "7",
                    "cate": "drink",
                    "itemName": "飲料",
                    "imgSrc": ".\/kaiimgs\/drink.jpeg",
                    "price": "80",
                    "description": "採用有機農場生產之香蕉，有機栽種、高度營養價值，健康無負擔，讓您吃得安心又滿足。",
                    "stock": "90",
                    "date": "2023-03-03"
                },
            ];
            //test data end
            //control innertable start
            let divList = document.querySelectorAll(".searching");
            divList.forEach(div => {
                div.addEventListener("click", () => {
                    divList.forEach(div => {
                        div.classList.remove("selected", "bg-warning");
                    });
                    div.classList.add("selected", "bg-warning");
                });
            });
            let confirm = document.getElementById("removeConfirm");

            let remove = event => {
                let itemIdToRemove = event.id.split("-")[1];
                confirm.classList.remove("d-none");
                event.classList.add("btn-active");
            }


            // let confirm = document.getElementById("removeConfirm");
            // let remove = event => {
            //     confirm.classList.remove("d-none");
            // }
            let yesRemove = () => {
                confirm.classList.add("d-none");
                console.log(document.getElementsByClassName("btn-active")[0].id);
            }
            let noRemove = () => {
                confirm.classList.add("d-none");
            }
            document.addEventListener("DOMContentLoaded", () => {
                divList[0].classList.add("selected", "bg-warning");
                testPushData.forEach((data => {
                    let { itemId, cate, itemName, imgSrc, price, description, stock, date } = data;
                    tBody.innerHTML += `
                        <tr class="text-center tritem">
                            <td class="py-4">
                                <img src=${imgSrc} class="photofix">
                            </td>
                            <td>
                                ${itemName}
                            </td>
                            <td>
                                ${cate}
                            </td>
                            <td style="width:20% ;text-align:start">${description}</td>
                            <td>${price}</td>
                            <td>${stock}</td>
                            <td>${date}</td>
                            <td class="fs-3">
                                <i class="fa-solid fa-pencil pointer" onclick="edit()"></i>
                                <i class="fa-solid fa-delete-left pointer ms-1" id="remove-${itemId}" onclick="remove(this)"></i>
                            </td>
                        </tr>
                        `

                }))
            })
            let pushItem = document.getElementById("pushItem");
            let readyPushItem = document.getElementById("readyPushItem");
            let wishItem = document.getElementById("wishItem");
            let tHead = document.getElementById("tHead");
            let tBody = document.getElementById("tBody");
            pushItem.addEventListener("click", () => {
                tHead.innerHTML = "";
                tBody.innerHTML = "";
                if(testPushData.length > 6){
                    testPushData.filter
                }
                testPushData.forEach((data => {
                    let { itemId, cate, itemName, imgSrc, price, description, stock, date } = data;

                    tHead.innerHTML =
                        `<tr>
                        <td class="py-3">圖片</td>
                        <td class="py-3">商品名稱</td>
                        <td class="py-3">商品類別</td>
                        <td class="py-3">商品描述</td>
                        <td class="py-3">商品單價</td>
                        <td class="py-3">庫存數量</td>
                        <td class="py-3">上架日期</td>
                        <td class="py-3">編輯</td>
                    </tr>`
                    tBody.innerHTML += `
                        <tr class="text-center tritem">
                            <td class="py-4">
                                <img src=${imgSrc} class="photofix">
                            </td>
                            <td>
                                ${itemName}
                            </td>
                            <td>
                                ${cate}
                            </td>
                            <td>${description}</td>
                            <td>${price}</td>
                            <td>${stock}</td>
                            <td>${date}</td>
                            <td class="fs-3">
                                <i class="fa-solid fa-pencil pointer" onclick="edit()"></i>
                                <i class="fa-solid fa-delete-left pointer ms-1" id="remove-${itemId}" onclick="remove(this)"></i>
                            </td>
                        </tr>
                        `
                }))
            })
            readyPushItem.addEventListener("click", () => {
                tHead.innerHTML = "";
                tBody.innerHTML = "";
                testReadyData.forEach((data => {
                    let { itemId, cate, itemName, imgSrc, price, description, stock, date } = data;
                    tHead.innerHTML =
                        `<tr>
                        <td class="py-3">圖片</td>
                        <td class="py-3">商品名稱</td>
                        <td class="py-3">商品類別</td>
                        <td class="py-3">商品描述</td>
                        <td class="py-3">商品單價</td>
                        <td class="py-3">庫存數量</td>
                        <td class="py-3">上架日期</td>
                        <td class="py-3">編輯</td>
                    </tr>`
                    tBody.innerHTML += `
                        <tr class="text-center tritem">
                            <td class="py-4">
                                <img src=${imgSrc} class="photofix">
                            </td>
                            <td>
                                ${itemName}
                            </td>
                            <td>
                                ${cate}
                            </td>
                            <td>${description}</td>
                            <td>${price}</td>
                            <td>${stock}</td>
                            <td>${date}</td>
                            <td class="fs-3">
                                <i class="fa-solid fa-pencil pointer" onclick="edit()"></i>
                                <i class="fa-solid fa-delete-left pointer ms-1" id="remove-${itemId}" onclick="remove(this)"></i>
                            </td>
                        </tr>
                        `
                }))
            })
            wishItem.addEventListener("click", () => {
                tHead.innerHTML =
                    `<tr>
                        <td class="py-3">圖片</td>
                        <td class="py-3">許願商品名稱</td>
                        <td class="py-3">廠商名稱</td>
                        <td class="py-3">商品單價</td>
                        <td class="py-3">處理狀態</td>
                        <td class="py-3">備註</td>
                        <td class="py-3">編輯</td>
                    </tr>`
                tBody.innerHTML =
                    `<tr class="text-center">
                        <td class="py-3"><img src="./kaiimgs/drink4.jpeg" class="photofix"></td>
                        <td class="py-3">茶</td>
                        <td class="py-3">農地</td>
                        <td class="py-3">60</td>
                        <td class="py-3">待處理</td>
                        <td class="py-3"></td>
                        <td class="fs-3">
                                <i class="fa-solid fa-pencil pointer" onclick="edit()"></i>
                                <i class="fa-solid fa-delete-left pointer ms-1" onclick="remove()"></i>
                        </td>
                    </tr>`
            })
            //control table end
            //table start
            //table end
            //form start
            let addNewItem = document.getElementById("addNewItem");
            let addform = document.getElementById("addform");
            let closeAdd = document.getElementById("closeAdd");
            let edit = () => {
                addform.classList.remove("d-none");
            }
            addNewItem.addEventListener("click", () => {
                addform.classList.remove("d-none");
            })
            closeAdd.addEventListener("click", () => {
                addform.classList.add("d-none");
            })
            //form end
        </script>

    </div>
</div>

</div>
</div>

<?php include "./backend_footer.php" ?>
<?php include "./backend_js_and_endtag.php" ?>