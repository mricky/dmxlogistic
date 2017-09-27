<?php /*Added by suwondo */ ?>

<?php include ('../../connections/con_gl.php'); ?>

<?php

$q = strtolower($_GET["q"]);

if (!$q) return;



mysql_select_db($database_con_gl, $con_gl);

$query = mysql_query("select NAMACUSTOMER,ALAMAT,HP,EMAIL,MARKETING from customer where NAMACUSTOMER like '%$q%'order by NAMACUSTOMER asc") or die (mysql_error());

while(list($NAMACUSTOMER, $ALAMAT,$HP,$EMAIL,$MARKETING) = mysql_fetch_row($query)){

	echo "$NAMACUSTOMER \n";

}

?>