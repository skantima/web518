<?php


session_start();
require_once("./mysqli_connect.php");
global $dbc;
ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL); 



  if($_FILES["file"]["name"] != ''){

  	$group_id =  $_POST["id"];
    $user_id = $_SESSION['user_id'];
  	$test = explode(".", $_FILES["file"]["name"]);
    $actual =$_FILES["file"]["name"];
  	$extension =end($test);

    if($extension != 'pdf' && $extension != 'txt' ){

      $name = rand(100,999).time().".".$extension;
    }
  	else{

      $name = $actual;
    }

  	$location = './upload/'.$name;
  	move_uploaded_file($_FILES["file"]["tmp_name"], $location);

    if($extension != 'pdf' && $extension != 'txt'  ){
      $insert = "INSERT INTO posts (user_id,image_content,post_timestamp,group_id)VALUES ('$user_id','$name',NOW(),'$group_id')";

     $run = mysqli_query($dbc,$insert);
    }
    else{

      $insert = "INSERT INTO posts (user_id,file_content,post_timestamp,group_id)VALUES ('$user_id','$name',NOW(),'$group_id')";

     $run = mysqli_query($dbc,$insert);
    }
  	 

  	 if($run){

  	 	        // echo "posted to timeline";
          $update = "update users set posts='yes' where user_id='$user_id'";
          $r_update=mysqli_query($dbc,$update);
          $g_posts = "SELECT * FROM posts INNER JOIN users WHERE posts.group_id='$group_id' and users.user_id=posts.user_id and users.posts = 'yes' ORDER BY post_id DESC LIMIT 1";
          $r_posts =  mysqli_query($dbc,$g_posts);
          if($r_posts->num_rows>0){
             while($row_posts=mysqli_fetch_assoc($r_posts)){ 
            $pos['messages'][] = $row_posts;

        }

         echo json_encode($pos);
          }
  	 	//echo '<img src="'.$location.'" height="150" width="225" class="img-thmbnail" />';
  	 }
  	 else{

  	 	echo "fail";
  	 }

  	
  }

?>