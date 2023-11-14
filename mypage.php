<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>

<!--　担当：川崎　10.マイページ-->



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>マイページ</title>
</head>
<body>
<h2>マイページ</h2>
<?php //エラーメッセージ
    if(!isset($_SESSION['customer'])){
        echo '<p><a href="login.php">ログインはこちら</a></p>';
        exit();
    }

?>
<?php //名前取得
        $id =$_SESSION['customer']['user_id'];
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->query("select user_sei from User where user_id='".$id."'");
        $sei = $sql->fetch(PDO::FETCH_COLUMN);
        echo '<p>',$sei,'様</p>';

    ?>

<a href="home.php"><i class="fas fa-home"></i></a>
<!--エラーメッセージ-->
<p>ポイント</p>
<hr>
<?php //ポイント取得
        $id =$_SESSION['customer']['user_id'];
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->query("select point from User where user_id='".$id."'");
        $point = $sql->fetch(PDO::FETCH_COLUMN);
        echo '<p>利用可能ポイント: ',$point,'pt</p>';

    ?>
<p>最近の購入履歴</p>
    <hr>
    <p>○○<br>
    カラー:ピンク<br>
    価格:￥0,000</p>

    <p>○○<br>
    カラー:オレンジ<br>
    価格:￥0,000</p>

    <p>○○<br>
    カラー:イエロー<br>
    価格:￥0,000</p>
    　　　　　　　　　　<a href="history.php">購入履歴一覧へ→</a></p>


<p><a href="logout.php">ログアウト</a><br>
<a href="update.php">登録情報更新</a></p>
</body>
</html>







    
    