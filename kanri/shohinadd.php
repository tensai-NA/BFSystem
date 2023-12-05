<?php session_start(); ?>
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
    <h1 class="title is-4">商品管理</h1>
    <?php
    if(!isset($_SESSION['kanri'])){
        echo 'このページを参照するにはログインしてください';
        echo '<a href="login.php">ログインはこちら</a>';
    }

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
                <td><button type="submit" class="button is-small is-success is-light is-outlined" name="add">追加</button></td>
            </form>
            </div>
        </tr>
        <?php
            foreach($sql as $row){
        ?>
        <tr>
        <div class="field">
            <form action="" method="post">
            <input type="hidden" name="id" class="input is-small" value="<?= $row['shohin_id'] ?>">
            <td><input type="text" name="name" class="input is-small" value="<?=  $row['shohin_mei'] ?>" require></td>
            <td><input type="number" name="price" min=0 class="input is-small" value="<?=  $row['price'] ?>" require></td>
            <td><input type="number" name="color"  min=1 max=13 class="input is-small" value="<?=  $row['color'] ?>" require></td>
            <td><input type="number" name="brand" min=1 max=11 class="input is-small" value="<?=  $row['brand'] ?>" require></td>
            <td><input type="number" name="cate" min=1 max=10 class="input is-small" value="<?=  $row['category'] ?>" require></td>
            <td><input type="text" name="img" class="input is-small" value="<?= $row['shohin_img'] ?>" require></td>
            <td><button type="submit" class="button is-small is-link is-light is-outlined" name="update">更新</button>
                <button type="submit" class="button is-small is-danger is-light is-outlined" name="del">削除</button></td>
            </form>
        </div>
        </tr>
   
        <?php
            }
            echo ' </table>';
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
echo '<div class="columns">';
//カラー
echo '<div class="dropdown is-hoverable">';
    echo '<div class="column">';
        echo '<div class="dropdown-trigger">
            <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">';
            echo '<span>カラー</span>
            <span class="icon is-small">
                <i class="fas fa-angle-down" aria-hidden="true"></i>
            </span>
            </button>';
        echo '</div>';
    echo '<div class="dropdown-menu" role="menu">';
    echo '<div class="dropdown-content">';
        echo '<table>';
        $color=$pdo->query("select * from Color");
        foreach($color as $row){
            echo '<div class="dropdown-item">';
                echo $row['color_code'],"：";
                echo $row['color_mei'];
            echo '</div>';
        }
        echo '</table>';
    echo '</div>'; //content
    echo '</div>'; //menu
    echo '</div>'; // columns
echo '</div>'; //dropdown

//ブランド
echo '<div class="dropdown is-hoverable">';
    echo '<div class="column">';
        echo '<div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">';
            echo '<span>ブランド</span>
            <span class="icon is-small">
                <i class="fas fa-angle-down" aria-hidden="true"></i>
            </span>
        </button>';
        echo '</div>';
    echo '<div class="dropdown-menu" role="menu">';
    echo '<div class="dropdown-content">';    
        $brand=$pdo->query("select * from Brand");
        foreach($brand as $row){
            echo '<div class="dropdown-item">';
                echo $row['brand_code'],"：";
                echo $row['brand_mei'];
            echo '</div>';
        }
    echo '</div>'; //content
    echo '</div>'; //menu
    echo '</div>'; // columns
echo '</div>'; //dropdown
//カテゴリ
echo '<div class="dropdown is-hoverable">';
    echo '<div class="column">';
    echo '<div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">';
        echo '<span>カテゴリ</span>
            <span class="icon is-small">
                <i class="fas fa-angle-down" aria-hidden="true"></i>
            </span>
        </button>';
    echo '</div>';
    echo '<div class="dropdown-menu" role="menu">';
    echo '<div class="dropdown-content">';
        $cate=$pdo->query("select * from Categori");
            foreach($cate as $row){
                echo '<div class="dropdown-item">';
                echo $row['cate_code'],"：";
                echo $row['cate_mei'];
                echo '</div>';
            }
    echo '</div>';
    echo '</div>';
echo '</div>'; //columns
echo '</div>'; //dropdown
?>
</body>
</html>