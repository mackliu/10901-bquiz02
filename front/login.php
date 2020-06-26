<fieldset style="margin:auto;padding:10px;width:50%;">
    <legend>會員登入</legend>
<table>
    <tr>
        <td width="50%" class="clo">帳號</td>
        <td width="50%"><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
        <td class="clo">密碼</td>
        <td><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td><input type="button" value="登入" onclick="login()"><input type="reset" value="清除"></td>
        <td>
            <a href="?do=forget">忘記密碼</a> | <a href="?do=reg">尚未註冊</a>
        </td>
    </tr>
</table>
</fieldset>
<script>

function login(){
    //document.querySelector("#acc").value
    
    //先取得表單上的帳號及密碼欄位資料
    let acc=$("#acc").val();
    let pw=$("#pw").val();

    //先判斷是否有填寫資料
    if(acc=="" || pw==""){
        alert("帳號及密碼欄位不可為空白")
    }else{
        //先以ajax傳送帳號，確認是否有該筆帳號資料存在
        $.get("api/chk_acc.php",{acc},function(res){
            if(res==='1'){

                //確認帳號存在後才送出帳號及密碼進行比對驗證
                $.get("api/chk_pw.php",{acc,pw},function(res){
                    if(res==='1'){

                        //判斷登入者是否為管理者，分別導向不同的頁面
                        if(acc=='admin'){
                            location.href="admin.php"
                        }else{
                            location.href="index.php"
                        }
                    }else{
                        alert("密碼錯誤")
                        location.reload();
                    }
                })
            }else{
                alert("查無帳號")
                location.reload();
            }
        })
    }

}


</script>