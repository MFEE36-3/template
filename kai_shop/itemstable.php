<table class="mt-4 w-100 bg-light">
    <div class="d-flex w-100 justify-content-between mt-2">
        <div class="d-flex">
            <div class="launch bg-warning-subtle p-3 pointer--kai searching" id="pushItem">已上架商品</div>
            <div class="nolaunch ms-4 bg-warning-subtle p-3 pointer--kai searching" id="readyPushItem">待上架商品
            </div>
        </div>
        <div class="d-flex">
            <div class="bg-warning rounded-3 pt-3 px-2 pointer--kai" id="addNewItem">
                <i class="fa-solid fa-plus"></i>
                新增商品
            </div>
            <div class="fs-2 ms-4 mt-2 text-warning pointer--kai" id="trashCan">
                <i class="fa-regular fa-trash-can"></i>
            </div>
        </div>
    </div>
    <thead class="text-center bg-dark-subtle line position-relative" id="tHead">
    </thead>
    <tbody class="underline--kai" id="tBody">
    </tbody>
</table>
<div id="alertWindowContent">

</div>
<div class="alert--kai d-none rounded-2" style="background-color: #A2D8FF;" id="takeOffConfirm">
    <div class="ask--kai">點擊確定後將商品下架</div>
    <div class="askbtn--kai">
        <button class="btnstyle--kai rounded-2" style="background-color: #ffb74d" onclick="takeOffT()">
            <i class="fa-solid fa-check"></i>
            確定
        </button>
        <button class="btnstyle--kai rounded-2" style="background-color: #D2E3F7" onclick="takeOffF()">
            <i class="fa-solid fa-xmark"></i>
            取消
        </button>
    </div>
</div>
<div class="alert--kai d-none rounded-2" style="background-color: #A2D8FF;" id="publishConfirm">
    <div class="ask--kai">點擊確定後將商品下架</div>
    <div class="askbtn--kai">
        <button class="btnstyle--kai rounded-2" style="background-color: #ffb74d" onclick="publishT()">
            <i class="fa-solid fa-check"></i>
            確定
        </button>
        <button class="btnstyle--kai rounded-2" style="background-color: #D2E3F7" onclick="publishF()">
            <i class="fa-solid fa-xmark"></i>
            取消
        </button>
    </div>
</div>
<script>
    let alertWindowContent = document.querySelector("#alertWindowContent");
    let setAlertWindow = (eventName) => {
        if (eventName === "removeConfirm") {
            alertWindowContent.innerHTML = `
      <div class="alert--kai d-none rounded-2" style="background-color: #A2D8FF;" id="removeConfirm">
        <div class="ask--kai">點擊確定後將商品刪除</div>
        <div class="askbtn--kai">
          <button class="btnstyle--kai rounded-2" id="yesRemoveBtn" data-action="yesRemove" style="background-color: #ffb74d">
            <i class="fa-solid fa-check"></i>
            確定
          </button>
          <button class="btnstyle--kai rounded-2" id="noRemoveBtn" data-action="noRemove" style="background-color: #D2E3F7">
            <i class="fa-solid fa-xmark"></i>
            取消
          </button>
        </div>
      </div>`;
        } else if (eventName === "removeToTrash") {
            alertWindowContent.innerHTML = `
      <div class="alert--kai d-none rounded-2" style="background-color: #A2D8FF;" id="removeToTrash">
        <div class="ask--kai">確定要將所選商品刪除嗎？</div>
        <div class="askbtn--kai">
          <button class="btnstyle--kai text-dark rounded-2" style="background-color: #ffb74d" data-action="goTrash">
            <i class="fa-solid fa-check"></i>確定
          </button>
          <button class="btnstyle--kai text-dark rounded-2" style="background-color: #D2E3F7" data-action="noTrash">
            <i class="fa-solid fa-xmark"></i>取消
          </button>
        </div>
      </div>`;
        }
    };

    let resetAlertWindowContent = () => {
        alertWindowContent.innerHTML = "";
    };



    let handleClick = (event) => {
        let target = event.target;
        let action = target.dataset.action;

        if (action === "yesRemove") {
            yesRemove();
        } else if (action === "noRemove") {
            noRemove();
        } else if (action === "goTrash") {
            goTrash();
        } else if (action === "noTrash") {
            noTrash();
        } else if (target.id.startsWith("remove-")) {
            remove(target);
        }
    };
    let confirm = null;
    let remove = (button) => {
        let itemIdToRemove = button.id.split("-")[1];
        confirm = document.getElementById("removeConfirm");

        if (confirm === null) {
            setAlertWindow("removeConfirm");
            confirm = document.getElementById("removeConfirm");
        }

        confirm.classList.remove("d-none");
        button.classList.add("btn-active");
        button.parentNode.parentNode.classList.add("bg-info-subtle");
    };

    let yesRemove = () => {
        confirm.classList.add("d-none");
        resetAlertWindowContent();
        let deleted_id = document.getElementsByClassName("btn-active")[0].id.replace("remove-", "");
        var formData = new FormData();
        formData.append('item_id', deleted_id);
        fetch('./controller/itemDelete.php', {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => console.log(data))
            .then(() => window.location.reload())
            .catch(error => console.error(error));
    };

    let noRemove = () => {
        confirm.classList.add("d-none");
        resetAlertWindowContent();
        const activeBtn = document.getElementsByClassName("btn-active")[0];
        const row = activeBtn.parentNode.parentNode;
        row.classList.remove("bg-info-subtle");
        activeBtn.classList.remove("btn-active");
        resetAlertWindowContent();
    };
    let trashContent = null;
    let trashItem = () => {
        trashContent = document.querySelector("#removeToTrash");

        if (trashContent === null) {
            setAlertWindow("removeToTrash");
            trashContent = document.querySelector("#removeToTrash");
        }

        trashContent.classList.remove("d-none");
    };

    let trashButton = document.querySelector("#trashCan");
    trashButton.addEventListener("click", trashItem);

    let goTrash = () => {
        trashContent.classList.add("d-none");
        resetAlertWindowContent();
        let checked = document.querySelectorAll(".checkedItem--kai");
        checked.forEach(item => {
            if (item.checked) {
                console.log(item);
            }
        });
    };

    let noTrash = () => {
        trashContent.classList.add("d-none");
        resetAlertWindowContent();
    };
    document.addEventListener('click', handleClick);

    let takeOffItem = document.querySelector("#takeOffItem");
    let takeOffConfirm = document.querySelector("#takeOffConfirm");
    let takeOffId;
    let takeOff = (event) => {
        takeOffId = event.target.id.split("-")[1];
        takeOffConfirm.classList.remove("d-none");
    }
    let takeOffT = () => {
        takeOffConfirm.classList.add("d-none");
        console.log(takeOffId);

    }
    let takeOffF = () => {
        takeOffConfirm.classList.add("d-none");
    }
    let publishItem =document.querySelector("#publishItem");
    let publishConfirm =document.querySelector("#publishConfirm");
    let publishId;
    let publish = event =>{
        publishId = event.target.id.split("-")[1];
        publishConfirm.classList.remove("d-none");
    }
    let publishT = ()=>{
        publishConfirm.classList.add("d-none");
        console.log(publishId);
    }
    let publishF = ()=>{
        publishConfirm.classList.add("d-none");
    }
    
</script>