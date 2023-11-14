<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>

<!--完成-->

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
    <div id="app">
        <?php
            $sei=$mei=$mail=$password=$password2=$postnum=$address='';
            if(isset($_SESSION['customer'])){
                $sei=$_SESSION['customer']['sei'];
                $mei=$_SESSION['customer']['mei'];
                $mail=$_SESSION['customer']['mail'];
                $password=$_SESSION['customer']['password'];
                $password2=$_SESSION['customer']['password2'];
                $postnum=$_SESSION['customer']['postnnum'];
                $address=$_SESSION['customer']['address'];
            }
        
        echo '<form action="toroku-output.php" method="post">';
        echo '<table>';

        echo '<tr><td>お名前</td><td>';
        echo '<input type="text" name="sei" v-model="sei" value="',$sei,'"/>','<input type="text" name="mei" v-model="mei" value="',$mei,'"/>';
        echo '</td></tr>';

        echo '<tr><td>メールアドレス</td><td>';
        echo '<input type="text" name="mail" v-model="email" value="',$mail,'"/>';
        echo '<p v-if="isInValidEmail" class="has-text-danger">Eメールアドレスの形式で入力してください</p>';
        echo '</td></tr>';

        echo '<tr><td>パスワード</td><td>';
        echo '<input type="password" name="password" v-model="pass1" value="',$password,'"/>';
        echo '</td></tr>';

        echo '<tr><td>パスワード確認</td><td>';
        echo '<input type="password" name="password2" v-model="pass2" value="',$password2,'"/>';
        echo '<p v-if="isInValidPass" class="has-text-danger">パスワードがちがいます。';
        echo '</td></tr>';

        echo '<tr><td>郵便番号</td><td>';
        echo '<input type="text" name="postnum" v-model="postnum" value="',$postnum,'"/>';
        echo '<p v-if="isInValidPost" class="has-text-danger">郵便番号は7桁の数字で入力してください。';
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="js/toroku.js"></script>
</body>
</html>

