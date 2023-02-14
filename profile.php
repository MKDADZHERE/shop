<?php
session_start();
   include 'init.php';
   if(isset($s_user)):
    $stuser=$con->prepare("SELECT * FROM users WHERE username=?");
    $stuser->execute(array($s_user));
    $info=$stuser->fetch();
 ?>
<h2 class="text-center">
    <?php if(isset($_SESSION['nameuser']))//  للحمايه
    {echo   $s_user;?></h2>
<div class="information block">
   <div class="container">
       <div class="panel panel-primary">
           <div class="panel-heading">Main Information</div>
            <div class="panel-body"> 
                name  :<?php echo $info['Username']?><BR>
                email  :<?php echo $info['Email']?><BR>
                fullname  :<?php echo $info['Fullname']?><BR>
        </div>
       </div> 
   </div>
</div>
<div class="my-ads block">
   <div class="container">
       <div class="panel panel-primary">
           <div class="panel-heading">Main ads</div>
            <div class="panel-body"> name  :osama</div>
       </div> 
   </div>
</div>
<div class="block">
   <div class="container">
       <div class="panel panel-primary">
           <div class="panel-heading">comments</div>
            <div class="panel-body"> test  :comments</div>
       </div> 
   </div>
</div>
<div class="f">d</div>
 <?php  
    }else{
        header('location:log.php');
    }
endif;
 include $tpl.'footer.php'; 
 ob_end_flush();?>
