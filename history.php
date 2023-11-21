<?php
if(isset($_SESSION['customer'])){
    $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query("select OrderA.buy_date,  Shohin.shohin_mei,   Color.color_mei, Shohin.price
            from OrderA,Shohin,Color,History
            where History.order_id = OrderA.order_id
            and   History.shohin_id = Shohin.shohin_id
            and   Shohin.color = Color.color_code
            and OrderA.user_id = '".$id."'");

    foreach($sql as $row){
        echo '購入日',$row['buy_date'],'<br>';
        echo '商品名',$row['shohin_mei'],'<br>';
        echo '色：',$row['color_mei'],'<br>';
        echo '価格:￥',$row['price'],'<br>';
    }
}


?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>購入履歴</title>
</head>
<body>
    <div class="m-4 has-text-centered ">
        
        <nav class="level  is-mobile">
        <div class="level-left">
            <a href="mypage.php"><i class="fas fa-long-arrow-alt-left" ></i></a>
          </div>
          <div class="level-item">
          <h1 class="title is-4">購入履歴</h1>
          </div>
          <div class="level-right">
            </div>
        </nav>
        <?php
if(isset($_SESSION['customer'])){
    $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query("select OrderA.buy_date,  Shohin.shohin_mei,   Color.color_mei, Shohin.price
            from OrderA,Shohin,Color,History
            where History.order_id = OrderA.order_id
            and   History.shohin_id = Shohin.shohin_id
            and   Shohin.color = Color.color_code
            and OrderA.user_id = '".$id."'");

    foreach($sql as $row){
        echo '購入日',$row['buy_date'],'<br>';
        echo '商品名',$row['shohin_mei'],'<br>';
        echo '色：',$row['color_mei'],'<br>';
        echo '価格:￥',$row['price'],'<br>';
    }
}


?>

  

    <p>2023/00/00</p>
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



    
    
    <p>2023/00/00</p>
    <hr>
    <p>○○<br>
    カラー:ピンク<br>
    価格:￥0,000</p>
    </div>
    </body>
</html>


