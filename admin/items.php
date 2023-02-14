<?php 
ob_start();
session_start();
$pagetitle='Items';
if(isset($_SESSION['username']))
{
  include 'init.php';
  $do=isset($_GET['do']) ? $_GET['do'] : 'manage';

    if($do=='manage')
    {
        $stmt=$con->prepare("SELECT items.*,categories.name AS cat_name,users.Username FROM items
        INNER JOIN categories ON categories.id=items.cart_id
        INNER JOIN users ON users.UserID=items.mem_id");
        $stmt ->execute();
        $items=$stmt->fetchAll();
         ?>
          <h1 class="text-center">Mange Items</h1>
          <div class="container">
            <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
              <tr>
                <td># ID</td>
                <td>name</td>
                <td>description</td>
                <td>price</td>
                <td> Date </td>
                <td>cat_name</td>
                <td>mem name</td>
                <td>control</td>
              </tr>
              <?php 
                foreach($items as $row){
                  echo "<tr>";
                      echo "<td>".$row['item_id']."</td>";
                      echo "<td>".$row['name']."</td>";
                      echo "<td>".$row['description']."</td>";
                      echo "<td>".$row['price']."</td>";
                      echo "<td>".$row['add_date']."</td>";
                      echo "<td>".$row['cat_name']."</td>";
                      echo "<td>".$row['Username']."</td>";
                      echo"<td>
                            <a href='items.php?do=Edit&itemsid="
                            .$row['item_id']."' class='btn btn-success'>
                            <i class='fa fa-edit'></i> Edit </a>
                            <a href='items.php?do=delet&itemsid="
                            .$row['item_id']."' class='btn btn-danger'>
                            <i class='fa fa-close'></i> Delete </a> ";
                            if($row['approve'] ==0){
                              echo "<a href='items.php?do=approve&b="
                              .$row['item_id']."' class='btn btn-info'>
                              <i class='fa fa-check'></i> Actiate</a>";
                           }
                      echo"</td>";
                  echo"</tr>";
                 //echo $Us;
                }
              ?>
              <tr>
           </table>
          </div>
      <a href="items.php?do=Add"class="btn btn-primary">
        <i class="fa fa-plus "></i> Add Items </a>
<?php  }

    elseif($do =='Add') {?>
    <h1 class="text-center">Add New Itemms</h1>
      <div class="container">
        <form class="form-horizontal" action="?do=insert"method="POST">
          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text"name="name"class="form-control"autocomplete="off"/>
            </div>
          </div>

          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label">	Description</label>
            <div class="col-sm-10">
              <input type="text"name="description"class="form-control"autocomplete="off"/>
            </div>
          </div>

          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10">
              <input type="text"name="price"class="form-control"autocomplete="off"/>
            </div>
          </div>

          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label">Country made</label>
            <div class="col-sm-10">
              <input type="text"name="made"class="form-control"autocomplete="off"/>
            </div>
          </div>
          
          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label">Country made</label>
            <div class="col-sm-10">
                <select class="form-control" name="stats">
                    <option value="0">.....</option>
                    <option value="1">New</option>
                    <option value="2">Like New</option>
                    <option value="3">Usesd</option>
                    <option value="4">Old</option>
                </select>
            </div>
          </div>

          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label"> Member</label>
            <div class="col-sm-10">
                <select class="form-control" name="member">
                    <option value="0">.....</option>
                    <?php 
                      $stmt=$con->prepare("SELECT * FROM users");
                      $stmt->execute();
                      $a=$stmt->fetchAll();
                      foreach($a as $w){
                        echo "<option value='" . $w['UserID'] ."'>".$w['Username']."</optin>";
                      }
                      ?>
                </select>
            </div>
          </div>
          
          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label"> Category</label>
            <div class="col-sm-10">
                <select class="form-control" name="category">
                    <option value="0">.....</option>
                    <?php 
                      $stmt2=$con->prepare("SELECT * FROM categories");
                      $stmt2->execute();
                      $aa=$stmt2->fetchAll();
                      foreach($aa as $ww){
                        echo "<option value='" . $ww['id'] ."'>".$ww['name']."</optin>";
                      }
                      ?>
                </select>
            </div>
          </div>
          <div calss="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit"value="Add Category"class="btn btn-primary btn-sm"/>
            </div>
          </div>
        </form>
      </div>
<?php }
      elseif ($do=='insert')
      {
        if($_SERVER['REQUEST_METHOD']=='POST')
            {
             echo "<h1 class='text-center'>Editi Items</h1>";
             echo "<div class='container'>";
              $name=$_POST['name'];
              $des=$_POST['description'];
              $pri=$_POST['price'];
              $made=$_POST['made'];
              $stats=$_POST['stats'];
              $mem=$_POST['member'];
              $cat=$_POST['category'];
                            
              $formError=array();
              if(empty($name)):
                $formError[]="Name cant Be <strong> Empty </strong>";
              endif; 
              if(empty($des) ):
                $formError[]="Description cant Be <strong> Empty </strong>";
              endif; 
              if(empty($pri)):
                $formError[]="Price cant Be Empty";
              endif; 
              if(empty($made)):
                $formError[]="Country cant Be Empty";
              endif;
              if(($stats==0)):
                $formError[]="Stats cant Be Empty";
              endif;
              if(($mem==0)):
                $formError[]="member cant Be Empty";
              endif;
              if(($cat==0)):
                $formError[]="cat cant Be Empty";
              endif;
              
              foreach($formError as $error):
                echo "<div class='alert alert-danger'>". $error . "</div>";
              endforeach;
                if(empty($formError)):
                $stmt=$con->prepare("INSERT INTO items (name,description,price,made,stats,add_date,cart_id,mem_id)
                VALUES ('$name','$des','$pri','$made','$stats',now(),'$cat','$mem')");
                $stmt->execute(array($name,$des,$pri,$made,$stats,$cat,$mem));

                $errmsg= "<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                ReError($errmsg); 
                endif;   
                    
                      
            }else{
                echo "<div class='container'>";
                $errmsg ="<div class='alert alert-danger'>you cant open directory the insert </div>";
                ReError($errmsg,'back');
                echo "</div>";
              } 
                //echo"<div/>"; 
      }
      elseif ($do=='Edit'){//itemsid ==  do=delet&itemsid

        $M=isset($_GET['itemsid']) && is_numeric($_GET['itemsid']) ? intval($_GET['itemsid']) : 0;
        $stmt=$con->prepare("SELECT * FROM items WHERE item_id=?");
        $stmt->execute(array($M));
        $rowb=$stmt->fetch();/////-<
        $count=$stmt->rowCount();

    if($count >0 ) {?>
       <h1 class="text-center">Edit New Itemms</h1>
      <div class="container">
        <form class="form-horizontal" action="?do=update"method="POST">
          <div calss="form-group form-group-lg">
          <input type="hidden" name="items" value="<?php echo $M ?>">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text"name="name"class="form-control"autocomplete="off"value="<?php echo$rowb['name']?>"/>
            </div>
          </div>

          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label">	Description</label>
            <div class="col-sm-10">
              <input type="text"name="description"class="form-control"autocomplete="off" value="<?php echo$rowb['description']?>"/>
            </div>
          </div>

          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10">
              <input type="text"name="price"class="form-control"autocomplete="off"value="<?php echo$rowb['price']?>"/>
            </div>
          </div>
          
          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label">Country made</label>
            <div class="col-sm-10">
                <select class="form-control" name="stats">
                    <option value="1" <?php if($rowb['stats']==1){echo 'selected';}?>>New</option>
                    <option value="2" <?php if($rowb['stats']==2){echo 'selected';}?>>Like New</option>
                    <option value="3" <?php if($rowb['stats']==3){echo 'selected';}?>>Usesd</option>
                    <option value="4" <?php if($rowb['stats']==4){echo 'selected';}?>>Old</option>
                </select>
            </div>
          </div>

          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label"> Member</label>
            <div class="col-sm-10">
                <select class="form-control" name="member">
                    <?php 
                      $stmt=$con->prepare("SELECT * FROM users");
                      $stmt->execute();
                      $a=$stmt->fetchAll();
                      foreach($a as $w){
                        echo "<option value='" . $w['UserID'] ."'";
                        if($rowb['mem_id']==$w['UserID']){echo 'selected';}
                        echo ">".$w['Username']."</optin>";
                      }
                      ?>
                </select>
            </div>
          </div>

          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label"> Category</label>
            <div class="col-sm-10">
                <select class="form-control" name="category">
                    <?php 
                      $stmt2=$con->prepare("SELECT * FROM categories");
                      $stmt2->execute();
                      $aa=$stmt2->fetchAll();
                      foreach($aa as $ww){
                        echo "<option value='" .$ww['id'] ."'";
                        if($rowb['cart_id']==$ww['id']){echo 'selected';}
                        echo ">".$ww['name']."</optin>";
                      }
                      ?>
                </select>
            </div>
          </div>
          <div calss="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit"value="Add Category"class="btn btn-primary btn-sm"/>
            </div>
          </div>
        </form><?php
        $stmt=$con->prepare("SELECT comment.* ,users.username AS d 
           FROM comment 
           INNER JOIN users ON users.UserID =comment.user_id WHERE item_id=?");
        $stmt ->execute(array($M));
        $rows=$stmt->fetchAll();
        if(! empty($rows)):
         ?>
          <h1 class="text-center">Edit [<?php echo $M['name'] ?> ]Comment</h1>
          <div class="container">
            <div class="table-responsive">
            <table class="main-table text-center table table-bordered">
              <tr>                
                <td> comment</td>
                <td>Date</td>
                <td> user_name </td>
                <td>control</td>
              </tr>
              <?php 
                foreach($rows as $row){
                  echo "<tr>";
                      echo "<td>".$row['comment']."</td>";
                      echo "<td>".$row['date']."</td>";
                     
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
           <?php endif; ?>
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
      elseif($do=='update')
      {
        echo "<h1 class='text-center'>Editi Items</h1>";
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD']=='POST'){
         $id=$_POST['items'];
         $name=$_POST['name'];
         $des=$_POST['description'];
         $pri=$_POST['price'];
         $stats=$_POST['stats'];
         $mem_id=$_POST['member'];
         $cart_id=$_POST['category'];
                       
         $formError=array();
         if(empty($name)):
           $formError[]="Name cant Be <strong> Empty </strong>";
         endif; 
         if(empty($des) ):
           $formError[]="Description cant Be <strong> Empty </strong>";
         endif; 
         if(empty($pri)):
           $formError[]="Price cant Be Empty";
         endif;          
         if(($stats==0)):
           $formError[]="Stats cant Be Empty";
         endif;
         if(($mem_id==0)):
           $formError[]="member cant Be Empty";
         endif;
         if(($cart_id==0)):
           $formError[]="cat cant Be Empty";
         endif;
         
         foreach($formError as $error):
           echo "<div class='alert alert-danger'>". $error . "</div>";
         endforeach;
           if(empty($formError)):
           $stmt=$con->prepare("UPDATE items SET name=?,description=?,price=?,
           stats=?,mem_id=?,cart_id=? WHERE item_id=? ");
           $stmt->execute(array($name,$des,$pri,$stats,$mem_id,$cart_id,$id));

           $errmsg= "<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
           ReError($errmsg); 
           endif;   
          }else{
            echo "<div class='container'>";
            $errmsg ="<div class='alert alert-danger'>you cant open directory the insert </div>";
            ReError($errmsg,'back');
            echo "</div>";
                 
       
          }
         
        }elseif ($do =='delet') { //delet&itemsid
          echo'<h1 class="text-center">Manage Members</h1>';
          echo "<div class='container'>";
            $f=isset($_GET['itemsid']) && is_numeric($_GET['itemsid']) ? intval($_GET['itemsid']) : 0;
            $check=checkitem('item_id','items',$f);//name tabel // from // الاستعلام
         //echo $f;
              if($check >0 ) { 
                  $stmt=$con->prepare("DELETE FROM items WHERE item_id=?");// ???? :::: 
                  //$stmt ->bindParam($user,$userid); not working 
                  $stmt -> execute(array($f)); 
                  $errmsg="<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                  ReError($errmsg);  
               }
              else{
                $errmsg="<div class='alert alert-danger'>theres No Id Exist </div>";
                ReError($errmsg);   
              }
                echo "</div>";
            } 
            elseif($do =='approve'){//approve&b
              echo'<h1 class="text-center">Approve</h1>';
              echo "<div class='container'>";
              $A=isset($_GET['b']) && is_numeric($_GET['b']) ? intval($_GET['b']) : 0;
            // select from the data base all userid == 1
              $check=checkitem('item_id','items',$A);//name tabel // from // الاستعلام
                      
              if($check >0 ) { 
                    $stmt=$con->prepare("UPDATE items  SET approve =1  WHERE item_id=?");// ???? :::: 
                    $stmt -> execute(array($A)); 
                    $errmsg="<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                    ReError($errmsg,'back');  
                 }else{
                  $errmsg="<div class='alert alert-danger'>theres No Id Activate </div>";
                  ReError($errmsg);   
                  }
                echo "</div>";
            }    
        
   include $tpl.'footer.php';
      }else{
       header('location:index.php');
     }  
ob_end_flush();
?>