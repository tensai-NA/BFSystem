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
    $minid=$pdo->prepare("select min(del_id) as minid from Delivery where user_id =?");
    $minid->execute([$user_id]);
    foreach($minid as $row){
       $minids=$row['minid'];
}

    if(empty($sql->fetchAll())){
        $name =  $_POST['user_sei'].$_POST['user_mei'];
        $sql=$pdo->prepare('update Delivery set del_name= ?,del_address= ?,del_psnum =?,koshinbi=? where del_id= ?');//Delceryの最初の配送先住所を更新
                $sql->execute([$name,$_POST['address'], $_POST['postnum'],date('Y-m-d'),$minids]);
        
        
        if(isset($_SESSION['customer'])){
            $sql=$pdo->prepare('update User set user_sei=?,user_mei=?,mail=?,postnum=?,address=?
                                where user_id=?');
            $sql->execute([
                $_POST['user_sei'],$_POST['user_mei'],$_POST['mail'],
                $_POST['postnum'],$_POST['address'],$user_id]);

            $sele=$pdo->prepare("select * from User where user_id=?");
            $sele->execute([$user_id]);
            foreach($sele as $row){
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
                    ]; 
            }
           
        }
        $msg = '<p class="title is-4 m-4">更新が完了しました</p>';
    
                          
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>更新完了画面</title>
</head>
<body>

    

<div class="m-6 has-text-centered is-family-code has-text-weight-semibold">
    <p class="title is-3 "> 会員情報更新完了</p>
        <div class="columns  is-mobile  is-centered"> 
        <div class="column"> 
         <div class=" box has-background-white-bis box-padding-4 ">
    <?= $msg ?> 
    <div class="has-text-centered mt-3 mb-6"> <img src="sozai/check_mark-2.png" width="200vw" style="max-width:'100%'"></div>
    <p class=" mb-6"><a href="mypage.php">マイページへ➝</a></p>
    </p>
</div>
</div>
</div>
</div>
</p>
</body>
</html>