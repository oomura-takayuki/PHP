<!-- 削除ボタン押下時の確認ダイアログ表示 -->
<script>
        function delete_confirm() {
                let result = confirm('本当に削除してよろしいですか？');
                return result;
        }
</script>
<?php
//DB接続情報の定数
const DSN = 'mysql:dbname=test;host=localhost;';
const USER = 'root';
const PASSWORD = 'takayuki07';
//DB接続処理
function utl_db_connect()
{
        //pod形式でDBに接続
        try {
                $dbh = new PDO(DSN, USER, PASSWORD);
        } catch (PDOException $e) {
                print('DB接続に失敗しました' . $e->getMessage());
                die();
        }
        return $dbh;
};
//DB表示処理(引数の省略可)
function utl_select($id = "")
{
        //DB接続
        $dbh  = utl_db_connect();
        //引数の有無で分岐
        if ($id == "") {
                $sql = 'SELECT id, task_contents, created_date,updated_date FROM tasks';
                $stmt = $dbh->query($sql);
                //DB接続を閉じる
                $dbh = null;
                //sql実行結果を返却する
                return $stmt;
        } else {
                //DB接続
                $dbh  = utl_db_connect();
                //挿入する値は空のまま、SQL実行の準備をする
                $sql =  $dbh->prepare('SELECT id, task_contents, created_date, updated_date FROM tasks WHERE id = ?');
                //バインド変数を利用
                $sql->bindValue(1, $id, PDO::PARAM_INT);  //
                //executeでクエリを実行
                $sql->execute();
                //DB接続を閉じる
                $dbh = null;
                //sql実行結果を返却する
                return $sql;
        }
}
//DB登録処理
function utl_insert($task_contents)
{
        $dbh  = utl_db_connect();
        $sql = "INSERT INTO tasks ( task_contents, created_date, updated_date ) VALUES (:task, now(), now())";
        //挿入する値は空のまま、SQL実行の準備をする
        $stmt = $dbh->prepare($sql);
        //挿入する値を配列に格納する
        $params = array(':task' => $task_contents);
        //挿入する値が入った変数をexecuteにセットしてSQLを実行
        $stmt->execute($params);
        //DB接続を閉じる
        $dbh = null;
}
//DB更新処理
function utl_update($update_id)
{
        $dbh = utl_db_connect();
        $sql = "UPDATE tasks SET task_contents = :task , updated_date = now() WHERE id = $update_id ";
        //挿入する値は空のまま、SQL実行の準備をする
        $stmt = $dbh->prepare($sql);
        //挿入する値を配列に格納する
        $params = array(':task' => $_POST["task_contents"]);
        //executeでクエリを実行
        $stmt->execute($params);
        //DB接続を閉じる
        $dbh = null;
}
//DB削除処理
function utl_delete($delete_id)
{
        //DB接続
        $dbh  = utl_db_connect();
        $sql =  $dbh->prepare('DELETE  FROM tasks WHERE id = ?');
        //バインド変数を利用
        $sql->bindValue(1, $delete_id, PDO::PARAM_INT);
        //executeでクエリを実行
        $sql->execute();
        //DB接続を閉じる
        $dbh = null;
}
?>