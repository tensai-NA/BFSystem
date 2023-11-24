<?php require 'kyotu/db-connect.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>商品詳細画面</title>
</head>
<body>
<div class="m-4 has-text-centered ">
    <div class="head">
    
        <p class="back">
            <a href="search.php"><i class="fas fa-long-arrow-alt-left fa-3x" ></i></a>
        </p>

        <p class="headitems">
            <a href="cart.php"><i class="fas fa-shopping-cart fa-3x" ></i></a>
            <a href="home.php"><i class="fas fa-home fa-3x"></i></a>
        </p>

    </div><hr>


    <div class="main">
       
        <ul>
          
        </ul>
        <?php
            if(isset($_SESSION['customer'])){
                $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
                $pdo=new PDO($connect,USER,PASS);
                $sql=$pdo->query("select Shohin.shohin_id,Shohin.shohin_img,Shohin.shohin_mei,Shohin.price
                                    from Shohin
                                    where Shohin.shohin_id = Cart.shohin_id
                                    and Cart.user_id = '".$id."'");
            }
        
        <h3>商品名</h3>
        <h3>価格</h3>
        <button  onclick="loction.href='cart.php'">カートに入れる</button>
    </div>

    <div class="notlogin">
        <?php
            if(!isset($_SESSION['customer'])){
                echo '<p>カートを閲覧するにはログインしてください</p>';
                echo '<p><a href="login.php">ログインはこちら</a></p>';
            exit();
            }
    ?>
        
    </div>
</body>
</html>