<?php session_start(); require_once('../connections/con_gl.php'); ?>
<?php

$bar = $_GET['barang'];
$kid = $_GET['kid'];
$jum = intval($_GET['jumlah']); 
if($jum == 0) $jum = 1;
// get kendaraan
mysql_select_db($database_con_gl, $con_gl);
$query_harga = "select a.hargasewa from gl_jenbar a where a.barang = '$bar' and a.area = '$_SESSION[area]' and a.jenis = (select tipekendaraan from gl_masterkendaraan where nopolisi ='$kid')"; 
//print_r($query_harga);
//echo $query_harga;

$harga       = mysql_query($query_harga, $con_gl) or die(mysql_error());
$row_harga   = mysql_fetch_assoc($harga);
$total_harga = mysql_num_rows($harga);

?>
<input name="hargasatuan" type="text" id="hargasatuan" readonly="readonly" onchange="javascript:this.form.total.value=(this.form.jumlah.value * this.form.hargasatuan.value) - (this.form.jumlah.value * this.form.hargasatuan.value * this.form.diskon.value / 100);  " value="<?php echo ($row_harga['hargasewa'] * $jum); ?>" size="20" maxlength="10" style="text-align:right;"/><input name="xharga" type="hidden" id="xharga" value="<?php echo $row_harga['hargasewa'];?>" onchange="javascript:this.form.hargasatuansebelum.value = this.form.xharga.value"/>