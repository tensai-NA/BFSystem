<div class="kensaku">
   <div class=" box has-background-light m-5">
      <h5 class="title is-5">検索</h5>

      <div class="control m-1">

         <div class="field has-addons-fullwidth has-addons-centered">
            <p class="control has-icons-left m-6">
               <input class="input is-success  is-normal is-focused " type="text" name="shohin_mei" placeholder="商品名">
               <span class="icon is-small is-left">
                  <i class="fas fa-shopping-bag"></i>
               </span>
            </p>
         </div>
         <div class="B m-1  has-text-left"> 絞り込み <i class="fas fa-angle-down"></i></div>
         <div class="shibori has-text-left ml-6 mt-2">

            <div class="C m-1  has-text-left"> カテゴリー <i class="fas fa-angle-down"></i></div>
            <div class="C-main m-5">
               <p class="is-size-5 m-1"><label><input id="checkAllcate" type="checkbox" />全てのカテゴリー</label></p><!--押すとすべて選択に-->
               <?php
               $pdo = new PDO($connect, USER, PASS);
               $sql = $pdo->prepare('select  * from Categori');
               $sql->execute();
               foreach ($sql as $row) {
                  echo '<label class="mr-3"><input type="checkbox" class="checkscate" name="cate[]" value="', $row['cate_code'], '" />', $row['cate_mei'], '</label>';
               }
               ?>
            </div>

            <div class="D m-1  has-text-left"> ブランド <i class="fas fa-angle-down"></i></div>
            <div class="D-main m-5">
               <p class="is-size-5 m-1"><label><input id="checkAll1" type="checkbox" />全てのブランド</label></p><!--押すとすべて選択に-->
               <?php
               $pdo = new PDO($connect, USER, PASS);
               $sql = $pdo->prepare('select  * from Brand');
               $sql->execute();
               foreach ($sql as $row) {
                  echo '<label class="mr-3"><input type="checkbox" class="brand" name="brand[]" value="', $row['brand_code'], '" />', $row['brand_mei'], '</label>';
               }
               ?>
            </div>

            <div class="E m-1  has-text-left"> カラー <i class="fas fa-angle-down"></i></div>
            <div class="E-main m-5">

               <p class="is-size-5 m-1"><label><input id="checkAll2" type="checkbox" name="color[]" value="all" />全てのカラー</label></p><!--押すとすべて選択に-->
               <?php
               $sql = $pdo->prepare('select  * from Color');
               $sql->execute();
               $count = 0;
               foreach ($sql as $row) {
                  echo '<label class="mr-3"><input type="checkbox" class="color" name="color[]" value="', $row['color_code'], '" />', $row['color_mei'], '</label>';
                  $count++;
               }
               ?>
            </div>

            <div class="F m-1  has-text-left"> 金額 <i class="fas fa-angle-down"></i></div>
            <div class="F-main m-5">
               <p class="is-size-5 m-1"><label class="mr-3"><input id="checkAll3" type="checkbox" name="price[]" value="0" />全ての価格<label></p>
               <?php
               $sql = "SELECT MAX(price) AS `max` FROM Shohin";
               $stmt = $pdo->query($sql);
               $prices = array(
                  0 => 1500,
                  1500 => 5000,
                  5000 => 10000,
                  10000 => 30000,
               );
               foreach ($prices as $key => $value) {
                  echo '<label class="mr-3"><input type="checkbox" class="price" name="price[]" value=', $key, ' />', $key, '～', $value, '円</label>';
               }
               ?>
               <label class="mr-3"><input type="checkbox" class="price" name="price[]" value="8" />30000円～</label>
            </div>
         </div>
         <div class="seach m-5 ">
            <button type="submit" class="button is-info is-outlined is-normal is-rounded">検索</button>
            </form>
         </div>
      </div>
   </div>
</div>

</div>


<script src="js/searchbox.js"></script>y