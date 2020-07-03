<style>
    fieldset{
        display:inline-block;
        vertical-align: top;
        margin-top:20px ;
    }
    .item,
    .list-item{
        display: block;
        margin:5px 10px;
    }

</style>
<div>目前位置：首頁 > 分類網誌 > <span id="nav"></span></div>
<fieldset>
    <legend>分類網誌</legend>
<a class='item' href="javascript:showList(1)">健康新知</a>
<a class='item' href="javascript:showList(2)">菸害防治</a>
<a class='item' href="javascript:showList(3)">癌症防治</a>
<a class='item' href="javascript:showList(4)">慢性病防治</a>
</fieldset>
<fieldset style="width:75%">
    <legend>文章列表</legend>
    <div class="list"></div>
    <div class="text"></div>
</fieldset>


<script>
showList(1)

function showList(type){
    let str=["健康新知","菸害防治","癌症防治","慢性病防治"]
    $("#nav").html(str[type-1])
    $.get("api/get_list.php",{type},function(list){
        $(".list").html(list)
        $(".text").hide()
        $(".list").show()
    })

}

function showPost(id){
    $.get("api/get_post.php",{id},function(post){
        $(".text").html(post)
        $(".list").hide();
        $(".text").show();
    })
}
</script>