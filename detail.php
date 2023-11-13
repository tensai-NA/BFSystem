<!--　担当：山﨑　6.商品詳細画面-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>
<body>
    <div class="head">
    
        <p class="back">
            <a href="search.php"><i class="fas fa-long-arrow-alt-left fa-3x" ></i></a>
        </p>

        <p class="headitems">
            <a href="cart.php"><i class="fas fa-shopping-cart fa-3x" ></i></a>
            <a href="home.php"><i class="fas fa-home fa-3x"></i></a>
        </p>

    </div><hr>

    <div class="main">
        <img src="sozai/mypage.png"  width="70%"alt="image1">
        <ul>
            <li><img src="sozai/mypage.png" width="90%" alt="image2"></li>
            <li><img src="sozai/mypage.png" width="90%" alt="image3"></li>
            <li><img src="sozai/mypage.png" width="90%" alt="image4"></li>
            <li><img src="sozai/mypage.png" width="90%" alt="image5"></li>
        </ul>
        <h3>商品名</h3>
        <h3>価格</h3>
        <button  onclick="loction.href='cart.php'">カートに入れる</button>
    </div>

    <div class="notlogin">
        <p>カートに追加するにはログインしてください</p><!--赤字-->
        <p>ログインは <a href="login.php">こちら</a></p>
        
    </div>
</body>
</html>