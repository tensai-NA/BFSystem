<?php require '../kyotu/db-connect.php'?>
<?php
$pdo=new PDO($connect,USER,PASS);
if(isset($_POST['add'])){   // 追加ボタンが押された処理
    $sql=$pdo->prepare("insert into Shohin value (null,?,?,?,?,?,null,?)");
    $sql->execute([$_POST['name'], $_POST['price'],$_POST['color'],$_POST['brand'],$_POST['cate'],$_POST['img']]);

}else if(isset($_POST['update'])){  //　更新ボタンが押された処理
    $sql=$pdo->prepare("update Shohin set shohin_mei=?,price=?,color=?,brand=?,category=?,shohin_img=? where shohin_id=?");
    $sql->execute([$_POST['name'], $_POST['price'],$_POST['color'],$_POST['brand'],$_POST['cate'],$_POST['img'],$_POST['id']]);
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>商品管理ページ</title>

</head>
<body>
    <p>商品管理</p>
    <?php
    $sql=$pdo->prepare("select * from Shohin");
    $sql->execute();
    ?>
    <table>
        <tr><th>商品名</th><th>金額</th><th>色</th><th>ブランド</th><th>カテゴリ</th><th>画像ファイル名</th><th>操作</th></tr>
        <tr>
            <form action="" method="post">
                <td><input type="text" name="name" require></td> <!--商品名-->
                <td><input type="number" name="price" require></td> <!--金額-->
                <td><input type="text" name="color" require></td> <!--色-->
                <td><input type="text" name="brand" require></td> <!--ブランド-->                
                <td><input type="text" name="cate" require></td> <!--カテゴリ-->
                <td><input type="text" name="img" require></td> <!--画像-->
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
            <td><input type="number" name="price" value="<?=  $row['price'] ?>" require></td>
            <td><input type="number" name="color" value="<?=  $row['color'] ?>" require></td>
            <td><input type="number" name="brand" value="<?=  $row['brand'] ?>" require></td>
            <td><input type="number" name="cate" value="<?=  $row['category'] ?>" require></td>
            <td><input type="text" name="img" value="<?= $row['shohin_img'] ?>" require></td>
            <td><button type="submit" name="update">更新</button>
                <button type="submit" name="del">削除</button></td>
            </form>
        </tr>
    </table>


        <?php
            }

            echo '<div class="columns">';
                echo '<div class="column">';
                    echo '<p>カラー</p>';
                    echo '<table>';
                    $sql=$pdo->query("select * from Color");
                    foreach($sql as $row){
                        echo '<tr>';
                        echo '<td>',$row['color_code'],'</td>';
                        echo '<td>',$row['color_mei'],'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                echo '</div>';

                echo '<div class="column">';
                    echo '<p>ブランド</p>';
                    echo '<table>';
                    $sql=$pdo->query("select * from Brand");
                    foreach($sql as $row){
                        echo '<tr>';
                        echo '<td>',$row['brand_code'],'</td>';
                        echo '<td>',$row['brand_mei'],'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                echo '</div>';

                echo '<div class="column">';
                    echo '<p>カテゴリー</p>';
                    echo '<table>';
                    $sql=$pdo->query("select * from Categori");
                    foreach($sql as $row){
                        echo '<tr>';
                        echo '<td>',$row['cate_code'],'</td>';
                        echo '<td>',$row['cate_mei'],'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                echo '</div>';
            echo '</div>';

        ?>
    </table>
</body>
</html>