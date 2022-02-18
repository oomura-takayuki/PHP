<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
    <!-- <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /> -->
    <title>編集画面</title>
</head>

<body>
    <h1>内容編集</h1>
    <?php
    //外部ファイル読み込み
    require 'utils.php';
    //GET値を取得
    $id = filter_input(INPUT_GET, 'id');
    //更新時のPOST値を取得
    $update_id = filter_input(INPUT_POST, 'update_id');
    //pod形式で'test'databaseに接続
    $dsn = 'mysql:dbname=test;host=localhost;';
    $user = 'root';
    $password = 'takayuki07';
    $dbh  = utl_db_connect($dsn, $user, $password);
    //task_contents初期値をDBから取得

    //挿入する値は空のまま、SQL実行の準備をする
    $sql =  $dbh->prepare('SELECT task_contents FROM tasks WHERE id = ?');
    // 更新実施の有無でバインド変数を変更
    if (empty($update_id) == true) {
        $sql->bindValue(1, $id, PDO::PARAM_INT);
    } else {
        $sql->bindValue(1, $update_id, PDO::PARAM_INT);
    }
    // executeでクエリを実行
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    ?>
    <form method="POST" action=<?php print $_SERVER['PHP_SELF']; ?>>
        <!-- 更新処理実行後はボタンが消えるように設定 -->
        <?php
        if (empty($update_id) == true) {
        ?>
            <!-- 必須入力 -->
            タスク内容:<input type="text" name="task_contents" value="<?php echo $result['task_contents'] ?>" required><br>
            <input type="hidden" name="update_id" value=<?php echo $id ?>>
            <input type="submit" name="button1" value="更新" /><br>
        <?php
        }
        ?>
        <?php
        //更新ボタン押下時のみ処理
        if (empty($update_id) == false) {
            $sql = "UPDATE tasks SET task_contents = :task , updated_date = now() WHERE id = $update_id ";
            // 挿入する値は空のまま、SQL実行の準備をする
            $stmt = $dbh->prepare($sql);
            // 挿入する値を配列に格納する
            $params = array(':task' => $_POST["task_contents"]);
            // executeでクエリを実行
            $stmt->execute($params);
            $id = $update_id;
            print "更新しました";
        }
        //DB接続を閉じる
        $dbh = null;
        ?>
    </form>
    <!-- 詳細画面へ遷移 -->
    <form method="GET" action="show.php">
        <input type="hidden" name="id" value=<?php echo $id ?>>
        <input type="submit" name="btn1" value="詳細画面へ戻る">
    </form>
    <!-- 一覧表示画面へ遷移 -->
    <form method="GET" action="index.php">
        <input type="submit" name="btn1" value="一覧表示画面へ戻る">
    </form><br>
</body>

</html>