<?php

include_once "../base.php";
$db=new DB("que");

if(!empty($_POST['subject'])){
    
    $db->save(['text'=>$_POST['subject'],'parent'=>0,'count'=>0]);
    $parent=$db->find(['text'=>$_POST['subject']]);

    if(!empty($_POST['options'])){
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

to("../admin.php?do=que");

?>