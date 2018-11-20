<?php  
DEFINE('DB_USER','admin');
DEFINE('DB_PASSWORD', 'monarchs');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME', 'web_prj');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
?>