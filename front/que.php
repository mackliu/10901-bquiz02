<fieldset>
    <legend>目前位置：首頁 > 問卷調查</legend>
    <table>
        <tr style="font-weight:bolder">
            <td>編號</td>
            <td>問卷題目</td>
            <td>投票總數</td>
            <td>結果</td>
            <td>狀態</td>
        </tr>
    <?php
        $db=new DB("que");
        $rows=$db->all(["parent"=>0]);
        foreach($rows as $key => $row){
    ?>
        <tr>
            <td><?=$key+1;?></td>
            <td><?=$row['text'];?></td>
            <td><?=$row['count'];?></td>
            <td><a href="?do=result&q=<?=$row['id'];?>">結果</a></td>
            <td>
                <?php
                    //利用session來判斷使用者的登入狀態,並顯示相應的文字內容或功能
                    if(empty($_SESSION['login'])){
                        echo "請先登入";
                    }else{
                        echo "<a href='?do=vote&q=".$row['id']."'>";
                        echo "參與投票";
                        echo "</a>";
                    }
                ?>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

</fieldset>
