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
    <title>ホーム画面</title>
</head>
<body>
<form action="search.php" method="post">
    <a href="mypage.php"><i class="fas fa-user-circle"></i></a>
    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
    <?php
?>

    <?php
        if(!isset($_SESSION['customer'])){
            echo '<p><a href="login.php">ログインはこちら</a></p>';
        }else{
            $id =$_SESSION['customer']['user_id'];
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->query("select point from User where user_id='".$id."'");
            $point = $sql->fetch(PDO::FETCH_COLUMN);
            echo '<p>マイポイント: ',$point,'pt</p>'   ; 
        }
        
    ?>

   

       
 
          
        </nav>

        <div class="A  has-background-light"><i class="fas fa-search"></i>　seach</div> 
       
        <?php require 'kyotu/searchbox.php'?>

    <div class="a">
        <h2>おすすめ</h2>
        <!--全顧客で一緒の表示にする-->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</body>
</html>