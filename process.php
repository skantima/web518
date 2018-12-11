<?php 
session_start(); 
ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL); 
$rndno=rand(100000, 999999);
//OTP generate 
$message = urlencode("otp number.".$rndno); 
$to=$_POST['email']; 
$subject = "OTP"; 
$txt = "OTP: ".$rndno.""; 
$headers = "From: otp@postmanreply.com" ; 
mail($to,$subject,$txt,$headers); 
if(isset($_POST['encypte'])) 
	{ $_SESSION['name']=$_POST['name']; 
$_SESSION['email']=$_POST['email']; 
$_SESSION['otp']=$rndno;
 header( "Location: otp.php" ); }

 ?>