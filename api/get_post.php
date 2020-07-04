<?php 

include_once "../base.php";
$db=new DB("news");

//取得以GET方式傳送過來的文章id
$id=$_GET['id'];

//根據文章id來取得文章的資料
$row=$db->find($id);

//顯示文章資料給前端使用
echo "<pre>".$row['text']."</pre>";

?>