<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo$pagetitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $css;?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo $css;?>font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo $css;?>/backend.css">
</head>
<body>
  <div class="upper-bar">
    <div class="container"><?php 
    if(isset($_SESSION['nameuser'])) //my-image img-thumbnail circle
    {?>
     <img class='mkg'src="1.png" alt=""style="width: 32px;
  height: 32px;">

    <div class="btn-group my-infor text-right">
      <span class="btn dropdown-torggle" data-toggle="dropdown">
        <?php echo $s_user ?>
        <span class="caret"></span>
      </span>
      <ul class="dropdown-menu">
        <li><a href="profile.php">My Profile</a></li>
        <li><a href="logout.php"> - Log out</a></li>

      </ul>
    </div>
    </div>    
  <?php  }
    else{ echo "no seesion ";}?>
  </div>
  </div>
<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="inde.php">Home</a>
    </div>

    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav navbar-right">
      <?php  
       foreach (getcatt() as $r )
       {// هون جبنا id وحطينا فراغ ب اعلى الصفحه
        echo '<li>
        <a href="cat.php?pageid='.$r['id'].'&pagename='.str_replace(' ','-',$r['name']).'">
        '.$r['name'].'</a></li>';
       }
       ?>
        </ul>
     
    </div>
  </div>
</nav>

