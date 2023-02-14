<?php
session_start();
$no_nav='';
$pagetitle="Login";
if(isset($_SESSION['username'])):
  header('location:d.php');
endif ;

include 'init.php';
// check if user coming from http post
if($_SERVER['REQUEST_METHOD']=='POST'){
  $username=$_POST['user'];
  $password=$_POST['pass'];
  $hash=sha1($password);
  // check if user exist in database
  $stmt=$con->prepare("SELECT UserID, username,password FROM 
         users WHERE  username=? AND  password=? AND groupid=1 LIMIT 1");
         //groupid=1 LIMIT 1 why 
  $stmt->execute(array($username,$hash));// الاستخراج للمقارنه 
  $row=$stmt->fetch();// array 
  $count=$stmt->rowcount();// 
 
  if($count > 0 ):
      $_SESSION['username']=$username;//زرع 
      $_SESSION['ID']=$row['UserID'];
      header('location:d.php');
      exit();
    endif;
}
 ?>

<form class="login"action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
  <h3 class="text-center">Admin login</h3>
  <input class="form-control "type="text" name="user" placeholder="username" autocomplete="off"/>
  <input class="form-control "type="password" name="pass" placeholder="password" autocomplete="new-password"/>
  <input class="btn btn-primary btn-block"type="submit" value="login"/>
</form>
<?php  include $tpl.'footer.php'; ?>
