<?php require 'kyotu/db-connect.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="css/search.css">

  <title>Document</title>
</head>

<body>
  <form action="search.php" method="post">
    <div class="m-3 has-text-centered is-family-code has-text-weight-semibold">

      <nav class="level  is-mobile mt-6 mx-3">

        <div class="level-left">

          <script src="https://code.jquery.com/jquery.min.js"></script>
          <div class="columns ">
            <div class="column is-full">
              <div class="A box m-3 has-background-white-ter ">
                <i class="fas fa-search fa-xs"></i>　search
              </div>
            </div>
          </div>
        </div>

        <div class="level-right">
          <a href="home.php"><i class="fas fa-home is-6 fa-2x"></i> </a>
        </div>
      </nav>
      <?php require 'kyotu/searchbox.php' ?>
      <hr>
      <!--以下　検索結果表示-->
      <?php
      $pdo = new PDO($connect, USER, PASS);
      $cate = "";/*それぞれの項目のsql文を格納 */
      $brand = "";
      $color = "";
      $price = "";
      $flag1 = false;/*price～colorまで１つでもあるかどうか*/
      $flag2 = false/*cate～colorまで１つでもあるかどうか*/;
      $flagprice = false;
      $sql_search = "select * from Shohin where  (shohin_mei like ?)";
      $pricef = false;/*それぞれの項目で$sql_searchに入るのが最初か判断 */
      $catef = false;
      $brandf = false;
      $colorf = false;
      if (isset($_POST['shohin_mei'])) {
        $arr[] = "%" . $_POST['shohin_mei'] . "%";
      }
      $prices =
        array(
          0 => 1500,
          1500 => 5000,
          5000 => 10000,
          10000 => 30000

        );
      if (isset($_POST['price'])) {
        $sql_search = $sql_search . " AND (";

        foreach ($_POST['price'] as $pr) {
          if (!$pricef) {
            $pricef = true;
            if ($pr == 8) {
              $sql_search =  $sql_search . " price >= ?";
              $arr[]  = 30000;
            } else {
              $sql_search =  $sql_search . " price between ? and  ? ";
              $arr[]  = $pr;
              $arr[]  = $prices[$pr];
            }
          } else {
            if ($pr == 8) {
              $sql_search =  $sql_search . " AND price >= ?";
              $arr[]  = 30000;
            } else {
              $sql_search =  $sql_search . " AND price between ? and  ? ";
              $arr[]  = $pr;
              $arr[]  = $prices[$pr];
            }
          }
        }
        $sql_search = $sql_search . ") ";
        $flag1 = true;
        $flagprice = true;
      }

      if (isset($_POST['cate'])) {

        $sql_search = $sql_search . " AND ";
        $flag1 = true;
        $flag2 = true;
        foreach ($_POST['cate'] as $ca) {
          if (!$catef) {
            $catef = true;
            $sql_search =  $sql_search . "  category = ?";
            $arr[] = $ca;
          } else {
            $sql_search =  $sql_search . " or category = ?";
            $arr[] = $ca;
          }
        }
      }
      if (isset($_POST['brand'])) {
        if (!$flag2 || !$flag1) {
          $sql_search = $sql_search . " AND ";
        } else if ($flag2) {
          $sql_search = $sql_search . " OR ";
        } else {
        }
        $flag1 = true;
        $flag2 = true;
        foreach ($_POST['brand'] as $br) {
          if (!$brandf) {
            $brandf = true;
            $sql_search =  $sql_search . "  brand = ?";
            $arr[] = $br;
          } else {
            $sql_search =  $sql_search . " or brand = ?";
            $arr[] = $br;
          }
        }
      }
      if (isset($_POST['color'])) {
        if (!$flag2 || !$flag1) {
          $sql_search = $sql_search . " AND ";
        } else if ($flag2) {
          $sql_search = $sql_search . " OR ";
        } else {
        }
        $flag1 = true;
        $flag2 = true;
        foreach ($_POST['color'] as $co) {
          if (!$colorf) {
            $colorf = true;
            $sql_search =  $sql_search . " color = ?";
            $arr[] = $co;
          } else {
            $sql_search =  $sql_search . " or color = ?";
            $arr[] = $co;
          }
        }
      }
      if (isset($_POST['shohin_mei'])) {
        // echo $sql_search,'<br>';
        // echo var_dump($arr),'<br>'; テスト用
        $sql = $pdo->prepare($sql_search);
        $sql->execute($arr);
      } else {
        echo '<p class="is-size-7 has-text-right m-5">全件表示</p>';
        $sql = $pdo->query("select * from Shohin");
      }
      if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      $count = $sql->rowCount();
      if ($count == 0) {
        echo '<p class="m-4 has-text-centered ">検索に一致する商品がありません';
      } else {
        echo '<div class="columns  is-multiline">';
        foreach ($sql as $row) {
          $id = $row['shohin_id'];
          echo '<div class="column  is-2 is-one-quarter">
                  <div class="card">
                    <div class="card-image">';
          echo '<figure class="image is-square">';
          echo '<a href="detail.php?id=', $id, '"><p class="m-1"><img src="', $row['shohin_img'], '" alt="', $row['shohin_mei'], '"></p></figure></div>';
          echo ' <div class="card-content"> <div class="content">';
          echo '<p class="has-text-centered	is-size-7"><a href="detail.php?id=', $id, '">', $row['shohin_mei'], '</a></p><hr>';
          echo '<p class="has-text-centered	is-size-7">', $row['price'], '円 </p>';
          echo '</div></div></div></div>';
        }
        echo '</div>';
      }
      ?>
  </form>
</body>
</html>