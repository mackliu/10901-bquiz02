<fieldset>
    <legend>帳號管理</legend>
    <form action="api/admin_acc.php" method="post">
        <table style="width:50%;margin:auto">
            <tr class="ct clo">
                <td>帳號</td>
                <td>密碼</td>
                <td>刪除</td>
            </tr>
        <?php
            $db=new DB("user");
            $rows=$db->all();
            foreach($rows as $row){
                if($row['acc']!='admin'){
        ?>
            <tr class="ct">
                <td><?=$row['acc'];?></td>
                <td><?=str_repeat("*",strlen($row['pw']));?></td>
                <td>
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                </td>
            </tr>
        <?php
                }
            }
        ?>
        </table>
        <div class="ct">
            <input type="submit" value="確定刪除">
            <input type="reset" value="清空選取">
        </div>
    </form>

</fieldset>