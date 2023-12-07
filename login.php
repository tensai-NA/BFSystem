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
    <div class="m-6 has-text-centered is-family-code has-text-weight-semibold">
        <p class="title is-3 "> ログイン</p>

   

    
    <div class='columns  is-mobile  is-centered'> 
            <div class='column is-10'> 
                <div class=" box has-background-white-bis box-padding-4 ">
        <div class="field">

        <div class="control m-1">
        <label class="label is-size-6 m-4">メールアドレス</label>
        <div class="field  has-addons-centered">
           
                <input class="input is-success  is-normal is-focused "  type="email" name="name"  placeholder="✉ メールアドレス" style="width: 615px;"  required>
           
            
                <p class="m-3 has-text-danger-dark"><?= $msgMail ?></p>
    </div></div>

    <div class="control m-1">
        <label class="label is-size-6 m-4">パスワード</label>
        <div class=" has-addons-centered">
     <input type="password"  class="input  is-normal is-focused "name="password"  placeholder="🔐 パスワード"  style="width: 615px;"  required>
   
       
         <p class="m-3 has-text-danger-dark"><?= $msgPass ?></p>
            </div></div></div>
           

            <div class='columns  is-mobile is-centered'> 
            <div class='column'> 
        <button type="submit" class="button is-danger  mx-4 mt-4"  name="login" value="send">ログイン</button>

        <button    onclick="history.back()"  class="button is-info  mx-4 mt-4">キャンセル</button>
</div>
</div>


      
        <p class=" mt-5 mb-4 "><a href="toroku.php">新規登録はこちら</a></p>
      
        
        <p class="m-4"><a href="password.php">パスワードを忘れた方はこちら</a></p>

        </form>
    </div>
    </div>
    </div>
    </div>
</body>
</html>