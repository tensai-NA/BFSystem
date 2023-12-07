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
<div class="m-6 has-text-centered is-family-code has-text-weight-semibold">
        <nav class="level  is-mobile mt-6 mx-3">
            <div class="level-left">
                <a href="mypage.php"><i class="fas fa-long-arrow-alt-left fa-2x" ></i></a>
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
                            $sql=$pdo->query("select OrderA.buy_date, OrderA.order_id ,  Shohin.shohin_mei,   Color.color_mei, Shohin.price,Shohin.shohin_img ,Shohin.shohin_id,History.odsho_id,History.order_id as hisorder_id
                            from OrderA,Shohin,Color,History
                            where History.order_id =  OrderA.order_id
                            and   History.shohin_id = Shohin.shohin_id
                            and   Shohin.color = Color.color_code
                            and    OrderA.user_id = '".$id."'
                            order by History.order_id DESC ,History.odsho_id desc
                            limit 20
                            ");
                            $stack = array();
                            $count=0;
                            $countorder=1;
                            foreach($sql as $row){
                                array_push($stack,$row['hisorder_id']);
                                if($count>0){
                                    if($stack[$count]!=$stack[$count-1]){
                                        echo' <p class="title is-5 has-text-left">','直近の注文', $countorder,'(',$row['buy_date'],')</p><hr>';
                                        $countorder++;
                                    }
                                }else{
                                    echo' <p class="title is-5 has-text-left">','直近の注文', $countorder,'(',$row['buy_date'],')</p><hr>';
                                    $countorder++;
                                }
                                echo '<div class="columns  is-mobile  is-centered"> ';
                                echo '<div class="column is-10"> ';
                                echo '<div class=" box has-background-white-bis box-padding-4 ">';
                              
                                echo '<div class="left ml-5 mx-5 mb-3" style=" float: left;">';
                               
                                echo '<p class="mx-3"> <a href="detail.php?id=', $row['shohin_id'],'   class="thumbnail"  style=" display: inline-block; height: 100px; margin-right: 5px; margin-bottom: 20px;""><img src="',$row['shohin_img'],'" alt="',$row['shohin_mei'],'"  style="height: 100%;"></a></p>';
                                echo '</div>';
                                echo '<div class="items2 m-2">';
                                echo '<p class="is-size-5"><a href="detail.php?id=', $row['shohin_id'],'">',$row['shohin_mei'],'</a></p><hr>';
                                echo '<p class="m-2">色：',$row['color_mei'],'</p>';
                                echo '<p class="m-2">価格:￥',$row['price'],'</p>';
                                echo '</div></div></div></div>';
                                $count++;
                            }
                        }
                    
                    ?>
              <p class="has-text-right">最大20件表示</p>
    </div>
    </body>
</html>
 
