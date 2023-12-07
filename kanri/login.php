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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>管理者ログイン</title>
</head>
<body>
<div class="m-4 has-text-centered ">
<h1 class="title is-4">管理者ログイン</h1>
<div class="box has-background-light m-6">
    <div class="field">
    <div class="control m-1">
    <form action="login.php" method="post">
    <div class="field has-addons-fullwidth has-addons-centered">
            <label class="label">管理者名</label>
            <input type="text" class="input is-normal is-focused m-i" name="name">
            <?= $msgname?>
        </div></div>
        <div class="control m-1">
        <div class="field has-addons-fullwidth has-addons-centered">
            <label class="label">パスワード</label>
            <input type="password" class="input is-primary is-focused m-i" name="pass">
            <?= $msgpass ?>
        </div></div>
        <button name="login"  class="button is-danger m-5" >ログイン</button>
    </form>
    </div></div>
</div>
</body>
</html>