<?php session_start(); ?>
<!--完成-->

<?php require 'kyotu/db-connect.php'; ?>
<?php require 'kyotu/header.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$ps = password_hash($_POST['password'],PASSWORD_DEFAULT);
if(isset($_SESSION['toroku'])){
    $id=$_SESSION['toroku']['id'];
    $sql=$pdo->prepare('select * from User where id!=? and mail=?');
    $sql->execute([$id,$_POST['mail']]);
}else{          //メールが一緒のとき
    $sql=$pdo->prepare('select * from User where mail=?');
    $sql->execute([$_POST['mail']]);
}
$sql=$pdo->prepare('insert into User values(null,?,?,?,?,?,?,0)');
$sql->execute([
    $_POST['sei'],$_POST['mei'],$_POST['mail'],$ps,$_POST['postnum'],
    $_POST['address']
]);
?>

<script>
    window.location.href = 'torokucomp.php';
</script>
<?php require 'kyotu/footer.php'; ?>


