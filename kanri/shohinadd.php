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
    $per_page = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1; // 現在のページ番号
    $start_index = ($page - 1) * $per_page;

    $sql=$pdo->query("select * from Shohin");    
    $total_results = $sql->rowCount(); //総データ数
    $total_pages = ceil($total_results / $per_page);

    $sql = $pdo->prepare("SELECT * FROM Shohin LIMIT :start_index, :per_page");
    $sql->bindValue(':start_index', $start_index, PDO::PARAM_INT);
    $sql->bindValue(':per_page', $per_page, PDO::PARAM_INT);
    $sql->execute();
    ?>
    <table>
        <tr><th>商品名</th><th>金額</th><th>色</th><th>ブランド</th><th>カテゴリ</th><th>画像ファイル名</th><th>操作</th></tr>
        <tr>
            <div class="field">
            <form action="" method="post">
                <td><input type="text" class="input is-small" name="name" require></td> <!--商品名-->
                <td><input type="number" class="input is-small" name="price" require></td> <!--金額-->
                <td><input type="number" class="input is-small" name="color" require></td> <!--色-->
                <td><input type="number" class="input is-small" name="brand" require></td> <!--ブランド-->                
                <td><input type="number" class="input is-small" name="cate" require></td> <!--カテゴリ-->
                <td><input type="text" class="input is-small" name="img" require></td> <!--画像-->
                <td><button type="submit" name="add">追加</button></td>
            </form>
            </div>
        </tr>
        <?php
            foreach($sql as $row){
        ?>
        <tr>
        <div class="field">
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
        </div>
        </tr>
    </table>
        <?php
            }
            echo '<nav class="pagination" role="navigation" aria-label="pagination">
            <ul class="pagination-list">';
    
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        echo "<li><a class='pagination-link is-current'>$i</a></li>";
                    } else {
                        echo "<li><a class='pagination-link' href='?page=$i'>$i</a><li>";
                    }
                }
            ?>
        </ul>
    </nav>
    
            <?php
                    echo '<p>カラー</p>';
                    echo '<table>';
                    $color=$pdo->query("select * from Color");
                    foreach($color as $row){
                        echo '<tr>';
                        echo '<td>',$row['color_code'],'</td>';
                        echo '<td>',$row['color_mei'],'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';

                    echo '<p>ブランド</p>';
                    echo '<table>';
                    $brand=$pdo->query("select * from Brand");
                    foreach($brand as $row){
                        echo '<tr>';
                        echo '<td>',$row['brand_code'],'</td>';
                        echo '<td>',$row['brand_mei'],'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';

                    echo '<p>カテゴリー</p>';
                    echo '<table>';
                    $cate=$pdo->query("select * from Categori");
                    foreach($cate as $row){
                        echo '<tr>';
                        echo '<td>',$row['cate_code'],'</td>';
                        echo '<td>',$row['cate_mei'],'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';

        ?>
</body>
</html>