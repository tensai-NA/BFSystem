<?php require 'kyotu/db-connect.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/search.css">

    <title>Document</title>
</head>
<body>
<form action="search.php" method="post">
    <div class="m-4 has-text-centered ">

    <nav class="level  is-mobile">

        <div class="level-left">

            <script src="https://code.jquery.com/jquery.min.js"></script>
        <div class="A"><i class="fas fa-search"></i>　seach</div> <!--seachの部分は商品名　（絞り込み検索があれば表示）　例　パンプス　白　1000～　-->
        </div>
 
          <div class="level-right">
            <a href="home.php"><i class="fas fa-home is-6"></i> </a>
            </div>
        </nav>

  
        <?php require 'kyotu/searchbox.php'?>


<!--以下　検索結果表示-->
<?php

if (isset($_POST['brand']) && is_array($_POST['brand'])) {
    $brand = $_POST['brand'];
}
if (isset($_POST['color']) && is_array($_POST['color'])) {
    $color= $_POST['color'];
}

    if(isset($_POST['shohin_mei'])){
       
    $sql=$pdo->prepare('select * from Shohin where shohin_mei like ?');
    $sql->execute(['%'.$_POST['shohin_mei'].'%']);
    }else{
       $sql=$pdo->query('select * from Shohin');
    }
   
    foreach($sql as $row){
       $id=$row['shohin_id'];
       echo'<div class="column">';
       echo '<div style="background:white; padding: 10px;">';
       echo '<div class="section"> <div class="columns is-variable is-8">';
       echo '<p><img src="images/',$row['shohin_img'],'" alt="',$row['shohin_mei'],'"></p>';
       echo '<p><a href="detail.php?id=',$id,'">',$row['shohin_mei'],'</a></p>';
       echo '<p class="has-text-left">',$row['price'],'円 </p>';
       echo '</div></div></div></div>';
    }

 
   ?>
<!--　デザイン変更予定-->
<style>
 
.columns > div.column {
  border: solid 1px #ddd;
  text-align: center;
}
 
</style>

</body>
</html>