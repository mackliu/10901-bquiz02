<?php 

include_once "../base.php";
$db=new DB("user");
/* $acc=$_POST['acc'];
$pw=$_POST['pw'];
$email=$_POST['email']; */

//因為ajax傳送過來的資料和資料表的欄位相符,而$_POST本身也是個陣列，因此可以直接進行儲存的操作
//但是在實務上，需要先對傳送過來的資料做格式及安全性的檢查後才能寫入資料表
echo $db->save($_POST);

?>
