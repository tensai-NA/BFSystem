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
       <p><span class="is-size-4">ご注文ありがとうございました！</span></p><br>
         <p class="my-6">
         <p><span class="is-size-6">ご注文内容</span></p>
         <p><span class="is-size-7">
         〇〇〇
         カラーピンク<br>
         価格￥0000         小計　￥0000
        </span></p> 
         <hr>
        <p><span class="is-size-7">
         商品点数                   〇点<br>
         代金合計                ￥00000 <br>
         送料                      ￥000
         <hr>
       </span></p>
         <p><span class="is-size-6">
            ご注文合計      ￥00000 <br>
            獲得予定ポイント   000pt
         </span></p>
        </p>
        <p class="my-6">
       <form action="home.php" method="post">
         <button type="submit" name="home" class="button is-active">ホームへ戻る</button>
        </form>
        </p>
     </p>
    </div>
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

            echo '</h5>';
            echo '<hr>';

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

                echo '<hr>';
                echo '</h5>';

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
    <button onclick="location.href='home.php'">ホームへ戻る</button>
    
</body>
</html>