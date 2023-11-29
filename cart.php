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
<a href="#" onclick="history.back()"><i class="fas fa-long-arrow-alt-left fa-3x" ></i></a>
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
        $sql=$pdo->query("select Shohin.shohin_id,Shohin.shohin_img,Shohin.shohin_mei,Shohin.price,Color.color_mei,Cart.num,Cart.flag
                from Shohin,Cart,Color
                where Shohin.shohin_id = Cart.shohin_id
                and Shohin.color = Color.color_code
                and Cart.user_id = '".$id."'");
        
        $total=0;
        echo '<form method="post" action="purchase.php">';        
        foreach($sql as $row){
            echo '<input type="checkbox" name="checkbox[]" value="'.$row['shohin_id'].'" checked /><br>';
            /*
                if(isset($_POST['checkbox'])){
                    $flag=0; //チェックボックスがついてるとき
                }else{
                    $flag=1;
                }
                */

            echo '<a href="detail.php?id=', $row['shohin_id'],'">',$row['shohin_mei'],'</a><br>';
            echo $row['color_mei'],'<br>';
            echo '￥',$row['price'],'<br>';  
            //echo '数量 ',$row['num'],'<br>';  
            echo '数量','<input type="number" name="quantity_'.$row['shohin_id'].'" value="'.$row['num'].'" min="1" />','<br>';

            /*'
                if($flag==0){
                    $pdo=new PDO($connect,USER,PASS);
                    $sql = $pdo -> prepare('update Cart set flag = 0 where user_id = ? and shohin_id = ? ');
                    $sql -> execute([$id,$row['shohin_id']]);
                }else{
                    $sql = $pdo -> prepare('update Cart set flag = 1 where user_id = ? and shohin_id = ? ');
                    $sql -> execute([$id,$row['shohin_id']]); 
                }

             */   
            $subtotal = $row['num'] * $row['price'];
            $total+=$subtotal;
            echo '小計 ￥',$subtotal,'<br>';
    
            echo 'ポイント',floor($subtotal/100),'pt','<br>';

            $his=$pdo->prepare("select shohin_id from History
            where user_id = ?
            and shohin_id = ?
            ");
            $his->execute([$id, $row['shohin_id']]);

            $repeat = 0;
            if(isset($his)){
                /*
                foreach($his as $row){
                        $num = $row['num'];
                        $price = $row['price'];
                        $subtotal = $num * $price; //商品それぞれの計をだす  
                        echo 'shohin_id=[',$row['shohin_id'],'],num=[',$row['num'],'], price=[', $row['price'], '] subtotal=[', $subtotal, ']';
                        $repeat = $subtotal * 0.1;
                }
                */
                $repeat = $subtotal * 0.1;

            }
            echo 'リピート割 -￥',$repeat,'<br>';
            echo '<a href="cart-delete.php?id=',$row['shohin_id'],'">削除</a>','<br>';
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
        $totalrepeat=0;       
        foreach($sql as $row){
            $subtotal = $row['num'] * $row['price'];
            $total+=$subtotal;

            $repeat = $subtotal * 0.1;
            $totalrepeat += $repeat;

        }
        echo '商品合計（税込）',$total,'円','<br>';
        echo 'リピート割 ',$totalrepeat,'円','<br>';
        echo '送料350円','<br>';
    }
    ?>

    <hr>

    <?php
    $repeat=0;
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
            $repeat = $subtotal * 0.1;
        }
        echo '注文合計',$total-$repeat+350,'円','<br>';
    }
    ?>
    <button type="submit" name="purchase">ご注文手続きへ ＞</button>
</form>
</body>
</html>