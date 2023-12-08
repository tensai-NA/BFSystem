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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/address.css">
    <title>住所変更</title>
</head>
<body>
<div class="m-6 has-text-centered is-family-code has-text-weight-semibold">
    <nav class="level  is-mobile mt-6 mx-3">
        <div class="level-left ml-2">
            
            <?php
              $link=$_SERVER['HTTP_REFERER'] ;

            echo ' <a href="',$link,'" "><i class="fas fa-long-arrow-alt-left fa-2x" ></i></a>';
                        ?>
        </div>
        <div class="level-item">
                <p class="title is-4 "> 配送先住所の選択</p>
        </div>
        <div class="level-right ml-3">
        </div>
    </nav>
    <?php
    if(isset($_SESSION['customer'])){
        $boxcount=0;
    $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query("select del_id, del_address ,del_name, del_psnum from Delivery where user_id='".$id."' and destination=1");
    foreach($sql as $row){
        
        echo '<p class="title is-5">現在の配送先住所</p><hr>';
        echo '<div class="columns  is-mobile  is-centered"> ';
        echo '<div class="column is-10"> ';
        echo '<div class="box  has-text-centered has-background-white-ter">';
        echo ' <label>お名前:</label>',$row['del_name'],'<br>';
        echo ' <label>郵便番号:</label>',$row['del_psnum'],'<br>';
        echo '住所:',$row['del_address'] ,'<br>';
        echo '<input type="checkbox" id="F">';
        echo '<label class="F" for="F">変更</label><i class="fas fa-angle-down"></i>
         <form action="address.php" method="post">
         <input type="hidden" name="postIdu" value="',$row['del_id'],'">';
      
         echo '<div class="G">';
         echo '<div class="columns  is-mobile  is-centered"> ';
         echo '<div class="column is-10"> ';
         echo '<div class="box  has-text-centered has-background-white-bis">';
        echo   '<label>お名前</label>
                <p><input type="text" name="seiu">
                <input type="text" name="meiu"></p>
          
            <label>郵便番号</label>
                <p><input type="text" name="postnumu"></p>

                <label>住所</label>
                <p><input type="text" name="addressu"></p>

            <button name="update" class="button is-small is-black m-2">変更</button>
        </form>
    </div></div></div></div>';
    echo '</div></div></div>';
    $boxcount++;
    }
}
      echo '<p class="title is-5">配送先住所一覧</p><hr>';
      
if(isset($_SESSION['customer'])){
    $id = $_SESSION['customer']['user_id']; //ログイン済みの処理
    $pdo=new PDO($connect,USER,PASS);
    $count=1;
    $sql=$pdo->query("select del_id,del_address ,del_name, del_psnum from Delivery where user_id='".$id."' and destination=0");
    foreach($sql as $row){
        echo '<p class=" has-text-left is-size-5 mb-3">配送先住所',$count,'</p>';
        $count++;
        echo '<div class="columns  is-mobile  is-centered"> ';
        echo '<div class="column is-10"> ';
        echo '<div class="box  has-text-centered has-background-white-ter">';
        echo ' <label>お名前:</label>',$row['del_name'],'<br>';
        echo '郵便番号:',$row['del_psnum'],'<br>';
        echo '住所:',$row['del_address'] ,'<br>';
        echo '<input type="checkbox" id="ch">';
        echo '<label class="ch" for="ch">変更</label><i class="fas fa-angle-down"></i>
                
            <div class="op">
                 <form action="address.php" method="post">
                 <input type="hidden" name="postIdu" value="',$row['del_id'],'">';
              echo '<div class="columns  is-mobile  is-centered"> ';
                 echo '<div class="column is-10"> ';
                 echo '<div class="box  has-text-centered has-background-white-bis">';
                  echo  ' <label>お名前</label>
                        <p><input type="text" name="seiu">
                        <input type="text" name="meiu"></p>
                  
                    <label>郵便番号</label>
                        <p><input type="text" name="postnumu"></p>

                        <label>住所</label>
                        <p><input type="text" name="addressu"></p>

                    <button name="update" class="button is-small is-black m-2">変更</button>
                </form>
            </div></div></div></div>';
        echo '</div><button name="swicth" class="button  is-small is-dark is-black m-2">この住所に届ける</button></div></div>';
        $boxcount++;
    }
 //変更部分は見えないようにしておく

    
}
    ?>
    <script src="https://code.jquery.com/jquery.min.js"></script>

  
    

    <div class="F mb-5 "><p class="is-size-5">配送先住所を追加する<i class="fas fa-angle-down"></i></p></div>

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
