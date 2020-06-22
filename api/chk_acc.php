<?php
include_once "../base.php";

$db=new DB("user");
$acc=$_GET['acc'];
$chk=$db->find(['acc'=>$acc]);

if(empty($chk)){
    echo 0;
}else{
    echo 1;
}


?>