<?php session_start(); ?>
<?php require 'kyotu/db-connect.php'; ?>
<?php require 'kyotu/header.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$ps = password_hash($_POST['password'],PASSWORD_DEFAULT);

// if(isset($_SESSION['customer'])){
//     $id=$_SESSION['customer']['user_id'];
//     $sql=$pdo->prepare('select * from User where id!=? and mail=?');
//     $sql->execute([$id,$_POST['mail']]);
//     echo '<p>すでにメールアドレスが登録されています</p>';
//     echo '<a href="toroku.php">登録画面へ戻る</a>';
//     exit();
// }else{          //メールが一緒のとき
//     $sql=$pdo->prepare('select * from User where mail=?');
//     $sql->execute([$_POST['mail']]);
//     echo '<p>すでにメールアドレスが登録されています</p>';
//     echo '<a href="toroku.php">登録画面へ戻る</a>';
//     exit();
// }

$sql=$pdo->prepare('insert into User values(null,?,?,?,?,?,?,0)');
$sql->execute([
    $_POST['sei'],$_POST['mei'],$_POST['mail'],$ps,$_POST['postnum'],
    $_POST['address']
]);
$sql=$pdo->prepare('select * from User where mail=?');
$sql->execute([$_POST['mail']]);
    foreach($sql as $row){
        $_SESSION['customer']=[
            'user_id'=>$row['user_id'],
            'user_sei'=>$row['user_sei'],
            'user_mei'=>$row['user_mei'],
            'mail'=>$row['mail'],
            'password'=>$row['password'],
            'postnum'=>$row['postnum'],
            'point'=>$row['point'],
            'address'=>$row['address'],
            'password'=>$row['password']
        ];
    }
$id=$_SESSION['customer']['user_id'];
$name = $_POST['sei'].$_POST['mei'];
$sql=$pdo->prepare('insert into Delivery values(null,?,?,?,?,?,null)');
$sql->execute([
    $id,$name,$_POST['address'],$_POST['postnum'],date('Y-m-d')
]);
?>

<script>
    window.location.href = 'torokucomp.php';
</script>
<?php require 'kyotu/footer.php'; ?>


