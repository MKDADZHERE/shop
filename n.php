<?php
  function endd($filed,$table,$where=NULL,$orderfiled,$order="DESC")
  {
    global $con;
    $alll=$con->prepare("SELECT $filed FROM $table $where ORDER BY $orderfiled $order ");
    $alll->execute();
    $all=$alll->fetchAll();
    return $all;
   }
   $e=endd("*","users","","","","");
   echo $e['Email'];
?>