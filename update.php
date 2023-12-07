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
<div class="m-6 has-text-centered is-family-code has-text-weight-semibold" id="app">
    <h1 class="title is-3"> 会員情報更新</h1>
    <div class=" box has-background-white-bis box-padding-4 ">
        <div class="field">
            <div class="control m-1">
            <label class="label label is-size-6 m-4"> お名前 </label>
            <div class="field   has-addons-centered ">
            <?php
            $msgmail = '';
            $user_sei=$user_mei=$mail=$password=$shin=$postnum=$address='';
            if(isset($_SESSION['customer'])){
                $user_sei=$_SESSION['customer']['user_sei'];
                $user_mei=$_SESSION['customer']['user_mei'];
                $mail=$_SESSION['customer']['mail'];
                $postnum=$_SESSION['customer']['postnum'];
                $address=$_SESSION['customer']['address'];
            }
            echo '<input type="text"  class="input  is-normal is-focused m-1" name="user_sei" value="',$user_sei,'"  style="width: 250px;">
                <input type="text" class="input  is-normal is-focused m-1"  name="user_mei" value="',$user_mei,'"  style="width: 250px;">';
            echo ' </div></div>';

        echo '<div class="control m-1">
                <label class="label label is-size-6 m-4">メールアドレス</label>
                <div class="field has-addons-fullwidth has-addons-centered">';
                

            echo '<input type="text" class="input  is-primary  is-normal is-focused " v-model="email" name="mail" value="',$mail,'"  style="width: 515px;"  />';
            echo ' <p v-if="isInValidEmail" class="has-text-danger">Eメールアドレスの形式で入力してください</p>
                </div>
            </div>';

        echo ' <div class="control m-1">
                    <label class="label label is-size-6 m-4">郵便番号</label>
                    <div class="field has-addons-fullwidth has-addons-centered">';

            echo '<input type="number" class="input  is-normal is-focused " v-model="postnum" name="postnum" value="',$postnum,'"   style="width: 515px;" />';
            echo '<p v-if="isInValidPost" class="has-text-danger">郵便番号は7桁の数字で入力してください。</p>
                    </div>
            </div>';

        echo '<div class="control m-1">
                <label class="label label is-size-6 m-4">住所</label>
                <div class="field has-addons-fullwidth has-addons-centered">';
               

        echo '<input type="text" class="input  is-primary is-normal is-focused " name="address" value="',$address,'"  style="width: 515px;" >';
        echo '</div></div>';
        ?>
        <button type="submit" class="button is-danger m-3">更新</button>
    </form>

        <button type="button" onclick="location.href='mypage.php'" class="button is-link m-3">キャンセル</button>
        </div>
        </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="js/update.js"></script>
</body>
</html>
