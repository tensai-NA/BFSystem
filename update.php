<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>会員情報更新</title>
</head>
<body>
<form action="updatecomp.php" method="post">
    <div class="m-4 has-text-centered ">
        <h1 class="title is-4"> 会員情報更新</h1>
    <div class="box has-background-light m-6">
        <div class="field">
  

        <div class="control m-1">
         <label class="label"> お名前 </label>
            <div class="field  has-addons has-addons-centered ">
<?php
$user_sei=$user_mei=$mail=$password=$shin=$postnum=$address='';
if(isset($_SESSION['customer'])){
    $user_sei=$_SESSION['customer']['user_sei'];
    $user_mei=$_SESSION['customer']['user_mei'];
    $mail=$_SESSION['customer']['mail'];
    $postnum=$_SESSION['customer']['postnum'];
    $address=$_SESSION['customer']['address'];
}
     echo '<input type="text"  class="input  is-normal is-focused m-1" name="user_sei" value="',$user_sei,'">
           <input type="text" class="input  is-normal is-focused m-1"  name="user_mei" value="',$user_mei,'">';
     echo ' </div></div>';

     echo '<div class="control m-1">
            <label class="label">メールアドレス</label>
            <div class="field has-addons-fullwidth has-addons-centered">
             <p class="control has-icons-left">';

     echo '<input type="text" class="input  is-primary  is-normal is-focused " name="mail" value="',$mail,'">';
     echo ' <span class="icon is-small is-left">
             <i class="fas fa-mail-bulk"></i>
             </span>
            </p>
            </div>
            </div>';

     echo ' <div class="control m-1">
            <label class="label">郵便番号</label>
            <div class="field has-addons-fullwidth has-addons-centered">
            <p class="control has-icons-left">';

     echo '<input type="number" class="input  is-normal is-focused "  name="postnum" value="',$postnum,'">';
     echo '<span class="icon is-small is-left">
            <i class="has-text-weight-bold">〒</i>
             </span>
            </p>
            </div>
            </div>';

     echo '<div class="control m-1">
            <label class="label">住所</label>
            <div class="field has-addons-fullwidth has-addons-centered">
            <p class="control has-icons-left">';

     echo '<input type="text" class="input  is-primary is-normal is-focused " name="address" value="',$address,'">';
     echo '
     <span class="icon is-small is-left">
       <i class="fas fa-house-user"></i>
         </span>
        </p>
        </div>
        </div>';
       ?>
    <button type="submit" class="button is-danger m-3">更新</button>
</form>

    <button type="button" onclick="location.href='mypage.php'" class="button is-link m-3">キャンセル</button>
    </div>
    </div>
    </div>
</body>
</html>
