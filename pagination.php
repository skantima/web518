<?php
session_start();
require_once("./mysqli_connect.php");
global $dbc;

$record_per_page = 5;
$page = '';


 if(isset($_GET['group_messages'])){
 	$data = $_GET['group_messages'];
    $group_id =  $data['g_msg'];
          $user_id = $_SESSION['user_id'];

          if(isset($data['page'])){

          	$page = $data['page'];
          }
          else{
 			$page = 1;

          }
        
           

                    //$group_id= $data['group_id'];
$start_from = ($page - 1)*$record_per_page;
$g_posts = "SELECT * FROM posts INNER JOIN users JOIN archive_info WHERE posts.group_id='$group_id' and users.user_id=posts.user_id and users.posts = 'yes' and archive_info.group_id = posts.group_id ORDER BY posts.post_id DESC LIMIT $start_from, $record_per_page";
$r_posts =  mysqli_query($dbc,$g_posts);

          if($r_posts->num_rows>0){
             while($row_posts=mysqli_fetch_assoc($r_posts)){ 
            $groupMessages['messages'][] = $row_posts;
             }  
          }else{

           $groupMessages['messages'] = "noposts";
        }
        echo json_encode($groupMessages);

  }



    

?>


