

<fieldset>
    <legend>新增問卷</legend>
    <form action="api/admin_que.php" method="post">
        <table>
            <tr>
                <td class="clo">問卷名稱</td>
                <td><input type="text" name="subject" ></td>
            </tr>
            <tr>
                <td colspan="2"  class="clo" id="opts">
                    選項<input type="text" name="options[]" >
                    <input type="button" value="更多" onclick="more()">
    
                </td>
            </tr>
    
        </table>
        <div class="ct">
            <input type="submit" value="新增">
            <input type="reset" value="清空">
        </div>
    </form>

</fieldset>
<script>
    function more(){
        let str=`選項<input type="text" name="options[]" ><br>`
        $("#opts").prepend(str)
    }

</script>