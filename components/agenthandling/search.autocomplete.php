<?php /*Added by suwondo */ ?>

<?php include ('../../connections/con_gl.php'); ?>

<?php

$q = strtolower($_GET["q"]);

if (!$q) return;



mysql_select_db($database_con_gl, $con_gl);

$query = mysql_query("select ID,NAMA from agenthanding where NAMA like '%$key%'") or die (mysql_error());

while(list($id, $jenis) = mysql_fetch_row($query)){

	echo "$NAMA \n";

}

?>