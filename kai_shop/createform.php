<form action="./php_form.php" method="post" onsubmit="submitForm()" id="addform" class="d-none">
    <div class="position-fixed top-50 start-50 translate-middle formbr--kai" style="background-color: #E1F5FE;">
        <div class="inputadd--kai pt-4">
            <div class="mx-auto fs-2 mb-3">
                <div>新增商品</div>
            </div>
            <div class="ms-3">
                <div class="innerinput mb-3">
                    <label for="itemName" style="color:#555555">商品名稱:</label>
                    <input type="text" name="itemName" id="itemName" style="background-color: #1976D2"
                        class="inputborder--kai">
                </div>
                <div class="innerinput mb-3">
                    <label for="cate" style="color:#555555">商品類別:</label>
                    <input type="text" name="cate" id="cate" style="background-color: #1976D2"
                        class="inputborder--kai">
                </div>
                <div class="innerinput mb-3">
                    <label for="imgSrc" style="color:#555555">商品圖片:</label>
                    <input type="file" name="imgSrc" id="imgSrc">
                </div>
                <div class="innerinput mb-3">
                    <label for="price" style="color:#555555">商品價格:</label>
                    <input type="text" name="price" id="price" style="background-color: #1976D2"
                        class="inputborder--kai">
                </div>
                <div class="innerinput mb-3">
                    <label for="stock" style="color:#555555">商品庫存:</label>
                    <input type="text" name="stock" id="stock" style="background-color: #1976D2"
                        class="inputborder--kai">
                </div>
                <div class="descrip--kai d-flex">
                    <label for="description" style="color:#555555">商品敘述:</label>
                    <textarea name="description" id="description" cols="30" rows="7"
                        style="background-color: #1976D2" class="inputborder--kai ms-2"></textarea>
                </div>
                <div class="addbtngroup--kai my-3">
                    <button type="submit" class="addbtnstyle--kai p-2 rounded-3 pointer--kai"
                        style="background-color: #ffb74d">送出</button>
                    <button type="button" class="addbtnstyle--kai p-2 rounded-3 pointer--kai" id="closeAdd"
                        style="background-color: #D2E3F7">取消</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function generateStockItems(data, thead, tbody) {
    let { item_id, cate_name, item_name, img_url, price, item_description, created_at } = data;
    thead.innerHTML = `
        <tr>
            <td><input type="checkbox" class="ms-3" id="checkAllItem" onclick="toggle(this)"></td>
            <td class="py-3">圖片</td>
            <td class="py-3">商品名稱</td>
            <td class="py-3">商品類別</td>
            <td class="py-3">商品描述</td>
            <td class="py-3">商品單價</td>
            <td class="py-3">庫存數量</td>
            <td class="py-3">上架日期</td>
            <td class="py-3">編輯</td>
        </tr>`
    tbody.innerHTML += `
        <tr class="text-center tritem--kai">
            <td><input type="checkbox" class="ms-3 checkedItem"></td>
            <td class="py-4">
                <img src=${img_url} class="photofix--kai">
            </td>
            <td>${item_name}</td>
            <td>${cate_name}</td>
            <td style="width:20% ;text-align:start">${item_description}</td>
            <td>${price}</td>
            <td>${0}</td>
            <td>${created_at}</td>
            <td class="fs-3">
                <i class="fa-solid fa-pencil pointer--kai" onclick="edit()"></i>
                <i class="fa-solid fa-delete-left pointer--kai ms-1" id="remove-${item_id}" onclick="remove(this)"></i>
            </td>
        </tr>
    `
}
</script>