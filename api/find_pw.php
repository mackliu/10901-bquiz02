<?php
include_once "../base.php";

$email=$_GET['email'];
$db=new DB("user");
$user=$db->find(['email'=>$email]);

if(empty($user)){
    echo "查無此帳號";
}else{
    echo "您的密碼為:".$user['pw'];
}

?>