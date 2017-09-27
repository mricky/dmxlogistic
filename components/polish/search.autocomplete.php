<?php /*Added by suwondo */ ?>
<?php include ('../../connections/con_gl.php'); ?>
<?php
$q = strtolower($_GET["q"]);
if (!$q) return;

mysql_select_db($database_con_gl, $con_gl);
$query = mysql_query("select id, merk from gl_merkkendaraan where merk like '%$q%'order by merk asc") or die (mysql_error());
while(list($id, $jenis) = mysql_fetch_row($query)){
	echo "$jenis \n";
}
?>