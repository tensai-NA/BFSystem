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
            商品名検索<input type="text" name="search">
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