<?php
$page_number = isset($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = isset($_GET['totalshow']) ? $_GET['totalshow'] : 3;
?>
<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>
<div class="w-100 p-3 mb-auto">
    <div class="container w-100 h-100 position-relative">
        <?php include "./kai_shop/searchbar.php" ?>
        <div class="row">
            <div class="col">
                <?php include "./kai_shop/itemstable.php" ?>
                <?php include "./kai_shop/pagination.php" ?>
            </div>
        </div>
        <div class="alert--kai d-none bg-warning" id="removeConfirm">
            <div class="ask--kai">點擊確定後將商品移至未上架商品</div>
            <div class="askbtn--kai">
                <button class="btnstyle--kai bg-danger text-light" id="yesRemoveBtn" onclick="yesRemove()">確定</button>
                <button class="btnstyle--kai bg-danger text-light" id="noRemoveBtn" onclick="noRemove()">取消</button>
            </div>
        </div>
        <?php include "./kai_shop/createform.php" ?>
        <script>
            //searchbox start
            let searchItem = document.getElementById("searchItem");
            let search = () => {
                console.log(searchItem.value);
            }

            let testWishData = [{
                "itemId": "16",
                "cate": "drink",
                "itemName": "許願商品",
                "factoryName": "廠商名稱",
                "imgSrc": ".\/kaiimgs\/drink2.jpeg",
                "price": "90",
                "status": "ing",
                "note": "",
                "date": "2023-03-03"
            }];
            //test data end
            //control innertable start
            let divList = document.querySelectorAll(".searching");
            divList.forEach(div => {
                div.addEventListener("click", () => {
                    divList.forEach(div => {
                        div.classList.remove("selected--kai", "bg-warning");
                    });
                    div.classList.add("selected--kai", "bg-warning");
                });
            });
            let confirm = document.getElementById("removeConfirm");

            let remove = event => {
                let itemIdToRemove = event.id.split("-")[1];
                confirm.classList.remove("d-none");
                event.classList.add("btn-active");
                event.parentNode.parentNode.classList.add("bg-info-subtle");
            }
            let yesRemove = () => {
                confirm.classList.add("d-none");
                console.log(document.getElementsByClassName("btn-active")[0].id);
            }
            let noRemove = () => {
                confirm.classList.add("d-none");
                const activeBtn =document.getElementsByClassName("btn-active")[0];
                const row =activeBtn.parentNode.parentNode;
                row.classList.remove("bg-info-subtle");
                activeBtn.classList.remove("btn-active")
            }
            let checkall = () => {
                document.querySelectorAll(".checkedItem--kai").forEach(e => {
                    console.log(e);
                    e.checked = true;
                });
            }

            function toggle(source) {
                checkboxes = document.getElementsByClassName('checkedItem--kai');
                for (let i = 0, n = checkboxes.length; i < n; i++) {
                    checkboxes[i].checked = source.checked;
                }
            }

            let pushItem = document.getElementById("pushItem");
            let readyPushItem = document.getElementById("readyPushItem");
            let wishItem = document.getElementById("wishItem");
            let tHead = document.getElementById("tHead");
            let tBody = document.getElementById("tBody");
            document.addEventListener("DOMContentLoaded", () => {
                divList[0].classList.add("selected--kai", "bg-warning");
                let active;
                let activePage = "pushItem";
                let page = <?php echo $page_number; ?>;
                let totalshow = <?php echo $items_per_page; ?>;

                let switchToPage = pageId => {
                    if (pageId === "pushItem") {
                        active = 1;
                        tHead.innerHTML = "";
                        tBody.innerHTML = "";
                        fetch(`./controller/itemController.php?active=${active}&page=${page}&totalshow=${totalshow}`)
                            .then(response => response.json())
                            .then(data => {
                                data.data.forEach((row => {
                                    generateStockItems(row, tHead, tBody);
                                }))
                                renderPaginationLinks(active, data, totalshow);
                            })
                            .catch(error => console.error(error));
                    } else if (pageId === "readyPushItem") {
                        active = 0;
                        tHead.innerHTML = "";
                        tBody.innerHTML = "";
                        fetch(`./controller/itemController.php?active=${active}&page=${page}&totalshow=${totalshow}`)
                            .then(response => response.json())
                            .then(data => {
                                data.data.forEach((row => {
                                    generateStockItems(row, tHead, tBody);
                                }))
                                renderPaginationLinks(active, data, totalshow);
                            })
                            .catch(error => console.error(error));
                    } else if (pageId === "wishItem") {
                        tBody.innerHTML = "";
                        testWishData.forEach((item) => {
                            let {
                                itemId,
                                cate,
                                itemName,
                                factoryName,
                                imgSrc,
                                price,
                                status,
                                note,
                                date
                            } = item;
                            tHead.innerHTML = `
                            <tr>

                                <td><input type="checkbox" class="ms-3" id="checkAllWishItem" ></td>
                                <td class="py-3">圖片</td>
                                <td class="py-3">許願商品名稱</td>
                                <td class="py-3">廠商名稱</td>
                                <td class="py-3">商品單價</td>
                                <td class="py-3">處理狀態</td>
                                <td class="py-3">備註</td>
                                <td class="py-3">編輯</td>
                            </tr>`;
                            tBody.innerHTML += `
                                <tr class="text-center tritem">
                                    <td><input type="checkbox" class="ms-3 checkedItem--kai"></td>
                                    <td class="py-4">
                                        <img src=${imgSrc} class="photofix--kai">
                                    </td>
                                    <td>${itemName}</td>
                                    <td>${factoryName}</td>
                                    <td>${price}</td>
                                    <td>${status}</td>
                                    <td>${note}</td>
                                    <td class="fs-3">
                                        <i class="fa-solid fa-pencil pointer--kai" onclick="edit()"></i>
                                        <i class="fa-solid fa-delete-left pointer--kai ms-1" id="remove-${itemId}" onclick="remove(this)"></i>
                                    </td>
                                </tr>
                        `
                        })
                    }
                    activePage = pageId;
                }
                switchToPage(activePage);
                pushItem.addEventListener("click", () => {
                    switchToPage("pushItem");
                });

                readyPushItem.addEventListener("click", () => {
                    switchToPage("readyPushItem");
                });

                wishItem.addEventListener("click", () => {
                    switchToPage("wishItem");
                });
            })
            //control table end
        </script>
    </div>
</div>

<?php include "./backend_footer.php" ?>
<?php include "./backend_js_and_endtag.php" ?>