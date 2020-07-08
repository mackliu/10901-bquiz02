<?php
include_once "../base.php";

$db=new DB("user");

//判斷是否有資料被勾選了刪除
if(!empty($_POST['del'])){

    //利用回圈檢查刪除陣列中的每一筆資料,並刪除相應的資料
    foreach($_POST['del'] as $id){
        $db->del($id);
    }
}

//將頁面導回後台帳號管理頁面
to("../admin.php?do=acc");
?>