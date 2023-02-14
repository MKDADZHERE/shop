<?php
ob_start();
session_start();
$pagetitle='categories';
if(isset($_SESSION['username']))
{
  include 'init.php';
  $do=isset($_GET['do']) ? $_GET['do'] : 'manage';// 

    if($do =='manage')
    {
        $sort='ASC';
        $sort_array=array('ASC','DESC');
        if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array))
        { $sort=$_GET['sort']; }
        $stmt2=$con->prepare("SELECT * FROM categories ORDER BY ordering $sort");
        $stmt2->execute();
        $cats=$stmt2->fetchAll();//حلب المل 
    ?>
        <h1 class="text-center">Manage Categories</h1>
        <div class="container categories">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Manage Categories
                   <div class="ording pull-right">
  <i class="fa fa-sort"></i>Ordering : [  
                      <a class="<?php if ($sort=='ASC'){echo 'active';}?>"href='?sort=ASC'> Asc</a> |
                      <a class="<?php if ($sort=='DESC'){echo 'active';}?>"href='?sort=DESC'> Desc</a> ]
                   </div>
                </div>
                <div class="panel-body">
                    <?php 
                        foreach ($cats as $cat){ 
                          echo"<div class='cat'>";   
                          echo"<div class='hidden-bto'>"; 
                             echo"<a href='categories.php?do=Edit&catid=".$cat['id'] ." ' class='btn btn-x5 btn-primary'><i class='fa fa-edit'></i> Edit</a>";
                             echo"<a href='categories.php?do=delet&catid=".$cat['id'] ." ' class='confirm btn btn-x5 btn-danger'><i class='fa fa-close'></i> Delete</a>";
                          echo "</div>";                     
                            echo "<h3>".$cat['name'].'</h3>' ;
                            echo "<p>";if($cat ['description']==''){echo "this category has no descriotion";}else{echo $cat ['description'];}echo "</p>";
                            if($cat ['visibility']==1){echo '<span class="vis"> Hidden </span>';}
                            if($cat ['allow_comment']==1){echo '<span class="com">Allow Comment</span>';}
                            if($cat ['allow_ads']==1){echo '<span class="aads">Allow Adds</span>';}
                          echo"</div>";
                          echo "<hr>";
                        }
                    ?>
                </div>
            </div>
            <a class="add-category btn btn-primary"href="categories.php?do=Add"><i class='fa fa-plus'></i> Add Categories</a>
        </div>
<?php } elseif($do=='Add'){?>
         <h1 class="text-center">Add new Members</h1>
      <div class="container">
        <form class="form-horizontal" action="?do=insert"method="POST">
          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text"name="name"class="form-control"autocomplete="off"required="required"/>
            </div>
          </div>

          <div calss="form-group form-group-lg">
          <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
              <input type="text"name="Des"class="form-control"/>
            </div>
          </div>
       
          <div calss="form-group form-groub-lg">
          <label class="col-sm-2 control-label">Oreder</label>
            <div class="col-sm-10">
              <input type="text" name="Oreder"class="form-control"/>
            </div>
          </div>
          
          <div calss="form-group form-group-lg">
          <label class="col-sm-2 control-label">Visibility</label>
            <div class="col-sm-10">
                <div>
                    <input id="vis-yes" type="radio"name="Vis" value="0" checked/>
                    <label for="vis-yes">Yes</label>
                </div>
                <div>
                    <input id="vis-no" type="radio"name="Vis" value="1"/>
                    <label for="vis-no">No</label>
                </div>
            </div>
          </div>

          <div calss="form-group form-group-lg">
          <label class="col-sm-2 control-label">Allow comment</label>
            <div class="col-sm-10">
                <div>
                    <input id="com-yes" type="radio"name="comment" value="0" checked/>
                    <label for="com-yes">Yes</label>
                </div>
                <div>
                    <input id="com-no" type="radio"name="comment" value="1"/>
                    <label for="com-no">No</label>
                </div>
            </div>
          </div>

          <div calss="form-group form-group-lg">
          <label class="col-sm-2 control-label">Allow_ads</label>
            <div class="col-sm-10">
                <div>
                    <input id="ads-yes" type="radio"name="ads" value="0" checked/>
                    <label for="ads-yes">Yes</label>
                </div>
                <div>
                    <input id="ads-no" type="radio"name="ads" value="1"/>
                    <label for="ads-no">No</label>
                </div>
            </div>
          </div>
          
          <div calss="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit"value="Add Category"class="btn btn-primary btn-lg"/>
            </div>
          </div>
        </form>
      </div>
    <?php }
    elseif($do=='insert')
    {
        echo'<h1 class="text-center"> Insert Category</h1>';
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD']=='POST'){//4/2
          // get the varivales from form
            $name=$_POST['name'];
            $ds=$_POST['Des'];
            $Or=$_POST['Oreder'];
            $vis=$_POST['vis'];
            $com=$_POST['comment'];
            $ads=$_POST['ads'];
          //echo $id.$user.$name.$email;
             $check =checkitem("Name","categories",$name);
                if ($check ==1):
                  $errmsg="<div class='alert alert-danger'>Sorry you cant insert in Category </div>";
                  ReError($errmsg,'back'); 
                else:
                    $stmt=$con->prepare("INSERT INTO categories (name,description,ordering,visibility,allow_comment,allow_ads)
                                          VALUES ('$name','$ds','$or','$vis','$com','$ads')");
                    $stmt->execute(array($name,$ds,$or,$vis,$com,$ads));

                    $errmsg= "<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                    ReError($errmsg,'back');//Add 
                  endif; 
           

    }// inert 1                
      else{// or insert 1 
        echo "<div class='container'>";
        $errmsg ="<div class='alert alert-danger'>you cant open directory the insert </div>";
        ReError($errmsg,'back');
        echo "</div>";
          }// end insert 1 
            echo"<div/>";     
}
          
            
    elseif($do=='Edit')
    {
         $catid=isset($_GET['catid']) &&is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
         $stmt=$con->prepare("SELECT * FROM categories WHERE id=?");
         $stmt->execute(array($catid));
         $cat=$stmt->fetch();
         $count=$stmt->rowcount();
           if($count >0 ) { ?>
            <h1 class="text-center">Add new Categories</h1>
            <div class="container">
              <form class="form-horizontal" action="?do=update"method="POST">
              <input type="hidden" name="catid" value="<?php echo $catid ?>">
                <div calss="form-group form-group-lg">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text"name="name"class="form-control"required="required" value="<?php echo $cat['name']?>"/>
                  </div>
                </div>
      
                <div calss="form-group form-group-lg">
                <label class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <input type="text"name="des"class="form-control" value="<?php echo $cat['description']?>"/>
                  </div>
                </div>
             
                <div calss="form-group form-groub-lg">
                <label class="col-sm-2 control-label">Oreder</label>
                  <div class="col-sm-10">
                    <input type="text" name="oreder"class="form-control" value="<?php echo $cat['ordering']?>"/>
                  </div>
                </div>
                
                <div calss="form-group form-group-lg">
                <label class="col-sm-2 control-label">Visibility</label>
                  <div class="col-sm-10">
                      <div>
                          <input id="vis-yes" type="radio"name="vis" value="0" <?php if($cat['visibility']==0){echo "checked";} ?>/>
                          <label for="vis-yes">Yes</label>
                      </div>
                      <div>
                          <input id="vis-no" type="radio"name="vis" value="1" <?php if($cat['visibility']==1){echo "checked";} ?>/>
                          <label for="vis-no">No</label>
                      </div>
                  </div>
                </div>
      
                <div calss="form-group form-group-lg">
                <label class="col-sm-2 control-label">Allow comment</label>
                  <div class="col-sm-10">
                      <div>
                          <input id="com-yes" type="radio"name="comment" value="0" <?php if($cat['allow_comment']==0){echo "checked";} ?>/>
                          <label for="com-yes">Yes</label>
                      </div>
                      <div>
                          <input id="com-no" type="radio"name="comment" value="1"<?php if($cat['allow_comment']==1){echo "checked";} ?>/>
                          <label for="com-no">No</label>
                      </div>
                  </div>
                </div>
      
                <div calss="form-group form-group-lg">
                <label class="col-sm-2 control-label">Allow_ads</label>
                  <div class="col-sm-10">
                      <div>
                          <input id="ads-yes" type="radio"name="ads" value="0" <?php if($cat['allow_ads']==1){echo "checked";} ?>/>
                          <label for="ads-yes">Yes</label>
                      </div>
                      <div>
                          <input id="ads-no" type="radio"name="ads" value="1" <?php if($cat['allow_ads']==1){echo "checked";} ?>/>
                          <label for="ads-no">No</label>
                      </div>
                  </div>
                </div>
                
                <div calss="form-group form-group-lg">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit"value="Add Category"class="btn btn-primary btn-lg"/>
                  </div>
                </div>
              </form>
            </div>
         
           
 <?php 
       }//3/2
        else{ //3/2
             echo "<div class='container'>";
             $errmsg ="<div class='alert alert-danger'>theres No Such ID</div>";
             ReError($errmsg);
             //http://localhost/apple/admin/mem.php?do=Edit&Us=33
             echo "</div>";
         }//3/2
         
   }
    
    elseif($do=='update')
    {
      echo'<h1 class="text-center">updata categories</h1>';
            echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD']=='POST'){//4/2
              // get the varivales from form
                $ID=$_POST['catid'];
                $name=$_POST['name'];
                $des=$_POST['des'];
                $ord=$_POST['oreder'];
                $vis=$_POST['vis'];
                $com=$_POST['comment'];
                $ads=$_POST['ads'];
               echo $ID;
                $stmt=$con->prepare("UPDATE categories SET Name=?,Description=?,ordering=?,Visibility=?,allow_comment=?,allow_ads =? WHERE id=?");
                $stmt->execute(array($name,$des,$ord,$vis,$com,$ads,$ID));

                $errmsg="<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                ReError($errmsg,'back',5);
                              
        }else{//4/2
              $errmsg="<div class='alert alert-success'>.you cant open directory </div> ";
              ReError($errmsg,5);

             
             }//4/2
             echo"<div/>";
    } 

    elseif($do=='delet')
    {
      echo'<h1 class="text-center">Delete Categories</h1>';
      echo "<div class='container'>";
        $catid=isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
        $check=checkitem('ID','categories',$catid);//name tabel // from // الاستعلام
      
          if($check >0 ) { 
              $stmt=$con->prepare("DELETE FROM categories  WHERE ID=?");// ???? :::: 
              $stmt -> execute(array($catid)); 
              $errmsg="<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
              ReError($errmsg,'back');  
           }
          else{
            $errmsg="<div class='alert alert-danger'>theres No Id Exist </div>";
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
