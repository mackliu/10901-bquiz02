<?php
include_once "../base.php";
//刪除session資料來達到登出的效果
unset($_SESSION['login']);

//登出後將使用者導回首頁
to("../index.php");
?>