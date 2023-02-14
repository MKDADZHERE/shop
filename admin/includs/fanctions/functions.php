<?php
function title()
    {
      global $pagetitle;
      if(isset($pagetitle)):
        echo $pagetitle;
      else :
        echo "Default";
      endif;
    }
// function to echo error and refresh to next page 
// check items function v 1.0

/* function ReError($errmsg,$seconds=4)
//   {
//       echo "<div class='alert alert-danger'>$errmsg</div>";
//       echo "<div class='alert alert-info'> You will Be to Redirected to Homepage After $seconds Seconds.</div>";
//       header("Refresh:$seconds; url=index.php");
// 
}      exit();
  */
 // check items function v 2.0 
 function ReError ($errmsg,$url=null,$seconds=4)
 {
    if($url === null){
      $url='index.php';
    }else{
           if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER'] !==''):
            $url =$_SERVER['HTTP_REFERER'];
           else:
              $url ='index.php';
           endif;
          }           
        echo $errmsg;
       // $errmsg= "<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
        echo "<div class='alert alert-info'> You will Be to Redirected to Homepage After $seconds Seconds.</div>";
        header("Refresh:$seconds; url=$url");
    exit();
}

// check item in database accept 
// select item from data username 
// from the tabel 
// value the item select 

function checkitem($select,$from,$value)
{
  global $con;
  $statment=$con ->prepare("SELECT $select FROM $from WHERE $select=?");
  $statment ->execute(array($value));
  $count=$statment->rowcount();
  return $count; // echo => echo || retuern  => 1 or 2 
}


function COtems($itmes,$table)
{
  global $con;
  $stmt2=$con->prepare("SELECT COUNT($itmes) FROM $table");
  $stmt2->execute();
  return $stmt2->fetchColumn();
}
 

function gitlst($select,$table,$order,$limit =2)
{
  global $con; // global 
  $stmt2=$con->prepare("SELECT $select  FROM $table ORDER BY $order DESC LIMIT $limit ");
   // connect to data 
  $stmt2->execute();
  $rows=$stmt2->fetchAll();
   return $rows ;
}

/*
ALTER TABLE comment ADD CONSTRAINT user_comments
FOREIGN KEY (user_id) REFERENCES users(userID)
ON UPDATE CASCADE 
ON DELETE CASCADE;
    
    75
 */
 ?>
