<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
    <h3>ご注文ありがとうございました！</h3><br>
    <h4>ご注文内容</h4>
    <h5>        
        <?php
        if(isset($_SESSION['customer'])){  //ログイン済みの処理
            $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->query("select Shohin.shohin_mei,Shohin.price,Color.color_mei,Cart.num
                    from Shohin,Cart,Color
                    where Shohin.shohin_id = Cart.shohin_id
                    and Shohin.color = Color.color_code
                    and Cart.user_id = '".$id."'");
            foreach($sql as $row){
                echo $row['shohin_mei'],'<br>';
                echo 'カラー：',$row['color_mei'],'<br>';
                echo '価格：￥',$row['price'],'<br>';
                $total = $row['num'] * $row['price'];
                echo '小計：￥',$total,'<br>';
            }
        }
        ?>
    </h5>

    <hr>
    商品点数                   〇点<br>
    代金合計                ￥00000 <br>
    送料                      ￥000
    <hr>
    </h5>
    <h4>ご注文合計      ￥00000 <br>
            獲得予定ポイント   000pt
    </h4>
    <form action="home.php" method="post">
    <button type="submit" name="home">ホームへ戻る</button>
    </form>
    
</body>
</html>