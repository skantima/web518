<!DOCTYPE html>
<html>
<head>
<title>CreateGroup</title>
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
    
   
     $join="";
     $join=$join."<div class='formdiv'>";
     $join=$join."<a id='icon' href=home.php <i class='fas fa-chevron-left' ></i></a>";
     $join=$join."<div class='align'>";
     $join=$join."<form method ='POST' id='join-form'>";
     
     $join=$join."<H4 style='text-align: center;'> Join / Invite to Groups </H4><br><br>";
     $join=$join."Select Group:";
     $sql = "SELECT group_name,privacy FROM groups WHERE privacy='public' and group_name!='Global' or owner_id='$user_id'";
     $run = mysqli_query($dbc,$sql);
      $join=$join."<select id='myselect'>";
     while( $result= mysqli_fetch_array($run)){

          $group_name=$result['group_name'];
          $pri=$result['privacy'];
         
 $join=$join."<option name='group' id='$group_name' value='$group_name'>$group_name    ($pri)</font></option><br>";
        
    }
     $join=$join."</select>";
     $join=$join."<br>";
     $join=$join."<br>Users list:";

        $join=$join."<div class='multiselect'>"; 
        $join=$join."<div class='selectBox' onclick='showCheckboxes()'>"; 
        $join=$join."<select><option>Select users list</option>"; 
        $join=$join."</select>"; 
        $join=$join."<div class='overSelect'></div>"; 
        $join=$join."</div>"; 
        $join=$join."<div id='checkboxes'>"; 
      
         $sqlist = "SELECT user_name,user_id from users";
        $runlist= mysqli_query($dbc,$sqlist);
        while($resultlist = mysqli_fetch_array($runlist)){
            $userlist_name= $resultlist['user_name'];
            $userlist_id = $resultlist['user_id'];
            $join=$join."<label>";
            $join=$join."<input type='checkbox' name='ulist[]'  value='".$userlist_id."'/>$userlist_name</label>";
           

        }
     $join=$join."</div>";
     $join=$join."</div>";




     $join=$join."<input type='submit' name='join' value='invite' class='btn btn-success invite-users' style='float:right;margin-right: -59px;'/>";
     $join=$join."</form>";
     $join=$join."</div>";
     $join=$join."</div>";
     echo $join;
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
