<!DOCTYPE html>

<?php

include ("./func.php"); 


?>
<html>
<head>
<title>Home</title>
<link rel ="stylesheet" a href="css\home.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">

</head>
<body>
<div class="vl">

<?php
session_start();
if(!isset($_SESSION['email_id']))
  header("Location:login.php");
?>



    <nav class="navbar navbar-expand-sm navbar-fixed-top navbar-light mb-3" style="background-color:teal; position: fixed;">
        <div class="container"> 
            <a class="navbar-brand" href="#" style="color:white;">Welcome <?php 
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
                    <a class="nav-link" href="#" style="color:white;">
                   
                    Account</a>
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
      <pre> <H5 style='margin-left:66px;' ><b>Groups</b>    <a style='margin-left:8px;' href=# <i class="fas fa-plus"></i> </a></H5></pre>
       
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
        echo " <a style='color:black;' href='home.php?id=$group_id'> $group_name </a><br> <br>";

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
      
       echo "<form method='POST'>
    
              <fieldset style='margin-top:65px;'>
              <label for='exampleTextarea' style='margin-left: 10px;'> It's time to post</label>
              <br><br>
              
              <textarea style='width:80%;'  id='content'name='content' placeholder='Type something.... :)'  rows='2' cols='100' required></textarea>

              <input type='submit' style='margin-top:-30px;'class='btn btn-primary'  name='pos' value='Post' />
              </fieldset>
              </form>";
    
  //Insert post
      

     if(isset($_POST['pos'])){

     
        if(trim($_POST['content']) == '' || empty($_POST['content'])) {
            //empty field, do something
           
            
            
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

   // Display the posts

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
       $row_user=mysqli_fetch_array($r_user);
       $user_name = $row_user['user_name'];
    
       //display posts
      
       echo "
       <br>
       <div id='dis'>
       <div id= 'posts' style='float:left;' >
        
       <H6><a href='user_profile.php? user_id=$user_id'>$user_name</a></H6>
       </div>
       <p id='tstamp' style='margin-left:100px;'>$post_tstamp</p>
       <p>$content</p>
       
       <i class='far fa-thumbs-up'></i>  
       <i style='margin-left:8px;'class='far fa-thumbs-down'></i>  
       <i style='margin-left:8px;'class='fas fa-reply'></i>
       <a href='reply.php?post_id=$post_id' style='font-size:10px;' >
          reply</a>
       
       </div>
       
          ";

      

       }


   }
  else{

    echo" <div id='index'>
      <H1 style='text-align:center; font-family:ink free; font-size:80px;'><b> Please Select The Group To Display </b> </H1>
      </div>";
  }

       
   

 ?>


 </div>
    <div class="container ">
    <!-- <form method="POST">
    
    <fieldset class="div1">
    <label for="exampleTextarea"> It's time to post</label>
    <br>
    <textarea  id="content"name="content"  rows="4" cols="50"></textarea>
    <br>
    <input type="submit" style="margin-left:320px" class="btn btn-primary"  name="pos" value="Post" />
    
    </fieldset>
    
    
    </form> -->

 
  
    <!--  <div class="posts" style="padding-left:16%;">

        <h5>RECENT</h5>
        <?php

        getpost();

        require_once('./mysqli_connect.php');
        global $dbc;
       $g_posts = "SELECT * FROM `posts` ORDER by post_id DESC";
       $r_posts =  mysqli_query($dbc,$g_posts);
       while($row_posts=mysqli_fetch_array($r_posts)){
    
         $post_id = $row_posts['post_id'];
         $user_id = $row_posts['user_id'];
         $content = $row_posts['post_content'];
         $post_tstamp = $row_posts['post_timestamp'];
       
    
      //fetch user details regarding the posts
    
       $user="SELECT * FROM `users` WHERE user_id='$user_id' AND posts='yes' ";
       $r_user= mysqli_query($dbc,$user);
       $row_user=mysqli_fetch_array($r_user);
       $user_name = $row_user['user_name'];
    
       //display posts
      
       echo "
       <p> ---------------------------------------</p>
       <div id= 'posts' style='float:left;' >
        
       <H6><a href='user_profile.php? user_id=$user_id'>$user_name</a></H6>
       </div>
       <p style='margin-left:100px;'>$post_tstamp</p>
       <p>$content</p>
       <a href='reply.php?post_id=$post_id'>
          Reply </a>
       <p> ---------------------------------------</p>
       
          ";
       }
        ?>  -->

    </div>
    </div>
</body>
</html>