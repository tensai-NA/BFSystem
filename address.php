<?php session_start(); ?>

<?php require 'kyotu/db-connect.php'?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>住所変更</title>
</head>
<body>
    <p>配送先を選んでください</p>
    <p>（現在登録されている住所）</p>
    <?php
    if(isset($_SESSION['customer'])){
            $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->query("select del_address from Delivery where user_id='".$id."'");
            $address = $sql->fetch(PDO::FETCH_COLUMN);
            echo $address ,'<br>';
        }

    ?>
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <div class="D">住所を変更する</div>
    <div class="E">
        <label>お名前</label>
            <input type="text" name="sei">
            <input type="text" name="mei">
        <label>住所</label>
            <input type="text" name="address">
        <label>郵便番号</label>
            <input type="number" name="postnum">
        <button>変更</button>
    </div>

    <?php
        $name = $_POST['sei'].$_POST['mei'];
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare("update Delivery set del_name=?,del_address=?,del_psnum=?,koshinbi=?");
        $sql->execute([$name,$_POST['address'],$_POST['postnum'],date("Y-m-d")]);
    ?>
</body>
</html>