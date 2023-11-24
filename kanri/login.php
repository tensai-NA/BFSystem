<?php session_start(); ?>
<?php require '../kyotu/db-connect.php'?>
<?php
$msgname='';
$msgpass='';
if(isset($_POST['login'])){
    unset($_SESSION['kanri']);
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare("select * from Kanri where name=?");
    $sql->execute([$_POST['name']]);
    $data = $sql->fetchAll();
    if( empty($data)){
        $msgname = '管理者が登録されていません';
    }else{
        foreach($data as $row){
            if($_POST['pass'] === $row['password']){
                $_SESSION['kanri']=[
                    'name'=>$row['name'],
                    'pass'=>$row['password']];
            }else{
                $msgpass='パスワードが違います。';
            }
        }
    }
    if(isset($_SESSION['kanri'])){
        header("Location: shohinadd.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログイン</title>
</head>
<body>
    <p>管理者ログイン</p>
    <form action="login.php" method="post">
        <label>管理者名</label>
        <p><input type="text" name="name"></p>
        <?= $msgname ?>
        <label>パスワード</label>
        <p><input type="password" name="pass"></p>
        <?= $msgpass ?>
        <button name="login">ログイン</button>
    </form>
</body>
</html>