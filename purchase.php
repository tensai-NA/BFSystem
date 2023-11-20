<?php session_start(); ?>

<?php require 'kyotu/db-connect.php'?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>購入確認画面</title>
</head>
<body>
    <h2>購入確認</h2>
    <p>配送先住所</p>
    <?php
    if(isset($_SESSION['customer'])){
            $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->query("select del_address from Delivery where user_id='".$id."'");
            $address = $sql->fetch(PDO::FETCH_COLUMN);
            echo $address ,'<br>';
        }

    ?>

    <p>配送希望日 <br>
        <select name="day">
            <option value="">指定しない</option>
            <?php
            for($i=1;$i<=7;$i++){
                echo '<option value="',date("Y-m-d", strtotime("$i day")),'" name="date">',date("Y-m-d", strtotime("$i day")),'</option>';           
            }
            ?>
        </select>

    <p>
        希望時間帯<br>
        <select name="time">
            <option value="0">指定しない</option>
            <option value="1">午前10時-午後12時</option>
            <option value="2">午後2時-午後4時</option>
            <option value="3">午後6時-午後8時</option>
        </select>
    </p>
    
    <p>
        ポイント利用<br>
        <?php
        if(isset($_SESSION['customer'])){
            $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->query("select point from User where user_id='".$id."'");
            $point = $sql->fetch(PDO::FETCH_COLUMN);
            echo '<p>利用可能ポイント',$point,'pt</p>';
        }
        ?>

            ご利用ポイント：<input id="number" type="number" value="0" />pt
    </p>

    <p>
        決済方法 <br>
        <select name="kessai">
            <option value="">クレカ払い</option>
            <option value="">現金</option>
        </select>
    </p>

    <p>
        ご注文内容<br>
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

            echo '</p>';
            echo '<hr>';
            echo '<p>';
            
            //IDとログインを比較　かつ　カート内の商品 cart と履歴 history を比較する
            $his=$pdo->query("select a.num,b.price from Cart a inner join History b on a.shohin_id = b.shohin_id
            and a.user_id ='".$id."'");            
            $kei = 0;   //もしカートにリピート割対象商品が2種類以上ある場合はどうなる？？
            if(isset($his)){
                foreach($his as $row){
                    $num = $row['num'];
                    $price = $row['price'];
                    $total = $num * $price; //商品それぞれの計をだす
                    $ripi = $total * 0.1;
                }
            }
            echo 'リピート割　-￥',$ripi,'<br>';
            if(isset($_SESSION['customer'])){  //ログイン済みの処理
                $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
                $pdo=new PDO($connect,USER,PASS);
                $sql=$pdo->query("select num from Cart where user_id = '".$id."'");
                $suryo = $sql->fetch(PDO::FETCH_NUM);
                $kei = 0;
                for($i=0;$i<count($suryo);$i++){
                    $kei = (int)$suryo + $kei;
                }
                echo '商品点数',$kei,'点<br>'; //数量をDBから抽出
                echo '送料￥350<br>';
                $total = 0;
                if(isset($_SESSION['customer'])){  //ログイン済みの処理
                    $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
                    $pdo=new PDO($connect,USER,PASS);
                    $sql=$pdo->query("select num,price from Cart,Shohin where Cart.shohin_id = Shohin.shohin_id and user_id = '".$id."'");
                    foreach($sql as $row){
                        $total = $row['num'] * $row['price'];
                    }
                }
                $total = (350 + $total) - $ripi ;
                echo '代金合計￥',$total,'<br>';//合計を求めてリピート割分を引く
                echo '</p>';
                echo '</p>';
                echo '<hr>';
                echo '<p>';
                echo 'ご注文合計￥',$total,'<br>';
                echo '獲得予定ポイント',floor($total / 100),'pt<br>';
                echo '</p>';
            }
    
        }

        
        ?>

    <button onclick="location.href='purchasecomp.php'">ご注文を確定する</button><br>
    <a href="cart.php">←カートへ戻る</a>
    </body>
</html>