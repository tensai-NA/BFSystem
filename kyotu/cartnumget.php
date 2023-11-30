if(isset($_SESSION['customer'])){   
    //カートの数量取得 
    $user=$_SESSION['customer']['user_id'];
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare("select * from Cart where user_id = ?");
    $sql->execute([$user]);
    $count=$sql-> rowCount();

}



        