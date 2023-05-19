<?php
$page_number = isset($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = isset($_GET['totalshow']) ? $_GET['totalshow'] : 9999;
?>
<?php include "./backend_header.php" ?>
<?php include "./backend_navbar_and_sidebar.php" ?>
<div class="w-100 p-3 mb-auto">
    <div class="container w-100 h-100 position-relative">
        <?php include "./kai_shop/searchbar.php" ?>
        <div class="row">
            <div class="col">
                <?php include "./kai_shop/itemstable.php" ?>
            </div>
        </div>
        <?php include "./kai_shop/createform.php" ?>
        <script>
            //searchbox start
            let searchItem = document.getElementById("searchItem");
            let page = <?php echo $page_number; ?>;
            let totalshow = <?php echo $items_per_page; ?>;
            let search = () => {
                let current_tab = document.querySelector('.selected--kai').id;
                let active = current_tab === 'pushItem' ? 1 : 0;
                fetch(`./controller/itemGet.php?active=${active}&page=${page}&totalshow=${totalshow}&q=${searchItem.value}`)
                    .then(response => response.json())
                    .then(data => {
                        flushTable();
                        data.data.forEach((row => {
                            if (current_tab == "pushItem"){
                                generateStockItems(row, tHead, tBody);
                            }
                            else {
                                generateStockItemsForReady(row, tHead, tBody);
                            }
                        }))
                    })
                    .catch(error => console.error(error));
            }

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

            let depbox = event => {
                event.target.parentNode.parentNode.classList.toggle("bg-info-subtle", event.target.checked);
            }
            function toggle(source) {
                checkboxes = document.getElementsByClassName('checkedItem--kai');
                for (let i = 0, n = checkboxes.length; i < n; i++) {
                    checkboxes[i].checked = source.checked;
                    checkboxes[i].parentNode.parentNode.classList.toggle("bg-info-subtle", source.checked);
                }
            }


            let pushItem = document.getElementById("pushItem");
            let readyPushItem = document.getElementById("readyPushItem");
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
                        fetch(`./controller/itemGet.php?active=${active}&page=${page}&totalshow=${totalshow}`)
                            .then(response => response.json())
                            .then(data => {
                                data.data.forEach((row => {
                                    generateStockItems(row, tHead, tBody);
                                }))
                            })
                            .catch(error => console.error(error));
                    } else if (pageId === "readyPushItem") {
                        active = 0;
                        tHead.innerHTML = "";
                        tBody.innerHTML = "";
                        fetch(`./controller/itemGet.php?active=${active}&page=${page}&totalshow=${totalshow}`)
                            .then(response => response.json())
                            .then(data => {
                                data.data.forEach((row => {
                                    generateStockItemsForReady(row, tHead, tBody);
                                }))
                            })
                            .catch(error => console.error(error));
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
            })
            //control table end
        </script>
    </div>
</div>

<?php include "./backend_footer.php" ?>
<?php include "./backend_js_and_endtag.php" ?>