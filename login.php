
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel ="stylesheet" a href="css\style.css">
</head>

<body >
<div  class= "back">
<h1 align="center"></h1>
<label class="errmsg">


</label>
<form method="POST" >
<!--   -->
 <div class="login">
<div class="main"
 <b>Enter credentials to login</b>
  
 <p>Email:</p>
   <input type="text" name="email_id" size="30" value="" />
 
  
 <p>Password: </p>
 <input type="password" name="password" size="30" value="" />

  
 <p>
 <input type="submit" name="submit" value="Login" />
 </p>
</div>

 </form>

 <?php 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL); 
  


if(isset($_POST['submit'])){

    $data_missing = array();

     
    if(empty($_POST['email_id'])){
 
        // Adds mail_id to array
        $data_missing[] = 'Email_ID';


    }
    
    else {
 
        // Trim white space from the email and store the mail id
        $mail_id = trim($_POST['email_id']);
 
    }
 
    if(empty($_POST['password'])){
 
        // Adds passowrd to array
        $data_missing[] = 'Password';


    }
    
    else {
 
        // Trim white space from the pass and store the pass
        $password = trim($_POST['password']);
 
    }

    if(empty($data_missing)){
        
        require_once('./mysqli_connect.php');
        
        $query = "SELECT * FROM `login` WHERE  email_id ='$mail_id' AND password = '$password'";
   
        $result = mysqli_query($dbc, $query);
        
        $affected_rows = mysqli_num_rows($result);

        
        
        
        if($affected_rows == 1){
            
            echo "<div class='main'> Login success <br /></div>";
            header("refresh:2; url=home.php");
            
          
            
            mysqli_close($dbc);
            
        } else {
            
            echo 'Incorrect info <br />';
            header("refresh:2; url=login.php");
            //echo mysqli_error();

            
          
            
            mysqli_close($dbc);
            
        }
        
    }
    else {
        
        
        
        foreach($data_missing as $missing){
            
            echo "<div class='main'> $missing  required <br /></div>";
            
            header("refresh:2; url=login.php");
            
        }
        
    }
    
    


   

}


?>
</div>
</div>
</body>
</html>


