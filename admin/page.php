<?php
$do='';
    if(isset($_GET['do']))
    {
        $do=$_GET['do'];
    }
    else{
        $do='manage';
    }

    if($do=='manage'){
        echo"wellcom in manage";
        echo'<a href="?do=Add">Add new page</a>';

    }
    elseif($do=='Add'){
        echo"welcom in Add";
    }
    elseif ($do=='insert'){
        echo"welcom in insert";
    }
    else{
        echo"welcom in home";
    }
