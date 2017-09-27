<?php /*Added by suwondo */ ?>
<?php include ('../../connections/con_gl.php'); ?>
<?php
$q = strtolower($_GET["q"]);
if (!$q) return;

mysql_select_db($database_con_gl, $con_gl);
$query = mysql_query("select id, gudang from gl_gudang where area = '$_GET[area]' AND gudang like '%$q%'order by gudang asc") or die (mysql_error());
while(list($id, $jenis) = mysql_fetch_row($query)){
	echo "$jenis \n";
}
?>