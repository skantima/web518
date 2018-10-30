<!DOCTYPE html>
<html>
<head>
<title>All profile</title>
<link rel ="stylesheet" a href="css\uprofile.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>


<?php
    session_start();
    if(!isset($_SESSION['email_id']))
  	header("Location:login.php");
    require_once('./mysqli_connect.php');


    if(isset($_GET['id'])){

         $user_id = $_GET['id'];
         $user="SELECT user_name,user_image,email_id FROM `users` WHERE user_id = '$user_id' ";
       	 $r_user= mysqli_query($dbc,$user);
       	 $row_user=mysqli_fetch_array($r_user);
       	 $user_name = $row_user['user_name'];
       	 $mail=$row_user['email_id'];
       	   if($row_user['user_image']==""){
                $dp="";
                $dp=$dp."default.jpg";
               

              }

              else{

              	$dp =$row_user['user_image'];
              }
         
        $g_name = "SELECT groups.group_name FROM `groups` INNER JOIN `user_groups` where user_groups.user_id='$user_id' AND groups.group_id=user_groups.group_id AND groups.privacy='public' and groups.group_name!='Global'";
      	 $gn_result= mysqli_query($dbc,$g_name);
      	 
       $profile='';
       $profile=$profile."<div class='profilepage'>";
       $profile=$profile."<a style='margin-top:50px;margin-left:50px;' href=home.php <i class='fas fa-chevron-left' ></i></a>";
       $profile=$profile."<H4 style='text-align:center; color:teal; margin-top:0px;'>User Profile</H4><br>";
       $profile=$profile."<div id='aligns'>";
       $profile=$profile."<img width='100' height='100' src ='img/$dp'><br>";
       $profile=$profile."<label>Username:</label>";
       $profile=$profile." $user_name<br><br>";
       $profile=$profile."<label>Email:</label>";
       $profile=$profile." $mail<br><br>";
       $profile=$profile."<label>Public Groups:</label><br>";
       if($result = $gn_result->num_rows > 0)
       {
       while( $rowg= mysqli_fetch_array($gn_result)){
          
           $group_name=$rowg['group_name'];
           
           	$profile=$profile."<li>$group_name</li><br><br>";
           
       
       }
   }else{
   	$profile=$profile."No public groups";
   }
       
       
       $profile=$profile."</div>";
       $profile=$profile."<div id='imgg'style='float:right';>";
       
      
       $profile=$profile."</form>";

       $profile=$profile."</div>";
	  
       $profile=$profile."</div>";
       echo $profile;

    }
    ?>


</body>
</html>