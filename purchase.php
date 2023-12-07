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
<div class="m-6 has-text-centered is-family-code has-text-weight-semibold">
    <p class="title is-3 m-5">購入確認</p><hr>
   

    <?php
    if(isset($_SESSION['customer'])){
    $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query("select del_id, del_address ,del_name, del_psnum from Delivery where user_id='".$id."' and destination=1");
    foreach($sql as $row){
        
        echo '<p class="title is-5">現在の配送先住所</p>';
        echo '<div class="columns  is-mobile  is-centered"> ';
        echo '<div class="column is-7"> ';
        echo '<div class="box has-background-light mx-6">';
        echo ' <p class="m-1"><label>お名前:</label>',$row['del_name'],'</p>';
        echo ' <p class="m-1"><label>郵便番号</label>',$row['del_psnum'],'</p>';
        echo '<p class="m-1">住所:',$row['del_address'] ,'</p>';
      

    }

    
}
?>

  <button type="button" onclick="location.href='address.php'">変更</button> 
</div></div></div>

  <hr>
           
          
    
    

         

    <form action="purchasecomp.php" method="post">
     <p class="title is-5 mx-1">配送希望日 </p>
        <select name="day">
            <option value="">指定しない</option>
            <?php
            for($i=1;$i<=7;$i++){ //DBに保存
                echo '<option value="',date("Y-m-d", strtotime("$i day")),'" name="date">',date("Y-m-d", strtotime("$i day")),'</option>';           
            }
            ?>
        </select>

    <p>
    <p class="title is-5 mt-4 mx-1"> 希望時間帯</p>
        <select name="time">
            <option value="0">指定しない</option>
            <option value="1">午前10時-午後12時</option>
            <option value="2">午後2時-午後4時</option>
            <option value="3">午後6時-午後8時</option>
        </select>
    </p>
    <hr>
    <p>
    <p class="title is-5 mx-1">ポイント利用</p>
        <?php
        if(isset($_SESSION['customer'])){
            $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->query("select point from User where user_id='".$id."'");
            $point = $sql->fetch(PDO::FETCH_COLUMN);
            echo '<p>利用可能ポイント：',$point, ' pt</p>';
        }
        ?>

            ご利用ポイント：<input name="use" type="number" value="0" style="width: 80px;" /> pt
    </p>

    <p>
    <p class="title is-5 mt-4 mx-1">決済方法 </p>
        <select name="kessai">
            <option value="0">クレジット</option>
            <option value="1">現金</option>
            <option value="2">銀行振込</option>
            <option value="3">後払い</option>
        </select>
    </p>
<hr>
    <p>
    <p class="title is-5">ご注文内容</p>
        <?php
        if(isset($_SESSION['customer'])){  //ログイン済みの処理
            $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->prepare("select Shohin.shohin_id,Shohin.shohin_mei,Shohin.price,Shohin.shohin_img,Color.color_mei,Cart.num
                    from Shohin,Cart,Color
                    where Shohin.shohin_id = Cart.shohin_id
                    and Shohin.color = Color.color_code
                    and Cart.user_id = ?");
            $sql->execute([$id]);
            $check=array();
            if(isset($_POST['checkbox'])){
                $check=$_POST['checkbox']; //チェックボックスがついてるとき
            }

            $total = 0;
            foreach($sql as $row){
                $num = 'quantity_'.$row['shohin_id'];
                if(in_array($row['shohin_id'], $check) != false){
                    echo '<div class="columns  is-mobile  is-centered"> ';
                    echo '<div class="column is-7"> ';
                    echo '<div class=" box has-background-white-bis box-padding-4 ">';
                    echo '<div class="left ml-6 mx-6 mb-6" style=" float: left;">';
                    echo '<a href="detail.php?id=', $row['shohin_id'],'   class="thumbnail"  style=" display: inline-block; height: 100px; margin-right: 5px; margin-bottom: 20px;"">','<img src="' ,$row['shohin_img'], '"  style="height: 105%;">','</div>';
                    echo '<div class="items2 m-2">';
                    echo '<p class="is-size-6"><a href="detail.php?id=', $row['shohin_id'],'">',$row['shohin_mei'],'</p></a>';
                    echo '<p class="m-2">個数：',$row['num'],'</p>';
                    echo '<p class="m-2">カラー：',$row['color_mei'],'</p>';
                    echo '<p class="m-2">価格：￥',$row['price'],'</p>';
                    $total = $row['num'] * $row['price'];
                    echo '<p class="m-2">小計：￥',$total,'</p>';
                    echo '</div></div></div></div>';
                    $sql = $pdo -> prepare('update Cart set flag = 0, num = ? where user_id = ? and shohin_id = ? ');
                    //echo "商品ID=".$row['shohin_id']." flg=0へ更新しました<br>";
                }else{
                    $sql = $pdo -> prepare('update Cart set flag = 1, num = ?  where user_id = ? and shohin_id = ? ');
                    //echo "商品ID=".$row['shohin_id']." flg=1へ更新しました<br>";
                }
                $count = isset($_POST[$num])?$_POST[$num] : $row['num'];
                $sql -> execute([$count, $id,$row['shohin_id']]);

                $his=$pdo->prepare("select shohin_id from History
                where user_id = ?
                and shohin_id = ?
                ");
                $his->execute([$id, $row['shohin_id']]);

                $repeat = 0;
                if(isset($his)){
                    $repeat += $total * 0.1;
                }
            }

            echo '</p>';
            echo '<hr>';
            echo '<p>';
 
            echo 'リピート割 -￥',$repeat,'<br>';
            if(isset($_SESSION['customer'])){  //ログイン済みの処理
                $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
                $pdo=new PDO($connect,USER,PASS);
                $sql=$pdo->query("select num from Cart where user_id = '".$id."' and flag=0");
                $suryo = $sql->fetchAll();
                $kei = 0;
                foreach($suryo as $s){
                    $kei = $s['num'] + $kei;
                }
                echo '商品点数',$kei,'点<br>'; //数量をDBから抽出
                echo '送料￥350<br>';
                $total = 0;
                $point = 0;
                if(isset($_SESSION['customer'])){  //ログイン済みの処理
                    $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
                    $pdo=new PDO($connect,USER,PASS);
                    $sql=$pdo->query("select num,price from Cart,Shohin where Cart.shohin_id = Shohin.shohin_id and user_id = '".$id."'  and flag=0");
                    foreach($sql as $row){
                        $total += $row['num'] * $row['price'];
                    }
                }
                $total = (350 + $total) - $repeat ;
                $point = floor($total / 100) ;
                echo '代金合計￥',$total,'<br>';//合計を求めてリピート割分を引く
                echo '</p>';
                echo '</p>';
                echo '<hr>';
                echo '<p>';
                echo 'ご注文合計￥',$total,'<br>';
                echo '獲得予定ポイント',$point,'pt<br>';
                echo '</p>';
            }
    
        }

        
        ?>

    <button type="submit" class="button  is-black m-4">ご注文を確定する</button><br>
    </form>
    <a href="cart.php">←カートへ戻る</a>
    </div>
    </body>
</html>