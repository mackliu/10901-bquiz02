<?php 

include_once "../base.php";
$db=new DB("news");

$id=$_GET['id'];
$row=$db->find($id);

echo "<pre>".$row['text']."</pre>";


?>