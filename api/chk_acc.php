<?php
include_once "../base.php";

$db=new DB("user");
//接收ajax傳送過來的資料
$acc=$_GET['acc'];

//在資料表尋找是否有相符的資料
$chk=$db->find(['acc'=>$acc]);

//根據尋找的結果回應不同的資料
if(empty($chk)){
    echo 0;
}else{
    echo 1;
}


?>