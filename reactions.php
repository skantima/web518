
<?php 

require_once("./mysqli_connect.php");
include ("./func.php");
global $dbc;
// if user clicks like , dislike or archive  button
session_start();
if(!isset($_SESSION['email_id']))
  header("Location:login.php");
$mail_id=$_SESSION['email_id'];
$u_id = "SELECT user_id FROM `users` where email_id='$mail_id'";
$un_result= mysqli_query($dbc,$u_id);
$rowu= mysqli_fetch_array($un_result);
$user_id= $rowu['user_id'];

if (isset($_POST['action'])) {
  $post_id = $_POST['post_id'];
  // $group_id = $_POST['group_id'];
  $action = $_POST['action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO rating_info (user_id, post_id, rating_action) 
         	   VALUES ($user_id, $post_id, 'like') 
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
         	    mysqli_query($dbc, $sql);
         	    echo getRating($post_id);
         break;
  	case 'dislike':
          $sql="INSERT INTO rating_info (user_id, post_id, rating_action) 
               VALUES ($user_id, $post_id, 'dislike') 
         	   ON DUPLICATE KEY UPDATE rating_action='dislike'";
         	   mysqli_query($dbc, $sql);
         	    echo getRating($post_id);
         break;
  	case 'unlike':
	      $sql="DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
	      mysqli_query($dbc, $sql);
         	    echo getRating($post_id);
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
      	  mysqli_query($dbc, $sql);
         	    echo getRating($post_id);
      break;

    case 'archive':
         $sql="update archive_info set archive_action='archive' WHERE group_id = $group_id";
              mysqli_query($dbc, $sql);
              echo "success";
        break;

    case 'unarchive':
         $sql="update archive_info set archive_action='unarchive' WHERE group_id = $group_id";
         mysqli_query($dbc, $sql);
        break;

  	default:
  		break;
  }

  // // execute query to effect changes in the database ...
  // mysqli_query($dbc, $sql);
  // echo getRating($post_id);
  exit(0);
}

if (isset($_GET['action'])) {
  // $post_id = $_POST['post_id'];
  $group_id = $_GET['group_id'];
  $action = $_GET['action'];
  switch ($action) {
    

    case 'archive':
         $sql="update archive_info set archive_action='archive' WHERE group_id = $group_id";
              mysqli_query($dbc, $sql);
              echo "success";
        break;

    case 'unarchive':
         $sql="update archive_info set archive_action='unarchive' WHERE group_id = $group_id";
         mysqli_query($dbc, $sql);
        break;

    default:
      break;
  }

  // // execute query to effect changes in the database ...
  // mysqli_query($dbc, $sql);
  // echo getRating($post_id);
  exit(0);
}

?>