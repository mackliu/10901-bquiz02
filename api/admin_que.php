<?php

include_once "../base.php";
$db=new DB("que");

//檢查題目欄位是否有內容
if(!empty($_POST['subject'])){
    
    //直接新增題目的資料進資料表
    $db->save(['text'=>$_POST['subject'],'parent'=>0,'count'=>0]);

    //取得剛才存入資料表的題目的id
    $parent=$db->find(['text'=>$_POST['subject']]);

    //判斷是否有選項
    if(!empty($_POST['options'])){

        //利用迴圈將選項寫入資料表，要記得設定選項的所屬題目id
        foreach($_POST['options'] as $opt){
            $data=[
                'text'=>$opt,
                'parent'=>$parent['id'],
                'count'=>0
            ];
            $db->save($data);
        }
    }
}

//將頁面導向後台的問卷管理頁面
to("../admin.php?do=que");

?>