<?php require 'kyotu/db-connect.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/home.css">

    <title>Document</title>
</head>
<body>
<<<<<<< HEAD
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

      
        <div class="kensaku">
            <div class=" box has-background-light m-5">
                <h5 class="title is-5">検索</h5>
          
                    <label for="hinmei">商品名</label>
                <input type="text" id="hinmei"><br>

               <div class="B m-1  has-text-left"> 絞り込み <i class="fas fa-angle-down"></i></div>
            <div class="shibori has-text-left ml-6 mt-2">
               
           <div class="C m-1  has-text-left"> ブランド <i class="fas fa-angle-down"></i></div> 
           <div class ="C-main">   
     <?php
           $pdo=new PDO($connect, USER, PASS);
           $sql=$pdo->prepare('select  * from Brand');
           $sql->execute();
           foreach($sql as $row){
            echo '<input  class="button is-ghost is-small  is-rounded" type="reset" name="brand" value="',$row['brand_mei'],'" />';

         }
           ?>

            </div>
           <div class="D m-1  has-text-left"> カラー <i class="fas fa-angle-down"></i></div> 

           <div class ="D-main">   
     <?php
           $pdo=new PDO($connect, USER, PASS);
           $sql=$pdo->prepare('select  * from Color');
           $sql->execute();
           foreach($sql as $row){
            echo '<input class="button is-white is-small  is-rounded"  type="reset" name="brand" value="',$row['color_mei'],'" />';

         }
           ?>

            </div>
               
           <div class="E m-1  has-text-left"> 金額 <i class="fas fa-angle-down"></i></div>
           
           <div class="E-main">
                <label>下限：</label>
                <select name="select1">
                    <option value="0">指定なし</option>
                    <option value="1000">1000円</option>
                    <option value="2000">2000円</option>
                    <option value="3000">3000円</option>
                    <option value="4000">4000円</option>
                </select>
                
                
                <label>上限：</label>
                <select name="select2">
                <option value="0">指定なし</option>
                    <option value="1000">1000円</option>
                    <option value="2000">2000円</option>
                    <option value="3000">3000円</option>
                    <option value="4000">4000円</option>
                </select>
                
                <br>
                </div>
</div>
                <div class="seach m-5">
                <button>検索</button>
                
                </div>
        </div>
    </div>
        <script>
            $(function() {
                $(".A").click(function() {
                    $(".kensaku").slideToggle("");
                });
            });
            $(function() {
                $(".B").click(function() {
                    $(".shibori").slideToggle("");
                });
            });
            $(function() {
                $(".C").click(function() {
                    $(".C-main").slideToggle("");
                });
            });
            $(function() {
                $(".D").click(function() {
                    $(".D-main").slideToggle("");
                });
            });
            $(function() {
                $(".E").click(function() {
                    $(".E-main").slideToggle("");
                });
            });
        </script>


</div>

=======
<i class="fas fa-search"></i>
<a href="home.php"><i class="fas fa-home"></i> </a>
>>>>>>> 0b033ade9892450a36958c31aa5970593526b1a8

</body>
</html>