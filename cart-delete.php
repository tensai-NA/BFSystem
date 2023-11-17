<?php
$pdo=new PDO($connect,USER,PASS);
$sql = $pdo ->prepare('delete from Cart where id=?');
?>