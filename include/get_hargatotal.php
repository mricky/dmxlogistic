<?php 
//session_start(); 
require_once('../connections/con_gl.php'); ?>

<?php

$bar = $_GET['barang'];

$kid = $_GET['kid'];

$jum = intval($_GET['jumlah']);

// get kendaraan

mysql_select_db($database_con_gl, $con_gl);

$query_harga = "select a.hargasewa, a.supir, a.bbm, a.tol, a.parkir, a.akomod, a.other from gl_jenbar as a where a.barang = '$bar' and a.area = '$_SESSION[area]' and a.jenis = (select tipekendaraan from gl_masterkendaraan where nopolisi ='$kid')"; //echo $query_harga;



$harga       = mysql_query($query_harga, $con_gl) or die(mysql_error());

list($hargasewa, $supir, $bbm, $tol, $parkir, $akomod, $other)   = mysql_fetch_row($harga);

$totalbiaya = $supir + $bbm + $tol + $parkir + $akomod + $other;

?>

<input name="biaya" type="text" id="biaya" value="<?php echo $totalbiaya; ?>" size="20" onchange="javascript:this.form.ntotal.value = (2*this.form.xntotal.value) - this.form.xntotal.value + (2*this.form.biaya.value) - this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;this.form.saldohutang.value=this.form.ntotal.value-this.form.bayar.value;" onfocus="this.blur();" style="text-align:right;"/>

<input type="hidden" name="xbiaya" id="xbiaya" value="<?php echo $totalbiaya; ?>" />