
<?php 
function endd($filed,$table,$WHERE=NULL,$and=NULL,$orderfiled,$order="DESC")
{
  global $con; //WHERE item_id='10'
  $alll=$con->prepare("SELECT $filed FROM $table $WHERE $and ORDER BY $orderfiled $order ");
  $alll->execute();
  $all=$alll->fetchAll();
  return $all;
 }

function all($v,$order=NULL)// inde ... 
{
  global $con;
  $alll=$con->prepare("SELECT * FROM $v ORDER BY $order DESC");
  $alll->execute();
  $all=$alll->fetchall();
  return $all;

}
function title()
{
  global $pagetitle;
  if(isset($pagetitle)):
    echo $pagetitle;
  else :
    echo "Default";
  endif;
}
function userhere($userone){
  global $con;
  $stmt=$con->prepare("SELECT  username,reg FROM 
         users WHERE  username=? AND reg=0");
       
  $stmt->execute(array($userone));// الاستخراج للمقارنه 
  //$row=$stmt->fetch();// array 
  $count=$stmt->rowcount();
  return $count;
}


function getcatt()
{ 
  global $con; // global 
  $getcat=$con->prepare("SELECT *  FROM categories ORDER BY ID ASC");
  $getcat->execute();
  $cat=$getcat->fetchAll();
   return $cat ;
}

function getitem($val)
{ 
  global $con; // global 
  $getitem1=$con->prepare("SELECT *  FROM items WHERE cart_id=? ORDER BY item_id DESC");
  $getitem1->execute(array($val));
  $items=$getitem1->fetchAll();
   return $items ;
}
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
function checkitem($select,$from,$value)
{
  global $con;
  $statment=$con ->prepare("SELECT $select FROM $from WHERE $select=?");
  $statment ->execute(array($value));
  $count=$statment->rowcount();
  return $count; // echo => echo || retuern  => 1 or 2 
}
?>