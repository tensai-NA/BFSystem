<!--　担当：中嶋　2.会員登録画面-->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>会員登録</title>
</head>
<body>
    <form action="login.php" method="post">
     お名前<br>
     <input type="text" name="name"><input type="text" name="name"><br>
     メールアドレス<br>
     <input type="text" name="meru"><br>
     パスワード<br>
     <input type="text" name="pasu"><br>
     パスワード確認<br>
     <input type="text" name="kakunin"><br>
     郵便番号<br>
     <input type="text" name="yubin"><br>
     住所<br>
     <input type="text" name="home"><br>
        <button type="submit">登録</button>
        <button type="submit">キャンセル</button>
        <p><a href="toroku.php">アカウントをお持ちの方はこちら</a></p>
    </form>
</body>
</html>