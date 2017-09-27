<?php /*Added by suwondo */ ?>

<?php include ('../../connections/con_gl.php'); ?>

<?php

$q = strtolower($_GET["q"]);

if (!$q) return;



mysql_select_db($database_con_gl, $con_gl);

$query = mysql_query("select ID_AGENT,KODEAGENT,NAMAAGENT from agent where NAMAAGENT like '%$q%'") or die (mysql_error());

while(list($id, $kodeagent, $namaagent) = mysql_fetch_row($query)){

	echo "$namaagent \n";

}

?>