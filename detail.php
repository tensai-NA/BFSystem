<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>

<?php
    $msgPass="";
    $Link="";
    $shohin = $_GET['id'];
    if(isset($_POST["tuika"])){
        if(isset($_SESSION['customer'])){ // roguinn  //すでに同じshohin_idがある場合、数量＋1,登録しない
            // dbに保存
            $user=$_SESSION['customer']['user_id'];
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->prepare("insert into Cart values(?,?,?,0)");
            $sql->execute([$user,$shohin,$_POST['num']]);
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
    <title>商品詳細画面</title>
</head>
<body>
<div class="m-4 has-text-centered ">
    <div class="head">
        <p class="back">
            <a href="#" onclick="history.back()"><i class="fas fa-long-arrow-alt-left fa-2x" ></i></a>
        </p>
        <p class="headitems">
            <a href="cart.php"><i class="fas fa-shopping-cart fa-2x" ></i></a>
            <a href="home.php"><i class="fas fa-home fa-2x"></i></a>
        </p>
    </div><hr>
    <div class="main">
        <?php
            /*
            if(isset($_SESSION['customer'])){
                $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
                $pdo=new PDO($connect,USER,PASS);
                $sql=$pdo->query("select Shohin.shohin_id,Shohin.shohin_img,Shohin.shohin_mei,Shohin.price
                                    from Shohin
                                    where ");

                echo '<form method="post" action="cart.php">';        
                foreach($sql as $row){
                    echo '<img src="' ,$row['shohin_img'], '">','<br>';
                    echo $row['shohin_mei'],'<br>';
                    echo $row['price'],'円','<br>';
                }

            }
      */   
                $id = $_GET['id'];
                $pdo=new PDO($connect,USER,PASS);
                $sql=$pdo->prepare("select Shohin.shohin_id,Shohin.shohin_img,Shohin.shohin_mei,Shohin.price,shohin_exp
                                    from Shohin
                                    where shohin_id = ?");
                $sql->execute([$id]);

                // echo '<form method="post" action="cart.php">';
                echo '<form method="post" action="detail.php?id=',$id,'">';
                foreach($sql as $row){
                    echo '<img src="' ,$row['shohin_img'], '">','<br>';
                    echo $row['shohin_mei'],'<br>';
                    echo $row['price'],'円','<br>';
                    echo $row['shohin_exp'],'<br>';

                }
            ?>
      <p>個数<input type="number" name="num" min="0"></p>
     <?php 
     if(isset($_SESSION['customer'])){
       echo '<button name="tuika">カートに入れる</button> ';
      }else{
        echo '<button name="tuika" class="button"  disabled>カートに入れる</button> ';
        echo '<p>カートに追加するにはログインしてください</p>';
        echo '<a href="login.php">ログインはこちら</a>';
      }
     ?>
        </form>
        <!-- </form> -->
        <p><?= $msgPass ?></p>
        <p><?= $Link ?></p>
    </div>

        
        
</body>
</html>