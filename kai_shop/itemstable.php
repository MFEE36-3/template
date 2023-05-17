<table class="mt-4 w-100 bg-light">
    <div class="d-flex w-100 justify-content-between mt-2">
        <div class="d-flex">
            <div class="launch bg-warning-subtle p-3 pointer--kai searching" id="pushItem">已上架商品</div>
            <div class="nolaunch ms-4 bg-warning-subtle p-3 pointer--kai searching" id="readyPushItem">待上架商品
            </div>
            <div class="wish ms-4 bg-warning-subtle p-3 pointer--kai searching" id="wishItem">候選商品管理</div>
        </div>
        <div class="d-flex">
            <div class="bg-warning rounded-3 pt-3 px-2 pointer--kai" id="addNewItem">
                <i class="fa-solid fa-plus"></i>
                新增商品
            </div>
            <div class="fs-2 ms-4 mt-2 text-warning pointer--kai">
            <i class="fa-regular fa-trash-can "></i>
            </div>
        </div>
    </div>
        <div class="alert--kai d-none bg-warning" id="removeConfirm">
            <div class="ask--kai">點擊確定後將商品刪除</div>
            <div class="askbtn--kai">
                <button class="btnstyle--kai bg-danger text-light" id="yesRemoveBtn" onclick="yesRemove()">確定</button>
                <button class="btnstyle--kai bg-danger text-light" id="noRemoveBtn" onclick="noRemove()">取消</button>
            </div>
        </div>
    <thead class="text-center bg-dark-subtle line position-relative" id="tHead">
    </thead>
    <tbody class="underline--kai" id="tBody">
    </tbody>
</table>