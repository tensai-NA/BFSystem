<?php session_start();?>
<?php require 'kyotu/db-connect.php'?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>購入履歴</title>
</head>
<body>
    <div class="m-4 has-text-centered ">
       
        <nav class="level  is-mobile">
            <div class="level-left">
                <a href="mypage.php"><i class="fas fa-long-arrow-alt-left fa-4x" ></i></a>
                </div>
                <div class="level-item">
                    <h1 class="title is-3">購入履歴</h1>
                </div>
                <div class="level-right">
                </div>
        </nav>
                    <?php
                        if(isset($_SESSION['customer'])){
                            $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
                            $pdo=new PDO($connect,USER,PASS);
                            $sql=$pdo->prepare("select OrderA.buy_date,  Shohin.shohin_mei,   Color.color_mei, Shohin.price, Shohin.shohin_img
                                    from OrderA,Shohin,Color,History
                                    where History.user_id = OrderA.user_id
                                    and   History.shohin_id = Shohin.shohin_id
                                    and   Shohin.color = Color.color_code
                                    and OrderA.user_id = ?
                                    order by OrderA.buy_date DESC");
                            
                            $sql->execute([$id]);
                            $date="";
                            foreach($sql as $row){

                                if($date != $row['buy_date']){
                                    echo '<div class="mb-3 has-text-left">
                                    <span class="icon-text is-size-4">
                                        <span class="icon has-text-link">
                                        <i class="fas fa-prescription-bottle"></i>
                                        </span>
                                        <span>
                                    <strong class="has-text-link">',$row['buy_date'],'</strong>';
                                    //echo '<p class="m-4 has-text-left-desktop is-size-4-desktop">',$row['buy_date'];
                                    //echo '<hr>';
                                    echo '</span>
                                    </span>
                                  </div>
                                  <div class="box">
                                  ';
                                    $date = $row['buy_date'];
                                }
                                /*
                                echo '<p class="m-4 has-text-left-desktop"><img src="',$row['shohin_img'],'" alt="',$row['shohin_mei'],'">'; 
                                echo '<p class="m-4 has-text-right-desktop">','商品名：',$row['shohin_mei'],'<br>';
                                echo '<p class="m-4 has-text-right-desktop">','色：',$row['color_mei'],'<br>';
                                echo '<p class="m-4 has-text-right-desktop">','価格：￥',$row['price'],'<br>';
                                echo '</p>';
                                */
                                echo '
                                <div class="level is-mobile">
                                  <div class="level-left">
                                    <div class="media">
                                      <figure class="media-left">
                                        <p class="image is-64x64">
                                        <img src="',$row['shohin_img'],'" alt="',$row['shohin_mei'],'">
                                        </p>
                                      </figure>
                                      <div class="media-content">
                                        <div class="is-size-5">
                                          <strong>商品名：',$row['shohin_mei'],'</strong>
                                        </div>
                                        <div class="is-size-7 has-text-grey-light">
                                        色：',$row['color_mei'],'価格：￥',$row['price'],'
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <hr>';
                            }
                        }
                    ?>
                    

      


              
    </div>
    </body>
</html>
 
