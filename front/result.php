
<style>
.bar{
    background: #ccc;
    height: 20px;
    display: inline-block;
}

</style>
<?php
    //取得要顯示的題目id
    $q=$_GET['q'];
    $db=new DB('que');
    $subject=$db->find($q);

    //取得對應題目的所有選項
    $options=$db->all(['parent'=>$q]);

?>

<fieldset>
    <legend>目前位置：首頁 > 問卷調查 > <?=$subject['text'];?></legend>
    <h3><?=$subject['text'];?></h3>
    <table>
    <?php

        foreach($options as $key => $row){
            //判斷總票數是否為零,如果是零則改為1
            $total=($subject['count']==0)?1:$subject['count'];

            //計算該選項的票數佔總票數的比例
            $rate=round($row['count']/$total,2);
    ?>
        <tr>
            <td width="50%"><?=$key+1;?>. <?=$row['text'];?></td>
                                                        <!--計算div要顯示的長度-->
            <td width="50%"><div class="bar" style="width:<?=(70*$rate);?>%"></div><?=$row['count'];?>票(<?=$rate*100;?>%)</td>

        </tr>
        <?php
        }
        ?>
    </table>
<div class="ct"><button onclick="location.href='?do=que'">返回</button></div>
</fieldset>

