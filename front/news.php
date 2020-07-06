<style>
.all{
    display:none;
}
.title{
    background:#eee;
    cursor:pointer;
}
</style>
<fieldset>
    <legend>目前位置：首頁 > 最新文章區</legend>
<table>
    <tr>
        <td width="20%">標題</td>
        <td width="60%">內容</td>
        <td width="20%"></td>
    </tr>

<?php
    //宣告兩個db的物件，一個是news資料表,一個是log資料表
    $db=new DB("news");
    $log=new DB('log');

    //建立分頁需要的各項變數
    $total=$db->count();
    $div=5;
    $pages=ceil($total/$div);
    $now=(!empty($_GET['p']))?$_GET['p']:1;
    $start=($now-1)*$div;

    //取得分頁需要的資料
    $rows=$db->all(["sh"=>1]," limit $start,$div");
    
    //顯示資料內容
    foreach($rows as $row){
?>
    <tr>
        <td class="title"><?=$row['title'];?></td>
        <td>
            <!--利用mb_substr()來截取片段的內容-->
            <div class="abbr"><?=mb_substr($row['text'],0,20,'utf8');?> ...</div>
            
            <!--建立一個隱藏的區塊用來存放完整的文章內容-->
            <div class="all"><?=nl2br($row['text']);?></div>
        </td>
        <td>
        <?php
        //根據是否登入來決定顯示按讚區
        if(!empty($_SESSION['login'])){

            //檢查登入會員是否在log資料表中有對此文章按讚的紀錄
            $chk=$log->count(['user'=>$_SESSION['login'],'news'=>$row['id']]);

            //根據按讚紀錄來決定要顯示讚或是收回讚
            if($chk>0){
                
                //在按讚的連結文字中加入js的good()函式
                echo "<a href='#' id='good".$row['id']."' onclick='good(".$row['id'].",2,&#39;".$_SESSION['login']."&#39;)'>收回讚</a>";
            }else{
                echo "<a href='#' id='good".$row['id']."' onclick='good(".$row['id'].",1,&#39;".$_SESSION['login']."&#39;)'>讚</a>";
            }
        }

        ?>

        </td>
    </tr>
<?php
    }
?>
</table>
<div>
<?php

//顯示頁碼
if(($now-1)>0){
    echo "<a href='?do=news&p=".($now-1)."' > < </a>";
}

for($i=1;$i<=$pages;$i++){
    $fontSize=($i==$now)?"24px":"18px;";
    echo "<a href='?do=news&p=$i' style='font-size:$fontSize'> $i </a>";
}

if(($now+1)<=$pages){
    echo "<a href='?do=news&p=".($now+1)."' > > </a>";
}

?>
</div>
</fieldset>
<script>

//當標題被點擊時，相鄰的下一個欄位裏的兩個區塊會交替顯示的狀態
$(".title").on("click",function(){
    $(this).next().children('.abbr').toggle();
    $(this).next().children('.all').toggle();

})


</script>