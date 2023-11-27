<?php require '../kyotu/db-connect.php'?>
<?php
$pdo=new PDO($connect,USER,PASS);
if(isset($_POST['add'])){   // 追加ボタンが押された処理
    $sql=$pdo->prepare("insert into Shohin (shohin_mei,price,shohin_img) value (?, ?, ?)");
    $sql->execute([$_POST['name'], $_POST['price'], $_POST['img']]);
}else if(isset($_POST['update'])){  //　更新ボタンが押された処理
    $sql=$pdo->prepare("update Shohin set shohin_mei=? ,price=? ,shohin_img=? where shohin_id=?");
    $sql->execute([$_POST['name'], $_POST['price'], $_POST['img'], $_POST['id']]);
}else if(isset($_POST['del'])){ //削除ボタンが押された処理
    $sql=$pdo->prepare("delete from Shohin where shohin_id=?");
    $sql->execute([$_POST['id']]);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品管理ページ</title>

</head>
<body>
    <p>商品管理</p>
    <?php

    $sql=$pdo->prepare("select Shohin.shohin_id,Shohin.shohin_img,Shohin.shohin_mei,Shohin.price
    from Shohin
    ");
    $sql->execute();
    ?>
    <table>
        <tr><th>商品名</th><th>金額</th><th>画像ファイル名</th><th>操作</th></tr>
        <tr>
            <form action="" method="post">
                <td><input type="text" name="name" require></td>
                <td><input type="number" name="price" require></td>
                <td><input type="text" name="img" require></td>
                <td><button type="submit" name="add">追加</button></td>
            </form>
        </tr>
        <?php
            foreach($sql as $row){
        ?>
        <tr>
            <form action="" method="post">
            <input type="hidden" name="id" value="<?= $row['shohin_id'] ?>">
            <td><input type="text" name="name" value="<?=  $row['shohin_mei'] ?>" require></td>
            <td><input type="number" name="price" value="<?=  $row['price'] ?>"require></td>
            <td><input type="text" name="img" value="<?= $row['shohin_img'] ?>" require></td>
            <td><button type="submit" name="update">更新</buttonbtton><button type="submit" name="del">削除</button></td>
            </form>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>