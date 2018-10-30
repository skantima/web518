<!DOCTYPE html>
<html>
<head>
<title>CreateGroup</title>
<link rel ="stylesheet" a href="css\uprofile.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">

</head>
<body>
<div>


<?php
    session_start();
    if(!isset($_SESSION['email_id']))
  	header("Location:login.php");
    require_once('./mysqli_connect.php');


    global $dbc;
    $mail = $_SESSION['email_id'];
      $user="SELECT user_name,user_id,user_image FROM `users` WHERE email_id = '$mail' ";
       $r_user= mysqli_query($dbc,$user);
       $row_user=mysqli_fetch_array($r_user);
       $user_name = $row_user['user_name'];
       $user_id = $row_user['user_id'];
       if($row_user['user_image']==""){
                $dp="";
                $dp=$dp."default.jpg";
               

              }

              else{

              	$dp =$row_user['user_image'];
              }
       $g_name = "SELECT groups.group_name FROM `groups` INNER JOIN `user_groups` where user_groups.user_id='$user_id' AND groups.group_id=user_groups.group_id AND groups.privacy='public'";
       $gn_result= mysqli_query($dbc,$g_name);
       
if(isset($_POST['submit'])){
$msg="";
global $dbc;
$file=$_FILES['img'];

$fileName=$_FILES['img']['name'];
$fileTmpName=$_FILES['img']['tmp_name'];
$fileSize=$_FILES['img']['size'];
$fileError=$_FILES['img']['error'];
$fileType=$_FILES['img']['type'];


$fileExt = explode('.',$fileName);
$fileActualExt= strtolower(end($fileExt));

$allowed = array('jpg', 'jpeg' , 'png');
if(in_array($fileActualExt, $allowed)){

	if($fileError === 0){
		if($fileSize<500000)
		{
			$fileNameNew = $user_id.".".$fileActualExt;
			$fileDesitnation = 'img/'.$fileNameNew;
			move_uploaded_file($fileTmpName, $fileDesitnation);

			$sql = "update `users` set user_image = '$fileNameNew' where user_id='$user_id'";

			$r_update=mysqli_query($dbc,$sql);			
			header("Location:userprofile.php?uploadsuccess");
		}
		else{

			echo "file is too big";
		}
	}
	else{
		echo "error uploading";
	}
}
else{

	echo "you cannot upload file of this type";

}


  }   

       $profile='';
       $profile=$profile."<div class='profilepage'>";
       $profile=$profile."<a style='margin-top:50px;margin-left:50px;' href=home.php <i class='fas fa-chevron-left' ></i></a>";
       $profile=$profile."<H4 style='text-align:center; color:teal; margin-top:0px;'>User Profile</H4><br>";
       $profile=$profile."<div id='aligns'>";
       $profile=$profile."<label>Username:</label>";
       $profile=$profile." $user_name<br><br>";
       $profile=$profile."<label>Email:</label>";
       $profile=$profile." $mail<br><br>";
       $profile=$profile."<label>Groups:</label><br><br>";
       while( $rowg= mysqli_fetch_array($gn_result)){

           $group_name=$rowg['group_name'];
       $profile=$profile."<li>$group_name</li><br><br>";
       }
       
       
       $profile=$profile."</div>";
       $profile=$profile."<div id='imgg'style='float:right';>";
       $profile=$profile."<img width='100' height='100' src ='img/$dp'>";
       $profile=$profile."<form method='POST' enctype='multipart/form-data'>";
       $profile=$profile."<input type='file' class='btn btn-light'name='img' value='choose'/><br>";
       $profile=$profile."<input type='submit' name='submit' class='btn btn-success' value='upload'/>";
       $profile=$profile."</form>";

       $profile=$profile."</div>";
	  
       $profile=$profile."</div>";


       echo $profile;
        
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
</body>
</html>