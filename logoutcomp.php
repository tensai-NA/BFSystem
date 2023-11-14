<?php session_start(); ?>

<!--完成-->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_SESSION['customer'])){
            unset($_SESSION['customer']);
            echo 'ログアウトしました';
        }else{
            echo 'すでにログアウトしています';
        }
    ?>
</body>
</html>