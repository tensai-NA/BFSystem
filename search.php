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
        <div class="A"><i class="fas fa-search"></i>　search</div> <!--seachの部分は商品名　（絞り込み検索があれば表示）　例　パンプス　白　1000～　-->
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
    $sql_search="select * from Shohin where  (shohin_mei like ?)";
    $arr[]="%".$_POST['shohin_mei']."%";
    $pricef=false;/*それぞれの項目で$sql_searchに入るのが最初か判断 */
    $catef=false;
    $brandf=false;
    $colorf=false;
    
    
    $prices=
    array(
      0 =>1500,
      1500=>5000,
      5000=>10000,
      10000=>30000

   );
   
   
if(isset($_POST['price'])){
    $sql_search= $sql_search ." AND (" ;
  
  foreach ($_POST['price'] as $pr){
    if(!$pricef){
      $pricef=true;
      if($pr==8){
        $sql_search=  $sql_search . " price >= ?";
        $arr[]  = 30000;
      }else{
        $sql_search=  $sql_search." price between ? and  ? ";
        $arr[]  = $pr;
        $arr[]  = $prices[$pr];
      }
    }else{
      if($pr==8){
        $sql_search=  $sql_search . " AND price >= ?";
        $arr[]  = 30000;
      }else{
        $sql_search=  $sql_search." AND price between ? and  ? ";
        $arr[]  = $pr;
        $arr[]  = $prices[$pr];
      }
    }
     
}
    $sql_search= $sql_search .") ";
    $flag1=true;
    $flagprice=true;
   
}

    if(isset($_POST['cate'])){

        $sql_search= $sql_search ." AND ";
        $flag1=true;

      $flag2=true;

     
    
    foreach($_POST['cate'] as $ca){
      if(!$catef){
        $catef=true;
        $sql_search=  $sql_search . "  category = ?";
        $arr[] = $ca;
      }else{
      $sql_search=  $sql_search . " or category = ?";
      $arr[] = $ca;
        }
      }
    
        
    
      
      }
       
      

    if(isset($_POST['brand'])){

      if(!$flag2 || !$flag1){
        $sql_search= $sql_search ." AND ";
      }else if($flag2){
        $sql_search= $sql_search ." OR ";
      }else{
       
      }
      $flag1=true;
      $flag2=true;
    foreach($_POST['brand'] as $br){
      if(!$brandf){
          $brandf=true;
          $sql_search=  $sql_search . "  brand = ?";
          $arr[] = $br;
      }else{

      $sql_search=  $sql_search . " or brand = ?";
      $arr[] = $br;
      }
        }
    
      
      }

      if(isset($_POST['color'])){

          if(!$flag2 || !$flag1){
            $sql_search= $sql_search ." AND ";
          }else if($flag2){
         $sql_search= $sql_search ." OR ";
         }else{
            
          }
          $flag1=true;
          $flag2=true;
        foreach($_POST['color'] as $co){
          if(!$colorf){
            $colorf=true;
            $sql_search=  $sql_search . " color = ?";
            $arr[] = $co;
          }else{
          $sql_search=  $sql_search . " or color = ?";
          $arr[] = $co;
            }
          }
              
             
          }

         
           
         
           


  

    if(isset($_POST['shohin_mei'])){
    
     echo $sql_search,'<br>';
     echo var_dump($arr),'<br>';
       
        $sql = $pdo->prepare($sql_search);
        $sql->execute($arr);
     
    } 

    $count=$sql-> rowCount();
    if($count==0){
      echo '<p class="m-4 has-text-centered ">検索に一致する商品がありません';
    }else{
   
     echo ' <div class="columns">';
    foreach($sql as $row){
       $id=$row['shohin_id'];
       echo'<div class="column">';
       echo '<div style="background:white; padding: 10px;">';
       echo '<div class="section"> <div class="columns is-variable is-8">';
       echo '<a href="detail.php?id=',$id,'"><p><img src="',$row['shohin_img'],'" alt="',$row['shohin_mei'],'"></p>';
       echo '<p class="has-text-center">',$row['shohin_mei'],'</a></p>';
       echo '<p class="has-text-center">',$row['price'],'円 </p>';
       echo '</div></div></div></div>';
    }
  }
  
 
   ?>
   </div>
<!--　デザイン変更予定-->
<style>
 
.columns > div.column {
  border: solid 1px #ddd;
  text-align: center;
}
 
</style>

</body>
</html>