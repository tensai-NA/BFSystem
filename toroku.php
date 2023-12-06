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
        <form action="toroku-output.php" method="post">
        <div class="m-4 has-text-centered ">
                 <h1 class="title is-4"> 会員情報登録</h1>
                  <div class="box has-background-light m-6">
                     <div class="field">

        <div class="control m-1">
                <label class="label"> お名前 </label>
                <div class="field  has-addons has-addons-centered "> 
        <input type="text" class="input  is-normal is-focused m-1" name="sei" placeholder="姓" v-model="sei" />
                <input type="text" class="input  is-normal is-focused m-1" name="mei" placeholder="名" v-model="mei" />
        </div></div>


        <div class="control m-1">
                 <label class="label">メールアドレス</label>
        <div class="field has-addons-fullwidth has-addons-centered">
                     <p class="control has-icons-left">
                         <input type="text"  class="input  is-primary  is-normal is-focused" name="mail" placeholder="メールアドレス" v-model="email" />
                         <span class="icon is-small is-left">
                             <i class="fas fa-mail-bulk"></i>
                          </span>
                    </p>

        <p v-if="isInValidEmail" class="has-text-danger">Eメールアドレスの形式で入力してください</p>
        </div></div>


        <div class="control m-1">
        <label class="label">パスワード</label>
        <div class="field has-addons-fullwidth has-addons-centered">
                    <p class="control has-icons-left">
                     <input type="password"  class="input  is-normal is-focused" name="password" placeholder="パスワード" v-model="pass1" />
                     <span class="icon is-small is-left">
                     <i class="fas fa-key"></i>
                 </span>
             </p>
        </div></div>


        <div class="control m-1">
                <label class="label">パスワード確認</label>
        <div class="field has-addons-fullwidth has-addons-centered">
                    <p class="control has-icons-left">
                     <input type="password"  class="input  is-primary is-normal is-focused " name="password2" placeholder="パスワード再確認" v-model="pass2" />
                     <span class="icon is-small is-left">
                     <i class="fas fa-key"></i>
                 </span>
             </p>
        <p v-if="isInValidPass" class="has-text-danger">パスワードがちがいます。</p>
        </div></div>



        <div class="control m-1">
                 <label class="label">郵便番号</label>
        <div class="field has-addons-fullwidth has-addons-centered">
                 <p class="control has-icons-left">
                    <input type="text" class="input  is-normal is-focused " name="postnum" placeholder="郵便番号" v-model="postnum" />
                    <span class="icon is-small is-left">
                    <i class="has-text-weight-bold">〒</i>
                 </span>
             </p>
        <p v-if="isInValidPost" class="has-text-danger">郵便番号は7桁の数字で入力してください。</p>
        </div></div>


        <div class="control m-1">
                 <label class="label">住所</label>
        <div class="field has-addons-fullwidth has-addons-centered">
                 <p class="control has-icons-left">
                    <input type="text" class="input  is-primary is-normal is-focused " placeholder="住所" name="address" >
                    <span class="icon is-small is-left">
                    <i class="fas fa-house-user"></i>
                  </span>
                    </p>
        </div></div>

       
        <input type="submit" class="button is-danger m-5" value="確定">
        </form>
       <button class="button is-info m-5" type="button" onclick="location.href='login.php'">キャンセル</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="js/toroku.js"></script>
</body>
</html>

