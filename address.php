<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'?>

<?php
   $id = $_SESSION['customer']['user_id'];
    if(isset($_POST['update'])){
        $name = $_POST['seiu'].$_POST['meiu'];
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare("update Delivery set del_name=?,del_address=?,del_psnum=?,koshinbi=? where user_id = '".$id."' and del_id= ?");
        $sql->execute([$name,$_POST['addressu'],$_POST['postnumu'],date("Y-m-d"),$_POST['postIdu']]);
        echo '<script>
        alert("配送先住所の内容を変更しました");
       </script>';
    }

    if(isset($_POST['inserts'])){
        $name = $_POST['seii'].$_POST['meii'];
        $id = $_SESSION['customer']['user_id'];
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare("insert into Delivery values(null,?,?,?,?,?,null,0)");
        $sql->execute([$id,$name,$_POST['addressi'],$_POST['postnumi'],date("Y-m-d")]);
        echo '<script>
        alert("配送先住所を追加しました");
       </script>';
    }

    if(isset($_POST['swicth'])){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare("update Delivery set destination =0 where user_id = '".$id."' and  destination =1");
        $sql->execute();

        $sql=$pdo->prepare("update Delivery set destination =1 where user_id = '".$id."' and del_id= ?");
        $sql->execute([$_POST['postIdu']]);
        echo '<script>
        alert("現在の配送先住所を変更しました");
       </script>';
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
<div class="m-6 has-text-centered is-family-code has-text-weight-semibold">
<p class="title is-3 "> 配送先住所の選択</p>
    
    <?php
  
    if(isset($_SESSION['customer'])){
        $boxcount=0;
    $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query("select del_id, del_address ,del_name, del_psnum from Delivery where user_id='".$id."' and destination=1");
    foreach($sql as $row){
        
        echo '<p class="title is-5">現在の配送先住所</p>';
        echo '<div class="box has-background-light m-5">';
        echo ' <label>お名前:</label>',$row['del_name'],'<br>';
        echo ' <label>郵便番号</label>',$row['del_psnum'],'<br>';
        echo '住所:',$row['del_address'] ,'<br>';
        echo '<div class="',$boxcount,'trigger">変更<i class="fas fa-angle-down"></i></div>
        <div class="',$boxcount,'box">
         <form action="address.php" method="post">
         <input type="hidden" name="postIdu" value="',$row['del_id'],'">
            <label>お名前</label>
                <p><input type="text" name="seiu">
                <input type="text" name="meiu"></p>
          
            <label>郵便番号</label>
                <p><input type="number" name="postnumu"></p>

                <label>住所</label>
                <p><input type="text" name="addressu"></p>

            <button name="update">変更</button>
        </form>
    </div>';
    echo '</div>';
    $boxcount++;
    }

    
}
      echo '<p class="title is-5">配送先住所一覧</p>';
      
if(isset($_SESSION['customer'])){
    $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
    $pdo=new PDO($connect,USER,PASS);
    $count=1;
    $sql=$pdo->query("select del_id,del_address ,del_name, del_psnum from Delivery where user_id='".$id."' and destination=0");
    foreach($sql as $row){
        echo '配送先住所',$count;
        $count++;
        echo '<div class="box has-background-light m-5">';
        echo ' <label>お名前:</label>',$row['del_name'],'<br>';
        echo '郵便番号:',$row['del_psnum'],'<br>';
        echo '住所:',$row['del_address'] ,'<br>';
        echo '<div class="',$boxcount,'trigger">変更<i class="fas fa-angle-down"></i></div>
                <div class="',$boxcount,'box">
                 <form action="address.php" method="post">
                 <input type="hidden" name="postIdu" value="',$row['del_id'],'">
                    <label>お名前</label>
                        <p><input type="text" name="seiu">
                        <input type="text" name="meiu"></p>
                  
                    <label>郵便番号</label>
                        <p><input type="number" name="postnumu"></p>

                        <label>住所</label>
                        <p><input type="text" name="addressu"></p>

                    <button name="update">変更</button>
                    <button name="swicth">この住所に届ける</button>
                </form>
            </div>';
        echo '</div>';
        $boxcount++;
    }
 //変更部分は見えないようにしておく

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

  
    

    <div class="F m-5">配送先住所を追加する<i class="fas fa-angle-down"></i></div>

<div class="G box has-background-light m-5">
 <form action="" method="post">
    <label>お名前</label>
        <p><input type="text" name="seii">
        <input type="text" name="meii"></p>
    <label>郵便番号</label>
        <p><input type="number" name="postnumi"></p>
    <label>住所</label>
        <p><input type="text" name="addressi"></p>
    <button type="submit" name="inserts">追加</button>
</form>
</div>

</div>


</div>
    <button onclick="location.href='purchase.php'">前のページに戻る</button>
</div>
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