<?php session_start(); ?>
<?php require 'kyotu/db-connect.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <title>ホーム画面</title>
</head>

<body>
    <form action="search.php" method="post">
    <div class="m-3 has-text-centered is-family-code has-text-weight-semibold">

            <nav class="level  is-mobile">

                <div class="level-left ml-3">
                    <img src="sozai/Shopicon.png" width="40vw" style="max-width:'100%'">
                </div>



                <div class="level-right">
                    <p class="mr-4"><a href="mypage.php"><i class="fas fa-user-circle fa-2x"></i></a></p>
                    <p class="mr-4 fa-2x">
                        <span class="fa-layers fa-fw bg">
                            <a href="cart.php"><i class="fas fa-shopping-cart"></i>
                                <?php
                                if (isset($_SESSION['customer'])) {
                                    //カートの数量取得 
                                    $user = $_SESSION['customer']['user_id'];
                                    $pdo = new PDO($connect, USER, PASS);
                                    $sql = $pdo->prepare("select * from Cart where user_id = ?");
                                    $sql->execute([$user]);
                                    $count = $sql->rowCount();

                                    echo  '<span class="fa-layers-counter" style="background: #ad9000;">';
                                    echo    $count;
                                    echo  '</span>';
                                } else {
                                }


                                ?>
                            </a></span>
                    </p>


                </div>
            </nav>


            <script src="https://code.jquery.com/jquery.min.js"></script>
            <div class ="columns">
              <div class="column is-full">
            <div class="A box m-6 has-background-white-ter "><i class="fas fa-search fa-xs"></i>　search</div>
                            </div></div>
            <?php require 'kyotu/searchbox.php' ?>


            <?php
            if (!isset($_SESSION['customer'])) {
                echo '<hr><p class="has-text-centered m-4"><a href="login.php">ログインはこちら</a></p><hr>';
            } else {
                $id = $_SESSION['customer']['user_id'];
                $pdo = new PDO($connect, USER, PASS);
                $sql = $pdo->query("select point from User where user_id='" . $id . "'");
                $point = $sql->fetch(PDO::FETCH_COLUMN);
                echo '<p>マイポイント: ', $point, 'pt</p><hr>';
            }

            ?>






            <div class="m-3 has-text-centered is-family-code has-text-weight-semibold ">
                <p class="title is-4 m-5">おすすめ</p><hr>
                <p>各ジャンル<label class="has-text-danger-dark">１位</label></p>
                <!--全顧客で一緒の表示にする-->
                <div class="sliderArea m-6">
                    <div class="full-screen-o slider">
                        
                        <?php 
                         $pdo=new PDO($connect,USER,PASS);
                       
                              $sql = $pdo->prepare("select count(*) as top,Shohin.shohin_id,Shohin.shohin_img,Shohin.shohin_mei,Shohin.category,Categori.cate_mei,Categori.cate_code
                              from History,Shohin,Categori
                              where History.shohin_id=Shohin.shohin_id and Categori.cate_code=Shohin.category
                              group by Shohin.category
                              order by top desc ");
                                $sql->execute();

                              

                             foreach($sql as $row){
                             $id=$row['shohin_id'];
                            
                             echo '<div> <p>',$row["cate_mei"],'</p>
                             <a href="detail.php?id=',$id,'"><img src="',$row['shohin_img'],'" alt="',$row['shohin_mei'],'"></a>
                             </div>';
                   
                            }
                        
                        ?>

                           
                       
                    </div>
                </div>
                       
                <div class="m-4">
                    <hr><p class="title is-4 m-5">新商品</p><hr>

                    <?php
                       $sql = $pdo->prepare("select * from Shohin order by shohin_id desc limit 12");
                       $sql->execute();
                    
                  
                     echo '<div class="columns  is-multiline">';
                     foreach($sql as $row){
                        $id=$row['shohin_id'];
                        echo '<div class="column  is-2 is-one-quarter">
                        <div class="card">
                          <div class="card-image">';
                               
                        echo '<figure class="image is-square">';
                        echo '<a href="detail.php?id=',$id,'"><p class="m-1"><img src="',$row['shohin_img'],'" alt="',$row['shohin_mei'],'"></p></figure></div>';
                        echo ' <div class="card-content"> <div class="content">';
                        echo '<p class="has-text-centered	"><a href="detail.php?id=',$id,'">',$row['shohin_mei'],'</a></p>';
                        echo '<p class="has-text-centered	">',$row['price'],'円 </p>';
                        echo '</div></div></div></div>';
                     }
                     echo '</div>';
                   
                    
                    
                    ?>
                </div>




            </div>
      
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/slick.min.js"></script>
        <script src="js/home.js"></script>
        </div>
</body>

</html>