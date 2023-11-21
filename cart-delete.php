<?php require 'kyotu/db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql = $pdo ->prepare('delete from Cart where shohin_id=?');
$sql->execute([$_GET['id']]);
header('location: cart.php');
?>