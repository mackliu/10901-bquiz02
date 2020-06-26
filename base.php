<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB
{

    private $dsn = "mysql:host=localhost;charset=utf8;dbname=db66";
    private $root = "root";
    private $password = "";
    private $table;
    private $pdo;

    //設定建構式
    public function __construct($table)
    {

        $this->table = $table;

        $this->pdo = new PDO($this->dsn, $this->root, $this->password);
    }

    public function all(...$arg)
    {

        $sql = "select * from $this->table ";

        if (!empty($arg[0]) && is_array($arg[0])) {
            foreach ($arg[0] as $key => $value) {
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }

            $sql = $sql . " where " . implode(" && ", $tmp);
        }

        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        }

        //echo $sql;
        return $this->pdo->query($sql)->fetchAll();
    }

    public function find($arg)
    {

        $sql = "select * from $this->table ";

        if (is_array($arg)) {

            foreach ($arg as $key => $value) {
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }

            $sql = $sql . " where " . implode(" && ", $tmp);

        } else {
            $sql = $sql . " where `id`='$arg'";
        }

        //echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

//計算筆數
    public function count(...$arg)
    {

        $sql = "select count(*) from $this->table ";

        if (!empty($arg[0]) && is_array($arg[0])) {

            foreach ($arg[0] as $key => $value) {
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }

            $sql = $sql . " where " . implode(" && ", $tmp);
        }

        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        }

        return $this->pdo->query($sql)->fetchColumn();

    }

    public function save($arg)
    {

        if (!empty($arg['id'])) {
            //更新
            foreach ($arg as $key => $value) {
                if ($key != 'id') {
                    $tmp[] = sprintf("`%s`='%s'", $key, $value);
                }
            }

            $sql = "update $this->table set " . implode(",", $tmp) . " where `id`='" . $arg['id'] . "'";

        } else {
            //新增
            $sql = "insert into $this->table (`" . implode("`,`", array_keys($arg)) . "`) values('" . implode("','", $arg) . "')";

        }

        return $this->pdo->exec($sql);
    }

    public function del($arg)
    {

        $sql = "delete from $this->table ";

        if (is_array($arg)) {

            foreach ($arg as $key => $value) {
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }

            $sql = $sql . " where " . implode(" && ", $tmp);

        } else {
            $sql = $sql . " where `id`='$arg'";
        }

        //echo $sql;
        return $this->pdo->exec($sql);
    }

    public function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll();
    }

}

function to($url)
{
    header("location:" . $url);
}


/**判斷瀏灠人次 */

$total=new DB('total');
$chk=$total->find(['date'=>date("Y-m-d")]);
if(empty($chk) && empty($_SESSION['visited'])){
    //沒有今天的資料,也沒有session  今天頭香 需要新增今日資料,
    $total->save(["date"=>date("Y-m-d"),"total"=>1]);
    $_SESSION['visited']=1;

}else if(empty($chk) && !empty($_SESSION['visited'])){
    //沒有今天的資料,但是有session 異常情形..需要新增今日資料
    $total->save(["date"=>date("Y-m-d"),"total"=>1]);

}else if(!empty($chk) && empty($_SESSION['visited'])){
    //有今天的資料,沒有session  表示是新來 需要加1
    $chk['total']++;
    $total->save($chk);
    $_SESSION['visited']=1;

}

/*巢狀判斷的寫法*/
//先建一個檢查日期用的函式，並且會回傳當天的訪客人數資料
/* function chkTotal(){
    global $total;
    $chk=$total->find(["date"=>date("Y-m-d")]);
    if(empty($chk)){
        $total->save(["date"=>date("Y-m-d"),"total"=>1]);
    }

    return $total->find(["date"=>date("Y-m-d")]);
}

//利用session來檢查使用者是否為首次來訪的訪客，再套用chkTotal函式來執行日期的檢查，藉此減少重覆程式碼的撰寫
if(empty($_SESSION['visited'])){
    $t=chkTotal();
    $t['total']++;
    $total->save($t);
    $_SESSION['visited']=1;
}else{
    chkTotal();
} */