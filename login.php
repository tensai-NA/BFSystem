<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php 
    unset($_SESSION['customer']);
    $ps = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select * from customer where login=?');
    $sql->execute([$_POST['login']]);

    foreach($sql as $row){
        if(password_verify($_POST['password'],$row['password']) == true){
        $_SESSION['customer']=[
            'id'=>$row['id'],'name'=>$row['name'],
            'address'=>$row['address'],'login'=>$row['login'],
            'password'=>$ps];
        }else{
            echo 'ログイン名またはパスワードが違います。';
        }
    }
    
    if(isset($_SESSION['customer'])){
        echo 'いらっしゃいませ、',$_SESSION['customer']['name'],'さん。';
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <form action="login.php" method="post">
     メールアドレス<br>
     <input type="text" name="name"><br>
     パスワード<br>
     <input type="text" name="pasu"><br>
        <button type="submit">ログイン</button>
        <button type="submit">キャンセル</button>
        <p><a href="toroku.php">新規登録はこちら</a></p>
        <p><a href="password.php">パスワードを忘れた方はこちら</a></p>
    </form>
</body>
</html>