
<?php

    //取得題目的id
    $q=$_GET['q'];
    $db=new DB('que');
    $subject=$db->find($q);

    //取得題目的所有選項
    $options=$db->all(['parent'=>$q]);

?>

<fieldset>
    <legend>目前位置：首頁 > 問卷調查 > <?=$subject['text'];?></legend>
    <h3><?=$subject['text'];?></h3>
    <form action="api/vote.php" method="post">
        <table>
        <?php
            foreach($options as $key => $row){
        ?>
            <tr>
                <td><input type="radio" name="vote" value="<?=$row['id'];?>"><?=$row['text'];?></td>
           </tr>
            <?php
            }
            ?>
        </table>
    <div class="ct"><input type="submit" value="我要投票"></div>
    </form>
</fieldset>


