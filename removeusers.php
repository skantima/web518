<!DOCTYPE html>
<html>
<head>
<title>Join</title>
<link rel ="stylesheet" a href="css\join.css">
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

    global $dbc;
    $user_id = $_SESSION['user_id'];
    
   
     $remove="";
     $remove=$remove."<div class='formdiv'>";
     $remove=$remove."<a id='icon' href=home.php <i class='fas fa-chevron-left' ></i></a>";
     $remove=$remove."<div class='align'>";
     $remove=$remove."<form method ='POST' id='remove-form'>";
     
     $remove=$remove."<H4 style='text-align: center;'> Remove users from group </H4><br><br>";
     $remove=$remove."Select Group:";
     
     $sql = "SELECT group_name,privacy FROM groups";

     
     
     $run = mysqli_query($dbc,$sql);
      $remove=$remove."<select id='myselect'>";
     while( $result= mysqli_fetch_array($run)){

          $group_name=$result['group_name'];
          $pri=$result['privacy'];
         
 $remove=$remove."<option name='group' id='$group_name' value='$group_name'>$group_name    ($pri)</font></option><br>";
        
    }
     $remove=$remove."</select>";
     $remove=$remove."<br>";
     $remove=$remove."<br>Users list:";

        $remove=$remove."<div class='multiselect'>"; 
        $remove=$remove."<div class='selectBox' onclick='showCheckboxes()'>"; 
        $remove=$remove."<select><option>Select users list</option>"; 
        $remove=$remove."</select>"; 
        $remove=$remove."<div class='overSelect'></div>"; 
        $remove=$remove."</div>"; 
        $remove=$remove."<div id='checkboxes'>"; 
      
         $sqlist = "SELECT user_name,user_id from users where user_id != 20";
        $runlist= mysqli_query($dbc,$sqlist);
        while($resultlist = mysqli_fetch_array($runlist)){
            $userlist_name= $resultlist['user_name'];
            $userlist_id = $resultlist['user_id'];
            $remove=$remove."<label>";
            $remove=$remove."<input type='checkbox' name='ulist[]'  value='".$userlist_id."'/>$userlist_name</label>";
           

        }
     $remove=$remove."</div>";
     $remove=$remove."</div>";




     $remove=$remove."<input type='submit' name='join' value='remove' class='btn btn-danger remove-users' style='float:right;margin-right: -59px;'/>";
     $remove=$remove."</form>";
     $remove=$remove."</div>";
     $remove=$remove."</div>";
     echo $remove;
?>
<script >
  var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>
<script src="script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
</body>
</html>
