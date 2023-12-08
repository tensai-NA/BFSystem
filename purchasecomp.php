<?php session_start(); ?>
<?php require 'kyotu/db-connect.php' ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>購入完了画面</title>
</head>

<body>
    <div class="m-6 has-text-centered is-family-code has-text-weight-semibold">
        <p class="mb-4">
        <p><span class="is-size-4">ご注文ありがとうございました！</span></p>
        <p class="my-6">
        <p><span class="is-size-6">ご注文内容</span></p>
        <p><span class="is-size-7">

                <?php
                $repeat = 0;
                $total = 0;
                $point = 0;
                if (isset($_SESSION['customer'])) {  //ログイン済みの処理
                    $sho = '';
                    $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
                    $pdo = new PDO($connect, USER, PASS);
                    $sql = $pdo->query("select Shohin.shohin_mei,Shohin.price,Color.color_mei,Cart.num,Cart.shohin_id
                    from Shohin,Cart,Color
                    where Shohin.shohin_id = Cart.shohin_id
                    and Shohin.color = Color.color_code
                    and Cart.user_id = '" . $id . "'");
                    foreach ($sql as $row) {

                        echo '<div class="columns  is-mobile  is-centered"> ';
                        echo '<div class="column is-7"> ';
                        echo '<div class="box  has-text-centered ">';
                        echo '<p class="is-size-5">', $row['shohin_mei'], '</p>';
                        echo 'カラー：', $row['color_mei'], '<br>';
                        echo '価格：￥', $row['price'], '<br>';
                        $total = $row['num'] * $row['price'];

                        echo '小計：￥', $total, '<br></div></div></div>';
                        //Historyに追加


                        $his = $pdo->prepare("select shohin_id from History
                where user_id = ?
                and shohin_id = ?");
                        $his->execute([$id, $row['shohin_id']]);
                        if (isset($his)) {
                            $repeat += $total * 0.1;
                        }
                    }
                    // echo '<hr>';
                    // echo '</span></p>';
                    // echo '<p><span class="is-size-7">';
                    echo 'リピート割　-￥', $repeat, '<br>';

                    if (isset($_SESSION['customer'])) {  //ログイン済みの処理
                        $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
                        $pdo = new PDO($connect, USER, PASS);
                        $sql = $pdo->query("select num from Cart where user_id = '" . $id . "'");
                        $suryo = $sql->fetchAll();
                        $kei = 0;
                        foreach ($suryo as $s) {
                            $kei = $s['num'] + $kei;
                        }
                        echo '商品点数', $kei, '点<br>'; //数量をDBから抽出
                        echo '送料￥350<br>';
                        echo '<hr>';
                        echo '</span></p>';
                        echo '<p><span class="is-size-6">';
                        $total = 0;
                        $point = 0;
                        if (isset($_SESSION['customer'])) {  //ログイン済みの処理
                            $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
                            $pdo = new PDO($connect, USER, PASS);
                            $sql = $pdo->query("select num,price from Cart,Shohin where Cart.shohin_id = Shohin.shohin_id and user_id = '" . $id . "' and flag=0");
                            foreach ($sql as $row) {
                                $total += $row['num'] * $row['price'];
                            }
                        }
                        $id = $_SESSION['customer']['user_id']; //セッションに入っているIDを取得
                        $total = (350 + $total) - $repeat;
                        $point = floor($total / 100);
                        $use_point = $_POST['use'];
                        $point = $point - $use_point;

                        echo '代金合計￥', $total, '<br>'; //合計を求めてリピート割分を引く
                        echo '</p>';
                        echo '</p>';
                        echo '<hr>';
                        echo '<p>';
                        echo 'ご注文合計￥', $total, '<br>';
                        echo '獲得予定ポイント', $point, 'pt<br>';
                        echo '</p>';

                        $fuyo = $pdo->prepare("update User set point = point + ? where user_id = ?");
                        $fuyo->execute([$point, $id]);
                    }
                    $zikan = ['指定しない', '午前10時-午後12時', '午後2時-午後4時', '午後6時-午後8時'];
                    $pay = ['クレジット', '現金', '銀行振込', '後払い'];
                    $zi = $_POST['time'];
                    $siharai = $_POST['kessai'];
                    $houhou = $pay[$siharai];
                    $kiboutime = $zikan[$zi];
                    $id = $_SESSION['customer']['user_id'];
                    $today = date("Y-m-d");
                    $del = $pdo->prepare("select del_id from Delivery where user_id = ?");
                    $del->execute([$id]);
                    $deli = $del->fetch();

                    $sql = $pdo->prepare("insert into OrderA values (null,?,?,?,?,?,?,?,?,?)");
                    $sql->execute([$id, $deli['del_id'], $total, $point, $today, $_POST['day'], $kiboutime, $_POST['use'], $houhou]);

                    $del1 = $pdo->prepare("select max(order_id) as order_idans from OrderA where user_id = ?");
                    $del1->execute([$id]);
                    $deli1 = $del1->fetch();

                    $sql = $pdo->query("select Shohin.price,Cart.num,Cart.shohin_id
                    from Shohin,Cart,Color
                    where Shohin.shohin_id = Cart.shohin_id
                    and Shohin.color = Color.color_code
                    and Cart.user_id = '" . $id . "'");
                    
                    foreach ($sql as $row) {
                        $sql = $pdo->prepare("insert into History values(null,?,?,?,?,?)");
                        $pdo = new PDO($connect, USER, PASS);
                        $sql->execute([$id, $deli1['order_idans'], $row['shohin_id'], $row['num'], $row['price']]);
                    }
                }
                //カートから商品を削除する
                $id = $_SESSION['customer']['user_id'];
                $delete = new PDO($connect, USER, PASS);
                $dele = $delete->prepare("delete from Cart where user_id = ?");
                $dele->execute([$id]);
                ?>
            </span></p>
        </p>
        <p class="my-6">
            <button onclick="location.href='home.php'" class="button  is-black m-4">ホームへ戻る</button>
        </p>
        </p>
    </div>
</body>

</html>