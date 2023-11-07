<?php require 'kyotu/db-connect.php'?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>ホーム画面</title>
</head>
<body>
        <img src="sozai/mypage.png" width="30px" height="30px">
        <img src="sozai/cart.png" width="30px" height="30px">
        <p>マイポイント 〇〇pt</p>
        <div class="A">search</div>
        <div class="B">
            <label for="cate">カテゴリ検索</label>
                <input type="radio" name="kate" value="1">
                    <label for="hinmei">商品名</label>
                <input type="text" id="hinmei"><br>

                <input type="radio" name="kate" value="2">
                    <label for="brand">ブランド</label>
                <input type="text" id="brand"><br>

                <input type="radio" name="kate" value="3">
                    <label for="color">カラー</label>
                <input type="text" id="color"><br>


        </div>
        <script src="https://code.jquery.com/jquery.min.js"></script>
        <script>
            $(function() {
                $(".A").click(function() {
                    $(".B").toggleClass("C");
                });
            });
        </script>
        <h2>おすすめ</h2>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</body>
</html>