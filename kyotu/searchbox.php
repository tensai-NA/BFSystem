<div id="app">
<script src="js/searchbox.js"></script>
<div class="kensaku">
            <div class=" box has-background-light m-5">
                <h5 class="title is-5">検索</h5>
          
                <div class="control m-1">
        <label class="label">商品名</label>
        <div class="field has-addons-fullwidth has-addons-centered">
            <p class="control has-icons-left">
                <input class="input is-success  is-normal is-focused "  type="text" name="shohin_mei"  placeholder="商品名">
             <span class="icon is-small is-left">
             <i class="fas fa-shopping-bag"></i>
                </span>
                </p>
    </div>
                 

               <div class="B m-1  has-text-left"> 絞り込み <i class="fas fa-angle-down"></i></div>
            <div class="shibori has-text-left ml-6 mt-2">
               
           <div class="C m-1  has-text-left"> ブランド <i class="fas fa-angle-down"></i></div> 
           <div class ="C-main m-5">  
           <form> 
           <p class="is-size-5 m-1"><label><input id="checkAll1" type="checkbox"  name="name[]" value="all"/>全てのブランド</label></p><!--押すとすべて選択に-->
     <?php
           $pdo=new PDO($connect, USER, PASS);
           $sql=$pdo->prepare('select  * from Brand');
           $sql->execute();
           foreach($sql as $row){
            echo '<label class="mr-3"><input  type="checkbox" class="checks1"  name="brand[]" value="',$row['brand_mei'],'" />', $row['brand_mei'],'</label>';
          
         }
           ?>
             </form>

            </div>
           <div class="D m-1  has-text-left"> カラー <i class="fas fa-angle-down"></i></div> 

           <div class ="D-main m-5">   
           <form> 
           <p class="is-size-5 m-1"><label><input id="checkAll2" type="checkbox" name="color[]" value="all" />全てのカラー</label></p><!--押すとすべて選択に-->
           <?php
           $sql=$pdo->prepare('select  * from Color');
           $sql->execute();
           $count=0;
           foreach($sql as $row){
            echo '<label class="mr-3"><input  type="checkbox" class="checks2" name="color[]" value="',$row['color_mei'],'" />', $row['color_mei'],'</label>';
            $count++;
          
         }
        
           ?>
            </form> 
          
           

            </div>
               
           <div class="E m-1  has-text-left"> 金額 <i class="fas fa-angle-down"></i></div>
           
           <div class="E-main m-5"><!--最適化する予定-->
           
           <form> 
           
           <p class="is-size-5 m-1"><label class="mr-3"><input id="checkAll3" type="checkbox" name="price[]" value="0" />全ての価格<label></p>
            <label class="mr-3"><input  type="checkbox" class="checks3" name="price[]" value="1" />0～1500円<label>
            <label class="mr-3"><input  type="checkbox" class="checks3" name="price[]" value="2" />1500～5000円<label>
            <label class="mr-3"><input  type="checkbox" class="checks3" name="price[]" value="3" />5000～10000円<label>
            <label class="mr-3"><input  type="checkbox" class="checks3" name="price[]" value="4" />10000～30000円<label>

        </form> 
           
                </div>
</div>
                <div class="seach m-5 ">
                <button type="submit">検索</button>
        </form>
                </div>
        </div>
    </div>
        </div>

</div>
      
</div>
<script src="js/searchbox.js"></script>