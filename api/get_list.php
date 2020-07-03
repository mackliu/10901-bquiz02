<?php 

include_once "../base.php";
$db=new DB("news");

$type=$_GET['type'];
$rows=$db->all(['type'=>$type]);

foreach($rows as $r){
    echo "<a class='list-item' href='javascript:showPost(".$r['id'].")'>";
    echo $r['title'];
    echo "</a>";
}


?>