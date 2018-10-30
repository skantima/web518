


<?php
session_start();
require_once("./mysqli_connect.php");
global $dbc;
ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL); 



 if (isset($_POST['reply'])){
 	
 	  $data =  $_POST['reply'];
    $user_id = $_SESSION['user_id'];
    $post_id = $data['post_id'];
    $comment = htmlspecialchars(mysqli_real_escape_string($dbc,$data['comment']));



 
  
 $insert = "INSERT INTO comments (post_id,user_id,comment,comment_timestamp)VALUES ('$post_id','$user_id','$comment',NOW())";

                $run = mysqli_query($dbc,$insert);
                echo "inserted";
               if($run){

               	$update = "update users set comments='yes' where user_id='$user_id'";
       		    $r_update=mysqli_query($dbc,$update);
               }
               else{

               	echo "fail".$insert;
               }
        

           

       }

 if (isset($_POST['join'])){


 

 $data =  $_POST['join'];

    
    $group_name = $data['group_name'];
    $user_id = $data['user_id'];
    $seuser_id = $_SESSION['user_id'];

    $sql= "SELECT group_id FROM groups WHERE group_name='$group_name'";
    $run=mysqli_query($dbc,$sql);
    $result=mysqli_fetch_array($run);
    $group_id=$result['group_id'];

          if(!empty($user_id))
                {

                   foreach ($user_id as $ulist)
                 {
                         $userfetch = "SELECT group_id from user_groups where user_id='$ulist' and group_id ='$group_id'";
                         $runfetch = mysqli_query($dbc,$userfetch);
                         $result = mysqli_fetch_array($runfetch);
                         $dupuser = $result['group_id'];
                         
                     
                         if($group_id == $dupuser)
                         {


                         }
                         else{


                          $userinsert = "INSERT into user_groups(user_id,group_id) values ('$ulist', '$group_id')";
                          $rin=mysqli_query($dbc,$userinsert);
                         }


                  } 
                }

          else{

          $insert="INSERT INTO user_groups(user_id,group_id) VALUES('$user_id','$group_id')";
          $r=mysqli_query($dbc,$insert);
          if($r){

           echo "success";
            }
    
          else{

           echo "fail".$insert;
             }

          }


  

 }


 ?>