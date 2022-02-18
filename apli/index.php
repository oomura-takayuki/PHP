<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<link rel="stylesheet" href="style.css">

<head>
    <title>一覧表示画面</title>
</head>

<body>
    <h1>タスク一覧</h1>
    <?php
    //外部ファイル読み込み
    require 'utils.php';
    //一覧表示画面or詳細表示画面で削除ボタン押下した際の削除処理
    $delete_id = filter_input(INPUT_POST, 'delete_id');
    if (empty($_POST["delete_id"]) == false) {
        utl_delete($delete_id);
    }
    //pod形式で'test'databaseに接続
    $dsn = 'mysql:dbname=test;host=localhost;';
    $user = 'root';
    $password = 'takayuki07';
    $dbh  = utl_db_connect($dsn, $user, $password);
    //tasks table から一覧情報取得
    $sql = 'SELECT id, task_contents, created_date,updated_date from tasks';
    $stmt = $dbh->query($sql);
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        print($result['id'] . '｜');
        print($result['task_contents'] . '｜');
        $id = $result['id'];
    ?>
        <div style="display:inline-flex">
            <form method="GET" action="show.php">
                <input type="hidden" name="id" value=<?php echo $id ?>>
                <input type="submit" name="btn1" value="詳細">
            </form>
            <!-- 削除処理-->
            <form method="POST" action=<?php echo $_SERVER['PHP_SELF']; ?> onsubmit="return delete_confirm()">
                <input type="hidden" name="delete_id" value=<?php echo $id ?>>
                <input type="submit" name="button1" value="削除" /><br>
            </form>
        </div> <br>
    <?php
    };
    //DB接続を閉じる
    $dbh = null;
    ?>
    <!-- 新規登録画面へ遷移 -->
    <form method="GET" action="new.php">
        <input type="submit" name="btn1" value="新規タスクを登録する">
    </form>
</body>

</html>