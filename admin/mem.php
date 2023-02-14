<?php
session_start();
$pagetitle='mem';
if(isset($_SESSION['username'])){// 1
  include 'init.php';

    $do=isset($_GET['do']) ? $_GET['do'] : 'manage';// 

    if($do=='manage'){ 
      $pagg='';// االاشخاص غير مفعليت 
      if(isset($_GET['pagg']) && $_GET['pagg'] == 'Pending'):
        $pagg=' AND reg=0';
      endif;

        //  $value="mkdad";
        //  $check= checkitem("username","users",$value);
        //   if($check ==1 ):
        //     echo "cool";
        //   endif;
        $stmt=$con->prepare("SELECT * FROM users WHERE GroupID !=1 $pagg");
        $stmt ->execute();
        $rows=$stmt->fetchAll();

        //foreach ()
         ?>
          <h1 class="text-center">Mange Members</h1>
          <div class="container">
            <div class="table-responsive">
            <table class="main-table manage-members text-center table table-bordered">
              <tr>
                <td># ID</td>
                <td>Image</td>
                <td>Username</td>
                <td>Email</td>
                <td>FullName</td>
                <td>Registerd Date </td>
                <td>Control</td>
              </tr>
              <?php 
                foreach($rows as $row){
                  echo "<tr>";
                      echo "<td>".$row['UserID']."</td>";
                      echo "<td>";
                      if(empty($row['avatar'])){
                        echo"no image";
                      }else{//style='width: 50px;'
                      echo "<img style='width: 50px;' src='A/B/".$row['avatar']."'alt=''/>";
                    }
                      echo"</td>";
                      echo "<td>".$row['Username']."</td>";
                      echo "<td>".$row['Email']."</td>";
                      echo "<td>".$row['Fullname']."</td>";
                      echo "<td>".$row['Date']."</td>";
                      echo"<td>
                            <a href='mem.php?do=Edit&Us=".$row['UserID']."' class='btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                            <a href='mem.php?do=delet&Us=".$row['UserID']."' class='btn btn-danger'><i class='fa fa-close'></i> Delete </a> ";
                            if($row['reg'] ==0){
                               echo "<a href='mem.php?do=act&Us=".$row['UserID']."' class='btn btn-info'><i class='fa fa-close'></i> Actiate</a>";
                            }
                      echo"</td>";
                  echo"</tr>";
                 echo $Us;
                }
              ?>
              <tr>
           </table>
          </div>
      <a href="mem.php?do=Add"class="btn btn-primary">
        <i class="fa fa-plus "></i> Add new </a>
<?php    }//2
    
    elseif($do=='Add'){// 8 ?>
        

      <h1 class="text-center">Add new Members</h1>
      <div class="container">

        <form class="form-horizontal" action="?do=insert"method="POST" enctype="multipart/form-data">
          <div calss="form-group form-group-lg">
            <label class="col-sm-2 control-label">username</label>
            <div class="col-sm-10">
              <input type="text"name="username"class="form-control"autocomplete="off"required="required"/>
            </div>
          </div>
          <!---->
          <!--user-->
          <div calss="form-group form-group-lg">
          <label class="col-sm-2 control-label">password</label>
            <div class="col-sm-10">
              <input type="password"name="password"class="form-control"autocomplete="new-password"/>
              <i class="show-pass fa fa-eye fa-2x"></i>
            </div>
          </div>
          <!---->
          <!--user-->
          <div calss="form-group form-groub-lg">
          <label class="col-sm-2 control-label">email</label>
            <div class="col-sm-10">
              <input type="email" name="email"class="form-control"required="required"/>
            </div>
          </div>
          <!---->
          <!--user-->
          <div calss="form-group form-group-lg">
          <label class="col-sm-2 control-label">Fullname</label>
            <div class="col-sm-10">
              <input type="text"name="full"class="form-control"required="required"/>
            </div>
          </div>
          <!---->
          <div calss="form-group form-group-lg">
          <label class="col-sm-2 control-label">Image</label>
            <div class="col-sm-10">
              <input type="file"name="avatar"class="form-control"required="required"/>
            </div>
          </div>
          <!--user-->
          <div calss="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit"value="Add"class="btn btn-primary btn-lg"/>
            </div>
          </div>
          <!---->
        </form>
      </div>
       
<?php  
        }// 8 
        elseif($do=='insert'){
              if($_SERVER['REQUEST_METHOD']=='POST'){// insert 1
                // get the varivales from form
               echo "<h1 class='text-center'>Editi Members</h1>";
               echo "<div class='container'>";

               $avatar=$_FILES['avatar'];
               //print_r($avatar);
               echo $_FILES['avatar']['name'].'<br>';
               echo $_FILES['avatar']['size'].'<br>';
               echo $_FILES['avatar']['tmp_name'].'<br>';
               echo $_FILES['avatar']['type'].'<br>';

               $Aname=$_FILES['avatar']['name'];
               $Asize=$_FILES['avatar']['size'];
               $Atmp=$_FILES['avatar']['tmp_name'];
               $Atype=$_FILES['avatar']['type'];

               $imageextion=array("png","gif","jpg","jpeg");

               $AVA=strtolower(end(explode('.',$Aname)));
                //echo $AVA;
                  $user=$_POST['username'];
                  $email=$_POST['email'];
                  $name=$_POST['full'];
                  $pass=$_POST['password'];
                  // sha 1 to passwoord 
                  $hsapass=sha1($_POST['password']);

                  $formError=array();

                  if(strlen($user) < 4):
                    $formError[]="username cant Be less<strong> 4 characters </strong>";
                  endif; 
                  if(strlen($user) > 20):
                    $formError[]="username cant Be more  <strong> 20 characters</strong>";
                  endif; 
                  if(empty($user)):
                    $formError[]="username cant Be Empty";
                  endif; 
                  if(empty($pass)):
                    $formError[]="pass cant Be Empty";
                  endif;
                  if(empty($email) ):
                    $formError[]="email cant Be Empty";
                  endif;
                  if(empty($name)):
                    $formError[]="Full name cant Be Empty";
                  endif; 
                  if(! empty($Aname) && ! in_array($AVA,$imageextion)):
                    $formError[]="No Image";
                  endif;
                  foreach($formError as $error):
                    echo "<div class='alert alert-danger'>".$error . "</div>";
                  endforeach;
                //update to data beas 
                  if(empty($formError)):
                    // check if user exist in data
                      $dataimage=rand(0,1000) . '_' . $Aname;
                      //echo $dataimage;//
                      //move_uploaded_file(string $from, string $to)
                      move_uploaded_file($Atmp,"A\B\\".$dataimage);
                     
                    
                     $check =checkitem("username","users",$user);
                        if ($check ==1):
                          $errmsg="<div class='alert alert-danger'>Sorry you cant Add this user </div>";
                          ReError($errmsg,'back'); 
                        else:
                            $stmt=$con->prepare("INSERT INTO users (Username,Password,Email,Fullname,reg,Date,avatar)
                                                  VALUES ('$user','$hsapass','$email','$name',1,now(),'$dataimage')");
                            $stmt->execute(array($user,$hsapass,$email,$name,$dataimage));

                            $errmsg= "<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                            ReError($errmsg,'back');//Add 
                          endif; 
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
      

    elseif($do=='Edit'){//3/1 editi
          // check if Get request userid is numeric && itval 0 or 1
            $userid=isset($_GET['Us']) &&is_numeric($_GET['Us']) ? intval($_GET['Us']) : 0;
          //echo$userid;
          // select from the data base all userid == 1
            $stmt=$con->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1");
          // Execute الاستخراج  
            $stmt->execute(array($userid));
          // fetch data   
            $row=$stmt->fetch();
          //   
            $count=$stmt->rowcount();

              if($count >0 ) {  // 3/2?>
                                            
              <h1 class="text-center">Editi Members</h1>
              <div class="container">
                <form class="form-horizontal" action="?do=update"method="POST">
                  <div calss="form-group form-group-lg">
                    <input type="hidden" name="userid" value="<?php echo $userid ?>">
                    <label class="col-sm-2 control-label">username</label>
                    <div class="col-sm-10">
                      <input type="text"name="username"value="<?php echo $row['Username']?>"class="form-control"autocomplete="off"required="required"/>
                    </div>
                  </div>
                  <!---->
                  <!--user-->
                  <div calss="form-group form-group-lg">
                  <input type="hidden" name="oldpassword" value="<?php $row['Password'] ?>">
                  <label class="col-sm-2 control-label">password</label>
                    <div class="col-sm-10">
                      <input type="password"name="newpassword"class="form-control"autocomplete="new-password"/>
                    </div>
                  </div>
                  <!---->
                  <!--user-->
                  <div calss="form-group form-groub-lg">
                  <label class="col-sm-2 control-label">email</label>
                    <div class="col-sm-10">
                      <input type="email" value="<?php echo $row['Email']?>"name="email"class="form-control"required="required"/>
                    </div>
                  </div>
                  <!---->
                  <!--user-->
                  <div calss="form-group form-group-lg">
                  <label class="col-sm-2 control-label">Fullname</label>
                    <div class="col-sm-10">
                      <input type="text"name="full"  value="<?php echo $row['Fullname']?>"class="form-control"required="required"/>
                    </div>
                  </div>
                  <!---->
                  <!--user-->
                  <div calss="form-group form-group-lg">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit"value="save"class="btn btn-primary btn-lg"/>
                    </div>
                  </div>
                  <!---->
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
            
      }//3/1
      elseif($do=='update'){ //4/1
            echo'<h1 class="text-center">updata Members</h1>';
            echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD']=='POST'){//4/2
              // get the varivales from form
                $id=$_POST['userid'];
                $user=$_POST['username'];
                $email=$_POST['email'];
                $name=$_POST['full'];
              //echo $id.$user.$name.$email;

                $pass='';
                if(empty($_POST['newpassword'])):
                  $pass=$_POST['oldpassword'];
                else:
                  $pass=sha1($_POST['newpassword']);
                endif;
              // validate form 

                $formError=array();

                if(strlen($user) < 4):
                  $formError[]="<div class='alert alert-danger'>username cant Be less<strong> 4 characters </strong></div>";
                endif; 
                if(strlen($user) > 20):
                  $formError[]="<div class='alert alert-danger'>username cant Be more<strong> 20 characters</strong></div>";
                endif; 
                if(empty($user)):
                  $formError[]="<div class='alert alert-danger'>username cant Be Empty</div>";
                endif; 
                if(empty($email) ):
                  $formError[]="<div class='alert alert-danger'>email cant Be Empty</div>";
                endif;
                if(empty($name)):
                  $formError[]="<div class='alert alert-danger'>Full name cant Be Empty</div>";
                endif; 
                foreach($formError as $error):
                  echo $error;
                endforeach;
              //update to data beas 
                if(empty($formError)):

                  $stmt2=$con->prepare("SELECT * FROM users 
                  WHERE Username=? AND UserID!=?");
                  $stmt2->execute(array($user,$id));
                  $count2=$stmt2->rowCount();

                  if($count2==1):
                    echo "<div class='alert alert-danger'>email cant Be Empty</div>";
                    ReError($errmsg,'back',5);
                  else:
                  $stmt=$con->prepare("UPDATE users SET Username=?,
                  Email=?,Fullname=?,Password=? WHERE UserID=?");
                  $stmt->execute(array($user,$email,$name,$pass,$id));
              // echo message
              // useing function 
                  $errmsg="<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                  ReError($errmsg,'back',5);
                  
                endif;endif;

          }else{//4/2
                $errmsg="<div class='alert alert-success'>.you cant open directory </div> ";
                ReError($errmsg,5);

               
               }//4/2
               echo"<div/>";
          
      }//4/1
      elseif($do=='delet'){
          echo'<h1 class="text-center">Manage Members</h1>';
          echo "<div class='container'>";
          // check if Get request userid is numeric && itval 0 or 1
            $userid=isset($_GET['Us']) && is_numeric($_GET['Us']) ? intval($_GET['Us']) : 0;
          // select from the data base all userid == 1
            //$stmt=$con->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1");
            $check=checkitem('UserID','users',$userid);//name tabel // from // الاستعلام
          // Execute الاستخراج  
            //$stmt->execute(array($userid));
          // fetch data   
          // $row=$stmt->fetch(); //no thing
          //   
           //$count=$stmt->rowcount();

              if($check >0 ) { 
                  $stmt=$con->prepare("DELETE FROM users  WHERE UserID=?");// ???? :::: 
                  //$stmt ->bindParam($user,$userid); not working 
                  $stmt -> execute(array($userid)); 
                  $errmsg="<div class='alert alert-success'>". $stmt ->rowcount()."</div>";
                  ReError($errmsg);  
               }
              else{
                $errmsg="<div class='alert alert-danger'>theres No Id Exist </div>";
                ReError($errmsg);   
              }
                echo "</div>";
        } 
        
        elseif($do =='act'){
            echo'<h1 class="text-center">Activate</h1>';
            echo "<div class='container'>";
          // check if Get request userid is numeric && itval 0 or 1
            $userid=isset($_GET['Us']) && is_numeric($_GET['Us']) ? intval($_GET['Us']) : 0;
          // select from the data base all userid == 1
            $check=checkitem('UserID','users',$userid);//name tabel // from // الاستعلام
                    
            if($check >0 ) { 
                  $stmt=$con->prepare("UPDATE users  SET reg =1  WHERE UserID=?");// ???? :::: 
                  $stmt -> execute(array($userid)); 
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
