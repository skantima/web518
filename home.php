<!DOCTYPE html>


<html>
<head>
<title>Home</title>
<link rel ="stylesheet" a href="css\home.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

</head>
<body style="background-color: #fffdf6;">
<div class="vl">

<?php

if(!session_start())
{
  session_start();
}
if(!isset($_SESSION['email_id']))
  header("Location:login.php");
?>
<?php



include ("./func.php");
?>


    <nav class="navbar navbar-expand-sm navbar-fixed-top navbar-light mb-3" style="background-color:#155e63; position: fixed;">
        <div class="container"> 
            <a class="navbar-brand" href=<?php echo"allprofile.php?id=".$_SESSION['user_id'] ?> style="color:white;">Welcome <?php 
            require_once("./mysqli_connect.php");
    
            $mail_id=$_SESSION['email_id'];
            $u_nameq = "SELECT user_name FROM `users` where email_id='$mail_id'";
            $un_result= mysqli_query($dbc,$u_nameq);
            $rowu= mysqli_fetch_array($un_result);

              $user_name= $rowu['user_name'];
              echo $user_name;
          ?></a>
            <ul class="navbar-nav" >
                <li class="nav-item">
                    <a class="nav-link" href="home.php" style="color:white;">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="userprofile.php" style="color:white;">Account</a>
                      
                    

                </li>
                <li class="nav-item" >
                    <a class="nav-link" href="logout.php" style="color:white;">
                   
                    Logout</a>
                </li>
                
            </ul>
         </div>  
    </nav>
  
 <div id="content">

   <div id="usertimeline">

    <div id="groupdetails">
       <br>

 <div class="dropdown show" > 
      <a class="btn dropdown-toggle " style='margin-left:8px;' href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <i class="fas fa-plus"></i><b>Groups</b> </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="creategroup.php">Create Group</a>
                        <a class="dropdown-item" href="joinpublicgroup.php">Join/invite to Group</a>
                        <!--  -->

                                 <!--  -->
                      </div>
                    </div>

     
        
                      

                    
       <br>
   
   <H6>
  
       <?php
          
        require_once("./mysqli_connect.php");  
        global $dbc;    
        $mail_id=$_SESSION['email_id'];
        $u_id = "SELECT user_id FROM `users` where email_id='$mail_id'";
        $un_result= mysqli_query($dbc,$u_id);
        $rowu= mysqli_fetch_array($un_result);
        $user_id= $rowu['user_id'];
        $g_name = "SELECT groups.group_name,groups.group_id FROM `groups` INNER JOIN `user_groups` where user_groups.user_id='$user_id' AND groups.group_id=user_groups.group_id";
        $gn_result= mysqli_query($dbc,$g_name);
       while( $rowg= mysqli_fetch_array($gn_result)){

           $group_name=$rowg['group_name'];
           $group_id = $rowg['group_id'];
        echo " <a style='color:white;' href='home.php?id=$group_id'> $group_name </a><br> <br>";


       }
        
       ?>
       
  </H6>
    </div>
     
   </div>
 
      
 </div>


 <div class="clearfix" id='darea'>

    <?php
   require_once("./mysqli_connect.php");  
   global $dbc;
   if(isset($_GET['id'])){
       $uid=$_SESSION['user_id'];
       $gid = $_GET['id'];
      $sqlgetgroupid= "SELECT group_id from user_groups where user_id = '$uid' and group_id = '$gid'";
      $rungetgroupid=mysqli_query($dbc,$sqlgetgroupid);
      $resultgroupid = mysqli_fetch_array($rungetgroupid);
      $g_id = $resultgroupid['group_id'];
      

      
      if($g_id =="")
      {
      
        header("Location:home.php");
        die();
      }

       echo "<form method='POST'>
    
              <fieldset style='margin-top:75px;'>
              <label for='exampleTextarea' style='margin-left: 10px;'> It's time to post</label>
              <br><br>
              
              <textarea style='width:80%;'  id='content'name='content' placeholder='Type something.... :)'  rows='2' cols='100' required></textarea>

              <input type='submit' style='margin-top:-30px;'class='btn btn-primary'  name='pos' value='Post' />
              </fieldset>
              </form>";
      
    
  //Insert post
      

     if(isset($_POST['pos'])){

     
        if(trim($_POST['content']) == '' || empty($_POST['content'])) {
        }
    
        else{


    global $dbc;
    $group_id =mysqli_real_escape_string($dbc,$_GET['id']);
    $content =htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['content']));
    $mail_id=mysqli_real_escape_string($dbc,$_SESSION['email_id']);
    $user_query = "SELECT user_id FROM `users` WHERE email_id='$mail_id'";
  

  
    $user_result= mysqli_query($dbc,$user_query);
    $row= mysqli_fetch_array($user_result);
    $user_id= $row['user_id'];
    

    $insert = "insert into posts(user_id, post_content, post_timestamp,  group_id) values('$user_id','$content', NOW(),'$group_id')";
 
    $run = mysqli_query($dbc,$insert);

    if($run){


      // echo "posted to timeline";
       $update = "update users set posts='yes' where user_id='$user_id'";
       $r_update=mysqli_query($dbc,$update);

      
    }

   }
}
  getpost();
   // Display the posts

      //  $group_id =  $_GET['id'];
       
      //  $g_posts = "SELECT * FROM `posts` WHERE group_id='$group_id' ORDER BY post_id DESC";

      //  $r_posts =  mysqli_query($dbc,$g_posts);
      //  while($row_posts=mysqli_fetch_array($r_posts)){
         
      //    $post_id = $row_posts['post_id'];
      //    $user_id = $row_posts['user_id'];
      //    $content = $row_posts['post_content'];
      //    $post_tstamp = $row_posts['post_timestamp'];
         
       
    
      // //fetch user details regarding the posts
    
      //  $user="SELECT * FROM `users` WHERE user_id='$user_id' AND posts='yes' ";
      //  $r_user= mysqli_query($dbc,$user);
       
       
      //    while($row_user=mysqli_fetch_array($r_user)) {

      //         $user_name = $row_user['user_name'];
              
      //         if($row_user['user_image']==""){
      //           $dp="";
      //           $dp=$dp."default.jpg";
               

      //         }

      //         else{

      //           $dp =$row_user['user_image'];
      //         }
           
      //       }

    
      //  //display posts
      
      //  echo "<br>";
      //  echo "<div id='dis'>";
      //  echo "<div>";
      //  echo "<img width='40' height='40' src ='img/$dp' alt= 'ddp'>";
      //  echo "</div><br>";
      //  echo "<div id= 'posts' style='float:left;' >";
      //  echo "<H6><a href='userprofile.php?'>$user_name</a></H6>";
      //  echo "</div>";
      //  echo "<p id='tstamp' style='margin-left:100px;'>$post_tstamp</p>";
      //  echo "<p>$content</p>";

      //  //like

      //  if (userLiked($post_id) == true){
      //    echo "<i class='fa fa-thumbs-up like-btn' data-id=". $post_id . "></i>  ";
      //  }
      
      //  else{
      //   echo "<i class='fa fa-thumbs-o-up like-btn' data-id=". $post_id . "></i>";
        
      //  }

      //  echo "<span class='likes'>";
      //  echo getLikes($post_id);
      //  echo "</span>";
      //  echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        
      // //dislike
      

      //  if (userDisLiked($post_id) == true){
        
      //    echo "<i class='fa fa-thumbs-down dislike-btn' data-id=". $post_id . "></i>  ";
      //  }
      
      //  else{
      //  // echo "<i class='fas fa-thumbs-down dw dislike-btn' data-id=". $post_id . "></i>  ";
      //   echo "<i class='fa fa-thumbs-o-down dislike-btn' data-id=". $post_id . "></i>";
        
      //  }

      //  echo "<span class='dislikes'>";
      //  echo getDisLikes($post_id);
      //  echo "</span>";
      //  echo "&nbsp;&nbsp;&nbsp;&nbsp;";

      //  //Comment
      
      //  echo "<a  data-toggle='collapse' href='#".$post_id." '     aria-expanded='false' aria-controls='collapseExample' <i style='margin-left:8px;'class='far fa-comment'></i></a>";
      //  $string="";
      //  $string=$string."<div class='collapse' id='".$post_id."'>";
      //  $string=$string. "<div class='card card-body'>";


      //  $r_comments = "SELECT comment,comment_timestamp FROM `comments` WHERE post_id='$post_id'";
      //  $r_comments =  mysqli_query($dbc,$r_comments);
      //  while($row_comments=mysqli_fetch_array($r_comments)){
      //  $comment = $row_comments['comment'];
      //  $comment_tstamp = $row_comments['comment_timestamp'];
      //  $string=$string.$comment;
      //  $string=$string.$comment_tstamp;

      // }

      //  $string=$string."<form  method='POST' id = 'comment-form".$post_id."' >";
      //        $string=$string."<input type='hidden' name ='username'  value = ".$user_id. ">";
      //  $string=$string. "<textarea style='width:50%;'   name='content' placeholder='Leave a comment'  rows='1' cols='100' required></textarea>";
      //  $string=$string."<input type='submit' style='width: 6%;height:34px;margin-top:-15px;'id =". $post_id ." class='btn btn-primary-sm submit_cmt'  name='reply'  /></form>";
       
       
      //   $string=$string. "</div>";   
      //   $string=$string. " </div>"; 
      //  echo $string;
      //  echo "</div>";


      //  }


   }
  else{

    echo" <div id='index'>
      
        <img src='./bgd.PNG'></img>
      </div>";
}
?>


 </div>


    </div>
    </div>
     <script src="script.js"></script>
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
</body>
</html>