<!--　担当：溝口　14.ログアウト確認画面-->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>Document</title>
</head>
<body>
<div class="has-text-centered">
    <h4>ログアウトしますか？</h4>
    <h6>※　再度ログインするためにはメール<br>
    アドレスとパスワードが必要です
    </h6>
    <form action="login.php" method="post">
    <button type="submit" name="logout" class="button is-danger is-rounded is-normal">ログアウトする➝</button>
    </form>
    <form action="mypage.php" method="post">
        <button type="submit" name="cancel" class="button is-link is-rounded is-normal">キャンセル➝</button>
    </form>
</div>
</body>
</html>