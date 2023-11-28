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
   $pdo=new PDO($connect,USER,PASS);
    $cate="";/*それぞれの項目のsql文を格納 */
    $brand="";
    $color="";
    $price="";
    $flag1=false;/*price～colorまで１つでもあるかどうか*/ 
    $flag2=false/*cate～colorまで１つでもあるかどうか*/;
    $flagprice=false;


    
    $prices=
    array(
      0 =>1500,
      1500=>5000,
      5000=>10000,
      10000=>30000
   
   );
   
   
if(isset($_POST['price'])){
  
  foreach ($_POST['price'] as $pr){
      if($pr==8){
        $arr3[] = " price >=30000";
      }else{
        $arr3[] = " price between '$pr' and '$prices[$pr]' ";
      }
     
}
    $d = implode("or",$arr3);
    $price="  ($d)  ";
    $flag1=true;
    $flagprice=true;
   
}

    if(isset($_POST['cate'])){
    foreach($_POST['cate'] as $ca){
        $arr0[] = " category = '$ca' ";
        }
        $a = implode(" OR ",$arr0);


          $cate=" $a ";
          $flag1=true;
          $flag2=true;
    
      
      }
       
      

    if(isset($_POST['brand'])){
    foreach($_POST['brand'] as $br){
        $arr1[] = " brand = '$br' ";
        }
        $b = implode(" OR ",$arr1);
    
       
          $brand=" $b ";
          $flag1=true;
          if($flag2){
            $brand=" OR '$brand' ";
          }else{
            $flag2=true;
          }
      
      }

      if(isset($_POST['color'])){
        foreach($_POST['color'] as $co){
            $arr2[] = " color= '$co' ";
            }
            $c = implode(" OR ",$arr2);
           
          
              $color=" $c ";
              $flag1=true;
              if($flag2){
                $color=" OR '$color' ";
              }else{
            $flag2=true;
              }
             
          }

          if($flag2 &&  $flagprice){
            $price= $price ." AND ";
          }
           


          

  

    if(isset($_POST['shohin_mei'])){/*何も入力していなくてもtrueになっている */
      if($flag1){
          $price =" AND '$price'";
      }
      $sql = $pdo->prepare("select * from Shohin where  (shohin_mei like ?) ? ? ? ? ");
      echo $_POST["shohin_mei"],'<br>';
      echo  $cate,'<br>';
      echo $brand,'<br>';
      echo $color,'<br>';
      echo $price,'<br>';
      $sql->execute([$_POST['shohin_mei'],$price,$cate,$brand,$color]);
    }else {
      if($flag1){
       $sql=$pdo->prepare("select * from Shohin where  $price $cate  $brand  $color ");
      }else{
        $sql=$pdo->prepare("select * from Shohin");
      }
       $sql->execute();
    }

    $count=$sql-> rowCount();
    if($count==0){
      echo '検索に一致する商品がありません';
    }else{
  
   
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