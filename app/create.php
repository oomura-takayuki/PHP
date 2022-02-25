<?php
//外部ファイル読み込み
require 'utils.php';
//new.phpから受け取った"task_contents"をDBに登録
utl_insert($_POST["task_contents"]);
//new.phpへリダイレクト
header('Location: http://localhost/app/new.php');
