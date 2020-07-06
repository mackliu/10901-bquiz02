<?php
include_once "../base.php";

$db=new DB("user");
if(!empty($_POST['del'])){

    foreach($_POST['del'] as $id){
        $db->del($id);
    }
}

to("../admin.php?do=acc");
?>