<!-- 削除ボタン押下時の確認ダイアログ表示  -->
<script>
        function delete_confirm() {
                let result = confirm('本当に削除してよろしいですか？');
                return result;
        }
</script>
<?php

//DB接続処理
function utl_db_connect($dsn, $user, $password)
{
        try {
                $dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
                print('DB接続に失敗しました' . $e->getMessage());
                die();
        }
        return $dbh;
};
//DB削除処理
function utl_delete($delete_id)
{
        $dsn = 'mysql:dbname=test;host=localhost;';
        $user = 'root';
        $password = 'takayuki07';
        //DB接続
        $dbh  = utl_db_connect($dsn, $user, $password);
        $sql =  $dbh->prepare('DELETE  FROM tasks WHERE id = ?');
        // バインド変数を利用
        $sql->bindValue(1, $delete_id, PDO::PARAM_INT);
        // executeでクエリを実行
        $sql->execute();

        //DB接続を閉じる
        $dbh = null;
}
?> 