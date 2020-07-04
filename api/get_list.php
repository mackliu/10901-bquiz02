<?php 

include_once "../base.php";
$db=new DB("news");

//取得以GET傳送過來的文章分類
$type=$_GET['type'];

//根據文章分類來查詢所有符合分類的文章
$rows=$db->all(['type'=>$type]);

//以迴圈方式來產生前端需要的html內容
foreach($rows as $r){

    //在a標籤的連結中代入文章id及showPost()函式，用來取得文章內容
    echo "<a class='list-item' href='javascript:showPost(".$r['id'].")'>";
    echo $r['title'];
    echo "</a>";
}


?>