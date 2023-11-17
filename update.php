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
<body>
    <form action="login.php" method="post">
    <div class="m-4 has-text-centered ">
        <h1 class="title is-4"> 会員情報更新</h1>
    <div class="box has-background-light m-6">
        <div class="field">
  

        <div class="control m-1">
         <label class="label"> お名前 </label>
            <div class="field  has-addons has-addons-centered ">
                <input class="input  is-normal is-focused m-1"type="text" name="sei"  placeholder="姓">
                <input class="input  is-normal is-focused m-1" type="text" name="mei"  placeholder="名">
            </div>
        </div>

        <div class="control m-1">
            <label class="label">メールアドレス</label>
            <div class="field has-addons-fullwidth has-addons-centered">
                <p class="control has-icons-left">
                    <input class="input  is-primary  is-normal is-focused "type="email" name="meru"  placeholder="メールアドレス">
                    <span class="icon is-small is-left">
                        <i class="fas fa-mail-bulk"></i>
                    </span>
                </p>
            </div>
        </div>

        <div class="control m-1">
              <label class="label">現在のパスワード</label>
              <div class="field has-addons-fullwidth has-addons-centered">
                <p class="control has-icons-left">
                    <input class="input  is-normal is-focused "type="password" name="pasu"  placeholder="現在のパスワード">
                    <span class="icon is-small is-left">
                        <i class="fas fa-key"></i>
                    </span>
                </p>
            </div>
        </div>
                

        <div class="control m-1">
            <label class="label">新しいパスワード</label>
            <div class="field has-addons-fullwidth has-addons-centered">
              <p class="control has-icons-left">
                  <input class="input   is-primary is-normal is-focused "type="password" name="shin"  placeholder="新しいパスワード">
                  <span class="icon is-small is-left">
                      <i class="fas fa-key"></i>
                  </span>
              </p>
          </div>
      </div>

      <div class="control m-1">
        <label class="label">郵便番号</label>
        <div class="field has-addons-fullwidth has-addons-centered">
          <p class="control has-icons-left">
              <input class="input  is-normal is-focused "type="password" name="yubin"  placeholder="ハイフン無し">
              <span class="icon is-small is-left">
                 <i class="has-text-weight-bold">〒</i>
              </span>
          </p>
      </div>
  </div>
  

  <div class="control m-1">
    <label class="label">住所</label>
    <div class="field has-addons-fullwidth has-addons-centered">
      <p class="control has-icons-left">
          <input class="input  is-primary is-normal is-focused "type="password" name="home"  placeholder="住所">
          <span class="icon is-small is-left">
            <i class="fas fa-house-user"></i>
          </span>
      </p>
  </div>
</div>

     <button type="submit" class="button is-danger m-3">登録</button>
     <button onclick="mypage.php" class="button is-info m-3">キャンセル</button>
    </form>
    </div>
    </div>
    </div>
</body>
</html>
