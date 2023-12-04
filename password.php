<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>
<?php
    $msgMail = '';
    $msgPass = '';
    $msgError = '';
    $id = $_SESSION['customer']['user_id'];
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select * from User where user_id=?');
    $sql->execute([$id]);
    $data=$sql->fetchAll();

    foreach($data as $d){
        if(isset($_POST['send'])){
            if($_POST['sei'] == $d['user_sei'] && $_POST['mei'] == $d['user_mei'] && $_POST['mail'] == $d['mail']){  //姓とDBとを比較　&& 名前も比較
                $msgMail = "指定されたメールアドレスにリンクを送信しました。";
            }else{
                $msgMail = "入力されたデータが存在しません。";
            }
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
    <title>パスワード再設定画面</title>
</head>
<body>
    <div class="m-4 has-text-centered ">
   <h1 class="title is-4"> パスワード再設定</h1>

   <p class="m-6">
    会員登録時に登録されたお名前とメールアドレスをご入力の上「送信」をタップしてください<br>
    パスワード再設定ページURLを記載したメールをお送りいたします。<br>
    </p>

   <div class=" box has-background-light m-6"> <!--ボックスのwidthを指定-->
   <form action="password.php" method="post">
    <label class="label"> お名前 </label><br><!--横並びに-->
    <div class="field  has-addons has-addons-centered ">
    <input class="input is-info is-normal is-focused m-1"type="text" name="sei"  placeholder="姓">
    <input class="input is-info is-normal is-focused m-1" type="text" name="mei"  placeholder="名">
     </div><br>


     <label class="label">メールアドレス</label><br>
     <div class="field has-addons-fullwidth has-addons-centered">
      
        <p class="control has-icons-left">
     <input class="input is-success  is-normal is-focused "type="email" name="mail"  placeholder="メールアドレス">
     <span class="icon is-small is-left">
        <i class="fas fa-mail-bulk"></i>
        </span>
        </p>
        
    </div><br>
        <button type="submit" class="button is-info" name="send">送信</button>
     
        </div>
    </div>
    <p>
        <a href="login.php"><span class="is-size-6 is-underlined">ログインへ戻る</span></a></p>
</body>
</html>