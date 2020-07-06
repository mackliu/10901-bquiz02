<style>
/*將文章內容的區塊設計成彈出視窗的外觀*/
.all {
    background: rgba(51, 51, 51, 0.8);
    color: #FFF;
    min-height: 100px;
    width: 300px;
    position: fixed;
    display: none;
    z-index: 9999;
    overflow: auto;
}

.title {
    background: #eee;
    cursor: pointer;
}
</style>
<fieldset>
    <legend>目前位置：首頁 > 人氣文章區</legend>
    <table>
        <tr>
            <td width="20%">標題</td>
            <td width="60%">內容</td>
            <td width="20%">人氣</td>
        </tr>

        <?php
        //宣告兩個db的物件，一個是news資料表,一個是log資料表
            $db = new DB("news");
            $log = new DB('log');

            //建立分頁需要的各項變數
            $total = $db->count();
            $div = 5;
            $pages = ceil($total / $div);
            $now = (!empty($_GET['p'])) ? $_GET['p'] : 1;
            $start = ($now - 1) * $div;

            //取得分頁需要的資料
            $rows = $db->all(["sh"=>1], " order by good desc limit $start,$div");

            //顯示資料內容
            foreach ($rows as $row) {
         ?>
        <tr>
            <td class="title"><?=$row['title'];?></td>
            <td class="tt">
                <!--利用mb_substr()來截取片段的內容-->
                <div class="abbr"><?=mb_substr($row['text'], 0, 20, 'utf8');?> ...</div>

                <!--建立一個隱藏的區塊用來存放完整的文章內容-->
                <div class="all"><?=nl2br($row['text']);?></div>
            </td>
            <td>
                <!--顯示文章統計的按讚數-->
                <span id="vie<?=$row['id'];?>"><?=$row['good'];?></span>個人說<img src='icon/02B03.jpg' style="width:20px">

                <?php
                //根據是否登入來決定顯示按讚區
                if (!empty($_SESSION['login'])) {

                    //檢查登入會員是否在log資料表中有對此文章按讚的紀錄
                        $chk = $log->count(['user' => $_SESSION['login'], 'news' => $row['id']]);
                        
                        //根據按讚紀錄來決定要顯示讚或是收回讚
                        if ($chk > 0) {

                            //在按讚的連結文字中加入js的good()函式
                            echo "<a href='#' id='good" . $row['id'] . "' onclick='good(" . $row['id'] . ",2,&#39;" . $_SESSION['login'] . "&#39;)'>收回讚</a>";
                        } else {
                            echo "<a href='#' id='good" . $row['id'] . "' onclick='good(" . $row['id'] . ",1,&#39;" . $_SESSION['login'] . "&#39;)'>讚</a>";
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
        if (($now - 1) > 0) {
            echo "<a href='?do=pop&p=" . ($now - 1) . "' > < </a>";
        }

        for ($i = 1; $i <= $pages; $i++) {
            $fontSize = ($i == $now) ? "24px" : "18px;";
            echo "<a href='?do=pop&p=$i' style='font-size:$fontSize'> $i </a>";
        }

        if (($now + 1) <= $pages) {
            echo "<a href='?do=pop&p=" . ($now + 1) . "' > > </a>";
        }

        ?>
    </div>
</fieldset>

<script>
    //在標題欄和內容欄中建立滑鼠hover的事件，讓隱藏的文章內容可以顯示出來
    $(".title").hover(function() {
        $(this).next().children('.all').toggle();
    })

    $(".tt").hover(function() {
        $(this).children('.all').toggle();
    })
</script>