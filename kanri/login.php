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
<div class="m-6 has-text-centered is-family-code has-text-weight-semibold">
<p class="title is-3 "> 管理者ログイン</p>


<div class='columns  is-mobile  is-centered'> 
            <div class='column is-10'> 
                <div class=" box has-background-white-bis box-padding-4 ">
    <div class="field">
    <div class="control m-1">
    <form action="login.php" method="post">
    <div class="field has-addons-fullwidth has-addons-centered">
            <label class="label is-size-6 m-5">管理者名</label>
            <input type="text" class="input is-normal is-focused m-i"  placeholder="👤 管理者名" name="name" style="width: 615px;"  required >
            <p class="m-3 has-text-danger-dark"><?= $msgname?></p>
        </div></div>
        <div class="control m-1">
        <div class="field has-addons-fullwidth has-addons-centered">
            <label class="label is-size-6 m-5">パスワード</label>
            <input type="password" class="input is-primary is-focused m-i" placeholder="🔐 パスワード"  name="pass"  style="width: 615px;"  required>
            <p class="m-3 has-text-danger-dark"> <?= $msgpass ?></p>
        </div></div>
        <button name="login"  class="button is-danger m-6 mb-6" >ログイン</button>
    </form>
    </div></div>
</div></div></div>
</body>
</html>