<?php
 $dsn='mysql:host=localhost;dbname=shop';
 $user='root';
 $pass="1234qwer";
 $option=array(
   PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8',
 );
 try {
   $con=new PDO($dsn,$user,$pass,$option);
   $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   //echo"you are connected ";
 } catch (PDOException $e) {
   echo "faild to connnect" .$e->getMessage();
 }

 ?>
