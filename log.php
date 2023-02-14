<?php
ob_start();
session_start();
$pagetitle="Login";
if(isset($_SESSION['nameuser'])):
  header('location:inde.php');// دخل سابقا 
endif ;

include 'init.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['login'])):
      $username=$_POST['username'];
      $password=$_POST['password'];
      $hash=sha1($password);
      $stmt=$con->prepare("SELECT UserID, username,password FROM 
            users WHERE  username=? AND  password=?");
          
      $stmt->execute(array($username,$hash));// الاستخراج للمقارنه 
      $count=$stmt->rowcount();// 
    
      if($count > 0 ):
          $_SESSION['nameuser']=$username;//زرع 
          header('location:inde.php');
          exit();
      endif;
  else:
    $user=$_POST['username'];
    //$pass=$_POST['pass']
      $formerror=array();
      if(isset($_POST['username']))
      {  $userfilter=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
          if(strlen($userfilter)<4):
            $formerror[]='Username Must Be Larger Than Characters';
          endif;
      }
      if(isset($_POST['pass1']) && isset($_POST['pass2']))
      {     
          if(empty($_POST['pass1'])):
             $formerror[]='Soory Your Password Is Impty';
          endif;
           $pass1=sha1($_POST['pass1']);
           $pass2=sha1($_POST['pass2']);
            if( $pass1 !== $pass2){
              $formerror[] ="nono password";                 
             }else{  echo $pass1,"<br>".$pass2;}
      }
      if(empty($formerror)):
         $check =checkitem("username","users",$user);
            if ($check ==1):
              $errmsg="<div class='alert alert-danger'>Sorry you cant Add this user </div>";
            else:
                $stmt=$con->prepare("INSERT INTO users (Username,Password,reg,Date)
                                      VALUES ('$user','$pass1',0,now())");
                $stmt->execute(array($user,$pass1));

                $errmsg= "<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
              
              endif; 
      endif;     
  endif;
}
 ?>
<div class="container login">
    <h1 class="text-center"><span class="login">Login</span> | <span class="signup">Signup</span></h1>
    <form class="login"  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <input class="form-control"type="text"name="username"autocomplete="off"
        pattern=".{4,}" title="Uaername is must 4 pls"required>
        <input class="form-control"type="password"name="password"autocomplete="new-password">
        <input name="login"class="btn btn-primary btn-block"type="submit" value="login">
   </form>
   <form class="signup"   action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <input class="form-control"type="text"name="username"autocomplete="off"
        pattern=".{4,}" title="Uaername is must 4 pls"required>
        <input class="form-control"type="password"name="pass1"
        minlength="4"required>
        <input class="form-control"type="password"name="pass2">
        <input  name="signup"class="btn btn-primary btn-block"type="submit" value="login">
   </form>
   <div class="the-errors text-center">
      <?php //echo $username=$_POST['username'];
      if(!empty($formerror))
      {
        foreach($formerror as $form){
            echo $form.'<br>';
        }
      }
      if(isset($errmsg)){
        echo $errmsg;
      }
      ?>
      
   </div>
   </div>

<div class="k">t</div>
<?php include $tpl.'footer.php'; ?>