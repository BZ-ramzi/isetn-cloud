<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_isetn = "localhost";
$database_isetn = "isetn";
$username_isetn = "root";
$password_isetn = "";
$isetn = mysql_pconnect($hostname_isetn, $username_isetn, $password_isetn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>