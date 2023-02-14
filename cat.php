<?php include 'init.php'?>
<div class="container">
   <!-- the text page name in center all pages-->
   <h1 class="text-center">
      <?php echo str_replace('-',' ',$_GET['pagename']) ?>
   </h1>
   <div class="row">
   <?php foreach (getitem($_GET['pageid']) as $items2)
   {// تنسيق نص العنوان حسب ال id -->
      echo //$items2['name'].
        '<div class="col-sm-6 col-md-4">';  
            echo'<div class="thumbnail">';
               echo '<img class="img-responsive"src="1.png" alt=""/>';
                     echo '<div class=caption">';
                        echo'<h3>'.$items2['name'].'</h3>';
                        echo'<h4>'.$items2['price'].'</h4>';
                        echo'<p></p>';
                     echo '</div>';
            echo'</div>';     
      echo'</div>';
   } 
   ?>
   </div>
</div>
 
<?php include $tpl.'footer.php'; ?>
