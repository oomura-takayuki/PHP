<?php
//外部ファイル読み込み
require 'utils.php';
//遷移元から受け取った"delete_id"を元に削除処理
utl_delete($_POST["delete_id"]);
//index.phpへリダイレクト
header('Location: http://localhost/app/index.php');
