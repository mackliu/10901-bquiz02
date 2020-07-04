<?php
include_once "../base.php";

//建立news及log兩張表的物件
$News=new DB("news");
$Log=new DB("log");

//取得POST傳送過來的文章id
$id=$_POST['id'];

//取得POST傳送過來的動作代號
$type=$_POST['type'];

//取得POST傳送過來的登入者帳號名
$user=$_POST['user'];

//根據文章id取得文章資料
$post=$News->find($id);

//根據動作代號(1:讚,2:收回讚)，來對資料表做不同的動作
switch($type){
    case 1:
        
        //按讚時先向log資料表新增一筆資料，紀錄那位會員對某篇文章按了讚
        $Log->save(['news'=>$id,'user'=>$user]);
        
        //將文章的good欄位加1，做為統計人氣
        $post['good']++;
        
        //將文章資料存回資料表
        $News->save($post);
    break;
    case 2:

        //返回讚時向資料表刪求符合請求的資料
        $Log->del(['news'=>$id,'user'=>$user]);

        //將文章的按讚數減一
        $post['good']--;

        //將文章資料存回資料表
        $News->save($post);
    break;
    
}



?>