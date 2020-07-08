<?php
include_once "../base.php";

$db=new DB("news");

//利用迴圈來檢查每一筆資料要進行的動作
foreach($_POST['id'] as $key => $id){

    //如果有被勾選刪除的資料則直接刪除
    if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
        $db->del($id);
    }else{
        //取出資料
        $row=$db->find($id);
        //變更顯示的狀態後存回資料表
        $row['sh']=(!empty($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
        $db->save($row);
    }
}

//將頁面導回後台的文章管理頁面
to("../admin.php?do=news");


?>