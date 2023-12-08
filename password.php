<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>
<?php
$msgMail = '';
$msgPass = '';
$msgError = '';
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('select * from User ');
$sql->execute();
$data = $sql->fetchAll();
$flag = false;
foreach ($data as $d) {
    if (isset($_POST['send'])) {
        if ($_POST['sei'] == $d['user_sei'] && $_POST['mei'] == $d['user_mei'] && $_POST['mail'] == $d['mail']) {  //姓とDBとを比較　&& 名前も比較
            $flag = true;
        }
    }
}
if (isset($_POST['send'])) {
    if ($flag) {
        echo  '<script>
                alert("指定されたメールアドレスにリンクを送信しました。");
            </script>';
    } else {
        echo  '<script>
                    alert("入力されたデータが存在しません。");
                    </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>パスワード再設定画面</title>
</head>
<body>
    <div class="m-6 has-text-centered is-family-code has-text-weight-semibold">
        <p class="title is-3 ">パスワード再設定</p>
        <p class="m-6 is-size-6 ">
            会員登録時に登録されたお名前とメールアドレスをご入力の上「送信」をタップしてください<br>
            パスワード再設定ページURLを記載したメールをお送りいたします<br>
        </p>
        <div class='columns  is-mobile  is-centered'>
            <div class='column is-10'>
                <div class=" box has-background-white-bis box-padding-4 "> <!--ボックスのwidthを指定-->
                    <form action="password.php" method="post">
                        <label class="label is-size-6 m-4"> お名前 </label><br><!--横並びに-->
                        <div class="field  has-addons-centered ">
                            <input class="input is-info is-normal is-focused mb-2" type="text" name="sei" placeholder="姓" style="width: 250px;">
                            <input class="input is-info is-normal is-focused mb-2" type="text" name="mei" placeholder="名" style="width: 250px;">
                        </div>
                        <label class="label is-size-6 m-4">メールアドレス</label><br>
                        <div class="field  has-addons-centered">
                            <input class="input is-success  is-normal is-focused " type="email" name="mail" placeholder="✉  メールアドレス" style="width: 515px;">
                        </div><br>
                        <button type="submit" class="button is-info m-2" name="send">送信</button>
                </div>
            </div>
        </div>
        <div>
            <p>
                <a href="login.php"><span class="is-size-6 is-underlined">ログインへ戻る</span></a>
            </p>
</body>
</html>