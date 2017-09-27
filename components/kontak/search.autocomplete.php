<?php /*Added by suwondo */ ?>
<?php include ('../../connections/con_gl.php'); ?>
<?php
$q = strtolower($_GET["q"]);
if (!$q) return;

mysql_select_db($database_con_gl, $con_gl);

$query_data = "SELECT id, nama, alamat, tlp FROM gl_kontak WHERE true ";

$query_data .=" AND (nama like '%$q%' OR alamat like '%$q%' OR tlp like '%$q%')";

if(isset($_GET[cr_kel]) AND $_GET[cr_kel]<>'ALL') { 
$query_data .=" AND tlp ='$_GET[cr_kel]'";
}
$query_data .=" ORDER BY nama ASC";

$data = mysql_query($query_data, $con_gl) or die(mysql_error());
while($result = mysql_fetch_assoc($data)){
	echo "$result[nama] - $result[alamat] - $result[tlp] \n";
}
?>