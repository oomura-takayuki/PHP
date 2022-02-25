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
    //タスク情報取得処理 update_idの有無で分岐
    if (empty($update_id) == true) {
        $stmt = utl_select($id);
    } else {
        $stmt = utl_select($update_id);
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <!-- 更新ボタン -->
    <form method="POST" action=<?php print $_SERVER['PHP_SELF']; ?>>
        <!-- 更新処理実行後はボタンが消えるように設定 -->
        <?php
        if (empty($update_id) == true) {
        ?>
            タスク内容:<input type="text" name="task_contents" value="<?php echo $result['task_contents'] ?>" required><br>
            <input type="hidden" name="update_id" value=<?php echo $id ?>>
            <input type="submit" name="button1" value="更新" /><br>
        <?php
        }
        //更新ボタン押下時のみ処理
        if (empty($update_id) == false) {
            utl_update($update_id);
            $id = $update_id;
            print "更新しました";
        }
        ?>
    </form>
    <!-- 詳細画面遷移ボタン -->
    <form method="GET" action="show.php">
        <input type="hidden" name="id" value=<?php echo $id ?>>
        <input type="submit" name="btn1" value="詳細画面へ戻る">
    </form>
    <!-- 一覧表示画面遷移ボタン -->
    <form method="GET" action="index.php">
        <input type="submit" name="btn1" value="一覧表示画面へ戻る">
    </form><br>
</body>

</html>