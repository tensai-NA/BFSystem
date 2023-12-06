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
        <div class="m-6 has-text-centered is-family-code has-text-weight-semibold">
        
        <p class="title is-3 "> 会員情報登録</p>
        <div class='columns  is-mobile  is-centered'> 
            <div class='column is-10'> 
            <div class=" box has-background-white-bis box-padding-4 ">
                     <div class="field">

        <div class="control m-1">
                <label class="label is-size-6 m-5"> お名前 </label>
                <div class="field   has-addons-centered "> 
        <input type="text" class="input  is-normal is-focused mb-2" name="sei" placeholder="姓" v-model="sei"  style="width: 250px;"  required/>
                <input type="text" class="input  is-normal is-focused mb-2" name="mei" placeholder="名" v-model="mei" style="width: 250px;"  required/>
        </div></div>


        <div class="control m-1">
                 <label class="label is-size-6 m-5">メールアドレス</label>
        <div class="field has-addons-centered">
                         <input type="text"  class="input  is-primary  is-normal is-focused" name="mail" placeholder="✉ メールアドレス" v-model="email"  style="width: 515px;" required/>
                        

        <p v-if="isInValidEmail" class="has-text-danger m-2">Eメールアドレスの形式で入力してください</p>
        </div></div>


        <div class="control m-1">
        <label class="label is-size-6 m-5">パスワード</label>
        <div class="field  has-addons-centered">
                  
                     <input type="password"  class="input  is-normal is-focused" name="password" placeholder="🔐 パスワード" v-model="pass1" style="width: 515px;"  required/>
                    
        </div></div>


        <div class="control m-1">
                <label class="label is-size-6 m-5">パスワード確認</label>
        <div class="field  has-addons-centered">
                 
                     <input type="password"  class="input  is-primary is-normal is-focused " name="password2" placeholder="🔐 パスワード再確認" v-model="pass2"  style="width: 515px;"  required/>
                   
        <p v-if="isInValidPass" class="has-text-danger m-2">パスワードがちがいます。</p>
        </div></div>



        <div class="control m-1">
                 <label class="label is-size-6 m-5">郵便番号</label>
        <div class="field has-addons-centered">
                
                    <input type="text" class="input  is-normal is-focused " name="postnum" placeholder="〒 郵便番号" v-model="postnum" style="width: 515px;"  required/>
                    
        <p v-if="isInValidPost" class="has-text-danger m-2">郵便番号は7桁の数字で入力してください。</p>
        </div></div>


        <div class="control m-1">
                 <label class="label is-size-6 m-5">住所</label>
        <div class="field  has-addons-centered">
                 
                    <input type="text" class="input  is-primary is-normal is-focused " placeholder="🏠 住所" name="address " style="width: 515px;"  required>
                    
        </div></div>
</div>

       
        <input type="submit" class="button is-danger  mx-4 my-5 " value="確定">
        </form>
       <button class="button is-info mx-4 my-5" type="button" onclick="location.href='login.php'">キャンセル</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="js/toroku.js"></script>
</body>
</html>

