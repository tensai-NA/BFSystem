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
    <title>管理者登録</title>
</head>
<body>
    <p>管理者登録</p>
    <form action="kanriadd.php" method="post">
        <label>管理者名</label>
        <p><input type="text" name="name"></p>
        <label>パスワード</label>
        <p><input type="password" name="pass"></p>
        <button name="toroku">登録</button>
    </form>
    <button onclick="location.href='login.php'">ログインへ</button>
</body>
</html>