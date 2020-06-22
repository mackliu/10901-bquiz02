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

function findPw(){
    //document.querySelector("#acc").value
    let email=$("#email").val();
    if(email==""){
        alert("欄位不可為空白")
    }else{
        $.get("api/find_pw.php",{email},function(res){
            $("#result").html(res)
        })
    }

}


</script>