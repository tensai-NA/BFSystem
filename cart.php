<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
    
    <title>カート画面</title>
</head>
<body>
<div class="has-text-centered ">
<nav class="level  is-mobile  mt-5">

<div class="level-left ml-3">
<a href="#" onclick="history.back()"><i class="fas fa-long-arrow-alt-left fa-2x" ></i></a>
</div>
   
<div class="level-itemt ml-3">
<p class="title is-4">カート</p>
</div>

  <div class="level-right mr-3">
  <a href="home.php"><i class="fas fa-home fa-2x"></i></a>

    </div>
</nav>





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
        $count=$sql-> rowCount();
        if($count==0){
            echo '<p class="title is-4">カートに商品がありません</p>';
        }else{
        $total=0;
        echo '<form method="post" action="purchase.php">';        
        foreach($sql as $row){
            echo '<div class="box m-6 has-text-centered ">';
            echo '<p  class="has-text-right"><input type="checkbox" name="checkbox[]" value="'.$row['shohin_id'].'" checked /></p>';
            echo '<div class="left ml-6 mx-6" style=" float: left;">';
            echo '<p><a href="detail.php?id=', $row['shohin_id'],'  class="thumbnail"  style=" display: inline-block; height: 150px; margin-right: 5px; margin-bottom: 20px;"">','<img src="' ,$row['shohin_img'], '" style="height: 100%;">','</p></a>';
            echo '<p>数量','<input type="number" name="quantity_'.$row['shohin_id'].'" value="'.$row['num'].'" min="1" />','</p>';
            echo '</div>';
            /*
                if(isset($_POST['checkbox'])){
                    $flag=0; //チェックボックスがついてるとき
                }else{
                    $flag=1;
                }
                */
            echo '<div class="items2 m-2" >';
       
            echo '<p><a href="detail.php?id=', $row['shohin_id'],'">',$row['shohin_mei'],'</a></p>';
            echo '<p>',$row['color_mei'],'</p>';
            echo '￥<p class=" title is-4 " style=" display: inline-block;">',$row['price'],'</p>';  
            //echo '数量 ',$row['num'],'<br>';  
     

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
            echo '<p>小計 ￥',$subtotal,'</p>';
    
            echo '<p>ポイント',floor($subtotal/100),'pt','</p>';

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
            echo '<p>リピート割 -￥',$repeat,'</p>';
            echo '<p><a href="cart-delete.php?id=',$row['shohin_id'],'">削除</a>','</p>';
            echo '</div>';
            echo '</div>';
  
        }
  
        echo '<hr>';
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
        echo '<div class="left-total" class="has-text-left">';
        echo '<p>商品合計（税込）',$total,'円','</p>';
        echo '<p>リピート割 ',$totalrepeat,'円','</p>';
        echo '<p>送料350円</p>';
        echo '</div>';
       
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
    echo '<button type="submit" name="purchase">ご注文手続きへ</button>';
    }
}

  

    ?>
</form>
</div>
</body>
</html>