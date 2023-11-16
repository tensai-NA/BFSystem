<?php session_start(); ?>

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
    }
    ?>
    <form action="cart.php" method="post">
        <input type="checkbox" name=“checkbox” value="1" checked /><br>
        <?php
            if(isset($_POST['checkbox'])){
                $a=0;
            }else{
                $a=1;
            }
        ?>
    </form>

    <img src="">

    <?php
    if(!empty($_SESSION['Shohin'])){
        
        $total=0;
        foreach($_SESSION['Shohin'] as $id=>$Shohin){
            echo '<a href="detail.php?id=',$id,'">',
                $Shohin['name'],'</a>';
            echo $Shohin['price'];
            echo '<form method="post">';
            echo '<input type="number" name="quantity['.$id.']" value="'.$Shohin['count'].'" min="1" />';
            echo '<input type="submit" name="update" name="update" value="update" />';
            echo '</form>';

            $subtotal=$Shohin['price']*$Shohin['count'];
            $total+=$subtotal;
            echo $subtotal;

            echo floor($Shohin['price']/100);
        }
    }
    ?>

    <p>
        ポイント -pt <br>
        リピート割 -￥000 <br>
    </p>

    <a href="">削除</a>

    <hr>
    <p>
        商品合計（税込）　　　　0,000円<br>
        リピート割　　　　　　　　000円<br>
        送料　　　　　　　　　　　　0円<br>
    </p>
    <hr>

    <p>注文合計　　　　　　　　　0,000円</p>

    <button onclick="loction.href='purchase.php'">ご注文手続きへ ＞</button>

</body>
</html>
