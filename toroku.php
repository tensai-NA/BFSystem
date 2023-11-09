<!--　担当：中嶋　2.会員登録画面-->
<?php session_start(); ?>
<?php require 'db-connect.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>会員登録</title>
</head>
<body>
    <?php $name=$addresu ?>
    <form action="login.php" method="post">
     お名前<br>
     <input type="text" name="sei"><input type="text" name="mei"><br>
     メールアドレス<br>
     <input type="text" name="mail"><br>
     パスワード<br>
     <input type="text" name="password"><br>
     パスワード確認<br>
     <input type="text" name="password2"><br>
     郵便番号<br>
     <input type="test" name="postnum"><br>
     住所<br>
     <input type="text" name="address"><br>
        <button>登録</button>
        <button onclick="location.href='login.php'">キャンセル</button>
        <p><a href="login.php">アカウントをお持ちの方はこちら</a></p>
    </form>
</body>
</html>