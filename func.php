<?php



function insertpost() {
    if(isset($_POST['pos'])){
        
        require_once("./mysqli_connect.php");
        
        $content =$_POST['content'];
        $mail_id=$_SESSION['email_id'];
        
        $user_query = "SELECT user_id FROM `users` WHERE email_id='$mail_id'";
      
        $user_result= mysqli_query($dbc,$user_query);
        $row= mysqli_fetch_array($user_result);
        $user_id= $row['user_id'];
        
   
        $insert = "insert into posts(user_id, post_content, post_timestamp) values('$user_id','$content', NOW())";
     
        $run = mysqli_query($dbc,$insert);
   
        if($run){
   
   
           echo "posted to timeline";
           $update = "update users set posts='yes' where user_id='$user_id'";
           $r_update=mysqli_query($dbc,$update);
          
        }
   
       }
}


//func for receiving posts

function getpost(){

        require_once("./mysqli_connect.php");
        global $dbc;
        $group_id =  $_GET['id'];
    
        $g_posts = "SELECT * FROM `posts` WHERE group_id='$group_id' ORDER BY post_id DESC";
        $r_posts =  mysqli_query($dbc,$g_posts);

         while($row_posts=mysqli_fetch_array($r_posts)){
         
         $post_id = $row_posts['post_id'];
         $user_id = $row_posts['user_id'];
         $content = $row_posts['post_content'];
         $post_tstamp = $row_posts['post_timestamp'];
         //fetch user details regarding the posts
    
         $user="SELECT * FROM `users` WHERE user_id='$user_id' AND posts='yes' ";
         $r_user= mysqli_query($dbc,$user);
         while($row_user=mysqli_fetch_array($r_user)) {
               $user_name = $row_user['user_name'];
              
              if($row_user['user_image']==""){
                $dp="";
                $dp=$dp."default.jpg";
               

              }

              else{

                $dp =$row_user['user_image'];
              }
           
            }

    
       //display posts
      
       echo "<br>";
       echo "<div id='dis'>";
       echo "<div>";
       echo "<img width='40' height='40' src ='img/$dp' alt= 'ddp'>";
       echo "</div><br>";
       echo "<div id= 'posts' style='float:left;' >";
       echo "<H6><a href='userprofile.php?'>$user_name</a></H6>";
       echo "</div>";
       echo "<p id='tstamp' style='margin-left:100px;'>$post_tstamp</p>";
       echo "<p>$content</p>";

       //like

       if (userLiked($post_id) == true){
         echo "<i class='fa fa-thumbs-up like-btn' data-id=". $post_id . "></i>  ";
       }
      
       else{
        echo "<i class='fa fa-thumbs-o-up like-btn' data-id=". $post_id . "></i>";
        
       }

       echo "<span class='likes'>";
       echo getLikes($post_id);
       echo "</span>";
       echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        
      //dislike
      

       if (userDisLiked($post_id) == true){
        
         echo "<i class='fa fa-thumbs-down dislike-btn' data-id=". $post_id . "></i>  ";
       }
      
       else{
       // echo "<i class='fas fa-thumbs-down dw dislike-btn' data-id=". $post_id . "></i>  ";
        echo "<i class='fa fa-thumbs-o-down dislike-btn' data-id=". $post_id . "></i>";
        
       }

       echo "<span class='dislikes'>";
       echo getDisLikes($post_id);
       echo "</span>";
       echo "&nbsp;&nbsp;&nbsp;&nbsp;";

       //Comment
      
       echo "<a  data-toggle='collapse' href='#".$post_id." '     aria-expanded='false' aria-controls='collapseExample' <i style='margin-left:8px;'class='far fa-comment'></i></a>";
       $string="";
       $string=$string."<div class='collapse' id='".$post_id."'>";
       $string=$string. "<div class='card card-body'>";
       
       //get comments

       $r_comments = "SELECT user_id,comment,comment_timestamp FROM `comments` WHERE post_id='$post_id'";
       $r_comments =  mysqli_query($dbc,$r_comments);
       while($row_comments=mysqli_fetch_array($r_comments)){
       $comment = $row_comments['comment'];
       $comment_tstamp = $row_comments['comment_timestamp'];
       $u_id = $row_comments['user_id'];
       
    
       //fetch user details regarding the posts
    
         $user_c="SELECT * FROM `users` WHERE user_id='$u_id' AND comments='yes' ";
        
         $r_userc= mysqli_query($dbc,$user_c);
         while($row_userc=mysqli_fetch_array($r_userc)) {
               $user_namec = $row_userc['user_name'];
              
              if($row_userc['user_image']==""){
                $dp="";
                $dp=$dp."default.jpg";
               

              }

              else{

                $dp =$row_userc['user_image'];
              }
           
            }

           $string=$string."<div style='float:left; width:25%' >";
           $string=$string."<img width='20' height='20' src ='img/$dp' alt= 'dcdp'></img>";
           $string=$string."</div>";
           $string=$string."<div>";
           $string=$string."<p><font color='blue'>$user_namec</font> says:&nbsp;&nbsp;";
           $string=$string."$comment</p>";
           $string=$string."</div><br>";
       
       


     }

       $string=$string."<form  method='POST' id = 'comment-form".$post_id."' >";
             $string=$string."<input type='hidden' name ='username'  value = ".$user_id. ">";
       $string=$string. "<textarea style='width:60%;'   name='content' placeholder='Leave a comment'  rows='1' cols='100' required></textarea>";
       $string=$string."<input type='submit' style='width:15%;height:34px;margin-top:-20px;'id =". $post_id ." class='btn btn-success submit_cmt'  name='reply'  value='reply' / ><i style='margin-left:8px;'class='fas fa-pencil-alt'></i></form>";

        $string=$string. "</div>";   
        $string=$string. " </div>"; 
       echo $string;
       echo "</div>";


       }
}

function getLikes($post_id)
{
  global $dbc;
  $sql = "SELECT COUNT(*) FROM rating_info 
        WHERE post_id = $post_id AND rating_action='like'";
  $rs = mysqli_query($dbc, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($post_id)
{
  global $dbc;
  $sql = "SELECT COUNT(*) FROM rating_info 
        WHERE post_id = $post_id AND rating_action='dislike'";
  $rs = mysqli_query($dbc, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($post_id)
{
  global $dbc;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = $post_id AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_info 
            WHERE post_id = $post_id AND rating_action='dislike'";
  $likes_rs = mysqli_query($dbc, $likes_query);
  $dislikes_rs = mysqli_query($dbc, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
    'likes' => $likes[0],
    'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($post_id)
{
  global $dbc;
  $mail_id=$_SESSION['email_id'];
$u_id = "SELECT user_id FROM `users` where email_id='$mail_id'";
$un_result= mysqli_query($dbc,$u_id);
$rowu= mysqli_fetch_array($un_result);
$user_id= $rowu['user_id'];
  $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
        AND post_id=$post_id AND rating_action='like'";
  $result = mysqli_query($dbc, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  }else{
    return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($post_id)
{
  global $dbc;
  $mail_id=$_SESSION['email_id'];
$u_id = "SELECT user_id FROM `users` where email_id='$mail_id'";
$un_result= mysqli_query($dbc,$u_id);
$rowu= mysqli_fetch_array($un_result);
$user_id= $rowu['user_id'];
  $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
        AND post_id=$post_id AND rating_action='dislike'";
  $result = mysqli_query($dbc, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  }else{
    return false;
  }
}

function getusergroupid($group_id){

global $dbc;
if(!session_start())
{
  session_start();
}
     $user_id= $_SESSION['user_id'];
      $sqlgetgroupid= "SELECT * from user_groups where user_id ='$user_id' and group_id ='$group_id'";
      $result=mysqli_query($dbc,$sqlgetgroupid);
        if (mysqli_num_rows($result) > 0) {
        return true;
      }else{
        return false;
  }
}

?>