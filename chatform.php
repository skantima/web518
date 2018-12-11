<?php 



session_start();
require_once("./mysqli_connect.php");
global $dbc;
ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL); 


    if(isset($_POST['chat'])){
         $data =  $_POST['chat'];
         $user_id = $_SESSION['user_id'];
         $cuser_id = $data['cuser_id'];
        $content =htmlspecialchars(mysqli_real_escape_string($dbc,$data['content']));

     $insert = "insert into chats(user_id, chat_content, chat_timestamp, chat_user_id) values('$user_id','$content', NOW(),$cuser_id"."$user_id)";
     
        $run = mysqli_query($dbc,$insert);

   
        if($run){
   
   
           echo "chat posted";
           $update = "update users set chat='yes' where user_id='$user_id'";
           $r_update=mysqli_query($dbc,$update);
          
        }

        else{

          echo"failed";
        }
   
       }

if(isset($_POST['gravatar'])){ 

 $mail_id = $_SESSION['email_id'];
 $user_id = $_SESSION['user_id'];
 $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $mail_id ) ) );

    $sql = "update `users` set user_image = '$url' where user_id='$user_id'";
    $r_update=mysqli_query($dbc,$sql);

     $sql1 = "update `users` set img_num = '1' where user_id='$user_id'";
    $r_update1=mysqli_query($dbc,$sql1);
 
}


if(isset($_POST['default'])){ 

 $mail_id = $_SESSION['email_id'];
 $user_id = $_SESSION['user_id'];


    $sql = "update `users` set user_image = '' where user_id='$user_id'";
    $r_update=mysqli_query($dbc,$sql);

     $sql1 = "update `users` set img_num = 0 where user_id='$user_id'";
    $r_update1=mysqli_query($dbc,$sql1);
 
}


if (isset($_POST['action'])) { 

$user_id = $_POST['user_id'];
  // $group_id = $_POST['group_id'];
  $action = $_POST['action'];
  switch ($action) {
    case 'on':
    $sql="update users set security='1' where user_id ='$user_id '";
            
              mysqli_query($dbc, $sql);
              echo "success1";
             
         break;

    case 'off':

      $sql="update users set security='0' where user_id ='$user_id '";
            
              mysqli_query($dbc, $sql);
              echo"success0";
             
         break;

   }
}

?>