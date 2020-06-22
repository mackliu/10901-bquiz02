<?php 

include_once "../base.php";
$db=new DB("user");
/* $acc=$_POST['acc'];
$pw=$_POST['pw'];
$email=$_POST['email']; */

echo $db->save($_POST);

?>
