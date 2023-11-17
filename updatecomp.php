<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>
<?php
$pdo= new PDO($connect,USER,PASS);
$msg = '';
if(isset($_POST['touroku'])){
    $ps = password_hash($_POST['password'],PASSWORD_DEFAULT);
    if(isset($_SESSION['customer'])){
        $user_id=$_SESSION['customer']['user_id'];
        $sql=$pdo->prepare('select *from User where user_id!=? and mail=?');
        $sql->execute([$user_id,$_POST['mail']]);
        echo 'a';
    }else{
        $sql=$pdo->prepare('select * from User where mail=?');
        $sql->execute([$_POST['mail']]);
        echo 'b';
    }
    if(empty($sql->fetchAll())){
        if(isset($_SESSION['customer'])){
            echo 'c';
            $sql=$pdo->prepare('update User set user_sei=?,user_mei=?,mail=?,shin=?,postnum=?,address=?,'.
                                'mail=?,password=? where user_id=?');
            $sql->execute([
                $_POST['user_sei'],$_POST['user_mei'],$_POST['user_sei'],$_POST['mail'],$_POST['password'],$_POST['shin'],
                $_POST['postnum'],$_POST['address'],$ps,$user_id]);
            $_SESSION['customer']=[
                'user_id'=>$user_id,'name'=>$_POST['name'],
                'address'=>$_POST['address'],'name'=>$_POST['name'],
                'password'=>$ps];
                $msg = '更新が完了しました';
        }
    }else{
        echo 'd';
        $msg = 'ログイン名が既に使用されていますので、変更してください。';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>Document</title>
</head>
<body>
    <h4><?= $msg ?></h4><br>
    <a href="mypage.php">マイページへ➝</a>
</body>
</html>