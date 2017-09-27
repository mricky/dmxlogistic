<?php 
//session_start();
 require_once('../connections/con_gl.php'); ?>

<?php

$bar = $_GET['barang'];

$kid = $_GET['kid'];

$jum = intval($_GET['jumlah']);

$diskon = intval($_GET['diskon']);

$ppn = intval($_GET['ppn']);

$pph = intval($_GET['pph']);

$jumlahhari = intval($_GET['jumlah']);

//$pph = intval($_GET['pph']);

$uangmuka = intval($_GET['uangmuka']);

// get kendaraan

mysql_select_db($database_con_gl, $con_gl);

$query_harga = "select a.hargasewa, a.supir, a.bbm, a.tol, a.parkir, a.akomod, a.other from gl_jenbar as a where a.barang = '$bar' and a.area = '$_SESSION[area]' and a.jenis = (select tipekendaraan from gl_masterkendaraan where nopolisi ='$kid')"; //echo $query_harga;

//printf($query_harga);



$harga       = mysql_query($query_harga, $con_gl) or die(mysql_error());

list($hargasewa, $supir, $bbm, $tol, $parkir, $akomod, $other)   = mysql_fetch_row($harga);

$harga = $hargasewa*$jumlahhari;

$diskonval = $harga * ($diskon/100);

$afterdiskon = $harga - $diskonval;

$ppnval = $harga * ($ppn/100);

$pphval = $harga * ($pph/100);

//$pphval = $hargasewa * ($pph/100);

$totalbiaya = $supir + $bbm + $tol + $parkir + $akomod + $other;

$grandtotal =  $afterdiskon + $ppnval + $totalbiaya - $pphval;

//$afterdiskon + $ppnval + $totalbiaya - $uangmuka;

?>

<input name="ntotal" type="text" id="ntotal" value="<?php echo $grandtotal; ?>" size="20" maxlength="10" onfocus="javascript: this.blur();" style="text-align:right;" />