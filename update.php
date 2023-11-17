<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>会員情報更新画面</title>
</head>

<?php
$user_sei=$user_mei=$mail=$password=$shin=$postnum=$address='';
if(isset($_SESSION['customer'])){
    $user_sei=$_SESSION['customer']['user_sei'];
    $user_mei=$_SESSION['customer']['user_mei'];
    $mail=$_SESSION['customer']['mail'];
    $password=$_SESSION['customer']['password'];
    $shin=$_SESSION['customer']['shin'];
    $postnum=$_SESSION['customer']['postnum'];
    $address=$_SESSION['customer']['address'];
}
    echo '<form action="updatecomp.php" method="post">';
     echo '<p>お名前<br>';
     echo '<input type="text" name="user_sei" value="',$user_sei,'">　<input type="text" name="user_mei" value="',$user_mei,'"></p>';
     echo '<p>メールアドレス<br>';
     echo '<input type="text" name="mail" value="',$mail,'">';
     echo '<p>現在のパスワード<br>';
     echo '<input type="text" name="password" value="',$password,'">';
     echo '<p>新しいパスワード<br>';
     echo '<input type="text" name="shin" value="',$shin,'">';
     echo '<p>郵便番号<br>';
     echo '<input type="text" name="postnum" value="',$postnum,'">';
     echo '<p>住所<br>';
     echo '<input type="text" name="address" value="',$address,'">';
     echo '<p><button type="submit" name="touroku" >登録</button>';
     echo '<button type="submit">キャンセル</button></p>';
echo '</form>';
?>