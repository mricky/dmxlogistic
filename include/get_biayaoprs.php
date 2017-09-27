<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);

//Tangkap parameter
$bar = $_GET['barang'];
$kid = $_GET['kid'];

$query_biaya = "select a.hargasewa, a.supir, a.bbm, a.tol, a.parkir, a.akomod, a.other from gl_jenbar as a inner join gl_tipekendaraan as b on (a.jenis = b.id) inner join gl_masterkendaraan as c on (b.id = c.tipekendaraan) where a.barang='$bar' AND c.nopolisi='$kid'";
$biaya = mysql_query($query_biaya) or die (mysql_error());
$row_biaya = mysql_fetch_assoc($biaya);
$hargasewa = $row_biaya['hargasewa'];
$supir = $row_biaya['supir'];
$bbm = $row_biaya['bbm'];
$tol = $row_biaya['tol'];
$parkir = $row_biaya['parkir'];
$akomod = $row_biaya['akomod'];
$other = $row_biaya['other'];
$totalbiaya=$hargasewa+$supir+$bbm+$tol+$parkir+$akomod+$other;
echo $totalbiaya;
?>