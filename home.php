<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <title>ホーム画面</title>
</head>
<body>
<form action="search.php" method="post">
<div class="m-4 has-text-centered ">

<nav class="level  is-mobile">

<div class="level-left ml-3">
<img src="sozai/Shopicon.png" width ="40vw" style="max-width:'100%'">
</div>
   


  <div class="level-right">
  <p class="mr-4"><a href="mypage.php"><i class="fas fa-user-circle fa-lg"></i></a></p>
  <p class="mr-3" ><a href="cart.php"><i class="fas fa-shopping-cart fa-lg"   ></i></a></p>
    </div>
</nav>
   
 
<script src="https://code.jquery.com/jquery.min.js"></script>
 <div class="A box m-6 has-background-white-ter"><i class="fas fa-search fa-xs"></i>　search</div> 
 <?php require 'kyotu/searchbox.php'?>

  
    <?php
        if(!isset($_SESSION['customer'])){
            echo '<p><a href="login.php">ログインはこちら</a></p>';
        }else{
            $id =$_SESSION['customer']['user_id'];
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->query("select point from User where user_id='".$id."'");
            $point = $sql->fetch(PDO::FETCH_COLUMN);
            echo '<p>マイポイント: ',$point,'pt</p>'; 
        }
        
    ?>




       

    <div class="m-4 has-text-centered ">
        <h2>おすすめ</h2>
        <!--全顧客で一緒の表示にする-->
  
        <div class="sliderArea">
        <div class="full-screen-o slider">
        <div>
            <a href="detail.php?id=8"><img src="product_img/lip1.png"class="img-item"></a>
         </div>
        <div>
            <img src="product_img/perfume4.jpg" class="img-item">
        </div>
        <div>
            <img src="product_img/nail2.png" class="img-item">
        </div>
    </div>
    </div>

    <div class="m-4">
        <p>新商品</p>

    </div>




    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://code.jquery.com/jquery.min.js"></script> 
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/slick.min.js"></script>    
    <script src="js/home.js"></script> 
    
</body>
</html>