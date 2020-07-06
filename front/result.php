
<style>
.bar{
    background: #ccc;
    height: 20px;
    display: inline-block;
}

</style>
<?php
    $q=$_GET['q'];
    $db=new DB('que');
    $subject=$db->find($q);
    $options=$db->all(['parent'=>$q]);

?>

<fieldset>
    <legend>目前位置：首頁 > 問卷調查 > <?=$subject['text'];?></legend>
    <h3><?=$subject['text'];?></h3>
    <table>
    <?php

        foreach($options as $key => $row){
            $total=($subject['count']==0)?1:$subject['count'];
            $rate=round($row['count']/$total,2);
    ?>
        <tr>
            <td width="50%"><?=$key+1;?>. <?=$row['text'];?></td>
            <td width="50%"><div class="bar" style="width:<?=(70*$rate);?>%"></div><?=$row['count'];?>票(<?=$rate*100;?>%)</td>

        </tr>
        <?php
        }
        ?>
    </table>
<div class="ct"><button onclick="location.href='?do=que'">返回</button></div>
</fieldset>

