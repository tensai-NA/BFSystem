<!--　担当：溝口　14.ログアウト確認画面-->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>ログアウト確認画面</title>
</head>
<body>
    <p class="my-6">
<div class="has-text-centered">
    <h4>ログアウトしますか？</h4>
    <p class="my-5">
    <h6>※　再度ログインするためにはメール<br>
    アドレスとパスワードが必要です
    </h6>
    </p>
    <form action="login.php" method="post">
        <p class="mt-6">
          <button type="submit" name="logout" class="button is-danger is-rounded is-normal">ログアウトする➝</button>
    </form>
</p>
<p class="mb-5">
    <form action="mypage.php" method="post">
        <button type="submit" name="cancel" class="button is-link is-rounded is-normal">キャンセル➝</button>
        </p>
    </form>
</div>
</p>
</body>
</html>