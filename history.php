<?php
if(isset($_SESSION['customer'])){
    $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query("select OrdarA.buy_date,  shohin.Shohin.mei,   Color.color_mei,shohin.price
            from Shohin,Cart,Color
            where history.order_id = orderA.order_id
            and   history.shohin_id = shohin.shohin_id
            and   shohin.color_id = color.color_id
            and order.user_id = '".$id."'");

    foreach($sql as $row){
        echo '購入日'$row['buy_date'],'<br>';
        echo '商品名'$row['shohin_mei'],'<br>';
        echo '色：',$row['color_mei'],'<br>';
        echo '価格:￥',$row['price'],;
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
            <a href="mypage.php"><i class="fas fa-long-arrow-alt-left fa-4x" ></i></a>
          </div>
          <div class="level-item">
          <h1 class="title is-3">購入履歴</h1>
          </div>
          <div class="level-right">
            </div>
        </nav>
  

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


