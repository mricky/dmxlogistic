<?php /*Added by suwondo */ ?>

<?php include ('../../connections/con_gl.php'); ?>

<?php

$q = strtolower($_GET["q"]);

if (!$q) return;



mysql_select_db($database_con_gl, $con_gl);

$query = mysql_query("SELECT IDPENERIMA, NAMAPENERIMA,ALAMAT,TELEPON,FAX,HP,EMAIL FROM penerima where NAMAPENERIMA like '%$q%'order by NAMAPENERIMA asc") or die (mysql_error());

while(list($IDPENERIMA, $NAMAPENERIMA,$ALAMAT,$TELEPON,$FAX,$HP,$EMAIL) = mysql_fetch_row($query)){

	echo "$NAMAPENERIMA \n";

}

?>