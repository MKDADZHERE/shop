<?php
session_start();
include 'init.php';?>
 <div class="container">
   
   <div class="row">
   <?php // endd("*","items","","","item_id","DESC")
   //all($v,$order=NULL)
   //all('items','item_id'); 
   $additem=endd("*","items","","","item_id","DESC");
   foreach ($additem as $item)
   {
      echo //$items2['name'].
        '<div class="col-sm-6 col-md-4">';  
            echo'<div class="thumbnail item-box">';
            echo'<span class="price">'.$item['price'].'</span>';
               echo '<img class="img-responsive"src="1.png" alt=""/>';
                     echo '<div class=caption">';
                        echo'<h3>'.$item['name'].'</h3>';
                       
                     echo '</div>';
            echo'</div>';     
      echo'</div>';
   } 
   ?>
   </div>
</div>
<?php
   $e=endd("*","users","","","","");
   echo $e['Email'];
  include $tpl.'footer.php'; ?>
