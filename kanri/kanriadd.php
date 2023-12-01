<?php session_start(); ?>
<?php require '../kyotu/db-connect.php'?>
<?php
if(isset($_POST['toroku'])){
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare("insert into Kanri values(null,?,?)");
    $sql->execute([$_POST['name'],$_POST['pass']]);
    echo '登録しました。';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>管理者登録</title>
</head>
<body>
<div class="m-4 has-text-centered ">
    <h1 class="title is-4">管理者登録</h1>
    <div class="box has-background-light m-6">
        <div class="field">
        <div class="control m-1">
    <form action="kanriadd.php" method="post">
        <div class="field has-addons-fullwidth has-addons-centered">
            <label class="label">管理者名</label>
            <input type="text" class="input is-normal is-focused m-i" name="name">
        </div></div>
        <div class="control m-1">
        <div class="field has-addons-fullwidth has-addons-centered">
            <label class="label">パスワード</label>
            <input type="password" class="input is-primary is-focused m-i" name="pass">
        </div></div>
        <button name="toroku" class="button is-danger m-5" >登録</button>
        </form>
        <button type="button" onclick="location.href='login.php'" class="button is-info m-5">ログイン</button>
        </div></div>
</div>
</body>
</html>