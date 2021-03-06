<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
        <!-- <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /> -->
        <title>詳細表示画面</title>
</head>

<body>
        <h1>タスク詳細</h1>
        <?php
        //外部ファイル読み込み
        require 'utils.php';
        //GET値を取得
        $id = filter_input(INPUT_GET, 'id');
        //pod形式で'test'databaseに接続
        $dsn = 'mysql:dbname=test;host=localhost;';
        $user = 'root';
        $password = 'takayuki07';
        $dbh  = utl_db_connect($dsn, $user, $password);
        //挿入する値は空のまま、SQL実行の準備をする
        $sql =  $dbh->prepare('SELECT id, task_contents, created_date, updated_date FROM tasks WHERE id = ?');
        // バインド変数を利用
        $sql->bindValue(1, $id, PDO::PARAM_INT);  //
        // executeでクエリを実行
        $sql->execute();
        while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
                print $result['id'] . '｜';
                print($result['task_contents'] . '｜');
                print($result['created_date'] . '｜');
                print($result['updated_date'] . '｜');
        }
        //DB接続を閉じる
        $dbh = null;
        ?>
        <div style="display:inline-flex">
                <!-- 削除処理-->
                <form method="POST" action=index.php onsubmit="return delete_confirm()">
                        <input type="hidden" name="delete_id" value=<?php echo $id ?>>
                        <input type="submit" name="button1" value="削除" /><br>
                </form>
        </div>

        <!-- 編集画面へ遷移-->
        <form method="GET" action="edit.php">
                <input type="hidden" name="id" value=<?php echo $id ?>>
                <input type="submit" name="btn1" value="編集画面へ">
        </form>

        <!-- 一覧表示画面へ遷移 -->
        <form method="GET" action="index.php">
                <input type="submit" name="btn1" value="一覧表示画面へ戻る">
        </form><br>
        </p>
</body>

</html>