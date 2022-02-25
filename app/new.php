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
    <!-- 登録ボタン onsubmit属性を付与してregister_alert関数を実行する -->
    <form method="POST" action="create.php" onsubmit="return register_alert()">
        タスク内容:<input type="text" name="task_contents" required /><br>
        <input type="submit" name="button1" value="登録" /><br>
    </form>
    <!-- 一覧表示画面遷移ボタン -->
    <form method="GET" action="index.php">
        <input type="submit" name="btn1" value="一覧表示画面へ戻る">
    </form>
</body>

</html>