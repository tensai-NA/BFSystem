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
    if(!empty($_SESSION['Shohin'])){

        $total=0;
        foreach($_SESSION['Shohin'] as $id=>$Shohin){
            echo '<form method="post">';
            echo '<input type="checkbox" name=“checkbox” value="1" checked /><br>';
                if(isset($_POST['checkbox'])){
                    $a=0;
                }else{
                    $a=1;
                }
            echo '</form>';


            echo '<a href="detail.php?id=',$id,'">',
                $Shohin['name'],'</a>';
            echo $Shohin['price'];
            echo '<form method="post">';
            echo '<input type="number" name="quantity['.$id.']" value="'.$Shohin['count'].'" min="1" />';
            echo '<input type="submit" name="update" name="update" value="update" />';
            echo '</form>';

            $subtotal=$Shohin['price']*$Shohin['count'];
            $total+=$subtotal;
            echo '小計 ￥',$subtotal;

            echo 'ポイント',floor($Shohin['price']/100),'pt';
            echo 'リピート割 ￥',$Shohin-($Shohin*0.1);

            echo '<a href="cart-delete.php?id=',$id,'">削除</a>';
        }
    }
    ?>

    <hr>

    <?php
    if(!empty($_SESSION['Shohin'])){
        
        $total=0;
        foreach($_SESSION['Shohin'] as $id=>$Shohin){
            echo '商品合計（税込）',$total,'円';

            echo 'リピート割 ￥',$Shohin-($Shohin*0.1),'円';

            echo '送料350円';
        }
    }
    ?>

    <hr>

    <?php
    if(!empty($_SESSION['Shohin'])){
        
        $total=0;
        foreach($_SESSION['Shohin'] as $id=>$Shohin){
            echo '注文合計',$total+350,'円';
        }
    }
    ?>

    <button onclick="loction.href='purchase.php'">ご注文手続きへ ＞</button>

</body>
</html>
