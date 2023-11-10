<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>会員登録</title>
</head>
<body>
    <?php
        $sei=$mei=$mail=$password=$password2=$postnum=$address='';
        if(isset($_SESSION['toroku'])){
            $sei=$_SESSION['toroku']['sei'];
            $mei=$_SESSION['toroku']['mei'];
            $mail=$_SESSION['toroku']['mail'];
            $password=$_SESSION['toroku']['password'];
            $password2=$_SESSION['toroku']['password2'];
            $postnum=$_SESSION['toroku']['postnnum'];
            $address=$_SESSION['toroku']['address'];
        }
    
     echo '<form action="toroku-output.php" method="post">';
     echo '<table>';

     echo '<tr><td>お名前</td><td>';
     echo '<input type="text" name="sei" value="',$sei,'">','<input type="text" name="mei" value="',$mei,'">';
     echo '</td></tr>';

     echo '<tr><td>メールアドレス</td><td>';
     echo '<input type="text" name="mail" value="',$mail,'">';
     echo '</td></tr>';

     echo '<tr><td>パスワード</td><td>';
     echo '<input type="text" name="password" value="',$password,'">';
     echo '</td></tr>';

     echo '<tr><td>パスワード確認</td><td>';
     echo '<input type="text" name="password2" value="',$password2,'">';
     echo '</td></tr>';

     echo '<tr><td>郵便番号</td><td>';
     echo '<input type="test" name="postnum" value="',$postnum,'">';
     echo '</td></tr>';

     echo '<tr><td>住所</td><td>';
     echo '<input type="text" name="address" value="',$address,'">';
     echo '</td></tr>';

     echo '</table>';
     echo '<input type="submit" value="確定">';
     echo '</form>';

    echo '<button onclick="location.href=\'login.php\'">キャンセル</button>';
    echo '<p><a href="login.php">アカウントをお持ちの方はこちら</a></p>'
    ?>
    
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

</body>
</html>