<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>マイページ</title>
</head>
<body>
<div class="m-3 has-text-centered is-family-code has-text-weight-semibold">

<nav class="level  is-mobile  mt-6 mx-3">

<div class="level-left ml-3">

</div>
   
<div class="level-itemt ml-3">
<p class="title is-3">マイページ</p>
</div>

  <div class="level-right mr-3">
  <a href="home.php"><i class="fas fa-home fa-2x"></i></a>

    </div>
</nav>
<?php //エラーメッセージ
    if(!isset($_SESSION['customer'])){
        echo '<p>カートを閲覧するにはログインしてください</p>';
        echo '<p><a href="login.php">ログインはこちら</a></p>';
        exit();
    }

?>
<?php //名前取得
        $id =$_SESSION['customer']['user_id'];
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->query("select user_sei from User where user_id='".$id."'");
        $sei = $sql->fetch(PDO::FETCH_COLUMN);
        echo '<p class="has-text-left m-2 is-size-5">',$sei,'様</p>';

    ?>


<!--エラーメッセージ-->

<?php //ポイント取得
        $id =$_SESSION['customer']['user_id'];
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->query("select point from User where user_id='".$id."'");
        $point = $sql->fetch(PDO::FETCH_COLUMN);
        echo '<p class="has-text-left m-2">利用可能ポイント: ',$point,'pt</p>';
?>
<hr>

<p class="title is-5">最近の購入履歴</p>



    <?php
            if(isset($_SESSION['customer'])){
                $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
                $pdo=new PDO($connect,USER,PASS);
                $sql=$pdo->query("select OrderA.buy_date, OrderA.order_id ,  Shohin.shohin_mei,   Color.color_mei, Shohin.price,Shohin.shohin_img ,Shohin.shohin_id,History.odsho_id,History.order_id
                        from OrderA,Shohin,Color,History
                        where History.order_id =  OrderA.order_id
                        and   History.shohin_id = Shohin.shohin_id
                        and   Shohin.color = Color.color_code
                        and    OrderA.user_id = '".$id."'
                        order by History.order_id DESC ,History.odsho_id desc
                        limit 3
                        ");

                foreach($sql as $row){
                  
                    echo '<div class="columns  is-mobile  is-centered"> ';
                    echo '<div class="column is-9"> ';
                    echo ' <div class=" box has-background-white-bis box-padding-4 ">';
                    echo '<p class="title is-5 has-text-left ml-3">',$row['buy_date'],'</p><hr>';
                    echo '<div class="left ml-6 mx-6 mb-6" style=" float: left;">';
                    echo  '<p><a href="detail.php?id=', $row['shohin_id'],'  class="thumbnail"  style=" display: inline-block; height: 100px; margin-right: 5px; margin-bottom: 20px;"">','<img src="' ,$row['shohin_img'], '" style="height:90%;">',' </a></p></div>';
                    echo '<div class="items2 m-2">';
                    echo '<p class="is-size-5 m-1"><a href="detail.php?id=', $row['shohin_id'],'">',$row['shohin_mei'],'</p></a>';
                    echo '<p class="m-1">色：',$row['color_mei'],'</p>';
                    echo '<p class="m-1">価格:￥',$row['price'],'</p>';
                    echo '</div></div></div></div>';
                }
                echo '<p class="is-size-7  has-text-right m-4">最大３件表示</p>';
            }


            ?>
            <p class="m-2 has-text-right is-size-5 m-3"><a href="history.php">購入履歴一覧へ→</a></p>
<hr>

<p class="m-2"><a href="logout.php"  class="button is-danger is-rounded is-normal m-3">ログアウト</a></p>
<p class="m-2"><a href="update.php" class="button is-link is-rounded is-normal m-1">登録情報更新</a></p>
</div>
</body>
</html>   