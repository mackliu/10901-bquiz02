<?php
include_once "../base.php";

$db=new DB("que");

//取得投票傳過來的選項id
$id=$_POST['vote'];

//取得該選項的資料
$row=$db->find($id);

//取得該選項的題目資料
$subject=$db->find($row['parent']);

//選項的投票計數加1
$row['count']++;

//題目的投票計數加1
$subject['count']++;

//回傳選項及題目
$db->save($row);
$db->save($subject);

//將頁面導向題目的結果頁
to("../index.php?do=result&q=".$subject['id']."");


?>