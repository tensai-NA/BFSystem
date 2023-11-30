<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>

<?php
    $msgPass="";
    $Link="";
    $shohin = $_GET['id'];
    if(isset($_POST["tuika"])){
        if(isset($_SESSION['customer'])){ // roguinn  
            // dbに保存
            $user=$_SESSION['customer']['user_id'];
           
            $pdo=new PDO($connect, USER, PASS);  //すでに同じshohin_idがある場合、数量＋1,登録しない
            $sql=$pdo->prepare('select * from Cart where user_id= ? and shohin_id =?');//すでに登録されているか確認
            $sql->execute([$user, $shohin]);
            $count=$sql-> rowCount();

            if($count==0){
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare("insert into Cart values(?,?,?,0)");
            $sql->execute([$user,$shohin,$_POST['num']]);

            }else{
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare("update Cart set num= num+1 where user_id= ? and shohin_id =?");
            $sql->execute([$user, $shohin]);


            }
            $msgPass='<p>カートにこの商品を'.$_POST['num'].'個追加しました</p>';
            $Link='</p>カートは<a href="cart.php">こちら</p>';
           
           
        }
    }
        
  
              
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <title>商品詳細画面</title>
</head>
<body>
<div class="m-4 has-text-centered ">

        <nav class="level  is-mobile">

            <div class="level-left ml-3">
                <a href="#" onclick="history.back()"><i class="fas fa-long-arrow-alt-left fa-2x" ></i></a>
            </div>
               
            <div class="level-right">
            <p class="mr-4 fa-2x">
            <span class="fa-layers fa-fw bg">
                 <a href="cart.php"><i class="fas fa-shopping-cart " ></i>

               <span class="fa-layers-counter" style="background: #ad9000;">
                <!--ここにカートの数量-->仮
                </span>
                </a></span></p>
            <p class="mr-3" >
            <a href="home.php"><i class="fas fa-home fa-2x"></i></a>
            </p>
    </div></nav><hr>

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
      <p>個数<input type="number" name="num" min="1" value="1"></p>
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
        <?= $msgPass ?>
        <?= $Link ?>
    </div>

        
        
</body>
</html>