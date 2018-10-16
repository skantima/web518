
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel ="stylesheet" a href="css\style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
</head>

<body >

<div  class= "back">
<h1 align="center"></h1>
<label class="errmsg">


</label>
<form method="POST" >
<!--   -->
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
<p> 
<br>
 <input type="submit" class="btn btn-success " style="color:black; font-weight:bold;"  name="submit" value="Login" />
 </p>
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

    if(empty($data_missing)){
        
        require_once('./mysqli_connect.php');

       
        
        $query = "SELECT * FROM `users` WHERE  email_id ='$mail_id' AND password = '$password'";
   
        $result = mysqli_query($dbc, $query);
        
        $affected_rows = mysqli_num_rows($result);

        
        
        
        if($affected_rows == 1){
           
           $_SESSION['email_id']=$mail_id;
      

            echo "<div class='main'><br><br><br><br> Login success <br /></div>";
            header("refresh:1; url=home.php");
            
          
            
            mysqli_close($dbc);
            
        } else {
            
            echo "<div class='main'><br><br><br><br>Incorrect info <br /></div>";
            
            header("refresh:2; url=login.php");
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


?>
</div>
</div>
</body>
</html>


