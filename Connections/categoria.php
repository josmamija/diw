<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_categoria = "db470193152.db.1and1.com";
$database_categoria = "db470193152";
$username_categoria = "dbo470193152";
$password_categoria = "gesdesc1967";
$categoria = mysql_pconnect($hostname_categoria, $username_categoria, $password_categoria) or trigger_error(mysql_error(),E_USER_ERROR); 
?>