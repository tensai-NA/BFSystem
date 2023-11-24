<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>
<?php
$pdo= new PDO($connect,USER,PASS);
$msg = '';
    if(isset($_SESSION['customer'])){
        $user_id=$_SESSION['customer']['user_id'];
        $sql=$pdo->prepare('select * from User where user_id!=? and mail=?');
        $sql->execute([$user_id,$_POST['mail']]);
        $msg = "メールアドレスが既に使用されています。";
    }else{
        $sql=$pdo->prepare('select * from User where mail=?');
        $sql->execute([$_POST['mail']]);
    }
    if(empty($sql->fetchAll())){
        if(isset($_SESSION['customer'])){
            $sql=$pdo->prepare('update User set user_sei=?,user_mei=?,mail=?,postnum=?,address=?
                                where user_id=?');
            $sql->execute([
                $_POST['user_sei'],$_POST['user_mei'],$_POST['mail'],
                $_POST['postnum'],$_POST['address'],$user_id]);

            $sele=$pdo->prepare("select * from where id=?");
            $sele->execute([$user_id]);
            foreach($sele as $row){
                $_SESSION['customer']=[
                    $_SESSION['customer']=[
                        'user_id'=>$row['user_id'],
                        'user_sei'=>$row['user_sei'],
                        'user_mei'=>$row['user_mei'],
                        'mail'=>$row['mail'],
                        'password'=>$row['password'],
                        'postnum'=>$row['postnum'],
                        'point'=>$row['point'],
                        'address'=>$row['address'],
                        'password'=>$row['password']
                    ]]; 
            }
                $msg = '更新が完了しました';
        }
    }
//}
?>
<!--完成-->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>更新完了画面</title>
</head>
<body>
<p class="my-6">
<div class="has-text-centered">
    <p class="my-6">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
    <h4><?= $msg ?></h4><br>
    <a href="mypage.php">マイページへ➝</a>
    </p>
</div>
</p>
</body>
</html>