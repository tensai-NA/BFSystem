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
    <link rel="stylesheet" href="css/main.css">
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
        echo '<div class="m-4 has-text-centered ">
                 <h1 class="title is-4"> 会員情報登録</h1>
                  <div class="box has-background-light m-6">
                     <div class="field">';

        echo ' <div class="control m-1">
                <label class="label"> お名前 </label>
                <div class="field  has-addons has-addons-centered "> ';
        echo '<input type="text" class="input  is-normal is-focused m-1" name="sei" v-model="sei"value="',$sei,'"/>',
                '<input type="text" class="input  is-normal is-focused m-1" name="mei" v-model="mei"value="',$mei,'"/>';
        echo '</div><div>';


        echo '  <div class="control m-1">
                 <label class="label">メールアドレス</label>';
        echo '   <div class="field has-addons-fullwidth has-addons-centered">
                     <p class="control has-icons-left">
                         <input type="text"  class="input  is-primary  is-normal is-focused " name="mail" v-model="email" value="',$mail,'"/>
                         <span class="icon is-small is-left">
                             <i class="fas fa-mail-bulk"></i>
                          </span>
                    </p>';

        echo    '<p v-if="isInValidEmail" class="has-text-danger">Eメールアドレスの形式で入力してください</p>';
        echo '</div></div>';


        echo '  <div class="control m-1">
        <label class="label">パスワード</label>';
        echo '   <div class="field has-addons-fullwidth has-addons-centered">
                    <p class="control has-icons-left">
                     <input type="password"  class="input  is-normal is-focused " name="password" v-model="pass1" value="',$password,'"/>
                     <span class="icon is-small is-left">
                     <i class="fas fa-key"></i>
                 </span>
             </p>';
        echo '</div></div>';


        echo ' <div class="control m-1">
                <label class="label">パスワード確認</label>';
        echo '  <div class="field has-addons-fullwidth has-addons-centered">
                    <p class="control has-icons-left">
                     <input type="password"  class="input  is-primary is-normal is-focused " name="password2" v-model="pass2" value="',$password2,'" />
                     <span class="icon is-small is-left">
                     <i class="fas fa-key"></i>
                 </span>
             </p>';
        echo '<p v-if="isInValidPass" class="has-text-danger">パスワードがちがいます。';
        echo '</div></div>';



        echo '<div class="control m-1">
                 <label class="label">郵便番号</label>';
        echo ' <div class="field has-addons-fullwidth has-addons-centered">
                 <p class="control has-icons-left">
                    <input type="text" class="input  is-normal is-focused " name="postnum" v-model="postnum" value="',$postnum,'"/>
                    <span class="icon is-small is-left">
                    <i class="has-text-weight-bold">〒</i>
                 </span>
             </p>';
        echo '<p v-if="isInValidPost" class="has-text-danger">郵便番号は7桁の数字で入力してください。';
        echo '</div></div>';


        echo ' <div class="control m-1">
                 <label class="label">住所</label>';
        echo ' <div class="field has-addons-fullwidth has-addons-centered">
                 <p class="control has-icons-left">
                    <input type="text" class="input  is-primary is-normal is-focused " name="address" value="',$address,'">
                    <span class="icon is-small is-left">
                    <i class="fas fa-house-user"></i>
                  </span>
                    </p>';
        echo '</div></div>';

       
        echo '<input type="submit" class="button is-danger m-5" value="確定">';
        echo '</form>';

        echo '<button onclick="location.href=\'login.php\'" class="button is-info m-5">キャンセル</button>';
        echo '<p><a href="login.php">アカウントをお持ちの方はこちら</a></p>'
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="js/toroku.js"></script>
</body>
</html>

