<!--　担当：山﨑　6.商品詳細画面-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>
<body>
    <div class="head">
        <a href="cart.php"><h1>←</h1></a> <!--　矢印下線消す　改行をなくす--> 
        <a href="cart.php"><img src="sozai/cart.png" alt="home" width="10%" hight="10%"></a>
        <a href="home.php"><img src="sozai/home.png" alt="home" width="10%" hight="10%"></a>
    </div>

    <div class="main">
        <!-- 
            li {
            list-style: none;
             }
        -->
        <img src="" alt="image1" width="" hight="">
        <ul>
            <li><img src="" width="" height="" alt="image2"></li>
            <li><img src="" width="" height="" alt="image3"></li>
            <li><img src="" width="" height="" alt="image4"></li>
            <li><img src="" width="" height="" alt="image5"></li>
        </ul>

        <h3>商品名</h3>
        <h3>価格</h3>
        <button onclick="loction.href='cart.php'">カートに入れる</button>
    </div>

    <div class="notlogin">
        <p>カートに追加するにはログインしてください</p><!--赤字-->
        <p>ログインは <a href="login.php">こちら</a></p>

        
    </div>


</body>
</html>