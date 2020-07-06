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
            $total=$db->count();
            $div=3;
            $pages=ceil($total/$div);
            $now=(!empty($_GET['p']))?$_GET['p']:1;
            $start=($now-1)*$div;
        
            //取得分頁需要的資料
            $rows=$db->all([]," limit $start,$div");
            foreach($rows as $row){
            $checked=($row['sh']==1)?"checked":"";
        ?>
            <tr class="ct">
                <td><?=$row['id'];?>.</td>
                <td><?=$row['title'];?></td>
                <td>
                    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked;?>>
                </td>
                <td>
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                </td>
            </tr>
        <?php
                
            }
        ?>
        </table>
        <div class="ct">
        <?php

            //顯示頁碼
            if(($now-1)>0){
                echo "<a href='admin.php?do=news&p=".($now-1)."' > < </a>";
            }

            for($i=1;$i<=$pages;$i++){
                $fontSize=($i==$now)?"24px":"18px;";
                echo "<a href='admin.php?do=news&p=$i' style='font-size:$fontSize'> $i </a>";
            }

            if(($now+1)<=$pages){
                echo "<a href='admin.php?do=news&p=".($now+1)."' > > </a>";
            }

            ?>

        </div>
        <div class="ct">
            <input type="submit" value="確定修改">
        </div>
    </form>

</fieldset>