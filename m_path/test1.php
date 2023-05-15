<?php

$p = $_POST["username"];

if ($p === "Leo") {
    echo "歡迎回來，{$p}大仙";
} else {
    echo "輸入錯誤，請重新輸入";
}
