<style>
    /*對fieldset標籤做css設定，讓兩個區塊可以橫向並列，並且向上對齊*/
    fieldset {
        display: inline-block;
        vertical-align: top;
        margin-top: 20px;
    }

    /*用來設定a標籤元件可以有區塊屬性並自動佔滿整行來達到自動斷行的效果*/
    .item,
    .list-item {
        display: block;
        margin: 5px 10px;
    }
</style>
<div>目前位置：首頁 > 分類網誌 > <span id="nav"></span></div>
<fieldset>
    <legend>分類網誌</legend>
    <!--在a連結中宣告呼叫showList()函式，用來載入各分類的文章列表-->
        <a class='item' href="javascript:showList(1)">健康新知</a>
        <a class='item' href="javascript:showList(2)">菸害防治</a>
        <a class='item' href="javascript:showList(3)">癌症防治</a>
        <a class='item' href="javascript:showList(4)">慢性病防治</a>
</fieldset>
<fieldset style="width:75%">
    <legend>文章列表</legend>
    <!--建立兩個區塊，一個用來放置文章列表，一個用來放置文章內容-->
    <div class="list"></div>
    <div class="text"></div>
</fieldset>


<script>
    //在網頁載入後先執行一次showList(1)來用載入健康新知的文章列表
    showList(1)

    function showList(type) {
        //建立一個陣列來存放分類文字
        let str = ["健康新知", "菸害防治", "癌症防治", "慢性病防治"]

        //在分類導列區中寫入目前的分類文字
        $("#nav").html(str[type - 1])

        //以ajax的方式向get_list.php查詢文章列表
        $.get("api/get_list.php", {type}, function (list) {
            //將取得的文章列表寫入到.list的區塊中
            $(".list").html(list)

            //將文章區塊隱藏
            $(".text").hide()

            //將列表區塊顯示
            $(".list").show()
        })

    }


    function showPost(id) {

        //依據文章的id向get_post查詢文章
        $.get("api/get_post.php", {id}, function (post) {
            //將取得的文章內容寫入到.text的區塊中
            $(".text").html(post)

            //將列表區塊隱藏
            $(".list").hide();

            //將文章區塊顯示
            $(".text").show();
        })
    }
</script>