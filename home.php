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
                
                
                 
                
               
                </li>
                <li class="nav-item" >
                    <a class="nav-link" href="logout.php" style="color:white;">
                   
                    Logout</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" href="help.html" style="color:white;">
                   
                    <i class="fas fa-info"></i></a>
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
                        <?php 
                         require_once("./mysqli_connect.php");  
                         global $dbc;
                         $user_id = $_SESSION['user_id'];
                         if($user_id == '20') 
                         {
                           echo "<a class='dropdown-item' href='removeusers.php'>Remove users from a group</a>";
                         }

                        ?>
                        

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
        echo " <a style='color:white;' href='home.php?id=$group_id' id=".$group_id." class='group_details'> $group_name </a>";
        if($user_id == '20') 
        {
              echo "&nbsp;";
              if (archive($group_id) == true){

                echo "<i class='fas fa-unlock arch' style='float:right; margin-right:15px;' data-id=". $group_id . " ></i>";
              
              }
              else{

                
                echo "<i class='fas fa-archive arch' style='float:right; margin-right:15px;' data-id=". $group_id . "></i>";
              }
              
             
             

        }
        echo "<br><br>";

       }

        
       ?>
      <textarea class ="search"  id = "search" placeholder="Search.."name="search" rows="2"></textarea>
       <div id ='searchbar' style="width: 100%;"></div>
       
  </H6>
    </div>
     
   </div>
 
      
 </div>


 <div class="clearfix" id='darea'>


    <?php
   require_once("./mysqli_connect.php");  
   global $dbc;

   echo "<div id = 'displayposts'>";

   // if(isset($_GET['id'])){
   //     $uid=$_SESSION['user_id'];
   //     $gid = $_GET['id'];
   //    $sqlgetgroupid= "SELECT group_id from user_groups where user_id = '$uid' and group_id = '$gid'";
   //    $rungetgroupid=mysqli_query($dbc,$sqlgetgroupid);
   //    $resultgroupid = mysqli_fetch_array($rungetgroupid);
   //    $g_id = $resultgroupid['group_id'];
      

      
   //    if($g_id =="")
   //    {
      
   //      header("Location:home.php");
   //      die();
   //    }

   //     echo "<div id='mainform'>
   //            <form method='POST' id = 'post-form".$gid."'>
    
   //            <fieldset style='margin-top:75px;'>
   //            <label for='exampleTextarea' style='margin-left: 10px;'> It's time to post</label>
   //            <br><br>
              
   //            <textarea style='width:80%;'  id='content'name='content' placeholder='Type something.... :)'  rows='2' cols='100' required></textarea>

   //            <input type='submit' style='margin-top:-30px;'class='btn btn-primary submit_post' id=". $gid ."  name='pos' value='Post' />
   //            </fieldset>
   //            </form></div>";
      
     
    
 


   // }
  // else{
   
    echo" <div id='index'>

      
        <img src='./bgd.PNG'></img>
      </div>";
      echo "<div id='dpost' style='margin-bottom:10px;'></div>";
      echo "<div id='loadmore' style='margin-left:280px;'></div>";
      echo "<div id ='pagination_data'></div>";

// }


echo "</div>"; 

?>


 </div>


    </div>
    </div>
     <script src="script.js"></script>
     <script src="pag.js"></script>
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
</body>
</html>