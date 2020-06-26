<?php
include_once "../base.php";

//接收ajax傳送過來的資料
$email=$_GET['email'];
$db=new DB("user");

//在資料表中尋找是否有符合的資料
$user=$db->find(['email'=>$email]);

//產生回應的訊息
if(empty($user)){
    echo "查無此帳號";
}else{
    echo "您的密碼為:".$user['pw'];
}

?>