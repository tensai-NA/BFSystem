<!--　担当：荒巻　8.購入確認画面-->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購入確認画面</title>
</head>
<body>
    <h2>購入確認</h2>
    <p>配送先住所
            〇〇〇-▽▽▽▽<br>
            〇〇県××市△△町☐☐-〇<br>
            080-〇〇〇〇-☐☐☐☐<br>
            山田 太郎様<br>
    </p>
        <p><button type="submit">変更</button></p>

    <p>配送希望日
        <select name="day">
            <option value="">指定しない</option>

    <p>
        希望時間帯
        <select name="time">
            <option value="">指定しない</option>
    </p>
    
    <p>
        ポイント利用<br>
            ご利用可能ポイント：100pt<br>
            ご利用ポイント：<input id="number" type="number" value="0" />
    </p>

    <p>
        決済方法
        <select name="kessai">
            <option value="">クレカ払い</option>
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
        ご注文合計　　　　　　　　￥00000<br>
        獲得予定ポイント　000pt
    </p>

    <button type="submit">ご注文を確定する</button>
    <a href="cart.php">カートへ戻る</a>