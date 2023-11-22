<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>



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
    <?php
            if(isset($_SESSION['customer'])){
                $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
                $pdo=new PDO($connect,USER,PASS);
                $sql=$pdo->query("select OrderA.buy_date,  Shohin.shohin_mei,   Color.color_mei, Shohin.price
                        from OrderA,Shohin,Color,History
                        where History.order_id = OrderA.order_id
                        and   History.shohin_id = Shohin.shohin_id
                        and   Shohin.color = Color.color_code
                        and OrderA.user_id = '".$id."'
                        order by OrderA.buy_date DESC
                        limit 3
                        ");

                foreach($sql as $row){
                    echo '<h2>',$row['buy_date'],'</h2>';
                    echo '商品名',$row['shohin_mei'],'<br>';
                    echo '色：',$row['color_mei'],'<br>';
                    echo '価格:￥',$row['price'],'<br>';
                    echo '<hr>';
                }
            }


            ?>
    　　　　　　　　　　<a href="history.php">購入履歴一覧へ→</a></p>


<p><a href="logout.php">ログアウト</a><br>
<a href="update.php">登録情報更新</a></p>
</body>
</html>   