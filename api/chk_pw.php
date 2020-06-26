<?php
include_once "../base.php";

$db=new DB("user");

//接收ajax傳送過來的資料
$acc=$_GET['acc'];
$pw=$_GET['pw'];

//在資料表中尋找是否有符合的資料
$chk=$db->find(['acc'=>$acc,'pw'=>$pw]);

//根據結果回傳不同的資料及做相應的處理,如建立session
if(empty($chk)){
    echo 0;
}else{
    echo 1;
    $_SESSION['login']=$acc;
}


?>