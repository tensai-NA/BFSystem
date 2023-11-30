<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>

<?php
    if(isset($_POST['update'])){
        $name = $_POST['sei'].$_POST['mei'];
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare("update Delivery set del_name=?,del_address=?,del_psnum=?,koshinbi=? where user_id = '".$id."'");
        $sql->execute([$name,$_POST['address'],$_POST['postnum'],date("Y-m-d")]);
        echo '変更しました。';
    }

  
    ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>住所変更</title>
</head>
<body>
    <p class="title is-4">配送先住所の選択</p>
    
    <?php
  
    if(isset($_SESSION['customer'])){
        $boxcount=0;
    $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query("select del_address , del_psnum from Delivery where user_id='".$id."' and destination=1");
    foreach($sql as $row){
        
        echo '現在の配送先住所';
        echo '<div class="box has-background-light m-5">';
        echo ' <label>郵便番号</label>',$row['del_psnum'],'<br>';
        echo '住所:',$row['del_address'] ,'<br>';
        echo '<div class="',$boxcount,'trigger">変更<i class="fas fa-angle-down"></i></div>
        <div class="',$boxcount,'box">
         <form action="address.php" method="post">
            <label>お名前</label>
                <p><input type="text" name="sei">
                <input type="text" name="mei"></p>
            <label>住所</label>
                <p><input type="text" name="address"></p>
            <label>郵便番号</label>
                <p><input type="number" name="postnum"></p>
            <button name="update">変更</button>
        </form>
    </div>';
    echo '</div>';
    $boxcount++;
    }

    
}
      
      
if(isset($_SESSION['customer'])){
    $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
    $pdo=new PDO($connect,USER,PASS);
    $count=1;
    $sql=$pdo->query("select del_address , del_psnum from Delivery where user_id='".$id."' and destination=0");
    foreach($sql as $row){
        echo '配送先住所',$count;
        $count++;
        echo '<div class="box has-background-light m-5">';
        echo '郵便番号:',$row['del_psnum'],'<br>';
        echo '住所:',$row['del_address'] ,'<br>';
        echo '<div class="',$boxcount,'trigger">変更<i class="fas fa-angle-down"></i></div>
                <div class="',$boxcount,'box">
                 <form action="address.php" method="post">
                    <label>お名前</label>
                        <p><input type="text" name="sei">
                        <input type="text" name="mei"></p>
                    <label>住所</label>
                        <p><input type="text" name="address"></p>
                    <label>郵便番号</label>
                        <p><input type="number" name="postnum"></p>
                    <button name="update">変更</button>
                </form>
            </div>';
        echo '</div>';
        $boxcount++;
    }
 

    for($a=0;$a<$boxcount;$a++){
       echo  '<script>
                    $(function() {
                        $(".',$a,'trigger").click(function() {
                            $(".',$a,'box").slideToggle("");
                        });
                    });
            </script>

            <style>
                    .',$a,'box,{
                        display: none;
                    }
             </style>';
    
}
}


    ?>
    <script src="https://code.jquery.com/jquery.min.js"></script>

  
    

    <div class="F">配送先住所を追加する</div>

<div class="G box has-background-light m-5">
 <form action="" method="post">
    <label>お名前</label>
        <p><input type="text" name="sei">
        <input type="text" name="mei"></p>
    <label>郵便番号</label>
        <p><input type="number" name="postnum"></p>
    <label>住所</label>
        <p><input type="text" name="address"></p>
    <button type="submit" name="inserts">追加</button>
</form>
</div>

</div>


</div>
    <button onclick="location.href='purchase.php'">前のページに戻る</button>

</body>
</html>



    <script>
    $(function() {
        $(".F").click(function() {
            $(".G").slideToggle("");
        });
    });
        </script>
    <style>

        .G{
            display: none;
        }
    </style>