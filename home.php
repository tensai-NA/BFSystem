<?php require 'db/db-connect.php'?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面</title>
</head>
<body>
        <img src="sozai/mypage.png" width="30px" height="30px">
        <img src="sozai/cart.png" width="30px" height="30px">
        <p>マイポイント 〇〇pt</p>
        <p>search</p>
        <script src="https://code.jquery.com/jquery.min.js"></script>
            <script>
            $(function() {
                $(".A").click(function() {
                    $(".B").toggleClass("C");
                });
            });
            </script>
            <style>
            .A{
                display: inline-block;
                background: #b6beff;
                padding: 5px 10px;
                cursor: pointer;
            }
            .B{
                background: #ffaf74;
                height: 100px;
            }
            .C{
                display: none;
            }
            </style>
            <div class="A">ボタン</div>
            <div class="B">これが表示/非表示</div>
        <h2>おすすめ</h2>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</body>
</html>