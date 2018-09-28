<?php  

DEFINE('DB_USER','root');
DEFINE('DB_PASSWORD', 'Raina123');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME', 'web_prj');


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
OR dies('Could not connect'. mysqli_connect_error());
?>