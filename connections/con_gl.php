<?php

error_reporting(0);

# FileName="Connection_php_mysql.htm"

# Type="MYSQL"

# HTTP="true"
session_start();
date_default_timezone_set('Asia/Jakarta');



/*

$hostname_con_gl = "localhost";

$database_con_gl = "db_bimex";

$username_con_gl = "root";

$port_con_gl = "3306";

$password_con_gl = "";

*/



//bimex server

/*

$hostname_con_gl = "localhost";

$database_con_gl = "bimextou_system";

$username_con_gl = "bimextou_system";

$password_con_gl = "bimex123tour";

*/

$hostname_con_gl = "localhost";

$database_con_gl = "k9959829_dmxonline";

$username_con_gl = "k9959829";

$password_con_gl = "Pq73e5j2Pi";

$con_gl = mysql_pconnect($hostname_con_gl.":".$port_con_gl, $username_con_gl, $password_con_gl) or trigger_error(mysql_error(),E_USER_ERROR); 



mysql_select_db($database_con_gl,$con_gl);

function simple_encrypt($str){

	$rts = strrev($str);

	return base64_encode($rts);

}



function simple_decrypt($str){

	$rts = base64_decode($str);

	return strrev($rts);

}

?>