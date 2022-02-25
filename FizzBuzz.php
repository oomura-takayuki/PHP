<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>FizzBuzz問題</title>
</head>
<p>FizzBuzz問題<br>
    繰り返し処理まで完了後に実施 <br>
    以下の仕様を満たすようにphpファイルを作成してください<br>

    仕様<br>
    1から100までの連続した整数を画面に表示していく。ただし、<br>
    ・もし、その整数が3で割り切れる数なら “Fizz” と表示する。<br>
    ・もし、その整数が5で割り切れる数なら “Buzz” と表示する。<br>
    ・上記2つの条件は同時に満たせる。つまり、もし、その整数が3で割り切れ、なおかつ5で割り切れる数なら “FizzBuzz” と表示する。<br>
    ・それ以外の数はその数をそのまま表示する。<br>
</p>
<p>
    <以下出力結果>
</p>

<body>
    <?php
    for ($count = 1; $count <= 100; $count++) {
        //3と5の最小公倍数15を設定
        $num1 = $count % 15;
        $num2 = $count % 3;
        $num3 = $count % 5;
        if ($num1 == 0) {
            print 'FizzBuzz<br>';
        } elseif ($num2 == 0) {
            print 'Fizz<br>';
        } elseif ($num3 == 0) {
            print 'Buzz<br>';
        } else {
            print  $count . '<br>';
        }
    }
    ?>

</body>

</html>