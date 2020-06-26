<fieldset style="margin:auto;padding:10px;width:50%;">
    <legend>忘記密碼</legend>
<table style="width:100%">
    <tr>
        <td width="100%">
            <input type="text" name="email" id="email"  style="width:96%">
        </td>
    </tr>
    <tr>
        <td id="result"></td>
    </tr>
    <tr>
        <td><input type="button" value="尋找" onclick="findPw()"></td>
    </tr>
</table>
</fieldset>
<script>

//用ajax來查詢密碼
function findPw(){

    //先取得表單上的email值
    let email=$("#email").val();
    if(email==""){
        alert("欄位不可為空白")
    }else{

        //使用ajax的方式將email傳遞給find_pw.php，然後將回應的資料顯示在#result的位置
        $.get("api/find_pw.php",{email},function(res){
            $("#result").html(res)
        })
    }

}


</script>