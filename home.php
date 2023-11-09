<?php require 'kyotu/db-connect.php'?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <img src="sozai/mypage.png" width="30px" height="30px">
    <img src="sozai/cart.png" width="30px" height="30px">
    <p>マイポイント 〇〇pt</p>
        <input type="button" value="search" onclick="document.getElementById('A').style.display = 'block';">
        <div class="kensaku" id="A">
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
                <br>
                <input type="button" value="close" onclick="document.getElementById('A').style.visibility = 'none';">
        </div>
    <div class="a">
        <h2>おすすめ</h2>
        <!--初期状態-->


        <!--顧客によって変更-->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</body>
</html>