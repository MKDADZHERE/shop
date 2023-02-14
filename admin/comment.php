<?php
session_start();
$pagetitle='comments';
if(isset($_SESSION['username'])){// 1
  include 'init.php';

    $do=isset($_GET['do']) ? $_GET['do'] : 'manage';// 

    if($do=='manage'){    
           $stmt=$con->prepare("SELECT comment.* ,items.name AS M,users.username AS d 
           FROM comment INNER JOIN items ON items.item_id =comment.item_id 
           INNER JOIN users ON users.UserID =comment.user_id");
        $stmt ->execute();
        $rows=$stmt->fetchAll();
         ?>
          <h1 class="text-center">Mange Comment</h1>
          <div class="container">
            <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
              <tr>
                <td> ID</td>
                <td> comment</td>
                <td>Date</td>
                <td>item_name</td>
                <td> user_name </td>
                <td>control</td>
              </tr>
              <?php 
                foreach($rows as $row){
                  echo "<tr>";
                      echo "<td>".$row['c_id']."</td>";
                      echo "<td>".$row['comment']."</td>";
                      echo "<td>".$row['date']."</td>";
                      echo "<td>".$row['M']."</td>";
                      echo "<td>".$row['d']."</td>";
                      echo"<td>
                            <a href='comment.php?do=Edit&com=".$row['c_id']."' class='btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                            <a href='comment.php?do=delet&com=".$row['c_id']."' class='btn btn-danger'><i class='fa fa-close'></i> Delete </a> ";
                            if($row['stats'] ==0){
                               echo "<a href='comment.php?do=app&com=".$row['c_id']."' class='btn btn-info'><i class='fa fa-close'></i> Approve</a>";
                            }
                      echo"</td>";
                  echo"</tr>";
                 echo $Us;
                }
              ?>
              <tr>
           </table>
          </div>
      
<?php    }

   elseif($do=='Edit'){
       $com=isset($_GET['com']) &&is_numeric($_GET['com']) ? intval($_GET['com']) : 0;
            $stmt=$con->prepare("SELECT * FROM comment WHERE c_id=? ");
            $stmt->execute(array($com));
            $row=$stmt->fetch();
            $count=$stmt->rowcount();

              if($count >0 ) {?>
                                            
              <h1 class="text-center">Editi Members</h1>
              <div class="container">
                <form class="form-horizontal" action="?do=update"method="POST">
                  <div calss="form-group form-group-lg">
                    <input type="hidden" name="com" value="<?php echo $com ?>">
                    <label class="col-sm-2 control-label">comments</label>
                    <div class="col-sm-10">
                        <textarea name="comi"class="form-control"><?php echo $row['comment'];?>
                        </textarea>
                    </div>
                  </div>
                  <div calss="form-group form-group-lg">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit"value="save"class="btn btn-primary btn-lg"/>
                    </div>
                  </div>
                </form>
              </div>
    <?php 
          }
           else{ 
                echo "<div class='container'>";
                $errmsg ="<div class='alert alert-danger'>theres No Such ID</div>";
                ReError($errmsg);
                echo "</div>";
            }
      }
      elseif($do=='update'){ 
            echo'<h1 class="text-center">updata Comment</h1>';
            echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD']=='POST'){
        
                $comid=$_POST['com'];
                $comi=$_POST['comi'];
                $stmt=$con->prepare("UPDATE comment SET Comment=? WHERE c_id=?");
                $stmt->execute(array($comi,$comid));
                $errmsg="<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                  ReError($errmsg);
          }else{
                $errmsg="<div class='alert alert-success'>.you cant open directory </div> ";
                ReError($errmsg,5);               
               }
               echo"<div/>";          
      }
      elseif($do=='delet'){
          echo'<h1 class="text-center">Manage Comment</h1>';
          echo "<div class='container'>";
            $did=isset($_GET['com']) && is_numeric($_GET['com']) ? intval($_GET['com']) : 0;
          $check=checkitem('c_id','comment',$did);
         if($check >0 ) { 
                  $stmt=$con->prepare("DELETE FROM comment  WHERE c_id=?");// ???? :::: 
                  $stmt -> execute(array($did)); 
                  $errmsg="<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                  ReError($errmsg);  
               }
              else{
                $errmsg="<div class='alert alert-danger'>theres No Id Exist </div>";
                ReError($errmsg);   
              }
                echo "</div>";
        }        
        elseif($do =='app'){
            echo'<h1 class="text-center">Activate</h1>';
            echo "<div class='container'>";
            $apid=isset($_GET['mo']) && is_numeric($_GET['mo']) ? intval($_GET['mo']) : 0;
            $check=checkitem('stats','comment',$apid);//name tabel // from // الاستعلام
                    
            if($check >0 ) { 
                  $stmt=$con->prepare("UPDATE comment SET stats=1  WHERE stats=?");// ???? :::: 
                  $stmt -> execute(array($apid)); 
                  $errmsg="<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                  ReError($errmsg);  
               }else{
                $errmsg="<div class='alert alert-danger'>theres No Id Activate </div>";
                ReError($errmsg);   
                }
              echo "</div>";
          }    
  include $tpl.'footer.php';
}else{//1
       header('location:index.php');
     }  

?>
