<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="css/home.css">
    <title>ホーム画面</title>
</head>
<body>
    
    <a href="mypage.php"><i class="fas fa-user-circle"></i></a>
    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a><br>
    <?php

        if(isset($_SESSION['customer'])){
            $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->query("select point from User where user_id='".$id."'");
            $point = $sql->fetch(PDO::FETCH_COLUMN);
            echo 'マイポイント: ',$point,'pt';
        }

    ?>

    <script src="https://code.jquery.com/jquery.min.js"></script>
        <div class="A">search</div>
        <div class="kensaku">
            <h4>カテゴリ検索</h4>
                <input type="radio" name="kate" value="1">
                    <label for="hinmei">商品名</label>
                <input type="text" id="hinmei"><br>

                <input type="radio" name="kate" value="2">
                    <label for="brand">ブランド</label>
                <input type="text" id="brand"><br>

                <input type="radio" name="kate" value="3">
                    <label for="color">カラー</label>
                <input type="text" id="color"><br>
            <h4>金額検索</h4>
                <label>下限：
                <select name="drop01">
                    <option value="0">指定なし</option>
                    <option value="1000">1000円</option>
                    <option value="2000">2000円</option>
                    <option value="3000">3000円</option>
                    <option value="4000">4000円</option>
                </select>
                </label>
                <br>
                <label>上限：
                <select name="drop02">
                <option value="0">指定なし</option>
                    <option value="1000">1000円</option>
                    <option value="2000">2000円</option>
                    <option value="3000">3000円</option>
                    <option value="4000">4000円</option>
                </select>
                </label>
                <br>
                <button>検索</button>
                <!--検索機能どうするか js? php?-->
                <br>
        </div>
        <script>
            $(function() {
                $(".A").click(function() {
                    $(".kensaku").slideToggle("");
                });
            });
        </script>
    <div class="a">
        <h2>おすすめ</h2>
        <!--全顧客で一緒の表示にする-->
        <img src="images/eyeshadow.png">
        <img src="images/nail1.png">
        
    </div>
<?php
    if(!isset($_SESSION['customer'])){
        echo '<p><a href="login.php">ログインはこちら</a></p>';
    }

?>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</body>
</html>