<?php require_once('../connections/con_gl.php'); ?>
<?php
$t = $_GET['t'];
$q = $_GET['q'];
$n = $_GET['noref'];
$r = intval($_GET['replace']);
mysql_select_db($database_con_gl, $con_gl);
echo "<select name='kendaraan' id='kendaraan'><option value=''>Pilih Kendaraan</option>";
$query = mysql_query("SELECT a.nopolisi, b.tipekendaraan, a.tahun, a.tersedia, c.kendaraan from gl_masterkendaraan a, gl_tipekendaraan b, gl_rtrans c where c.kendaraan=a.nopolisi AND a.tipekendaraan = b.id AND a.tersedia='1' and c.no_ref = '$n' order by b.tipekendaraan, a.nopolisi asc") or die (mysql_error());
while(list($nopolisi, $tipekendaraan, $tahun, $ready, $desc, $kend) = mysql_fetch_row($query)){
	echo "<option value='$nopolisi'>$tipe, $tahun - ($nopolisi)</option>";
}
echo "</option>";