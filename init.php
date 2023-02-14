<?php
    ini_set('display_errord','On');
    error_reporting(E_ALL);
    // للجمايه اطبع الايرور
    $s_user='';
    if(isset($_SESSION['nameuser']))
    { $s_user=$_SESSION['nameuser'];}
    include 'admin/connect.php';  
    $tpl="includs/tamplets/";
    $css="layout/css/";
    $js="layout/js/";
    $fun="includs/fanctions/";
    include $fun."fun.php";
    include $tpl.'headar.php';
    
    
 ?>
