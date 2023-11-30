<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>
<?php
    if(isset($_POST['update'])){
        $name = $_POST['sei'].$_POST['mei'];
        $id = $_SESSION['customer']['user_id'];
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare("update Delivery set del_name=?,del_address=?,del_psnum=?,koshinbi=? where user_id = '".$id."'");
        $sql->execute([$name,$_POST['address'],$_POST['postnum'],date("Y-m-d")]);
        echo '<p class="has-text-centered has-text-danger-dark">変更しました</p>';
    }
?>

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
    <div class="has-text-centered">
    <p >購入確認</p>
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
    <!-- <button type="button" onclick="location.href='address.php'">変更</button> -->
    <div class="A">変更</div>
    <style>
            .B{
                display: none;
            }
    </style>
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="js/address.js"></script>
    <div class="B">
        <script src="https://code.jquery.com/jquery.min.js"></script>
        <style>
            .E{
                display: none;
            }
        </style>
        <div class="D">住所を変更する</div>
        <div class="E" id="app">
           <form action="" method="post">
                <label>お名前</label>
                    <p><input type="text" name="sei">
                    <input type="text" name="mei"></p>
                <label>郵便番号</label>
                    <p><input type="number" name="postnum" v-model="postnum" /></p>
                    <p v-if="posterror" class="has-text-danger">郵便番号は7桁の数字で入力してください</p>
                <label>住所</label>
                    <p><input type="text" name="address"></p>
                <button type="submit" name="update">変更</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="js/purchase.js"></script>

    </div>

    <form action="purchasecomp.php" method="post">
    <p>配送希望日 <br>
        <select name="day">
            <option value="">指定しない</option>
            <?php
            for($i=1;$i<=7;$i++){ //DBに保存
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
            echo '<p>利用可能ポイント：',$point,'pt</p>';
        }
        ?>

            ご利用ポイント：<input name="use" type="number" value="0" />pt
    </p>

    <p>
        決済方法 <br>
        <select name="kessai">
            <option value="0">クレジット</option>
            <option value="1">現金</option>
            <option value="2">銀行振込</option>
            <option value="3">後払い</option>
        </select>
    </p>

    <p>
        ご注文内容<br>
        <?php
        if(isset($_SESSION['customer'])){  //ログイン済みの処理
            $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->prepare("select Shohin.shohin_id,Shohin.shohin_mei,Shohin.price,Color.color_mei,Cart.num
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
                    echo $row['shohin_mei'],'<br>';
                    echo 'カラー：',$row['color_mei'],'<br>';
                    echo '価格：￥',$row['price'],'<br>';
                    $total = $row['num'] * $row['price'];
                    echo '小計：￥',$total,'<br>';
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

    <button type="submit" button is-active>ご注文を確定する</button><br>
    </form>
    <a href="cart.php">←カートへ戻る</a>
    </div>
    </body>
</html>