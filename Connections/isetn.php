<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_isetn = "localhost";
$database_isetn = "isetn";
$username_isetn = "root";
$password_isetn = "";

$isetn = new PDO('mysql:host='.$hostname_isetn.';dbname='.$database_isetn.', '.$username_isetn.', '.$password_isetn.'');
?>