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

        <p><button>変更</button></p>


    <p>配送希望日 <br>
        <select name="day">
            <option value="">指定しない</option>
            <!--current date ~7day-->
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
            〇〇〇<br>
            カラー：ピンク<br>
            価格：￥0,000<br>
            小計　￥00000
    </p>
    
    <hr>
    <p>
            リピート割　　　　　　　　-￥000<br>
            商品点数　　　　　　　　　　〇点<br>
            代金合計　　　　　　　　 ￥00000<br>
            送料　　　　　　　　　　　 ￥000<br>
    </p>
    <hr>

    <p>
        ご注文合計　　　　　　　￥00000<br>
        　　　　獲得予定ポイント　000pt
    </p>

    <button onclick="loction.href='purchasecomp.php'">ご注文を確定する</button><br>
    <a href="cart.php">←カートへ戻る</a>