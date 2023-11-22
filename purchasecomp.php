<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>購入完了画面</title>
</head>
<body>
    <div class="has-text-centered">
    <p class="mb-4">
        <p><span class="is-size-4">ご注文ありがとうございました！</span></p>
        <p class="my-6">
        <p><span class="is-size-6">ご注文内容</span></p>
        <p><span class="is-size-7">

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

                echo '<hr>';
                echo '</span></p>';
            echo '<p><span class="is-size-7">';
            $his=$pdo->query("select a.num,b.price from Cart a inner join History b on a.shohin_id = b.shohin_id
            and a.user_id ='".$id."'");            
            $kei = 0;   
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
                echo '<hr>';
                echo '</span></p>';
                echo '<p><span class="is-size-6">';
                $total = 0;
                $point = 0;
                if(isset($_SESSION['customer'])){  //ログイン済みの処理
                    $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
                    $pdo=new PDO($connect,USER,PASS);
                    $sql=$pdo->query("select num,price from Cart,Shohin where Cart.shohin_id = Shohin.shohin_id and user_id = '".$id."'");
                    foreach($sql as $row){
                        $total = $row['num'] * $row['price'];
                    }
                }
                $total = (350 + $total) - $ripi ;
                $point = floor($total / 100);
                echo '代金合計￥',$total,'<br>';//合計を求めてリピート割分を引く
                echo '</p>';
                echo '</p>';
                echo '<hr>';
                echo '<p>';
                echo 'ご注文合計￥',$total,'<br>';
                echo '獲得予定ポイント',$point,'pt<br>';
                echo '</p>';
            }
            $zikan = ['指定しない','午前10時-午後12時','午後2時-午後4時','午後6時-午後8時'];
            $zi = $_POST['time'];
            $kiboutime = $zikan[$zi];
            $del = $pdo->query("select del_id from Delivery where user_id = '".$id."'");
    
            $sql=$pdo->prepare("insert into OrderA values (null,?,?,?,?,?,?,?,?,?)");
            $sql->execute([$id,$del,$total,$point,date("Y-m-d"),$_POST['day'],$kiboutime,$_POST['use'],$_POST['kessai']]);
    
        }

        ?>
         </span></p>
        </p>
        <p class="my-6">
            <button onclick="location.href='home.php'">ホームへ戻る</button>
        </p>
     </p>
    </div>    
</body>
</html>