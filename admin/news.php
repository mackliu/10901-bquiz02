<fieldset>
    <legend>最新文章管理</legend>
    <form action="api/admin_news.php" method="post">
        <table style="width:80%;margin:auto">
            <tr class="ct">
                <td>編號</td>
                <td width="70%">標題</td>
                <td>顯示</td>
                <td>刪除</td>
            </tr>
        <?php
            $db=new DB("news");
            $rows=$db->all();
            foreach($rows as $row){
            $checked=($row['sh']==1)?"checked":"";
        ?>
            <tr class="ct">
                <td><?=$row['id'];?></td>
                <td><?=$row['title'];?></td>
                <td>
                    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked;?>>
                </td>
                <td>
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                </td>
            </tr>
        <?php
                
            }
        ?>
        </table>
        <div>


        </div>
        <div class="ct">
            <input type="submit" value="確定修改">
        </div>
    </form>

</fieldset>