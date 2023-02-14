<?php
session_start();
$pagetitle="Login";
if(isset($_SESSION['f'])):
  header('location:inde.php');
endif ;

include 'init.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $hash=sha1($password);
  $stmt=$con->prepare("SELECT UserID, username,password FROM 
         users WHERE  username=? AND  password=?");
       
  $stmt->execute(array($username,$hash));// الاستخراج للمقارنه 
  //$row=$stmt->fetch();// array 
  $count=$stmt->rowcount();// 
 
  if($count > 0 ):
      $_SESSION['f']=$username;//زرع 
      header('location:inde.php');
      exit();
    endif;
}


//page 2
session_start();?>