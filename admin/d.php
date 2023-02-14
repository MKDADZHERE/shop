<?php
ob_start();// output  Bueffering start //all thing and no no haedar
session_start();
$pagetitle='d';
if(isset($_SESSION['username'])):
  include 'init.php';
  ?>

    <div class="container home-stats text-center">
      <h1>Dashbord</h1>
      <div class="row">
        <div class="col-md-3">
          <div class="stat st-members">
            Total Members 
            <span><a href="mem.php"><?php echo "+". COtems('UserID','users')?></a></span> 
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat st-pending">
            Pending Members
            <span><a href="mem.php?do=manage&pagg=Pending">
              <?php echo checkitem("reg","users","0")?></a></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat st-items">
            Total Items
            <span><a href="items.php"><?php echo "+". COtems('item_id','items')?></a></span> 
           </div>
        </div>
        <div class="col-md-3">
          <div class="stat st-comments">
            Total Comment 
            <span><a href="comment.php"><?php echo "+". COtems('c_id','comment')?></a></span> 
          </div>
        </div>

      </div>
    </div>
    <div class="container latest">
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa fa-users"></i>  Latest
              <?php echo $num =5 ?> Users
            </div>
            <div class="panel-body">
              <ul class="list-unstyled latest-users">
              <?php 
                 $the=gitlst("*","users","UserID",$num);
                 // the == لزرع متغير ثم طباعه اللوب 
                   foreach ($the as $A){
                     echo '<li>';
                     echo $A ['Username'];
                     echo '<span class="btn btn-success pull-right">';
                     echo '<i class="fa fa-edit"></i><a href="mem.php?do=Edit&Us='.$A ['UserID'].'"> Edit</a></span></li>';
                     echo '</li>';
                     echo "<br>";// username = what you need echo
                    }
              ?>
              </ul>
            </div>            
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa fa-tag"></i> Latest
              <?php echo $last_item =5 ?> Items
            </div>
            <div class="panel-body">
            <ul class="list-unstyled latest-users">
              <?php 
                 $item_list=gitlst("*","items","item_id",$last_item);
                 // the == لزرع متغير ثم طباعه اللوب 
                 if(!empty($item_list)):
                   foreach ($item_list as $AA){
                     echo '<li>';
                     echo $AA ['name'];
                     echo '<span class="btn btn-success pull-right">';
                     echo '<i class="fa fa-edit">
                     </i><a href="items.php?do=Edit&itemsid='
                     .$AA ['item_id'].'"> Edit</a></span></li>';
                     echo '</li>';
                     echo "<br>";// username = what you need echo
                    }endif;
              ?>
              </ul>
            </div>            
          </div>
        </div>
      </div>
    </div>


   <?php  
  include $tpl.'footer.php';
else:
  header('location:index.php');
endif; 
ob_end_flush(); 
?>
