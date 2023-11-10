<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>
<?php
$msgMail = '';
$msgPass = '';
$ps = password_hash($_POST['password'],PASSWORD_DEFAULT);
if(isset($_POST['login'])){
    unset($_SESSION['customer']);
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select * from User where mail=?');
    $sql->execute([$_POST['name']]);
    $data = $sql->fetchAll();
    if( empty($data) ){
        $msgMail = "メールアドレスが登録されていません";
    }else{
        foreach($data as $row){
            if(password_verify($_POST['password'],$row['password']) == true){
            $_SESSION['customer']=[
                'user_id'=>$row['user_id'],
                'user_sei'=>$row['user_sei'],
                'user_mei'=>$row['user_mei'],
                'mail'=>$row['mail'],
                'password'=>$row['password'],
                'postnum'=>$row['postnum'],
                'point'=>$row['point'],
                'address'=>$row['address'],
                'password'=>$ps];
            }else{
                $msgPass = 'パスワードが違います。';
            }
        }
    }
    
    if(isset($_SESSION['customer'])){
        echo 'window.location.href = "torokucomp.php"';
        
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>ログイン</title>
</head>
<body>
    <form action="login.php" method="post">
     <p>メールアドレス<br>
     <input type="text" name="name"><br><?= $msgMail ?></p>
     <p>パスワード<br>
     <input type="text" name="password"><br><?= $msgPass ?></p>
        <button type="submit" name="login" value="send">ログイン</button>
        <button type="submit">キャンセル</button>
        <p><a href="toroku.php">新規登録はこちら</a></p>
        <p><a href="password.php">パスワードを忘れた方はこちら</a></p>
    </form>
</body>
</html>