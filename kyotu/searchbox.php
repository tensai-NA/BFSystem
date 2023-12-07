<div class="kensaku">
   <div class=" box has-background-light m-5">
      <h5 class="title is-4">検索</h5>

      <div class="control m-1">

         <div class="field has-addons-fullwidth has-addons-centered">
         
               <input class="input is-success  is-medium is-focused m-3" type="text" name="shohin_mei" placeholder="👝 商品名" style="width: 700px;" >
               
         </div>
         <div class="B ml-5 mx-4 has-text-left is-size-5"> 絞り込み <i class="fas fa-angle-down"></i></div>
         <div class="shibori has-text-left ml-5 mt-2">

            <div class="C mx-2  has-text-left has-text-primary is-size-5"> カテゴリー <i class="fas fa-angle-down"></i></div>
            <div class="C-main m-5">
               <p class="is-size-5 m-1"><label><input id="checkAllcate" onchange="Cateall(this)" type="checkbox" />全てのカテゴリー</label></p><!--押すとすべて選択に-->
               <?php
               $pdo = new PDO($connect, USER, PASS);
               $sql = $pdo->prepare('select  * from Categori');
               $sql->execute();
               foreach ($sql as $row) {
                  echo '<label class="mr-3"><input type="checkbox" id="cate" class="checkscate" name="cate[]" value="', $row['cate_code'], '" />', $row['cate_mei'], '</label>';
               }
               ?>
            </div>

            <div class="D m-1  has-text-left has-text-link is-size-5"> ブランド <i class="fas fa-angle-down"></i></div>
            <div class="D-main m-5">
               <p class="is-size-5 m-1 "><label><input id="checkAll1" onchange="Brandall(this)" type="checkbox" />全てのブランド</label></p><!--押すとすべて選択に-->
               <?php
               $pdo = new PDO($connect, USER, PASS);
               $sql = $pdo->prepare('select  * from Brand');
               $sql->execute();
               foreach ($sql as $row) {
                  echo '<label class="mr-3"><input type="checkbox" id="brand" class="brand" name="brand[]" value="', $row['brand_code'], '" />', $row['brand_mei'], '</label>';
               }
               ?>
            </div>

            <div class="E m-1  has-text-left has-text-info is-size-5"> カラー <i class="fas fa-angle-down"></i></div>
            <div class="E-main m-5">

               <p class="is-size-5 m-1"><label><input id="checkAll2" type="checkbox" name="color[]" onchange="Colorall(this)" value="all" />全てのカラー</label></p><!--押すとすべて選択に-->
               <?php
               $sql = $pdo->prepare('select  * from Color');
               $sql->execute();
               $count = 0;
               foreach ($sql as $row) {
                  echo '<label class="mr-3"><input type="checkbox" id="color" class="color" name="color[]" value="', $row['color_code'], '" />', $row['color_mei'], '</label>';
                  $count++;
               }
               ?>
            </div>

            <div class="F m-1  has-text-left has-text-success is-size-5"> 金額 <i class="fas fa-angle-down"></i></div>
            <div class="F-main m-5">
               <p class="is-size-5 m-1"><label class="mr-3"><input id="checkAll3" type="checkbox" name="price[]" onchange="Priceall(this)" value="0" />全ての価格<label></p>
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
                  echo '<label class="mr-3"><input type="checkbox" id="price" class="price" name="price[]" value=', $key, ' />', $key, '～', $value, '円</label>';
               }
               ?>
               <label class="mr-3"><input type="checkbox" id="price" class="price" name="price[]" value="8" />30000円～</label>
            </div>
         </div>
         <div class="seach m-5 ">
            <button type="submit" class="button is-info is-outlined is-normal is-rounded is-medium">検索</button>
            </form>
         </div>
      </div>
   </div>
</div>

</div>


<script src="js/searchbox.js"></script>