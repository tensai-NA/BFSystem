<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>カート画面</title>
</head>
<body>
    <button type="button" onclick="history.back()">←</button>
    <h2>カート</h2>
    <a href="home.php"><i class="fas fa-home"></i></a>

    <?php
    if(!isset($_SESSION['customer'])){
        echo '<p>カートを閲覧するにはログインしてください</p>';
        echo '<p><a href="login.php">ログインはこちら</a></p>';
        exit();
    }
    ?>

    <?php
    if(isset($_SESSION['customer'])){
        $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->query("select Shohin.shohin_img,Shohin.shohin_mei,Shohin.price,Color.color_mei,Cart.num
                from Shohin,Cart,Color
                where Shohin.shohin_id = Cart.shohin_id
                and Shohin.color = Color.color_code
                and Cart.user_id = '".$id."'");
        
        $total=0;        
        foreach($sql as $row){
            echo '<form method="post">';
            echo '<input type="checkbox" name=“checkbox” value="1" checked /><br>';
                if(isset($_POST['checkbox'])){
                    $a=1;
                }else{
                    $a=0;
                }
            echo '</form>';

            echo $row['shohin_mei'],'<br>';
            echo $row['color_mei'],'<br>';
            echo $row['price'],'円','<br>';  

            echo '<form method="post">';
            echo '数量','<input type="number" name="quantity['.$id.']" value="'.$row['num'].'" min="1" />';
            echo '</form>';

                if($a==1){
                    $subtotal = $row['num'] * $row['price'];
                    $total+=$subtotal;
                    echo '小計 ￥',$subtotal;
                }else{
                    $subtotal;
                }

            echo 'ポイント',floor($subtotal/100),'pt','<br>';
            $repeat = $row['price']-($row['price'] * 0.1);
            echo 'リピート割 ￥',$repeat,'<br>';

            echo '<a href="cart-delete.php?id=',$id,'">削除</a>';
        }
    }
    ?>

    <hr>

    <?php
    if(isset($_SESSION['customer'])){
        $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->query("select Shohin.shohin_img,Shohin.shohin_mei,Shohin.price,Color.color_mei,Cart.num
                from Shohin,Cart,Color
                where Shohin.shohin_id = Cart.shohin_id
                and Shohin.color = Color.color_code
                and Cart.user_id = '".$id."'");
        
        $total=0;        
        foreach($sql as $row){
            $subtotal = $row['num'] * $row['price'];
            $total+=$subtotal;
            echo '商品合計（税込）',$total,'円','<br>';

            $repeat = $row['price']-($row['price'] * 0.1);
            echo 'リピート割 ￥',$repeat,'円','<br>';

            echo '送料350円','<br>';
        }
    }
    ?>

    <hr>

    <?php
    if(isset($_SESSION['customer'])){
        $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->query("select Shohin.shohin_img,Shohin.shohin_mei,Shohin.price,Color.color_mei,Cart.num
                from Shohin,Cart,Color
                where Shohin.shohin_id = Cart.shohin_id
                and Shohin.color = Color.color_code
                and Cart.user_id = '".$id."'");
        
        $total=0;        
        foreach($sql as $row){
            $subtotal = $row['num'] * $row['price'];
            $total+=$subtotal;
            $repeat = $row['price']-($row['price'] * 0.1);
            echo '注文合計',$total-$repeat+350,'円';
        }
    }
    ?>

    <button onclick="location.href='purchase.php'">ご注文手続きへ ＞</button>

</body>
</html>
