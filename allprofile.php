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
         
        $g_name = "SELECT groups.group_name,groups.group_id FROM `groups` INNER JOIN `user_groups` where user_groups.user_id='$user_id' AND groups.group_id=user_groups.group_id AND groups.privacy='public' and groups.group_name!='Global'";
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
           $group_id = $rowg['group_id'];
           
           	$profile=$profile."<li>$group_name  ";

          $countsql = "select count(*) from rating_info inner join posts where posts.group_id ='$group_id' and rating_info.user_id = '$user_id' and rating_info.post_id = posts.post_id";
            $cnt_result= mysqli_query($dbc,$countsql);
            $row_count= mysqli_fetch_array($cnt_result);
             $count = $row_count['count(*)'];


          $countsql1 = "select count(*) from posts where user_id='$user_id' and group_id='$group_id'";
          $cnt1_result=mysqli_query($dbc,$countsql1);
          $row_count1=mysqli_fetch_array($cnt1_result);
          $count1 = $row_count1['count(*)'];
          echo  $count1;
            
            if($count1 >=2 && $count >=2)
            {
                  for($i =1; $i<=5; $i++ )
                  {
                    $profile=$profile."<i class='fas fa-star' style='color:orange'></i>";

                  }
                    $profile=$profile."100%</li> <br>";

            }

            else if($count1 >=2 && $count==1){

                 for($i =1; $i<=1; $i++ )
                  {

                     for($j =1; $j<=3; $j++ )
                     {
                       $profile=$profile."<i class='fas fa-star' style='color:orange'></i>";

                      }
                    
                     $profile=$profile."<i class='far fa-star'></i>";
                     $profile=$profile."<i class='far fa-star'></i>";
                  }
                  $profile=$profile."70%</li> <br>";

            }

            else if(($count1 >=1 && $count1<2) && ($count >=1)){

                 for($i =1; $i<=1; $i++ )
                  {

                     for($j =1; $j<=2; $j++ )
                     {
                       $profile=$profile."<i class='fas fa-star' style='color:orange'></i>";
                      }
                     $profile=$profile."<i class='fas fa-star-half' style='color:orange'></i>";
                     $profile=$profile."<i class='far fa-star'></i>";
                     $profile=$profile."<i class='far fa-star'></i>";
                  }
                  $profile=$profile."50%</li> <br>";

            }
            else{
                    for($i =1; $i<=5; $i++ )
                  {
                    $profile=$profile."<i class='far fa-star'></i>";
                  }
                  $profile=$profile."0%</li> <br>";

            } 

           
          

           
       
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