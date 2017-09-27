<?php /*Added by suwondo */ ?>
<?php include ('../../connections/con_gl.php'); ?>
<?php
$q = strtolower($_GET["q"]);
if (!$q) return;

mysql_select_db($database_con_gl, $con_gl);
$query = mysql_query("select IDLAYANAN,KODELAYANAN,NAMALAYANAN from layanan where NAMALAYANAN like '%$q%'") or die (mysql_error());
while(list($id, $kodelayanan, $namalayanan) = mysql_fetch_row($query)){
	echo "$namalayanan \n";
}
?>