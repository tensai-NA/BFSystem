<!--　担当：溝口　14.ログアウト確認画面-->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>ログアウトしますか？</h4>
    <h6>※　再度ログインするためにはメール<br>
    アドレスとパスワードが必要です
    </h6>
    <form action="login.php" method="post">
    <button type="submit" name="logout">ログアウトする➝</button>
    </form>
    <form action="mypage.php" method="post">
        <button type="submit" name="cancel">キャンセル➝</button>
    </form>
</body>
</html>