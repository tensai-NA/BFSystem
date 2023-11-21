<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>
<?php
$msgMail = '';
$msgPass = '';
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
                'password'=>$row['password']];
            }else{
                $msgPass = 'パスワードが違います。';
            }
        }
    }
    
    if(isset($_SESSION['customer'])){
        header('Location: home.php');
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>ログイン</title>
</head>
<body>
<form action="login.php" method="post">
    <div class="m-4 has-text-centered ">
        <h1 class="title is-4"> ログイン</h1>

   

    <div class=" box has-background-light m-6">

        <div class="field">

        <div class="control m-1">
        <label class="label">メールアドレス</label>
        <div class="field has-addons-fullwidth has-addons-centered">
            <p class="control has-icons-left">
                <input class="input is-success  is-normal is-focused "  type="email" name="name"  placeholder="メールアドレス">
             <span class="icon is-small is-left">
                <i class="fas fa-mail-bulk"></i>
                </span>
                </p>
                <?= $msgMail ?>
    </div></div>

    <div class="control m-1">
        <label class="label">パスワード</label>
        <div class="field has-addons-fullwidth has-addons-centered">
            <p class="control has-icons-left">
     <input type="password"  class="input  is-normal is-focused "name="password"  placeholder="パスワード">
     <span class="icon is-small is-left">
        <i class="fas fa-key"></i>
    </span>
        </p>
        <?= $msgPass ?>
            </div></div></div>
           
        <button type="submit" class="button is-danger m-3 is-small"  name="login" value="send">ログイン</button>
       <button type="submit"  class="button is-info m-3 is-small">キャンセル</button>

        <p><a href="toroku.php">新規登録はこちら</a></p>
        <p><a href="password.php">パスワードを忘れた方はこちら</a></p>
    </form>
    </div>
    </div>
</body>
</html>