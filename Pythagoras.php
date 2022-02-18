<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>ピタゴラス（三平方の定理）プログラム</title>
</head>

<body>
    <p>ピタゴラス（三平方の定理）プログラム <br>
        三平方の定理は、直角三角形の3つの辺について直角をはさむ2つの辺の長さをそれぞれ a と b、斜辺の長さを c としたとき、以下のような関係が成り立つという公式です。<br>
        cの二乗 = aの二乗 + bの二乗<br>
        以下の仕様を満たすようにphpファイルを作成してください<br>
        <br>
        仕様<br>
        ・GETパラメータを2つ使用（aとb）<br>
        ・phpではこの2つの辺の長さを取得し、三平方の定理を使って cの二乗 を求める<br>
        ・平方根のcを求め、以下のように画面に表示する<br>

        ex.直角をはさむ2辺の長さが 3.0 と 4.0 のとき、 斜辺の長さは 5.0 になります。
    </p>
    <p>==============================================<br>
        辺aとbの値をそれぞれ入力して下さい。
        <!--formアクション実行時サーバ変数を用いて同じURLを読み込む-->
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
        <!--数値かつ小数点一桁までのみ入力可能とする-->
        辺a:<input type="number" name="edge_a" step="0.1" /><br>
        辺b:<input type="number" name="edge_b" step="0.1" /><br>
        <input type="submit" name="button1" value="送信" /><br>
    </form>
    
    <入力値の確認><br>
        <?php
        if (empty($_GET["edge_a"]) == false && empty($_GET["edge_b"] == false)) {
            //number_format関数で小数点以下一桁までを表示する様に変換
            $edge_a = number_format($_GET["edge_a"], 1);
            $edge_b = number_format($_GET["edge_b"], 1);
            //pow関数で辺a,bを二乗し、sqrt関数で平方根(辺c)を計算
            $edge_c = number_format(sqrt(pow($edge_a, 2) + pow($edge_b, 2)), 1);
            //入力値の確認
            print "辺aの入力値は" . $edge_a . '<br>';
            print "辺bの入力値は" . $edge_b . '<br>';
            //結果出力
            print "<出力結果><br >";
            print "直角をはさむ2辺の長さが $edge_a と $edge_b のとき、 斜辺の長さは $edge_c になります。";
        } else {
            print "aとbに数値を入力してから送信ボタンを押してください。<br>";
        }
        ?>
        </p>
</body>

</html>