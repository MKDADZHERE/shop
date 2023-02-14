<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo$pagetitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $css;?>bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo $css;?>font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo $css;?>backend.css">
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="d.php">Home</a>
    </div>

    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a href="categories.php">categories</a></li>
        <li><a href="items.php">itimes</a></li>
        <li><a href="mem.php">members</a></li>
        <li><a href="comment.php">Comments</a></li>
        <li><a href="#">stat</a></li>
        <li><a href="#">logs</a></li>
        <li><a href="../f.php">shop</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="mem.php?do=Edit&Us=<?php echo $_SESSION['ID']?>">Editi</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="logout.php">Something else here</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
