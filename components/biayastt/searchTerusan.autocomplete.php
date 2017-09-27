<?php /*Added by suwondo */ ?>
<?php include ('../../connections/con_gl.php'); ?>
<?php
$q = strtolower($_GET["q"]);
if (!$q) return;

mysql_select_db($database_con_gl, $con_gl);
$query = mysql_query("select id, kode_airport,airport from gl_airport where airport like '%$q%'order by airport asc") or die (mysql_error());
while(list($id, $kode_airport,$airport) = mysql_fetch_row($query)){
	echo "$airport \n";
}
?>