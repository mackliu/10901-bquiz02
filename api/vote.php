<?php
include_once "../base.php";

$db=new DB("que");

$id=$_POST['vote'];

$row=$db->find($id);
$subject=$db->find($row['parent']);

$row['count']++;
$subject['count']++;
$db->save($row);
$db->save($subject);

to("../index.php?do=result&q=".$subject['id']."");


?>