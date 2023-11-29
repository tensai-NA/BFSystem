<?php session_start(); ?>

<!--完成-->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_SESSION['customer'])){
            unset($_SESSION['customer']);
            echo '<p>ログアウトしました</p>';
            echo '<a href="home.php">ホームへ戻る</a>';
        }else{
            echo '<p>すでにログアウトしています</p>';
            echo '<a href="home.php">ホームへ戻る</a>';
        }
    ?>
</body>
</html>