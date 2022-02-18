<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>新規登録画面</title>
</head>

<body>
<h1>新規登録</h1><br>
            ※id、登録日時は自動採番<br>
    <?php
    //外部ファイル読み込み
    require 'utils.php';
    ?>
    <!-- 新規登録処理 -->
    <div style="display:inline-flex">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- 必須入力 -->
            タスク内容:<input type="text" name="task_contents" required /><br>
            <input type="submit" name="button1" value="登録" /><br>
            <?php
            //新規登録ボタン押下時のみ処理
            if (empty($_POST["task_contents"]) == false) {
                //pod形式で'test'databaseに接続
                $dsn = 'mysql:dbname=test;host=localhost;';
                $user = 'root';
                $password = 'takayuki07';
                $dbh  = utl_db_connect($dsn, $user, $password);
                $sql = "INSERT INTO tasks ( task_contents, created_date, updated_date ) VALUES (:task, now(), now())";
                // 挿入する値は空のまま、SQL実行の準備をする
                $stmt = $dbh->prepare($sql);
                // 挿入する値を配列に格納する
                $params = array(':task' => $_POST["task_contents"]);
                // 挿入する値が入った変数をexecuteにセットしてSQLを実行
                $stmt->execute($params);
                print "入力内容を新規に登録しました<br>";
            }
            ?>
        </form>
    </div>
    <!-- DB接続を閉じる -->
    <?php
    $dbh = null;
    ?>
    <!-- 一覧表示画面へ遷移 -->
    <form method="GET" action="index.php">
        <input type="submit" name="btn1" value="一覧表示画面へ戻る">
    </form>
</body>

</html>