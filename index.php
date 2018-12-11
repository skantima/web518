
<!DOCTYPE html>
<html lang ="en">

<head>
  <meta charset="UTF-8">
<title>Login</title>
<link rel ="stylesheet"  href="css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body >

<div  class= "back">

<label class="errmsg">


</label>
<form method="POST" >

 <div class="login">
<div class="main">
<b>Enter credentials to login</b>
<br>
<br>
Email:<br>
<i class="fas fa-user" style="margin-right: 5px;"></i> <input type="text" name="email_id" size="30" value="" />
<br>
<br>
 Password:<br>
<i class="fas fa-key" style="margin-right: 5px;"></i> <input type="password" name="password" size="30" value="" />

<br>
<br>
<br>
<div class="g-recaptcha" data-sitekey="6Ld6Q30UAAAAAGM7NEX7UULYA38U1atfuZR-_rTj"></div><br>
 <input type="submit" class="btn btn-success " style="color:black; font-weight:bold;"  name="submit" value="Login" />
 <a href="signup.php" class="btn btn-primary" style="color:black; font-weight:bold;">Signup</a>

</div>
</div>
 </form>

 <?php 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL); 
  session_start();
  require_once('./mysqli_connect.php');



if(isset($_POST['submit'])){
    global $dbc;

    $data_missing = array();

     
    if(empty($_POST['email_id'])){
 
        // Adds mail_id to array
        $data_missing[] = 'Email_ID';


    }
    
    else {
 
        // Trim white space from the email and store the mail id
        $mail_id = trim(mysqli_real_escape_string($dbc,$_POST['email_id']));
 
    }
 
    if(empty($_POST['password'])){
 
        // Adds passowrd to array
        $data_missing[] = 'Password';


    }
    
    else {
 
        // Trim white space from the pass and store the pass
        $password = trim(mysqli_real_escape_string($dbc,$_POST['password']));
 
    }


    $secretkey = '6Ld6Q30UAAAAABzz6pGI4h9q8psw1EpO85Hu0C1Z';
    $responsekey =  $_POST['g-recaptcha-response'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$responsekey";
    $response = file_get_contents($url);
    $validation = json_decode($response);

   if($validation->success == 1){


      if(empty($data_missing)){
        
        require_once('./mysqli_connect.php');

        
        $query = "SELECT * FROM `users` WHERE  email_id ='$mail_id' AND password = '$password'";
   
        $result = mysqli_query($dbc, $query);
        
        $affected_rows = mysqli_num_rows($result);

        
        
        
        if($affected_rows == 1){
           $rowg= mysqli_fetch_array($result);
           $user_id = $rowg['user_id'];
           $mail_id = $rowg['email_id'];
           $security = $rowg['security'];
           $_SESSION['email_id']=$mail_id;
           $_SESSION['user_id']=$user_id;

      
            if($security == '0'){
            echo "<div class='main'><br><br><br><br> Login success <br /></div>";
            header("refresh:1; url=home.php");
            }

            else{

            
            header("Location:secondfactor.php");
            }
           
            
          
            
            mysqli_close($dbc);
            
        } else {
            
            echo "<div class='main'><br><br><br><br>Incorrect info <br /></div>";
            
            header("refresh:2; url=index.php");
           // echo mysqli_error();

            
          
            
            mysqli_close($dbc);
            
        }
        
    }
    else {
        
        
        
        foreach($data_missing as $missing){
            
            echo "<div class='main'><br><br><br><br> $missing  required <br /></div>";
            
            header("refresh:2; url=login.php");
            
        }
        
    }


}

else{

  echo "Verify if you are a human! ";
   header("refresh:1; url=login.php");
}
   


   

}


?>
</div>

</body>
</html>


