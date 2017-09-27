<?php /*Added by suwondo */ ?>
<?php include ('../../connections/con_gl.php'); ?>
<?php
$q = strtolower($_GET["q"]);
if (!$q) return;

mysql_select_db($database_con_gl, $con_gl);
$query = mysql_query("select kota_id,kota_name,prov_name from view_kota where kota_name like '%$q%'") or die (mysql_error());
while(list($id, $kota,$provinsi) = mysql_fetch_row($query)){
	echo "$kota \n";
}
?>